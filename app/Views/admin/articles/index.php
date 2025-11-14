<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<?= $this->include('partials/flash') ?>
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold">Articles</h1>
    <div>
        <button
            type="button"
            class="px-3 py-1 bg-green-600 text-white rounded"
            data-ajax-url="/admin/articles/create"
            data-ajax-target="#modal-content"
        >New Article</button>
    </div>
</div>

<?= $this->include('admin/articles/list_fragment') ?>

<?= $this->endSection() ?>
