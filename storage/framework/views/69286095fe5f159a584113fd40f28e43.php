<?php $__env->startSection('content'); ?>
    <div class="space-y-6 text-slate-100">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Daftar Customer</h1>
                <p class="text-slate-400 text-sm">
                    Kelola customer, member type, instansi, dan harga khusus.
                </p>
            </div>

            <a href="<?php echo e(route('admin.customers.create')); ?>"
               class="px-4 py-2 bg-sky-600 text-white rounded-lg shadow hover:bg-sky-500">
                + Tambah Customer
            </a>
        </div>

        
        <form method="GET"
              class="bg-slate-900 border border-slate-800 p-4 rounded-xl shadow flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
            <div class="flex-1 flex gap-2">
                <input type="text" name="q" value="<?php echo e(request('q')); ?>"
                       placeholder="Cari nama, phone, email, instansi..."
                       class="flex-1 rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
            </div>

            <div class="flex gap-2 flex-wrap">
                <select name="member_type_id"
                        class="rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    <option value="">Semua Member</option>
                    <?php $__currentLoopData = $memberTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mt->id); ?>" <?php if(request('member_type_id') == $mt->id): echo 'selected'; endif; ?>>
                            <?php echo e($mt->name ?? $mt->label ?? strtoupper($mt->code)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <select name="instansi_id"
                        class="rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    <option value="">Semua Instansi</option>
                    <?php $__currentLoopData = $instansi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ins->id); ?>" <?php if(request('instansi_id') == $ins->id): echo 'selected'; endif; ?>>
                            <?php echo e($ins->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <button class="px-4 py-2 bg-slate-800 text-white rounded-lg text-sm hover:bg-slate-700">
                    Filter
                </button>
            </div>
        </form>

        
        <div class="bg-slate-900 border border-slate-800 rounded-xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-800 text-left text-slate-200">
                    <tr>
                        <th class="p-3">Kode</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Member</th>
                        <th class="p-3">Instansi</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t border-slate-800 hover:bg-slate-800/60 transition">
                            <td class="p-3 font-mono text-xs text-slate-300"><?php echo e($customer->customer_code ?? $customer->id); ?></td>
                            <td class="p-3 font-semibold text-slate-100"><?php echo e($customer->name); ?></td>
                            <td class="p-3 text-slate-300"><?php echo e($customer->phone); ?></td>
                            <td class="p-3">
                                <div class="flex flex-col">
                                    <span class="px-2 py-1 rounded-full text-xs bg-sky-900/60 text-sky-200 border border-sky-700 inline-block w-fit">
                                        <?php echo e(strtoupper($customer->member_type ?? '-')); ?>

                                    </span>
                                    <?php if($customer->memberType): ?>
                                        <span class="text-[11px] text-slate-400"><?php echo e($customer->memberType->name); ?></span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="p-3 text-slate-300">
                                <?php echo e($customer->instansi->name ?? '-'); ?>

                            </td>
                            <td class="p-3">
                                <?php if($customer->status === 'active'): ?>
                                    <span class="px-2 py-1 rounded-full text-xs bg-emerald-900/60 text-emerald-200 border border-emerald-700">Aktif</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 rounded-full text-xs bg-slate-800 text-slate-300 border border-slate-700">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 text-right space-x-2">
                                <a href="<?php echo e(route('admin.customers.edit', $customer)); ?>" class="px-3 py-1 text-xs bg-amber-500 text-white rounded hover:bg-amber-400">Edit</a>

                                <a href="<?php echo e(route('admin.pricing.customer', $customer)); ?>" class="px-3 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-500">
                                    Harga Khusus
                                </a>

                                <form action="<?php echo e(route('admin.customers.toggle', $customer)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <button class="px-3 py-1 text-xs bg-slate-700 text-white rounded hover:bg-slate-600">
                                        Toggle
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>