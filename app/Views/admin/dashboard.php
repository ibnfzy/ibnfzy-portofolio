<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<div class="space-y-6">
    <header class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Admin Dashboard</h1>
        <div>
            <button type="button" class="px-3 py-1 bg-blue-600 text-white rounded" onclick="window.location.reload()">Refresh stats</button>
        </div>
    </header>

    <section id="stats" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 bg-white rounded shadow">Projects<br><span class="text-3xl"><?= esc($project_count ?? '—') ?></span></div>
        <div class="p-4 bg-white rounded shadow">Articles<br><span class="text-3xl"><?= esc($article_count ?? '—') ?></span></div>
        <div class="p-4 bg-white rounded shadow">Users<br><span class="text-3xl"><?= esc($user_count ?? '—') ?></span></div>
    </section>

    <section>
        <h2 class="text-lg font-medium mb-2">Quick actions</h2>
        <div class="space-x-2">
            <a href="/admin/projects/create" class="px-3 py-1 bg-green-600 text-white rounded">New Project</a>
            <a href="/admin/articles/create" class="px-3 py-1 bg-green-600 text-white rounded">New Article</a>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
