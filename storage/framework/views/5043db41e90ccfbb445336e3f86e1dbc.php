

<?php $__env->startSection('content'); ?>
    <div class="max-w-3xl mx-auto space-y-6">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Tambah Customer</h1>
            <a href="<?php echo e(route('admin.customers.index')); ?>" class="text-sm text-gray-600 hover:underline">
                ← Kembali
            </a>
        </div>

        <form method="POST" action="<?php echo e(route('admin.customers.store')); ?>" class="bg-white p-6 rounded-xl shadow space-y-4">
            <?php echo $__env->make('admin.customers._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="pt-4 flex justify-end gap-2">
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="px-4 py-2 text-sm rounded-lg border">Batal</a>
                <button class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white">
                    Simpan Customer
                </button>
            </div>
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/customers/create.blade.php ENDPATH**/ ?>