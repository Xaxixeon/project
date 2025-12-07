<?php if (isset($component)) { $__componentOriginal7651faf8e4a1e278424aad70c82de3ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h2 class="text-2xl font-bold mb-4 text-white">Invoices</h2>

    <table class="w-full bg-slate-900 rounded text-sm">
        <tr class="border-b border-slate-700 text-slate-300">
            <th class="p-2 text-left">Invoice #</th>
            <th class="p-2 text-left">Order #</th>
            <th class="p-2 text-left">Customer</th>
            <th class="p-2 text-right">Amount</th>
            <th class="p-2 text-center">Status</th>
            <th class="p-2 text-center">Action</th>
        </tr>

        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b border-slate-800">
                <td class="p-2"><?php echo e($inv->invoice_no); ?></td>
                <td class="p-2">#<?php echo e($inv->order_id); ?></td>
                <td class="p-2">
                    <?php echo e($inv->order?->customer?->name ?? $inv->order?->customer_name ?? '-'); ?>

                </td>
                <td class="p-2 text-right">
                    Rp <?php echo e(number_format($inv->amount)); ?>

                </td>
                <td class="p-2 text-center">
                    <?php if($inv->status === 'paid'): ?>
                        <span class="px-2 py-1 rounded text-xs bg-emerald-600 text-white">PAID</span>
                    <?php elseif($inv->status === 'partial'): ?>
                        <span class="px-2 py-1 rounded text-xs bg-amber-500 text-white">PARTIAL</span>
                    <?php else: ?>
                        <span class="px-2 py-1 rounded text-xs bg-red-600 text-white">UNPAID</span>
                    <?php endif; ?>
                </td>
                <td class="p-2 text-center">
                    <a href="<?php echo e(route('invoices.show', $inv)); ?>"
                       class="text-xs px-3 py-1 rounded bg-slate-700 hover:bg-slate-600">
                        Detail
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <div class="mt-4">
        <?php echo e($invoices->links()); ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7651faf8e4a1e278424aad70c82de3ba)): ?>
<?php $attributes = $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba; ?>
<?php unset($__attributesOriginal7651faf8e4a1e278424aad70c82de3ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7651faf8e4a1e278424aad70c82de3ba)): ?>
<?php $component = $__componentOriginal7651faf8e4a1e278424aad70c82de3ba; ?>
<?php unset($__componentOriginal7651faf8e4a1e278424aad70c82de3ba); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/invoices/index.blade.php ENDPATH**/ ?>