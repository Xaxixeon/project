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

<h2 class="text-3xl font-bold mb-6">Customer Service Dashboard</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-gray-800 p-6 rounded shadow">
        <h3 class="text-lg font-semibold">New Orders</h3>
        <p class="text-3xl font-bold mt-2"><?php echo e($newOrders ?? 0); ?></p>
    </div>

    <div class="bg-gray-800 p-6 rounded shadow">
        <h3 class="text-lg font-semibold">Waiting Approval</h3>
        <p class="text-3xl font-bold mt-2"><?php echo e($approvalCount ?? 0); ?></p>
    </div>

    <div class="bg-gray-800 p-6 rounded shadow">
        <h3 class="text-lg font-semibold">Urgent Orders</h3>
        <p class="text-3xl font-bold mt-2 text-red-400"><?php echo e($urgentOrders ?? 0); ?></p>
    </div>
</div>

<h3 class="text-xl font-bold mt-10 mb-4">New Orders</h3>

<?php echo $__env->make('partials.order-table', ['orders' => $newOrderList], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/dashboard/customer-service.blade.php ENDPATH**/ ?>