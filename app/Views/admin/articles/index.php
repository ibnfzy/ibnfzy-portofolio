<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<div class="brutal-card brutal-card-accent p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="space-y-1">
        <p class="text-xs uppercase tracking-[0.3em] font-black">Content Lab</p>
        <h1 class="text-3xl font-extrabold leading-tight">Articles</h1>
        <p class="text-sm max-w-xl">Manage write-ups with chunky controls, bold colors, and instant feedback.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <button
            type="button"
            class="brutal-button px-4 py-2 bg-white"
            data-ajax-url="/admin/articles/create"
            data-ajax-target="#modal-content"
        >New Article</button>
    </div>
</div>

<div class="brutal-card mt-6 p-0 overflow-hidden">
    <?= $this->include('admin/articles/list_fragment') ?>
</div>

<?= $this->endSection() ?>
