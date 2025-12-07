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
    <div class="p-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100 mb-6">Kanban Taking Order</h1>

        <?php
            $statuses = [
                'waiting'   => 'Waiting',
                'design'    => 'Design',
                'printing'  => 'Printing',
                'completed' => 'Completed',
            ];
        ?>

        <div class="grid grid-cols-4 gap-4">
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="kanban-column" data-status="<?php echo e($key); ?>">
                    <h2 class="text-lg font-semibold mb-3 text-slate-700 dark:text-slate-200"><?php echo e($label); ?></h2>
                    <div class="space-y-3 min-h-[200px] p-2 bg-slate-100 dark:bg-slate-800 rounded-lg"
                         ondragover="allowDrop(event)"
                         ondrop="dropCard(event, '<?php echo e($key); ?>')">

                        <?php $__currentLoopData = $orders->where('kanban_status', $key); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="kanban-card bg-white dark:bg-slate-900 rounded-xl shadow-md p-4 border border-gray-100 dark:border-slate-700 cursor-move"
                                 draggable="true"
                                 ondragstart="dragCard(event)"
                                 data-id="<?php echo e($order->id); ?>">

                                <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100"><?php echo e($order->order_code ?? ('ORD-'.$order->id)); ?></h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm mb-2"><?php echo e($order->product_name ?? '-'); ?></p>

                                <div class="text-sm text-slate-700 dark:text-slate-200 space-y-1">
                                    <p><strong>Pelanggan:</strong> <?php echo e($order->customer_name ?? '-'); ?></p>
                                    <p><strong>Deadline:</strong> <?php echo e(optional($order->deadline_date)->format('d M Y') ?? '-'); ?></p>
                                    <p><strong>Status:</strong> <?php echo e(ucfirst($order->kanban_status)); ?></p>
                                </div>

                                <hr class="my-3 border-slate-200 dark:border-slate-700">

                                <div class="flex justify-between mt-2">
                                    <button class="px-3 py-1 border border-gray-400 text-gray-600 dark:border-slate-600 dark:text-slate-200 rounded-md text-sm">Detail</button>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-500">Aksi</button>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($orders->where('kanban_status', $key)->isEmpty()): ?>
                            <div class="text-center text-xs text-slate-500 dark:text-slate-400 py-4">
                                Belum ada kartu.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <script>
        let draggedCard = null;
        function dragCard(event) {
            draggedCard = event.target;
            event.dataTransfer.effectAllowed = "move";
        }
        function allowDrop(event) { event.preventDefault(); }
        function dropCard(event, newStatus) {
            event.preventDefault();
            if (!draggedCard) return;
            event.target.closest(".kanban-column").querySelector(".space-y-3").appendChild(draggedCard);
            let orderId = draggedCard.getAttribute("data-id");
            fetch(`/orders/${orderId}/update-status`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({ status: newStatus })
            }).catch(console.error);
        }
    </script>
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
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/staff/dashboard.blade.php ENDPATH**/ ?>