<?php $isEdit = ! empty($project); ?>
<div class="w-full max-w-2xl" onclick="event.stopPropagation();">
    <?= view('partials/flash') ?>
    <div class="bg-white p-4 rounded shadow">
        <form method="post" enctype="multipart/form-data" action="<?= $isEdit ? '/admin/projects/update/'.$project['id'] : '/admin/projects/store' ?>" hx-post="<?= $isEdit ? '/admin/projects/update/'.$project['id'] : '/admin/projects/store' ?>" hx-target="#admin-projects-list" hx-swap="outerHTML">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="block text-sm">Title</label>
            <input type="text" name="title" value="<?= esc($project['title'] ?? old('title')) ?>" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-3">
            <label class="block text-sm">Slug</label>
            <input type="text" name="slug" value="<?= esc($project['slug'] ?? old('slug')) ?>" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-3">
            <label class="block text-sm">Description</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="6"><?= esc($project['description'] ?? old('description')) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="block text-sm">Images (multiple)</label>
            <input type="file" name="images[]" multiple class="w-full" />
        </div>
        <?php if ($isEdit): ?>
            <div class="mb-3">
                <h4 class="font-semibold mb-2">Images</h4>
                <?= view('admin/projects/images_fragment', ['project' => $project]) ?>
            </div>
        <?php endif ?>

            <div class="flex items-center space-x-2">
                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded"><?= $isEdit ? 'Update' : 'Create' ?></button>
                <button type="button" onclick="closeModal()" class="px-3 py-1 bg-gray-200 rounded">Cancel</button>
            </div>
        </form>
    </div>
</div>
