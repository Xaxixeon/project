<?php echo csrf_field(); ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold mb-1">Kode Customer</label>
        <input type="text" name="customer_code" value="<?php echo e(old('customer_code', $customer->customer_code ?? '')); ?>"
            class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Opsional, bisa otomatis">
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Nama</label>
        <input type="text" name="name" value="<?php echo e(old('name', $customer->name ?? '')); ?>" required
            class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">No HP</label>
        <input type="text" name="phone" value="<?php echo e(old('phone', $customer->phone ?? '')); ?>" required
            class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Email (opsional)</label>
        <input type="email" name="email" value="<?php echo e(old('email', $customer->email ?? '')); ?>"
            class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>
</div>

<div>
    <label class="block text-sm font-semibold mb-1">Alamat (opsional)</label>
    <textarea name="address" class="w-full border rounded-lg px-3 py-2 text-sm" rows="2"><?php echo e(old('address', $customer->address ?? '')); ?></textarea>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold mb-1">Instansi</label>
        <select name="instansi_id" class="w-full border rounded-lg px-3 py-2 text-sm">
            <option value="">Tidak terhubung</option>
            <?php $__currentLoopData = $instansi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($ins->id); ?>" <?php if(old('instansi_id', $customer->instansi_id ?? null) == $ins->id): echo 'selected'; endif; ?>>
                    <?php echo e($ins->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <p class="text-xs text-gray-500 mt-1">
            Beberapa customer bisa tergabung dalam satu instansi (misalnya satu kantor).
        </p>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Jenis Member</label>
        <select name="member_type_id" class="w-full border rounded-lg px-3 py-2 text-sm">
            <option value="">Default (Retail)</option>
            <?php $__currentLoopData = $memberTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($mt->id); ?>" <?php if(old('member_type_id', $customer->member_type_id ?? null) == $mt->id): echo 'selected'; endif; ?>>
                    <?php echo e($mt->name ?? $mt->label ?? strtoupper($mt->code)); ?> (Diskon <?php echo e($mt->discount_percent ?? $mt->default_discount); ?>%)
                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<?php if(!isset($customer)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t pt-4 mt-4">
        <div>
            <label class="block text-sm font-semibold mb-1">Password Akun Online (opsional)</label>
            <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 text-sm"
                placeholder="Jika diisi, customer bisa login untuk cek order">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2 text-sm">
        </div>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold mb-1">Status</label>
        <select name="status" class="w-full border rounded-lg px-3 py-2 text-sm">
            <option value="active" <?php if(($customer->status ?? 'active') === 'active'): echo 'selected'; endif; ?>>Aktif</option>
            <option value="inactive" <?php if(($customer->status ?? 'active') === 'inactive'): echo 'selected'; endif; ?>>Nonaktif</option>
        </select>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/customers/_form.blade.php ENDPATH**/ ?>