<?php /** @var array|null $article */ ?>
<?php $editing = ! empty($article); ?>
<?php $errors = $errors ?? session('errors') ?? []; ?>
<?php $formData = $formData ?? []; ?>

<?= view('partials/admin_modal_form', [
    'contextLabel'   => 'Article',
    'titleText'      => $editing ? 'Update Article' : 'Create Article',
    'errors'         => $errors,
    'errorHeading'   => 'Please fix the highlighted issues:',
    'action'         => $editing ? '/admin/articles/update/'.$article['id'] : '/admin/articles/store',
    'formAttributes' => [
        'enctype'         => 'multipart/form-data',
        'class'           => 'space-y-4',
        'data-ajax-target'=> '#admin-articles-list',
    ],
    'submitLabel'    => 'Save',
    'maxWidthClass'  => 'max-w-3xl',
    'fields'         => function () use ($formData, $article) { ?>
        <div class="space-y-1">
            <label class="block text-sm font-bold">Title</label>
            <input
                type="text"
                name="title"
                value="<?= esc($formData['title'] ?? old('title') ?? ($article['title'] ?? '')) ?>"
                class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal"
                required
            >
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-bold">Slug</label>
            <input
                type="text"
                name="slug"
                value="<?= esc($formData['slug'] ?? old('slug') ?? ($article['slug'] ?? '')) ?>"
                class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal"
                required
            >
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-bold">Body</label>
            <textarea
                name="body"
                rows="6"
                class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal"
            ><?= esc($formData['body'] ?? old('body') ?? ($article['body'] ?? '')) ?></textarea>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-bold">Images</label>
            <input type="file" name="images[]" multiple class="mt-1 block w-full">
        </div>
    <?php },
]) ?>
