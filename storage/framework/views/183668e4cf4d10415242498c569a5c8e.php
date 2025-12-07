

<?php $__env->startSection('content'); ?>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Daftar Instansi</h1>
        <a href="<?php echo e(route('admin.instansi.create')); ?>" class="px-4 py-2 bg-blue-600 text-white rounded-md">Tambah Instansi</a>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Kontak</th>
                    <th class="p-3 text-left">Alamat</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $instansi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3"><?php echo e($i->name); ?></td>
                        <td class="p-3"><?php echo e($i->contact ?? '-'); ?></td>
                        <td class="p-3"><?php echo e($i->address ?? '-'); ?></td>
                        <td class="p-3 text-right space-x-2">
                            <a href="<?php echo e(route('admin.instansi.edit', $i->id)); ?>"
                                class="px-3 py-2 bg-yellow-500 text-white rounded-md">Edit</a>

                            <form action="<?php echo e(route('admin.instansi.destroy', $i->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="px-3 py-2 bg-red-600 text-white rounded-md"
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/instansi/index.blade.php ENDPATH**/ ?>