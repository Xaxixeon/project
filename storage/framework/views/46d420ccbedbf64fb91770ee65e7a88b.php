

<?php $__env->startSection('content'); ?>
    <div class="max-w-3xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Tambah Staff</h1>
            <a href="<?php echo e(route('admin.staff.index')); ?>" class="text-sm text-gray-600 hover:underline">
                ← Kembali
            </a>
        </div>

        <form method="POST" action="<?php echo e(route('admin.staff.store')); ?>" class="bg-white p-6 rounded-xl shadow space-y-4">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Kode Staff (ID Karyawan)</label>
                    <input type="text" name="staff_code" value="<?php echo e(old('staff_code')); ?>"
                        class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="contoh: 0001021">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                        class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Username</label>
                    <input type="text" name="username" value="<?php echo e(old('username')); ?>" required
                        class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                        class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2 text-sm">
                    <p class="text-xs text-gray-500 mt-1">
                        Bisa di-set default seperti <code>password</code>, nanti staff diminta ganti.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Role</label>
                <select name="role" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($role->name); ?>">
                            <?php echo e(ucfirst(str_replace('_', ' ', $role->name))); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Status</label>
                <select name="is_active" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="pt-4 flex justify-end gap-2">
                <a href="<?php echo e(route('admin.staff.index')); ?>" class="px-4 py-2 text-sm rounded-lg border">Batal</a>
                <button class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white">
                    Simpan Staff
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/staff/create.blade.php ENDPATH**/ ?>