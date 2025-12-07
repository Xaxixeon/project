<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name']));

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

foreach (array_filter((['name']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $iconPath = resource_path('icons/' . $name . '.svg');
?>

<?php if(file_exists($iconPath)): ?>
    <?php
        $svg = file_get_contents($iconPath);
        $attr = $attributes->merge(['class' => $attributes->get('class')])->toHtml();
        $svg = preg_replace('/<svg\\b([^>]*)>/', '<svg $1 ' . $attr . '>', $svg, 1);
        echo $svg;
    ?>
<?php else: ?>
<?php switch($name):
    case ('home'): ?>
        <svg <?php echo e($attributes->merge(['class' => $attributes->get('class')])); ?> fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5a1 1 0 001-1V14a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 001 1h5a1 1 0 001-1V10" />
        </svg>
        <?php break; ?>

    <?php case ('users'): ?>
        <svg <?php echo e($attributes->merge(['class' => $attributes->get('class')])); ?> fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
            <path d="M17 20v-2a4 4 0 00-3-3.87M7 20v-2a4 4 0 013-3.87M12 4a4 4 0 110 8 4 4 0 010-8z"/>
        </svg>
        <?php break; ?>

    <?php case ('user-group'): ?>
        <svg <?php echo e($attributes->merge(['class' => $attributes->get('class')])); ?> fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
            <path d="M17 20v-2a4 4 0 00-3-3.87M7 20v-2a4 4 0 013-3.87M12 4a4 4 0 110 8 4 4 0 010-8z"/>
        </svg>
        <?php break; ?>

    <?php case ('office-building'): ?>
        <svg <?php echo e($attributes->merge(['class' => $attributes->get('class')])); ?> fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path d="M3 21V3h7v18m0-10h11v10H10z"/>
        </svg>
        <?php break; ?>

    <?php case ('identification'): ?>
        <svg <?php echo e($attributes->merge(['class' => $attributes->get('class')])); ?> fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
            <path d="M15 11.5a3 3 0 10-6 0M12 14v7m9-7v7H3v-7"/>
        </svg>
        <?php break; ?>

    <?php case ('currency-dollar'): ?>
        <svg <?php echo e($attributes->merge(['class' => $attributes->get('class')])); ?> fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path d="M12 8c-4 0-4 6 0 6s4 6 0 6m0-20v4m0 12v4"/>
        </svg>
        <?php break; ?>

    <?php case ('chip'): ?>
        <svg <?php echo e($attributes->merge(['class' => $attributes->get('class')])); ?> fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
            <path d="M9 9h6v6H9zM4 4h16v16H4z"/>
        </svg>
        <?php break; ?>
<?php endswitch; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/components/admin/icon.blade.php ENDPATH**/ ?>