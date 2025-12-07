

<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold mb-6">Edit Instansi</h1>

    <form class="bg-white p-6 shadow rounded-xl space-y-4" action="<?php echo e(route('admin.instansi.update', $instansi->id)); ?>"
        method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div>
            <label class="block mb-1 font-semibold">Nama Instansi</label>
            <input type="text" name="name" value="<?php echo e($instansi->name); ?>" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Kontak</label>
            <input type="text" name="contact" value="<?php echo e($instansi->contact); ?>" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Alamat</label>
            <textarea name="address" class="w-full border p-2 rounded"><?php echo e($instansi->address); ?></textarea>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded-md">
            Update
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/instansi/edit.blade.php ENDPATH**/ ?>