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
        <div class="space-y-2">
            <div class="flex items-center justify-between gap-3 flex-wrap">
                <label class="block text-sm font-bold">Tech Stack</label>
                <input
                    type="text"
                    placeholder="Search stack"
                    class="p-2 border-2 border-[var(--color-stroke)] rounded-brutal text-sm"
                    data-stack-search
                >
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 max-h-80 overflow-y-auto" data-stack-list>
                <?php foreach ($catalog as $icon): ?>
                    <?php $isChecked = in_array($icon['id'], $selectedStack, true); ?>
                    <label
                        class="flex items-center gap-3 brutal-card p-3 cursor-pointer transition hover:-translate-y-0.5"
                        data-stack-option
                        data-stack-label="<?= esc(strtolower($icon['label'])) ?>"
                    >
                        <input
                            type="checkbox"
                            class="sr-only"
                            name="tech_stack[]"
                            value="<?= esc($icon['id']) ?>"
                            <?= $isChecked ? 'checked' : '' ?>
                            data-stack-checkbox
                        >
                        <span class="flex items-center gap-3">
                            <span class="w-10 h-10 inline-flex items-center justify-center">
                                <?= stack_icon_svg($icon, 40) ?>
                            </span>
                            <span class="font-semibold text-sm"><?= esc($icon['label']) ?></span>
                        </span>
                        <span class="ml-auto text-xs brutal-pill <?= $isChecked ? 'bg-[var(--color-accent)] text-[var(--color-stroke)]' : 'bg-white' ?>" data-stack-state>
                            <?= $isChecked ? 'Selected' : 'Choose' ?>
                        </span>
                    </label>
                <?php endforeach; ?>
            </div>
            <p class="text-xs text-gray-600">Cari dan centang ikon untuk menandai teknologi yang digunakan.</p>
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
<script>
    (function() {
        const searchInput = document.querySelector('[data-stack-search]');
        const options = Array.from(document.querySelectorAll('[data-stack-option]'));
        if (searchInput) {
            searchInput.addEventListener('input', (event) => {
                const query = (event.target.value || '').toLowerCase();
                options.forEach((option) => {
                    const label = option.dataset.stackLabel || '';
                    const match = label.includes(query);
                    option.classList.toggle('hidden', !match);
                });
            });
        }

        options.forEach((option) => {
            const checkbox = option.querySelector('[data-stack-checkbox]');
            const state = option.querySelector('[data-stack-state]');
            const setState = (checked) => {
                option.classList.toggle('ring-2', checked);
                option.classList.toggle('ring-[var(--color-accent)]', checked);
                if (state) {
                    state.textContent = checked ? 'Selected' : 'Choose';
                    state.className = 'ml-auto text-xs brutal-pill ' + (checked ? 'bg-[var(--color-accent)] text-[var(--color-stroke)]' : 'bg-white');
                }
            };
            setState(checkbox.checked);

            option.addEventListener('click', (e) => {
                if (e.target.tagName !== 'INPUT') {
                    checkbox.checked = !checkbox.checked;
                }
                setState(checkbox.checked);
            });
        });
    })();
</script>
