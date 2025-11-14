<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<?= $this->include('partials/flash') ?>
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold">Projects</h1>
    <div>
        <button hx-get="/admin/projects/create" hx-target="#modal" hx-swap="outerHTML" class="px-3 py-1 bg-green-600 text-white rounded">New Project</button>
    </div>
</div>

<?= $this->include('admin/projects/list_fragment') ?>

<?= $this->endSection() ?>
