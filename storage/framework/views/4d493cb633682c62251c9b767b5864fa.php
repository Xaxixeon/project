<?php if (isset($component)) { $__componentOriginal7651faf8e4a1e278424aad70c82de3ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.layout','data' => ['title' => 'Produk']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Produk']); ?>
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold">Manajemen Produk</h1>
            <p class="text-xs text-slate-500 mt-1">
                Atur produk, varian, dan etalase untuk katalog & landing page.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <form method="get" class="hidden md:block">
                <input type="text" name="q" value="<?php echo e($search); ?>"
                       placeholder="Cari nama / SKU"
                       class="rounded-full border border-slate-300 bg-white px-3 py-2 text-sm w-56">
            </form>
            <a href="<?php echo e(route('admin.products.create')); ?>"
               class="px-3 py-2 rounded-full bg-sky-600 text-xs font-semibold text-white hover:bg-sky-500">
                + Produk Baru
            </a>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
            <tr class="text-xs text-slate-500">
                <th class="px-3 py-2 text-left">Produk</th>
                <th class="px-3 py-2 text-left">SKU</th>
                <th class="px-3 py-2 text-left">Etalase</th>
                <th class="px-3 py-2 text-left">Varian</th>
                <th class="px-3 py-2 text-left">Mulai dari</th>
                <th class="px-3 py-2 text-center">Status</th>
                <th class="px-3 py-2"></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b last:border-0 border-slate-100">
                    <td class="px-3 py-2 align-top">
                        <div class="text-sm font-semibold text-slate-800">
                            <?php echo e($product->name); ?>

                        </div>
                        <div class="text-[11px] text-slate-500 line-clamp-2">
                            <?php echo e($product->short_description ?? \Illuminate\Support\Str::limit($product->description, 60)); ?>

                        </div>
                    </td>
                    <td class="px-3 py-2 align-top text-xs text-slate-600">
                        <?php echo e($product->sku ?? '—'); ?>

                    </td>
                    <td class="px-3 py-2 align-top text-xs">
                        <div class="flex flex-wrap gap-1">
                            <?php $__currentLoopData = $product->displayGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="px-2 py-0.5 rounded-full bg-sky-50 text-sky-700 border border-sky-200 text-[10px]">
                                    <?php echo e($group->name); ?>

                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </td>
                    <td class="px-3 py-2 align-top text-xs text-slate-600">
                        <?php echo e($product->variants->count()); ?> varian
                    </td>
                    <td class="px-3 py-2 align-top text-xs text-sky-700 font-semibold">
                        <?php if($product->starting_price): ?>
                            Rp <?php echo e(number_format($product->starting_price, 0, ',', '.')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td class="px-3 py-2 align-top text-center">
                        <?php if($product->is_active): ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px]">
                                Aktif
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px]">
                                Nonaktif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-3 py-2 align-top text-right text-xs">
                        <a href="<?php echo e(route('admin.products.edit', $product)); ?>"
                           class="text-sky-600 hover:underline">Edit</a>

                        <form action="<?php echo e(route('admin.products.destroy', $product)); ?>"
                              method="post" class="inline-block ml-2"
                              onsubmit="return confirm('Hapus produk ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-rose-500 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="px-3 py-4 text-center text-xs text-slate-500">
                        Belum ada produk.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($products->links()); ?>

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
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/products/index.blade.php ENDPATH**/ ?>