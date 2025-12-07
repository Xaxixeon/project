<?php if (isset($component)) { $__componentOriginal7651faf8e4a1e278424aad70c82de3ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7651faf8e4a1e278424aad70c82de3ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.layout','data' => ['title' => $mode === 'create' ? 'Produk Baru' : 'Edit Produk']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mode === 'create' ? 'Produk Baru' : 'Edit Produk')]); ?>

    <form method="post"
          action="<?php echo e($mode === 'create'
                    ? route('admin.products.store')
                    : route('admin.products.update', $product)); ?>">
        <?php echo csrf_field(); ?>
        <?php if($mode === 'edit'): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="grid lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white border border-slate-200 rounded-2xl p-4">
                    <h2 class="text-sm font-semibold mb-3">Informasi Produk</h2>

                    <div class="space-y-3 text-sm">
                        <div>
                            <label class="text-xs font-semibold">Nama Produk</label>
                            <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>"
                                   class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-[11px] text-rose-500 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="grid md:grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs font-semibold">SKU</label>
                                <input type="text" name="sku" value="<?php echo e(old('sku', $product->sku)); ?>"
                                       class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm">
                                <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-[11px] text-rose-500 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="flex items-center gap-2 mt-5 md:mt-7">
                                <input type="checkbox" name="is_active" value="1"
                                       <?php if(old('is_active', $product->is_active)): echo 'checked'; endif; ?>>
                                <span class="text-xs text-slate-700">Produk aktif</span>
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-semibold">Deskripsi Singkat</label>
                            <textarea name="short_description" rows="2"
                                      class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm"><?php echo e(old('short_description', $product->short_description)); ?></textarea>
                        </div>

                        <div>
                            <label class="text-xs font-semibold">Deskripsi Lengkap</label>
                            <textarea name="description" rows="4"
                                      class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm"><?php echo e(old('description', $product->description)); ?></textarea>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white border border-slate-200 rounded-2xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-sm font-semibold">Varian Produk</h2>
                        <button type="button"
                                class="text-xs text-sky-600"
                                onclick="xeonAddVariantRow()">
                            + Tambah Varian
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-xs" id="variants-table">
                            <thead>
                            <tr class="border-b border-slate-200 text-[11px] text-slate-500">
                                <th class="px-2 py-1 text-left">Label</th>
                                <th class="px-2 py-1 text-left">Kode / Ukuran</th>
                                <th class="px-2 py-1 text-right">Harga</th>
                                <th class="px-2 py-1 text-right">Biaya</th>
                                <th class="px-2 py-1 text-right">Lebar (cm)</th>
                                <th class="px-2 py-1 text-right">Tinggi (cm)</th>
                                <th class="px-2 py-1 text-center">Aktif</th>
                                <th class="px-2 py-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $variantIndex = 0; ?>
                            <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b border-slate-100">
                                    <td class="px-2 py-1">
                                        <input type="hidden" name="variants[<?php echo e($variantIndex); ?>][id]"
                                               value="<?php echo e($v->id); ?>">
                                        <input type="text" name="variants[<?php echo e($variantIndex); ?>][label]"
                                               value="<?php echo e($v->label); ?>"
                                               class="w-full rounded border border-slate-200 px-2 py-1">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="text" name="variants[<?php echo e($variantIndex); ?>][size_code]"
                                               value=<?php echo e($v->size_code ? "\"$v->size_code\"" : '""'); ?>

                                               class="w-full rounded border border-slate-200 px-2 py-1"
                                               placeholder="A3+, A4, dst.">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="number" step="1" min="0"
                                               name="variants[<?php echo e($variantIndex); ?>][price]"
                                               value="<?php echo e($v->price); ?>"
                                               class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="number" step="1" min="0"
                                               name="variants[<?php echo e($variantIndex); ?>][cost]"
                                               value="<?php echo e($v->cost); ?>"
                                               class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="number" step="0.1" min="0"
                                               name="variants[<?php echo e($variantIndex); ?>][width_cm]"
                                               value="<?php echo e($v->width_cm); ?>"
                                               class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="number" step="0.1" min="0"
                                               name="variants[<?php echo e($variantIndex); ?>][height_cm]"
                                               value="<?php echo e($v->height_cm); ?>"
                                               class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                                    </td>
                                    <td class="px-2 py-1 text-center">
                                        <input type="checkbox" name="variants[<?php echo e($variantIndex); ?>][is_active]" value="1"
                                               <?php if($v->is_active): echo 'checked'; endif; ?>>
                                    </td>
                                    <td class="px-2 py-1 text-center">
                                        <input type="checkbox"
                                               name="variants[<?php echo e($variantIndex); ?>][_delete]"
                                               value="1">
                                        <span class="text-[10px] text-rose-500">hapus</span>
                                    </td>
                                </tr>
                                <?php $variantIndex++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                
                <div class="bg-white border border-slate-200 rounded-2xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-sm font-semibold">Tambahan / Finishing</h2>
                        <button type="button"
                                class="text-xs text-sky-600"
                                onclick="xeonAddAddonRow()">
                            + Tambah Tambahan
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-xs" id="addons-table">
                            <thead>
                            <tr class="border-b border-slate-200 text-[11px] text-slate-500">
                                <th class="px-2 py-1 text-left">Nama Tambahan</th>
                                <th class="px-2 py-1 text-right">Extra Harga</th>
                                <th class="px-2 py-1 text-right">Extra Biaya</th>
                                <th class="px-2 py-1 text-center">Aktif</th>
                                <th class="px-2 py-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $addonIndex = 0; ?>
                            <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b border-slate-100">
                                    <td class="px-2 py-1">
                                        <input type="hidden" name="addons[<?php echo e($addonIndex); ?>][id]"
                                               value="<?php echo e($a->id); ?>">
                                        <input type="text" name="addons[<?php echo e($addonIndex); ?>][name]"
                                               value="<?php echo e($a->name); ?>"
                                               class="w-full rounded border border-slate-200 px-2 py-1">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="number" step="1" min="0"
                                               name="addons[<?php echo e($addonIndex); ?>][extra_price]"
                                               value="<?php echo e($a->extra_price); ?>"
                                               class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="number" step="1" min="0"
                                               name="addons[<?php echo e($addonIndex); ?>][extra_cost]"
                                               value="<?php echo e($a->extra_cost); ?>"
                                               class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                                    </td>
                                    <td class="px-2 py-1 text-center">
                                        <input type="checkbox" name="addons[<?php echo e($addonIndex); ?>][is_active]" value="1"
                                               <?php if($a->is_active): echo 'checked'; endif; ?>>
                                    </td>
                                    <td class="px-2 py-1 text-center">
                                        <input type="checkbox"
                                               name="addons[<?php echo e($addonIndex); ?>][_delete]"
                                               value="1">
                                        <span class="text-[10px] text-rose-500">hapus</span>
                                    </td>
                                </tr>
                                <?php $addonIndex++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            
            <div class="space-y-4">
                <div class="bg-white border border-slate-200 rounded-2xl p-4 text-sm">
                    <h2 class="text-sm font-semibold mb-3">Etalase / Display Group</h2>
                    <div class="space-y-1 text-xs">
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="flex items-center gap-2">
                                <input type="checkbox"
                                       name="display_group_ids[]"
                                       value="<?php echo e($group->id); ?>"
                                       <?php if(in_array($group->id, old('display_group_ids', $product->displayGroups->pluck('id')->toArray()))): echo 'checked'; endif; ?>>
                                <span><?php echo e($group->name); ?></span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class="text-[11px] text-slate-500 mt-2">
                        Etalase akan muncul di landing page, katalog utama, dan POS CS.
                    </p>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-4 text-xs">
                    <h2 class="text-sm font-semibold mb-2">Preview Kartu Katalog</h2>
                    <div class="border border-slate-200 rounded-xl p-3">
                        <div class="flex flex-wrap gap-1 mb-1">
                            <span class="px-2 py-0.5 rounded-full bg-sky-50 text-sky-700 border border-sky-200 text-[10px]">
                                Best Seller
                            </span>
                        </div>
                        <div class="text-sm font-semibold mb-1 text-slate-800">
                            <span id="preview-name"><?php echo e(old('name', $product->name) ?: 'Nama produk'); ?></span>
                        </div>
                        <div class="text-[11px] text-slate-500 mb-2 line-clamp-2" id="preview-short">
                            <?php echo e(old('short_description', $product->short_description) ?: 'Deskripsi singkat produk akan tampil di sini.'); ?>

                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-[11px] text-slate-500">Mulai dari</div>
                            <div class="text-base font-bold text-sky-700">
                                (otomatis dari varian)
                            </div>
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-500 mt-2">
                        Preview ini hanya ilustrasi tampilan di katalog / landing.
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-2">
            <a href="<?php echo e(route('admin.products.index')); ?>"
               class="px-4 py-2 rounded-full border border-slate-300 text-xs">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 rounded-full bg-sky-600 text-xs font-semibold text-white hover:bg-sky-500">
                Simpan
            </button>
        </div>
    </form>

    <script>
        let variantIndex = <?php echo e($variantIndex ?? 0); ?>;
        let addonIndex   = <?php echo e($addonIndex ?? 0); ?>;

        function xeonAddVariantRow() {
            const tbody = document.querySelector('#variants-table tbody');
            const idx = variantIndex++;

            const tr = document.createElement('tr');
            tr.className = 'border-b border-slate-100';
            tr.innerHTML = `
                <td class="px-2 py-1">
                    <input type="text" name="variants[${idx}][label]"
                           class="w-full rounded border border-slate-200 px-2 py-1"
                           placeholder="Contoh: Artpaper 150gr A3+">
                </td>
                <td class="px-2 py-1">
                    <input type="text" name="variants[${idx}][size_code]"
                           class="w-full rounded border border-slate-200 px-2 py-1"
                           placeholder="A3+, A4, dst.">
                </td>
                <td class="px-2 py-1">
                    <input type="number" step="1" min="0"
                           name="variants[${idx}][price]"
                           class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                </td>
                <td class="px-2 py-1">
                    <input type="number" step="1" min="0"
                           name="variants[${idx}][cost]"
                           class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                </td>
                <td class="px-2 py-1">
                    <input type="number" step="0.1" min="0"
                           name="variants[${idx}][width_cm]"
                           class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                </td>
                <td class="px-2 py-1">
                    <input type="number" step="0.1" min="0"
                           name="variants[${idx}][height_cm]"
                           class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                </td>
                <td class="px-2 py-1 text-center">
                    <input type="checkbox" name="variants[${idx}][is_active]" value="1" checked>
                </td>
                <td class="px-2 py-1 text-center text-[10px] text-rose-500">
                    (hapus diabaikan untuk baris baru)
                </td>
            `;
            tbody.appendChild(tr);
        }

        function xeonAddAddonRow() {
            const tbody = document.querySelector('#addons-table tbody');
            const idx = addonIndex++;

            const tr = document.createElement('tr');
            tr.className = 'border-b border-slate-100';
            tr.innerHTML = `
                <td class="px-2 py-1">
                    <input type="text" name="addons[${idx}][name]"
                           class="w-full rounded border border-slate-200 px-2 py-1"
                           placeholder="Potong, Simpress, Simpress + Keling, dst.">
                </td>
                <td class="px-2 py-1">
                    <input type="number" step="1" min="0"
                           name="addons[${idx}][extra_price]"
                           class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                </td>
                <td class="px-2 py-1">
                    <input type="number" step="1" min="0"
                           name="addons[${idx}][extra_cost]"
                           class="w-full rounded border border-slate-200 px-2 py-1 text-right">
                </td>
                <td class="px-2 py-1 text-center">
                    <input type="checkbox" name="addons[${idx}][is_active]" value="1" checked>
                </td>
                <td class="px-2 py-1 text-center text-[10px] text-rose-500">
                    (hapus diabaikan untuk baris baru)
                </td>
            `;
            tbody.appendChild(tr);
        }

        const nameInput = document.querySelector('input[name="name"]');
        if (nameInput) {
            nameInput.addEventListener('input', function () {
                document.getElementById('preview-name').textContent = this.value || 'Nama produk';
            });
        }
        const shortInput = document.querySelector('textarea[name="short_description"]');
        if (shortInput) {
            shortInput.addEventListener('input', function () {
                document.getElementById('preview-short').textContent = this.value || 'Deskripsi singkat produk akan tampil di sini.';
            });
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
<?php /**PATH C:\xampp\htdocs\xeon\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>