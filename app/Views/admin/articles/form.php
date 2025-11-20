<?php /** @var array|null $article */ ?>
<?php $editing = ! empty($article); ?>
<?php $errors = $errors ?? session('errors') ?? []; ?>
<?php $formData = $formData ?? []; ?>

<div class="w-full max-w-3xl">
    <div class="brutal-card p-6 bg-white space-y-4">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs uppercase tracking-widest font-bold text-[var(--color-stroke)]">Article</p>
                <h3 class="text-2xl font-extrabold leading-tight"><?= $editing ? 'Update Article' : 'Create Article' ?></h3>
            </div>
            <span class="brutal-pill">Modal Form</span>
        </div>

        <?php if (! empty($errors)): ?>
            <div class="brutal-card bg-[var(--color-highlight)]/50 text-[var(--color-stroke)] p-4">
                <p class="font-extrabold mb-2">Please fix the highlighted issues:</p>
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
            class="space-y-4"
            action="<?= $editing ? '/admin/articles/update/'.$article['id'] : '/admin/articles/store' ?>"
            data-ajax-target="#admin-articles-list"
        >
            <?= csrf_field() ?>

            <div class="space-y-1">
                <label class="block text-sm font-bold">Title</label>
                <input type="text" name="title" value="<?= esc($formData['title'] ?? old('title') ?? ($article['title'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal" required>
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-bold">Slug</label>
                <input type="text" name="slug" value="<?= esc($formData['slug'] ?? old('slug') ?? ($article['slug'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal" required>
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-bold">Body</label>
                <textarea name="body" rows="6" class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal"><?= esc($formData['body'] ?? old('body') ?? ($article['body'] ?? '')) ?></textarea>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold">Images</label>
                <input type="file" name="images[]" multiple class="mt-1 block w-full">
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="brutal-button px-4 py-2 bg-[var(--color-accent)] text-[var(--color-stroke)]">Save</button>
                <button type="button" class="brutal-button px-4 py-2 bg-white" data-modal-close>Cancel</button>
            </div>
        </form>
    </div>
</div>
