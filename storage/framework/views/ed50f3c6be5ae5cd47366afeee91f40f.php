<?php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    $staff = Auth::guard('staff')->user();
    $roleName = $staff?->roles()->first()->name ?? null;

    $menu = [
        ['heading' => 'Akun'],
        ['name' => 'Daftar User', 'route' => 'admin.customers.index', 'icon' => 'user-group', 'roles' => ['superadmin','admin','marketing']],
        ['name' => 'Daftar Staff', 'route' => 'admin.staff.index', 'icon' => 'users', 'roles' => ['superadmin']],

        ['heading' => 'Gudang'],
        ['name' => 'Data Produk', 'route' => 'admin.products.index', 'icon' => 'cube', 'roles' => ['superadmin','admin']],
        ['name' => 'Kategori Produk', 'route' => null, 'icon' => 'folder', 'roles' => ['superadmin','admin']],

        ['heading' => 'Harga'],
        ['name' => 'Harga Produk', 'route' => 'admin.pricing.index', 'icon' => 'tag', 'roles' => ['superadmin','admin','marketing']],
        ['name' => 'Harga Tier Member', 'route' => 'admin.member.index', 'icon' => 'identification', 'roles' => ['superadmin','admin','marketing']],

        ['heading' => 'Orderan'],
        ['name' => 'Purchase Order', 'route' => 'orders.index', 'icon' => 'shopping-bag', 'roles' => ['superadmin','admin']],
        ['name' => 'Tugas Order', 'route' => null, 'icon' => 'clipboard', 'roles' => ['superadmin','admin']],

        ['heading' => 'Metode Pembayaran'],
        ['name' => 'Metode Pembayaran', 'route' => 'invoices.index', 'icon' => 'credit-card', 'roles' => ['superadmin','admin','cashier']],

        ['heading' => 'Keuangan (COA)'],
        ['name' => 'Pendapatan Harian', 'route' => null, 'icon' => 'chart', 'roles' => ['superadmin','admin','manager']],
        ['name' => 'Laporan Pembayaran', 'route' => null, 'icon' => 'receipt', 'roles' => ['superadmin','admin','manager']],
        ['name' => 'Pengeluaran', 'route' => null, 'icon' => 'shopping-cart', 'roles' => ['superadmin','admin','manager']],

        ['heading' => 'Riwayat'],
        ['name' => 'Riwayat Pesanan', 'route' => null, 'icon' => 'history', 'roles' => ['superadmin','admin']],
        ['name' => 'Riwayat Pembayaran', 'route' => null, 'icon' => 'history', 'roles' => ['superadmin','admin','cashier']],
        ['name' => 'Log Aktivitas Staff', 'route' => null, 'icon' => 'clipboard', 'roles' => ['superadmin','admin']],

        ['heading' => 'Pengaturan Laman'],
        ['name' => 'Jadwal Konten', 'route' => null, 'icon' => 'calendar', 'roles' => ['superadmin','admin','marketing']],
        ['name' => 'Event & Promo', 'route' => null, 'icon' => 'sparkles', 'roles' => ['superadmin','admin','marketing']],
        ['name' => 'Banner / Gambar', 'route' => null, 'icon' => 'image', 'roles' => ['superadmin','admin','marketing']],
        ['name' => 'Konten Lainnya', 'route' => null, 'icon' => 'book-open', 'roles' => ['superadmin','admin','marketing']],

        ['heading' => 'Pengaturan Sistem'],
        ['name' => 'System Overview', 'route' => 'admin.system', 'icon' => 'chip', 'roles' => ['superadmin']],

        ['heading' => 'Tentang Aplikasi'],
        ['name' => 'Tentang', 'route' => null, 'icon' => 'info', 'roles' => ['superadmin','admin']],
    ];

    $menu = array_filter($menu, function ($item) use ($roleName) {
        if (isset($item['heading'])) return true;
        return in_array($roleName, $item['roles'] ?? []);
    });
?>

<aside 
    class="bg-[#111827] dark:bg-gray-900 text-gray-300 min-h-screen
           transition-all duration-200 border-r border-gray-800"
    :class="sidebarOpen ? 'w-64' : 'w-20'">

    
    <div class="p-5 flex items-center justify-between">
        <span class="font-bold text-xl tracking-wide" x-show="sidebarOpen">Xeon Panel</span>
        <button @click="toggleSidebar"
                class="text-gray-400 hover:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 :class="sidebarOpen ? '' : 'rotate-180'" 
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>
        </button>
    </div>

    
    <nav class="mt-4 space-y-1">

        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($item['heading'])): ?>
                <div class="px-5 py-2 text-[11px] uppercase tracking-wide text-gray-500"><?php echo e($item['heading']); ?></div>
                <?php continue; ?>
            <?php endif; ?>
            <?php if($item['route'] && !Route::has($item['route'])): ?> <?php continue; ?> <?php endif; ?>
            <?php $active = $item['route'] ? request()->routeIs($item['route']) : false; ?>

            <?php if($item['route']): ?>
                <a href="<?php echo e(route($item['route'])); ?>"
                   class="
                       flex items-center px-4 py-3 mx-2 rounded-lg
                       transition-all duration-150 cursor-pointer
                       hover:bg-gray-800 hover:text-white
                       <?php echo e($active ? 'bg-indigo-600 text-white' : ''); ?>

                   ">
                    <?php if (isset($component)) { $__componentOriginal906aaa6a63a2f5f8b29c23c3195c96dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal906aaa6a63a2f5f8b29c23c3195c96dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.icon','data' => ['name' => $item['icon'],'class' => 'w-6 h-6 flex-none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['icon']),'class' => 'w-6 h-6 flex-none']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal906aaa6a63a2f5f8b29c23c3195c96dd)): ?>
<?php $attributes = $__attributesOriginal906aaa6a63a2f5f8b29c23c3195c96dd; ?>
<?php unset($__attributesOriginal906aaa6a63a2f5f8b29c23c3195c96dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal906aaa6a63a2f5f8b29c23c3195c96dd)): ?>
<?php $component = $__componentOriginal906aaa6a63a2f5f8b29c23c3195c96dd; ?>
<?php unset($__componentOriginal906aaa6a63a2f5f8b29c23c3195c96dd); ?>
<?php endif; ?>
                    <span class="ml-3 text-sm font-medium whitespace-nowrap"
                          x-show="sidebarOpen">
                        <?php echo e($item['name']); ?>

                    </span>
                </a>
            <?php else: ?>
                <div class="flex items-center px-4 py-3 mx-2 rounded-lg text-gray-500 bg-gray-800/30 cursor-not-allowed">
                    <?php if (isset($component)) { $__componentOriginal906aaa6a63a2f5f8b29c23c3195c96dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal906aaa6a63a2f5f8b29c23c3195c96dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.icon','data' => ['name' => $item['icon'],'class' => 'w-6 h-6 flex-none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['icon']),'class' => 'w-6 h-6 flex-none']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal906aaa6a63a2f5f8b29c23c3195c96dd)): ?>
<?php $attributes = $__attributesOriginal906aaa6a63a2f5f8b29c23c3195c96dd; ?>
<?php unset($__attributesOriginal906aaa6a63a2f5f8b29c23c3195c96dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal906aaa6a63a2f5f8b29c23c3195c96dd)): ?>
<?php $component = $__componentOriginal906aaa6a63a2f5f8b29c23c3195c96dd; ?>
<?php unset($__componentOriginal906aaa6a63a2f5f8b29c23c3195c96dd); ?>
<?php endif; ?>
                    <span class="ml-3 text-sm font-medium whitespace-nowrap" x-show="sidebarOpen">
                        <?php echo e($item['name']); ?> <span class="text-[10px] text-gray-500">(soon)</span>
                    </span>
                </div>
            <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
</aside>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/components/admin/sidebar.blade.php ENDPATH**/ ?>