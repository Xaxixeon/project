<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductAddon;
use App\Models\PrintingFinishing;
use App\Models\PrintingMaterial;
use App\Models\User;
use App\Models\Customer;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer.instansi', 'designer']);

        if ($request->search) {
            $q = "%{$request->search}%";
            $query->where('order_code', 'like', $q)
                  ->orWhereHas('customer', fn($c) => $c->where('name', 'like', $q));
        }

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->payment_method && $request->payment_method !== 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->date_start) {
            $query->whereDate('created_at', '>=', $request->date_start);
        }

        if ($request->date_end) {
            $query->whereDate('created_at', '<=', $request->date_end);
        }

        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->designer_id) {
            $query->where('designer_id', $request->designer_id);
        }

        return view('orders.index', [
            'orders'    => $query->latest()->paginate(20),
            'customers' => Customer::orderBy('name')->get(),
            'designers' => User::whereHas('roles', fn($q) => $q->where('name', 'designer'))->get(),
        ]);
    }

    public function store(Request $request)
    {
        // Customer portal flow with variants/addons
        if (Auth::guard('customer')->check() && $request->has('variant_id')) {
            $data = $request->validate([
                'product_id'  => 'required|integer|exists:products,id',
                'variant_id'  => 'required|integer|exists:product_variants,id',
                'addon_ids'   => 'array',
                'addon_ids.*' => 'integer|exists:product_addons,id',
                'qty'         => 'required|integer|min:1',
                'width_cm'    => 'nullable|numeric|min:0',
                'height_cm'   => 'nullable|numeric|min:0',
                'notes'       => 'nullable|string',
            ]);

            /** @var \App\Models\Customer $customer */
            $customer = auth('customer')->user();
            $variant = ProductVariant::with('product')->findOrFail($data['variant_id']);
            $product = $variant->product;
            $addons = collect($data['addon_ids'] ?? [])
                ->unique()
                ->values()
                ->map(fn($id) => ProductAddon::findOrFail($id));

            $qty    = $data['qty'];
            $width  = $data['width_cm'] ?? 0;
            $height = $data['height_cm'] ?? 0;

            $unitPrice = $variant->priceForCustomer($customer);

            if ($width > 0 && $height > 0) {
                $areaM2 = ($width * $height) / 10000;
                $baseSubtotal = $unitPrice * $areaM2 * $qty;
                $baseCost     = $variant->cost  * $areaM2 * $qty;
            } else {
                $areaM2 = null;
                $baseSubtotal = $unitPrice * $qty;
                $baseCost     = $variant->cost  * $qty;
            }

            $addonSubtotal = 0;
            $addonCost     = 0;
            foreach ($addons as $addon) {
                $addonSubtotal += $addon->extra_price * $qty;
                $addonCost     += $addon->extra_cost  * $qty;
            }

            $totalPrice = (int) round($baseSubtotal + $addonSubtotal);
            $totalCost  = (int) round($baseCost + $addonCost);
            $profit     = $totalPrice - $totalCost;

            DB::beginTransaction();
            try {
                $order = Order::create([
                    'order_code'  => 'ORD-' . strtoupper(Str::random(8)),
                    'customer_id' => $customer->id,
                    'user_id'     => null,
                    'subtotal'    => $totalPrice,
                    'shipping'    => 0,
                    'discount'    => 0,
                    'total'       => $totalPrice,
                    'status'      => 'pending',
                    'notes'       => $data['notes'] ?? null,
                    'meta'        => null,
                    'width_cm'    => $width ?: null,
                    'height_cm'   => $height ?: null,
                    'area_m2'     => $areaM2 ? (int) round($areaM2 * 100) : null,
                    'total_price' => $totalPrice,
                    'total_cost'  => $totalCost,
                    'profit'      => $profit,
                ]);

                $attrs = [
                    'variant_id'    => $variant->id,
                'variant_label' => $variant->label,
                'addon_ids'     => $addons->pluck('id')->all(),
                'width_cm'      => $width ?: null,
                'height_cm'     => $height ?: null,
            ];

                $order->items()->create([
                    'product_id' => $product->id,
                    'name'       => $product->name,
                    'attributes' => $attrs,
                    'qty'        => $qty,
                    'price'      => $unitPrice,
                    'subtotal'   => $totalPrice,
                    'note'       => $data['notes'] ?? null,
                ]);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                report($e);
                return back()->withErrors('Gagal membuat order: '.$e->getMessage());
            }

            return redirect()->route('orders.thanks', $order->id);
        }

        // Old customer flow with materials/finishing
        if (Auth::guard('customer')->check() && $request->has('product_id')) {
            $data = $request->validate([
                'product_id'            => 'required|exists:products,id',
                'quantity'              => 'required|integer|min:1',
                'size'                  => 'required|string|max:100',
                'width_cm'              => 'nullable|integer|min:1',
                'height_cm'             => 'nullable|integer|min:1',
                'printing_material_id'  => 'required|exists:printing_materials,id',
                'printing_finishing_id' => 'nullable|exists:printing_finishings,id',
                'notes'                 => 'nullable|string',
                'design_file'           => 'nullable|file|max:20480',
            ]);

            /** @var \App\Models\Customer $customer */
            $customer = auth('customer')->user();
            $product  = Product::findOrFail($data['product_id']);
            $material = PrintingMaterial::find($data['printing_material_id']);
            $finishing = !empty($data['printing_finishing_id'])
                ? PrintingFinishing::find($data['printing_finishing_id'])
                : null;

            $sizePresets = [
                'A3'            => 25,
                'A4'            => 16,
                'A5'            => 8,
                'Banner 60x160' => 96,
                'Custom'        => null,
            ];

            if ($data['size'] !== 'Custom') {
                $areaX100 = $sizePresets[$data['size']] ?? 100;
            } else {
                $w = $data['width_cm'] ?? 0;
                $h = $data['height_cm'] ?? 0;
                $areaM2 = ($w * $h) / 10000;
                $areaX100 = (int) round($areaM2 * 100);
            }

            $areaM2 = $areaX100 / 100;
            $qty    = $data['quantity'];

            $pricing = PricingService::calculate($product, $customer, $areaM2, $qty);
            $totalPrice = (int) $pricing['total'];

            $materialCost = ($material?->cost_per_m2 ?? 0) * $areaM2 * $qty;
            $finishingCost = 0;
            if ($finishing) {
                $finishingCost = (($finishing->cost_per_m2 ?? 0) * $areaM2 * $qty)
                    + ($finishing->cost_flat ?? 0);
            }
            $otherCost = 0;
            $totalCost = (int) round($materialCost + $finishingCost + $otherCost);
            $profit = $totalPrice - $totalCost;

            $filePath = null;
            if ($request->hasFile('design_file')) {
                $filePath = $request->file('design_file')->store('designs');
            }

            $order = Order::create([
                'order_code'            => 'ORD-' . strtoupper(Str::random(8)),
                'customer_id'           => $customer->id,
                'user_id'               => null,
                'subtotal'              => $totalPrice,
                'shipping'              => 0,
                'discount'              => 0,
                'total'                 => $totalPrice,
                'status'                => 'pending',
                'notes'                 => $data['notes'] ?? null,
                'meta'                  => null,
                'size'                  => $data['size'],
                'width_cm'              => $data['width_cm'] ?? null,
                'height_cm'             => $data['height_cm'] ?? null,
                'area_m2'               => $areaX100,
                'printing_material_id'  => $data['printing_material_id'],
                'printing_finishing_id' => $data['printing_finishing_id'] ?? null,
                'total_price'           => $totalPrice,
                'material_cost'         => $materialCost,
                'finishing_cost'        => $finishingCost,
                'other_cost'            => $otherCost,
                'total_cost'            => $totalCost,
                'profit'                => $profit,
            ]);

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'name'       => $product->name,
                'attributes' => [
                    'size'      => $data['size'],
                    'width_cm'  => $data['width_cm'] ?? null,
                    'height_cm' => $data['height_cm'] ?? null,
                    'material'  => $data['printing_material_id'],
                    'finishing' => $data['printing_finishing_id'] ?? null,
                ],
                'qty'        => $qty,
                'price'      => $totalPrice / $qty,
                'subtotal'   => $totalPrice,
                'design_file'=> $filePath,
                'note'       => $data['notes'] ?? null,
            ]);

            return redirect()->route('orders.thanks', $order->id);
        }

        $data = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'shipping' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',

            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.attributes' => 'nullable|array',
            'items.*.design_file' => 'nullable|string',
            'items.*.note' => 'nullable|string',
        ]);

        $pricing = config('pricing');
        $customerModel = null;
        if (!empty($data['customer_id'])) {
            $customerModel = Customer::with('memberType')->find($data['customer_id']);
        } elseif (Auth::guard('customer')->check()) {
            $customerModel = Auth::guard('customer')->user();
            $customerModel->loadMissing('memberType');
        }

        DB::beginTransaction();

        try {
            $subtotal = 0;
            $materialCostTotal = 0;
            $finishingCostTotal = 0;
            $otherCostTotal = 0;

            $order = Order::create([
                'order_code' => 'ORD-' . strtoupper(Str::random(8)),
                'customer_id' => $data['customer_id'] ?? null,
                'user_id' => Auth::id(),
                'subtotal' => 0,
                'shipping' => $data['shipping'] ?? 0,
                'discount' => $data['discount'] ?? 0,
                'total' => 0,
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
                'meta' => null,
            ]);

            foreach ($data['items'] as $it) {
                $product = Product::find($it['product_id']);
                $qty = (int) $it['qty'];
                $attrs = $it['attributes'] ?? [];
                $areaM2 = 1;
                $materialModel = null;
                $finishingModel = null;

                $materialId = $attrs['printing_material_id'] ?? $attrs['material_id'] ?? $attrs['material'] ?? null;
                if (is_numeric($materialId)) {
                    $materialModel = PrintingMaterial::find($materialId);
                }

                $finishingId = $attrs['printing_finishing_id'] ?? $attrs['finishing_id'] ?? $attrs['finishing'] ?? null;
                if (is_numeric($finishingId)) {
                    $finishingModel = PrintingFinishing::find($finishingId);
                }

                if (!empty($attrs['width']) && !empty($attrs['height'])) {
                    $w = (float) $attrs['width'];
                    $h = (float) $attrs['height'];

                    if (($pricing['area']['unit'] ?? 'mm') === 'mm') {
                        $areaM2 = ($w * $h) / 1_000_000;
                    } else {
                        $areaM2 = ($w * $h) / 10_000;
                    }

                    $minimum = $pricing['area']['minimum_m2'] ?? 0;
                    if ($minimum > 0 && $areaM2 < $minimum) {
                        $areaM2 = $minimum;
                    }
                }

                if ($customerModel) {
                    $pricingResult = PricingService::calculate($product, $customerModel, $areaM2, $qty);
                    $price = $pricingResult['total'] / $qty;
                    $flatPrice = 0;
                } else {
                    $price = (float) $product->base_price;
                    if (!empty($attrs['width']) && !empty($attrs['height'])) {
                        $price *= $areaM2;
                    }
                    $flatPrice = 0;
                }

                // Color count pricing
                if (!empty($attrs['colors']) && isset($pricing['colors'][$attrs['colors']])) {
                    $price *= $pricing['colors'][$attrs['colors']];
                }

                // Material & thickness
                if (!empty($attrs['material']) && isset($pricing['materials'][$attrs['material']])) {
                    $price *= $pricing['materials'][$attrs['material']];
                }

                if (!empty($attrs['thickness']) && isset($pricing['thickness'][$attrs['thickness']])) {
                    $price *= $pricing['thickness'][$attrs['thickness']];
                }

                // Deadline
                if (!empty($attrs['deadline']) && isset($pricing['deadline'][$attrs['deadline']])) {
                    $price *= $pricing['deadline'][$attrs['deadline']];
                }

                // Finishing options
                if (!empty($attrs['finishing'])) {
                    foreach ($attrs['finishing'] as $fin) {
                        if (isset($pricing['finishing'][$fin])) {
                            $price *= $pricing['finishing'][$fin];
                        }
                    }
                }

                // Tier pricing by qty
                foreach ($pricing['tiers'] as $tierRule) {
                    if ($qty >= $tierRule['qty_min']) {
                        $price *= $tierRule['modifier'];
                    }
                }

                // Package discounts
                if (!empty($attrs['package']) && isset($pricing['packages'][$attrs['package']])) {
                    $pkg = $pricing['packages'][$attrs['package']];

                    if ($qty >= $pkg['minimum_qty']) {
                        $price *= (1 - $pkg['discount_percentage'] / 100);
                    }
                }

                $materialCost = ($materialModel?->cost_per_m2 ?? 0) * $areaM2 * $qty;
                $finishingCost = 0;
                if ($finishingModel) {
                    $finishingCost = (($finishingModel->cost_per_m2 ?? 0) * $areaM2 * $qty)
                        + ($finishingModel->cost_flat ?? 0);
                }
                $otherCost = 0;

                $itemSubtotal = ($price * $qty) + $flatPrice;
                $subtotal += $itemSubtotal;
                $materialCostTotal += $materialCost;
                $finishingCostTotal += $finishingCost;
                $otherCostTotal += $otherCost;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'attributes' => $attrs,
                    'qty' => $qty,
                    'price' => round($price, 2),
                    'subtotal' => round($itemSubtotal, 2),
                    'design_file' => $it['design_file'] ?? null,
                    'note' => $it['note'] ?? null,
                ]);
            }

            $order->subtotal = round($subtotal, 2);

            $grossTotal = $order->subtotal + $order->shipping - $order->discount;

            $customer = null;
            $order->total = round($grossTotal, 2);
            if (Schema::hasColumn('orders', 'total_price')) {
                $order->total_price = (int) round($grossTotal);
            }

            $totalCost = (int) round($materialCostTotal + $finishingCostTotal + $otherCostTotal);
            $order->material_cost = (int) round($materialCostTotal);
            $order->finishing_cost = (int) round($finishingCostTotal);
            $order->other_cost = (int) round($otherCostTotal);
            $order->total_cost = $totalCost;
            $order->profit = (int) round(($order->total_price ?? $order->total) - $totalCost);

            $order->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'total' => $order->total,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Order $order)
    {
        $order->load([
            'customer.instansi',
            'designer',
            'items.product',
            'logs.user',
            'files',
            'chats',
            'invoice',
            'qcChecks',
            'operations.staff',
        ]);

        $workflowSteps = [
            'pending'     => 'Order Masuk',
            'assigned'    => 'Assigned ke Designer',
            'designing'   => 'Desain Dikerjakan',
            'design_done' => 'Desain Selesai',
            'production'  => 'Produksi Dimulai',
            'printing'    => 'Printing',
            'finishing'   => 'Finishing',
            'ready'       => 'Siap Dibayar',
            'paid'        => 'Sudah Dibayar',
            'packing'     => 'Packing',
            'shipping'    => 'Pengiriman',
            'completed'   => 'Selesai',
        ];

        return view('orders.show', [
            'order' => $order,
            'workflowSteps' => $workflowSteps,
        ]);
    }

    public function estimate(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.attributes' => 'nullable|array',
        ]);

        $items = $data['items'];
        $total = 0;
        $unitPrice = 0;
        $customer = auth('customer')->user();

        foreach ($items as $it) {
            $product = Product::find($it['product_id']);
            $qty = $it['qty'];
            $attrs = $it['attributes'] ?? [];

            $tier = $product->priceForTier($customer?->member_type_id);
            $pricePerM2 = (float) ($tier['price_per_m2'] ?? $product->base_price);
            $flatPrice = (float) ($tier['flat_price'] ?? 0);
            $price = $pricePerM2;
            $area = 1;

            if (!empty($attrs['width']) && !empty($attrs['height'])) {
                if ((config('pricing.area.unit', 'mm')) === 'mm') {
                    $area = ($attrs['width'] * $attrs['height']) / 1_000_000;
                } else {
                    $area = ($attrs['width'] * $attrs['height']) / 10_000;
                }

                $min = config('pricing.area.minimum_m2', 0.2);
                if ($area < $min) {
                    $area = $min;
                }
                $price = $pricePerM2 * $area;
            }

            if (!empty($attrs['material']) && isset(config('pricing.materials')[$attrs['material']])) {
                $price *= config('pricing.materials')[$attrs['material']];
            }

            if (!empty($attrs['finishing']) && is_array($attrs['finishing'])) {
                foreach ($attrs['finishing'] as $fin) {
                    if (isset(config('pricing.finishing')[$fin])) {
                        $price *= config('pricing.finishing')[$fin];
                    }
                }
            }

            // TODO: add color, thickness, deadline, tiers, package etc. same as OrderController

            $itemSubtotal = ($price * $qty) + $flatPrice;
            $total += $itemSubtotal;
            $unitPrice = $price + $flatPrice;
        }

        return response()->json([
            'success' => true,
            'estimate' => [
                'unit_price' => round($unitPrice, 2),
                'total' => round($total, 2),
            ],
        ]);
    }

    /**
     * Update status (kanban drag/drop).
     */
    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $prev = $order->order_status ?? $order->status;
        $order->order_status = $data['status'];
        $order->status = $data['status'];
        $order->save();

        return response()->json([
            'success' => true,
            'previous' => $prev,
            'new' => $data['status'],
        ]);
    }
}
