
<?php if (isset($component)) { $__componentOriginal7651faf8e4a1e278424aad70c82de3ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Manajemen Staff</h2>
            <p class="text-sm text-slate-400 mt-1">
                Kelola akun staff, role, dan status aktif/nonaktif.
            </p>
        </div>

        <a href="<?php echo e(route('admin.staff.create')); ?>"
           class="inline-flex items-center px-4 py-2 rounded bg-emerald-600 text-white text-sm hover:bg-emerald-500">
            + Tambah Staff
        </a>
    </div>

    <div class="bg-slate-900 rounded-lg shadow p-4">
        <table class="min-w-full text-sm text-left text-slate-200">
            <thead>
                <tr class="border-b border-slate-700 text-xs uppercase text-slate-400">
                    <th class="px-3 py-2">Nama</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2">Role</th>
                    <th class="px-3 py-2 text-center">Status</th>
                    <th class="px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $staffUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-slate-800 hover:bg-slate-800/60">
                        <td class="px-3 py-2">
                            <div class="font-semibold"><?php echo e($user->name); ?></div>
                            <?php if($user->username): ?>
                                <div class="text-xs text-slate-400">
                                    <?php echo e('@'.$user->username); ?>

                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="px-3 py-2 text-slate-200">
                            <?php echo e($user->email); ?>

                        </td>
                        <td class="px-3 py-2 text-slate-200">
                            <?php
                                $roleNames = $user->roles?->pluck('name')->toArray() ?? [];
                            ?>

                            <?php if(!empty($roleNames)): ?>
                                <?php echo e(implode(', ', $roleNames)); ?>

                            <?php else: ?>
                                <span class="text-xs text-slate-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-3 py-2 text-center">
                            <?php
                                $isActive = $user->is_active ?? true;
                            ?>

                            <?php if($isActive): ?>
                                <span class="px-2 py-1 rounded-full bg-emerald-600/80 text-xs text-white">
                                    Aktif
                                </span>
                            <?php else: ?>
                                <span class="px-2 py-1 rounded-full bg-red-600/80 text-xs text-white">
                                    Nonaktif
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-3 py-2 text-center">
                            <div class="inline-flex gap-1">

                                
                                <a href="<?php echo e(route('admin.staff.edit', $user->id)); ?>"
                                   class="px-2 py-1 rounded bg-sky-600 text-xs text-white hover:bg-sky-500">
                                    Edit
                                </a>

                                
                                <form action="<?php echo e(route('admin.staff.toggle', $user->id)); ?>"
                                      method="POST"
                                      onsubmit="return confirm('Ubah status staff ini?')">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                            class="px-2 py-1 rounded bg-slate-700 text-xs text-white hover:bg-slate-600">
                                        <?php echo e($isActive ? 'Nonaktifkan' : 'Aktifkan'); ?>

                                    </button>
                                </form>

                                
                                <form action="<?php echo e(route('admin.staff.reset-password', $user->id)); ?>"
                                      method="POST"
                                      onsubmit="return confirm('Reset password untuk <?php echo e($user->name); ?>?')">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                            class="px-2 py-1 rounded bg-amber-600 text-xs text-white hover:bg-amber-500">
                                        Reset PW
                                    </button>
                                </form>

                                
                                <form action="<?php echo e(route('admin.staff.destroy', $user->id)); ?>"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus staff ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                            class="px-2 py-1 rounded bg-red-600 text-xs text-white hover:bg-red-500">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-3 py-4 text-center text-slate-500">
                            Belum ada data staff.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7651faf8e4a1e278424aad70c82de3ba)): ?>
<?php $attributes = $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba; ?>
<?php unset($__attributesOriginal7651faf8e4a1e278424aad70c82de3ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7651faf8e4a1e278424aad70c82de3ba)): ?>
<?php $component = $__componentOriginal7651faf8e4a1e278424aad70c82de3ba; ?>
<?php unset($__componentOriginal7651faf8e4a1e278424aad70c82de3ba); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/staff/index.blade.php ENDPATH**/ ?>