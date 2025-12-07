<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">Daftar Customer</h1>

        <?php if($errors->any()): ?>
            <div class="mb-4 text-red-600 text-sm">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('customer.register')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">No HP (WhatsApp)</label>
                <input type="text" name="phone" value="<?php echo e(old('phone')); ?>"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Email (opsional)</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-semibold mb-1">Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
            </div>

            <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Daftar
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Sudah punya akun?
            <a href="<?php echo e(route('customer.login')); ?>" class="text-blue-600 hover:underline">
                Login di sini
            </a>
        </p>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/auth/customer/register.blade.php ENDPATH**/ ?>