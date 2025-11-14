<?php /** @var array|null $article */ ?>
<?php $editing = ! empty($article); ?>

<div class="w-full max-w-3xl" onclick="event.stopPropagation();">
    <div class="bg-white p-6 rounded shadow">
        <form
            method="post"
            enctype="multipart/form-data"
            class="space-y-4"
            action="<?= $editing ? '/admin/articles/update/'.$article['id'] : '/admin/articles/store' ?>"
            data-ajax-target="#admin-articles-list"
        >
            <?= csrf_field() ?>

            <div>
                <label class="block text-sm font-medium">Title</label>
                <input type="text" name="title" value="<?= $editing ? esc($article['title']) : '' ?>" class="mt-1 block w-full border rounded px-2 py-1" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Slug</label>
                <input type="text" name="slug" value="<?= $editing ? esc($article['slug']) : '' ?>" class="mt-1 block w-full border rounded px-2 py-1" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Body</label>
                <textarea name="body" rows="6" class="mt-1 block w-full border rounded px-2 py-1"><?= $editing ? esc($article['body']) : '' ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Images</label>
                <input type="file" name="images[]" multiple class="mt-1 block w-full">
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Save</button>
                <button type="button" class="px-3 py-1 bg-gray-300 rounded" data-modal-close>Cancel</button>
            </div>
        </form>
    </div>
</div>
