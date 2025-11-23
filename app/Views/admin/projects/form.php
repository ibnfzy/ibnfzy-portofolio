<?php $isEdit = ! empty($project); ?>
<?php $errors = $errors ?? session('errors') ?? []; ?>
<?php $formData = $formData ?? []; ?>
<?php helper('stack'); ?>
<?php $catalog = stack_catalog(); ?>
<?php $selectedStack = stack_decode($formData['tech_stack'] ?? old('tech_stack') ?? ($project['tech_stack'] ?? null)); ?>
<div class="w-full max-w-2xl">
    <div class="brutal-card p-6 bg-white space-y-4">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs uppercase tracking-widest font-bold text-[var(--color-stroke)]">Projects</p>
                <h3 class="text-2xl font-extrabold leading-tight"><?= $isEdit ? 'Edit Project' : 'Create Project' ?></h3>
            </div>
            <span class="brutal-pill">Modal Form</span>
        </div>

        <?php if (! empty($errors)): ?>
            <div class="brutal-card bg-[var(--color-highlight)]/50 text-[var(--color-stroke)] p-4">
                <p class="font-extrabold mb-2">Please check the fields below:</p>
                <ul class="list-disc space-y-1 pl-5 text-sm">
                    <?php foreach ($errors as $message): ?>
                        <li><?= esc($message) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form
            method="post"
            enctype="multipart/form-data"
            action="<?= $isEdit ? '/admin/projects/update/'.$project['id'] : '/admin/projects/store' ?>"
            data-ajax-target="#admin-projects-list"
            class="space-y-4"
            data-project-form
        >
        <?= csrf_field() ?>
        <div class="space-y-1">
            <label class="block text-sm font-bold">Title</label>
            <input type="text" name="title" value="<?= esc($formData['title'] ?? old('title') ?? ($project['title'] ?? '')) ?>" class="w-full p-3 border-2 border-[var(--color-stroke)] rounded-brutal focus-brutal" required>
        </div>
        <div class="space-y-1">
            <label class="block text-sm font-bold">Slug</label>
            <input type="text" name="slug" value="<?= esc($formData['slug'] ?? old('slug') ?? ($project['slug'] ?? '')) ?>" class="w-full p-3 border-2 border-[var(--color-stroke)] rounded-brutal focus-brutal" required>
        </div>
        <div class="space-y-1">
            <label class="block text-sm font-bold">Description</label>
            <textarea name="description" class="w-full p-3 border-2 border-[var(--color-stroke)] rounded-brutal focus-brutal" rows="6"><?= esc($formData['description'] ?? old('description') ?? ($project['description'] ?? '')) ?></textarea>
        </div>
        <div class="space-y-3" data-stack-field>
            <div class="flex items-center justify-between gap-3 flex-wrap">
                <div>
                    <label class="block text-sm font-bold">Tech Stack</label>
                    <p class="text-xs text-gray-600">Pilih teknologi lalu tambahkan sebagai tag ke project.</p>
                </div>
                <span class="brutal-pill bg-white text-xs" data-stack-selected-count>Belum ada pilihan</span>
            </div>

            <div class="space-y-2">
                <div
                    class="brutal-card border-2 border-[var(--color-stroke)] bg-white shadow-[4px_4px_0_var(--color-stroke)] p-3 flex flex-wrap gap-2 min-h-[3.25rem]"
                    data-stack-chips
                >
                    <span class="text-xs text-gray-500" data-stack-placeholder>Belum ada teknologi dipilih.</span>
                </div>

                <div class="relative" data-stack-dropdown-wrapper>
                    <input
                        type="text"
                        placeholder="Cari atau pilih teknologi"
                        class="w-full p-3 border-2 border-[var(--color-stroke)] rounded-brutal focus-brutal pr-12"
                        data-stack-input
                    >
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 brutal-pill bg-white text-xs">Select</span>

                    <div class="absolute left-0 right-0 mt-2 hidden" data-stack-dropdown>
                        <div class="brutal-card border-2 border-[var(--color-stroke)] bg-[var(--color-highlight)]/30 shadow-[4px_4px_0_var(--color-stroke)] max-h-72 overflow-y-auto divide-y divide-[var(--color-stroke)]/10">
                            <?php foreach ($catalog as $icon): ?>
                                <?php $isChecked = in_array($icon['id'], $selectedStack, true); ?>
                                <button
                                    type="button"
                                    class="w-full text-left flex items-center gap-3 p-3 hover:bg-white transition brutal-card border-2 border-transparent"
                                    data-stack-option
                                    data-stack-id="<?= esc($icon['id']) ?>"
                                    data-stack-label="<?= esc(strtolower($icon['label'])) ?>"
                                    data-stack-name="<?= esc($icon['label']) ?>"
                                    data-selected="<?= $isChecked ? 'true' : 'false' ?>"
                                >
                                    <span class="w-10 h-10 inline-flex items-center justify-center bg-white rounded-brutal border-2 border-[var(--color-stroke)]" data-stack-icon>
                                        <?= stack_icon_svg($icon, 40) ?>
                                    </span>
                                    <span class="font-semibold text-sm flex-1"><?= esc($icon['label']) ?></span>
                                    <span class="text-xs brutal-pill <?= $isChecked ? 'bg-[var(--color-accent)] text-[var(--color-stroke)]' : 'bg-white' ?>" data-stack-state>
                                        <?= $isChecked ? 'Selected' : 'Pilih' ?>
                                    </span>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="hidden" data-stack-hidden>
                    <?php foreach ($selectedStack as $value): ?>
                        <input type="hidden" name="tech_stack[]" value="<?= esc($value) ?>">
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                    <div>
                        <p class="block text-sm font-bold">Selected Tech</p>
                        <p class="text-xs text-gray-600">Teknologi yang akan tampil di kartu project.</p>
                    </div>
                </div>
                <div
                    class="brutal-card border-2 border-[var(--color-stroke)] bg-[var(--color-highlight)]/30 p-4 space-y-3"
                    data-stack-selected-list
                >
                    <p class="text-sm text-gray-600" data-stack-empty>Belum ada teknologi dipilih.</p>
                </div>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-bold">Images (multiple)</label>
            <input type="file" name="images[]" multiple class="w-full" />
        </div>
        <?php if ($isEdit): ?>
            <div class="space-y-2">
                <h4 class="font-extrabold mb-1">Images</h4>
                <?= view('admin/projects/images_fragment', ['project' => $project]) ?>
            </div>
        <?php endif ?>

            <div class="flex items-center space-x-3">
                <button type="submit" class="brutal-button px-4 py-2 bg-[var(--color-accent)] text-[var(--color-stroke)]"><?= $isEdit ? 'Update' : 'Create' ?></button>
                <button type="button" class="brutal-button px-4 py-2 bg-white" data-modal-close>Cancel</button>
            </div>
        </form>
    </div>
</div>
