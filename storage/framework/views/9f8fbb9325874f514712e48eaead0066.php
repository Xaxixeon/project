<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Title',
    'value' => '0',
    'bg' => 'blue',   
    'icon' => null
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'Title',
    'value' => '0',
    'bg' => 'blue',   
    'icon' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Map warna Tailwind berdasarkan parameter bg=""
    $colors = [
        'blue'   => 'bg-blue-100 text-blue-700 border-blue-300 dark:bg-blue-900/30 dark:text-blue-200 dark:border-blue-700/60',
        'green'  => 'bg-green-100 text-green-700 border-green-300 dark:bg-green-900/30 dark:text-green-200 dark:border-green-700/60',
        'red'    => 'bg-red-100 text-red-700 border-red-300 dark:bg-red-900/30 dark:text-red-200 dark:border-red-700/60',
        'yellow' => 'bg-yellow-100 text-yellow-700 border-yellow-300 dark:bg-yellow-900/30 dark:text-yellow-100 dark:border-yellow-700/60',
        'purple' => 'bg-purple-100 text-purple-700 border-purple-300 dark:bg-purple-900/30 dark:text-purple-200 dark:border-purple-700/60',
        'gray'   => 'bg-gray-100 text-gray-700 border-gray-300 dark:bg-gray-800/50 dark:text-gray-200 dark:border-gray-700/60',
    ];

    $colorClass = $colors[$bg] ?? $colors['blue'];
?>

<div class="p-5 rounded-xl shadow bg-white border border-gray-200 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
    <div class="flex items-center justify-between">
        
        <div>
            <p class="text-gray-500 dark:text-slate-400 text-sm"><?php echo e($title); ?></p>
            <h2 class="text-2xl font-bold mt-1 text-slate-900 dark:text-slate-100"><?php echo e($value); ?></h2>
        </div>

        <?php if($icon): ?>
            <div class="p-3 rounded-full <?php echo e($colorClass); ?>">
                <?php echo $icon; ?>

            </div>
        <?php endif; ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/components/stat-card.blade.php ENDPATH**/ ?>