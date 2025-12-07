

<?php $__env->startSection('content'); ?>
    <div class="p-6 space-y-6 text-slate-100">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <p class="text-xs text-slate-400">Customer Pricing</p>
                <h1 class="text-2xl font-bold">
                    Harga Customer: <?php echo e($customer->name); ?>

                </h1>
            </div>

            <a href="<?php echo e(route('admin.pricing.index')); ?>"
               class="px-4 py-2 rounded-lg bg-slate-800 border border-slate-600 text-sm hover:bg-slate-700">
                Kembali
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow p-4">
            <form action="<?php echo e(route('admin.pricing.customer.update', $customer)); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>

                <?php echo $__env->make('admin.pricing.components.price-table', [
                    'products' => $products,
                    'prices' => $prices ?? $specials ?? [],
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <div class="flex justify-end">
                    <button class="px-5 py-2 rounded-full bg-sky-600 text-sm font-semibold text-white hover:bg-sky-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/pricing/customer.blade.php ENDPATH**/ ?>