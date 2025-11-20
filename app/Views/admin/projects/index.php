<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<div class="brutal-card brutal-card-accent p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="space-y-1">
        <p class="text-xs uppercase tracking-[0.3em] font-black">Build Space</p>
        <h1 class="text-3xl font-extrabold leading-tight">Projects</h1>
        <p class="text-sm max-w-xl">Your playground for portfolio pieces with loud lines and chunky buttons.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <button
            type="button"
            class="brutal-button px-4 py-2 bg-white"
            data-ajax-url="/admin/projects/create"
            data-ajax-target="#modal-content"
        >New Project</button>
    </div>
</div>

<div class="mt-6">
    <?= $this->include('admin/projects/list_fragment') ?>
</div>

<?= $this->endSection() ?>
