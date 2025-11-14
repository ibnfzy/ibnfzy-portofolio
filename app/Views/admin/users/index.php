<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<?= $this->include('partials/flash') ?>
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold">Users</h1>
    <div>
        <button
            type="button"
            class="px-3 py-1 bg-green-600 text-white rounded"
            data-ajax-url="/admin/users/create"
            data-ajax-target="#modal-content"
        >New User</button>
    </div>
</div>

<div class="bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal p-4">
    <?= $this->include('admin/users/list_fragment', ['users' => $users]) ?>
</div>
<?= $this->endSection() ?>
