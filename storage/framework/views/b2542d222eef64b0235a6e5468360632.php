

<?php $__env->startSection('content'); ?>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Jenis Member</h1>
        <a href="<?php echo e(route('admin.member.create')); ?>" class="px-4 py-2 bg-blue-600 text-white rounded-md">Tambah Member
            Type</a>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Kode</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Diskon (%)</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3"><?php echo e($t->code); ?></td>
                        <td class="p-3"><?php echo e($t->name ?? $t->label); ?></td>
                        <td class="p-3"><?php echo e($t->discount_percent ?? $t->default_discount); ?>%</td>

                        <td class="p-3 text-right space-x-2">
                            <a href="<?php echo e(route('admin.member.edit', $t->id)); ?>"
                                class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                            <form method="POST" action="<?php echo e(route('admin.member.destroy', $t->id)); ?>" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="px-3 py-1 bg-red-600 text-white rounded"
                                    onclick="return confirm('Anda yakin?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/member/index.blade.php ENDPATH**/ ?>