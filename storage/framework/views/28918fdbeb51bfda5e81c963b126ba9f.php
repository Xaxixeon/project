<table class="w-full bg-gray-800 rounded text-gray-300 text-sm">
    <thead class="bg-gray-700 text-xs uppercase tracking-wide">
        <tr>
            <th class="px-4 py-2 text-left">Order</th>
            <th class="px-4 py-2 text-left">Customer</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Created</th>
            <th class="px-4 py-2 text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="border-b border-gray-700">
                <td class="px-4 py-2">#<?php echo e($order->id); ?></td>

                <td class="px-4 py-2">
                    <?php echo e($order->customer?->name ?? $order->customer_name ?? '-'); ?>

                </td>

                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded-full text-xs bg-gray-700">
                        <?php echo e($order->status); ?>

                    </span>
                </td>

                <td class="px-4 py-2">
                    <?php echo e(optional($order->created_at)->format('d M Y H:i')); ?>

                </td>

                <td class="px-4 py-2">
                    <a href="<?php echo e(route('orders.show', $order->id)); ?>"
                       class="px-3 py-1 rounded bg-indigo-600 text-white text-xs">
                        View
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                    No orders found.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/partials/order-table.blade.php ENDPATH**/ ?>