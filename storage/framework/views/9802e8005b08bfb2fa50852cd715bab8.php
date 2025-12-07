

<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold mb-6">Edit Member Type</h1>

    <form action="<?php echo e(route('admin.member.update', $memberType->id)); ?>" method="POST"
        class="bg-white p-6 rounded-xl shadow space-y-4">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div>
            <label class="font-semibold">Kode</label>
            <input type="text" name="code" value="<?php echo e($memberType->code); ?>" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="font-semibold">Nama / Label</label>
            <input type="text" name="name" value="<?php echo e($memberType->name ?? $memberType->label); ?>" class="w-full border p-2 rounded"
                required>
            <input type="text" name="label" value="<?php echo e($memberType->label); ?>" class="w-full border p-2 rounded mt-2"
                placeholder="Label (opsional)">
        </div>

        <div>
            <label class="font-semibold">Diskon (%)</label>
            <input type="number" name="discount_percent" value="<?php echo e($memberType->discount_percent ?? $memberType->default_discount); ?>"
                class="w-full border p-2 rounded" min="0" max="100">
        </div>

        <div>
            <label class="font-semibold">Deskripsi</label>
            <textarea name="description" class="w-full border p-2 rounded" rows="3"><?php echo e($memberType->description); ?></textarea>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/member/edit.blade.php ENDPATH**/ ?>