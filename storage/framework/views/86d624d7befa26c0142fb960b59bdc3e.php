<?php $__env->startSection('content'); ?>
    <div class="max-w-3xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Edit Customer: <?php echo e($customer->name); ?></h1>
            <a href="<?php echo e(route('admin.customers.index')); ?>" class="text-sm text-gray-600 hover:underline">
                ← Kembali
            </a>
        </div>

        <form method="POST" action="<?php echo e(route('admin.customers.update', $customer->id)); ?>"
            class="bg-white p-6 rounded-xl shadow space-y-4">
            <?php echo method_field('PUT'); ?>
            <?php echo $__env->make('admin.customers._form', ['customer' => $customer], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="border-t pt-4 mt-4">
                <h3 class="text-xl font-semibold mt-2 mb-2 text-gray-900">Special Price per Produk</h3>

                <table class="w-full bg-slate-900 rounded text-sm">
                    <tr class="border-b border-slate-700 text-slate-300">
                        <th class="p-2 text-left">Produk</th>
                        <th class="p-2 text-left">Price / m²</th>
                        <th class="p-2 text-left">Flat Price</th>
                    </tr>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $sp = $customer->specialPrices->firstWhere('product_id', $product->id);
                        ?>
                        <tr class="border-b border-slate-800">
                            <td class="p-2 text-white"><?php echo e($product->name); ?></td>
                            <td class="p-2">
                                <input type="number" name="special[<?php echo e($product->id); ?>][price_per_m2]"
                                    value="<?php echo e($sp->price_per_m2 ?? ''); ?>"
                                    class="w-full bg-slate-800 border-slate-600 rounded px-2 py-1 text-white">
                            </td>
                            <td class="p-2">
                                <input type="number" name="special[<?php echo e($product->id); ?>][flat_price]"
                                    value="<?php echo e($sp->flat_price ?? ''); ?>"
                                    class="w-full bg-slate-800 border-slate-600 rounded px-2 py-1 text-white">
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>

            <div class="pt-4 flex justify-end gap-2">
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="px-4 py-2 text-sm rounded-lg border">Batal</a>
                <button class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/customers/edit.blade.php ENDPATH**/ ?>