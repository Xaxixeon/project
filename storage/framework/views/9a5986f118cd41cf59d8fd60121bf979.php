<?php $__env->startSection('content'); ?>
    <div class="max-w-3xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Edit Staff: <?php echo e($staff->name); ?></h1>
            <a href="<?php echo e(route('admin.staff.index')); ?>" class="text-sm text-slate-600 dark:text-slate-300 hover:underline">
                ← Kembali
            </a>
        </div>

        <form method="POST" action="<?php echo e(route('admin.staff.update', $staff->id)); ?>"
              class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700 p-6 rounded-xl shadow space-y-4">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Kode Staff</label>
                    <input type="text" name="staff_code" value="<?php echo e(old('staff_code', $staff->staff_code)); ?>"
                           class="w-full border rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-700 text-slate-800 dark:text-slate-100">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $staff->name)); ?>" required
                           class="w-full border rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-700 text-slate-800 dark:text-slate-100">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Username</label>
                    <input type="text" name="username" value="<?php echo e(old('username', $staff->username)); ?>" required
                           class="w-full border rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-700 text-slate-800 dark:text-slate-100">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $staff->email)); ?>" required
                           class="w-full border rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-700 text-slate-800 dark:text-slate-100">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Role</label>
                <select name="role" class="w-full border rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-700 text-slate-800 dark:text-slate-100">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($role->name); ?>" <?php if($staff->roles->pluck('name')->contains($role->name)): echo 'selected'; endif; ?>>
                            <?php echo e(ucfirst(str_replace('_', ' ', $role->name))); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Status</label>
                <select name="is_active" class="w-full border rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-700 text-slate-800 dark:text-slate-100">
                    <option value="1" <?php if($staff->is_active ?? true): echo 'selected'; endif; ?>>Aktif</option>
                    <option value="0" <?php if(!($staff->is_active ?? true)): echo 'selected'; endif; ?>>Nonaktif</option>
                </select>
            </div>

            <div class="border-t border-gray-200 dark:border-slate-700 pt-4 mt-4">
                <label class="block text-sm font-semibold mb-1 text-slate-700 dark:text-slate-200">Reset Password (opsional)</label>
                <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 text-sm bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-700 text-slate-800 dark:text-slate-100"
                       placeholder="Kosongkan jika tidak diubah">
            </div>

            <div class="pt-4 flex justify-end gap-2">
                <a href="<?php echo e(route('admin.staff.index')); ?>" class="px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-slate-700 text-slate-700 dark:text-slate-200">Batal</a>
                <button class="px-4 py-2 text-sm rounded-lg bg-blue-600 hover:bg-blue-500 text-white">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/staff/edit.blade.php ENDPATH**/ ?>