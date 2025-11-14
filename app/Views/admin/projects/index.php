<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<?= $this->include('partials/flash') ?>
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold">Projects</h1>
    <div>
        <button
            type="button"
            class="px-3 py-1 bg-green-600 text-white rounded"
            data-ajax-url="/admin/projects/create"
            data-ajax-target="#modal-content"
        >New Project</button>
    </div>
</div>

<?= $this->include('admin/projects/list_fragment') ?>

<?= $this->endSection() ?>
