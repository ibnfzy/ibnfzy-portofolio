<?php $isEdit = ! empty($project); ?>
<?php $errors = $errors ?? session('errors') ?? []; ?>
<?php $formData = $formData ?? []; ?>
<div class="w-full max-w-2xl" onclick="event.stopPropagation();">
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
