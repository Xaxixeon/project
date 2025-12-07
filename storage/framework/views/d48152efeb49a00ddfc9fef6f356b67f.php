<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Xeon Panel</title>

    
    <script src="https://cdn.tailwindcss.com"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    
    <script src="//unpkg.com/alpinejs" defer></script>

    
    <script>
        function adminLayout() {
            return {
                sidebarOpen: localStorage.getItem('sidebarOpen') !== '0',
                theme: localStorage.getItem('theme') || 'dark',
                compact: localStorage.getItem('compact') === '1',
                init() {
                    if (this.theme === 'dark') {
                        document.documentElement.classList.add('dark');
                    }
                    if (this.compact) {
                        this.sidebarOpen = false;
                    }
                },
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                    localStorage.setItem('sidebarOpen', this.sidebarOpen ? '1' : '0');
                },
                toggleTheme() {
                    this.theme = (this.theme === 'dark') ? 'light' : 'dark';
                    localStorage.setItem('theme', this.theme);
                    document.documentElement.classList.toggle('dark', this.theme === 'dark');
                },
                toggleCompact() {
                    this.compact = !this.compact;
                    localStorage.setItem('compact', this.compact ? '1' : '0');
                    if (this.compact) {
                        this.sidebarOpen = false;
                        localStorage.setItem('sidebarOpen', '0');
                    }
                },
            }
        }
    </script>

    <style>
        .sidebar-link-active {
            @apply bg-indigo-600 text-white dark:bg-indigo-500;
        }
        .sidebar-link {
            @apply flex items-center px-4 py-3 rounded hover:bg-gray-200 dark:hover:bg-gray-700;
        }

        /* Dark mode overrides for legacy light classes */
        .dark .bg-white { background-color: #0f172a !important; color: #e5e7eb !important; }
        .dark .bg-gray-50 { background-color: #0b1224 !important; color: #e5e7eb !important; }
        .dark .bg-gray-100 { background-color: #111827 !important; color: #e5e7eb !important; }
        .dark .bg-gray-200 { background-color: #1f2937 !important; }
        .dark .border-gray-200 { border-color: #1f2937 !important; }
        .dark .border-gray-300 { border-color: #2d3748 !important; }
        .dark .text-gray-700 { color: #e2e8f0 !important; }
        .dark .text-gray-800 { color: #e5e7eb !important; }
        .dark .text-gray-900 { color: #f8fafc !important; }

        .dark input,
        .dark select,
        .dark textarea {
            background-color: #0b1224 !important;
            border-color: #1f2937 !important;
            color: #e5e7eb !important;
        }
        .dark input::placeholder,
        .dark textarea::placeholder {
            color: #94a3b8 !important;
        }

        .dark .shadow,
        .dark .shadow-md,
        .dark .shadow-lg {
            box-shadow: 0 10px 30px rgba(0,0,0,0.45) !important;
        }

        .dark table thead {
            background-color: #0b1224 !important;
            color: #cbd5e1 !important;
        }
        .dark table tbody tr {
            background-color: #0f172a !important;
        }
        .dark table tbody tr:nth-child(even) {
            background-color: #0c1426 !important;
        }
        .dark table td,
        .dark table th {
            border-color: #1f2937 !important;
        }
    </style>
</head>

<body class="h-full bg-gray-100 dark:bg-gray-900 dark:text-gray-200"
      x-data="adminLayout()" x-init="init()"
      :class="compact ? 'text-sm' : 'text-base'">

<div class="flex min-h-screen">

    
    <?php if (isset($component)) { $__componentOriginalbebe114f3ccde4b38d7462a3136be045 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbebe114f3ccde4b38d7462a3136be045 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbebe114f3ccde4b38d7462a3136be045)): ?>
<?php $attributes = $__attributesOriginalbebe114f3ccde4b38d7462a3136be045; ?>
<?php unset($__attributesOriginalbebe114f3ccde4b38d7462a3136be045); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbebe114f3ccde4b38d7462a3136be045)): ?>
<?php $component = $__componentOriginalbebe114f3ccde4b38d7462a3136be045; ?>
<?php unset($__componentOriginalbebe114f3ccde4b38d7462a3136be045); ?>
<?php endif; ?>

    
    <div class="flex flex-col flex-1">

        
        <?php if (isset($component)) { $__componentOriginal232f012cda936a4eb249de3234ccfddd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal232f012cda936a4eb249de3234ccfddd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.topbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.topbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal232f012cda936a4eb249de3234ccfddd)): ?>
<?php $attributes = $__attributesOriginal232f012cda936a4eb249de3234ccfddd; ?>
<?php unset($__attributesOriginal232f012cda936a4eb249de3234ccfddd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal232f012cda936a4eb249de3234ccfddd)): ?>
<?php $component = $__componentOriginal232f012cda936a4eb249de3234ccfddd; ?>
<?php unset($__componentOriginal232f012cda936a4eb249de3234ccfddd); ?>
<?php endif; ?>

        
        <main class="p-6">
            <?php echo e($slot); ?>

        </main>
    </div>
</div>


<?php if (isset($component)) { $__componentOriginalb774badd5a25171b3116df46663b1b78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb774badd5a25171b3116df46663b1b78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.command-palette','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.command-palette'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb774badd5a25171b3116df46663b1b78)): ?>
<?php $attributes = $__attributesOriginalb774badd5a25171b3116df46663b1b78; ?>
<?php unset($__attributesOriginalb774badd5a25171b3116df46663b1b78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb774badd5a25171b3116df46663b1b78)): ?>
<?php $component = $__componentOriginalb774badd5a25171b3116df46663b1b78; ?>
<?php unset($__componentOriginalb774badd5a25171b3116df46663b1b78); ?>
<?php endif; ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/components/admin/layout.blade.php ENDPATH**/ ?>