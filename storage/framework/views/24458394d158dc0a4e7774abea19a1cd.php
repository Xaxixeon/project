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

<h2 class="text-3xl font-bold mb-6">System Overview</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <div class="bg-gray-800 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">PHP Version</h3>
        <p class="text-3xl font-bold mt-2"><?php echo e($server['php_version']); ?></p>
    </div>

    <div class="bg-gray-800 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Laravel Version</h3>
        <p class="text-3xl font-bold mt-2"><?php echo e($server['laravel_version']); ?></p>
    </div>

    <div class="bg-gray-800 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Memory Usage</h3>
        <p class="text-3xl font-bold mt-2"><?php echo e($server['memory_usage']); ?></p>
    </div>

    <div class="bg-gray-800 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Disk Total</h3>
        <p class="text-3xl font-bold mt-2"><?php echo e($server['disk_total']); ?></p>
    </div>

    <div class="bg-gray-800 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Disk Free</h3>
        <p class="text-3xl font-bold mt-2"><?php echo e($server['disk_free']); ?></p>
    </div>

    <div class="bg-gray-800 text-white p-6 rounded-xl shadow">
        <h3 class="text-lg font-semibold">Disk Used</h3>
        <p class="text-xl font-bold mt-2"><?php echo e($server['disk_used_percent']); ?>%</p>
        <div class="mt-3 w-full bg-gray-700 rounded-full h-2">
            <div class="bg-red-500 h-2 rounded-full" style="width: <?php echo e($server['disk_used_percent']); ?>%"></div>
        </div>
    </div>

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
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/system.blade.php ENDPATH**/ ?>