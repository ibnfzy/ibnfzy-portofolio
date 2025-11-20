<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<div class="space-y-8">
    <header class="bg-[var(--color-highlight)] brutal-border rounded-brutal shadow-brutal-2 p-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="uppercase tracking-[0.2em] text-sm font-bold">Control Room</p>
            <h1 class="text-3xl font-extrabold leading-tight">Admin Dashboard</h1>
            <p class="text-base font-medium text-[var(--color-primary)]/80">Lihat performa dan buat konten baru dengan cepat.</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" class="px-4 py-2 bg-[var(--color-primary)] text-white brutal-border rounded-brutal shadow-brutal-1" onclick="window.location.reload()">Refresh stats</button>
            <a href="/" class="px-4 py-2 bg-white brutal-border rounded-brutal shadow-brutal-1 font-semibold">Lihat situs</a>
        </div>
    </header>

    <section id="stats" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-5 bg-[var(--color-surface)] brutal-border rounded-brutal shadow-brutal-1">
            <p class="text-sm uppercase tracking-[0.2em] font-bold text-[var(--color-secondary)]">Projects</p>
            <p class="text-4xl font-extrabold mt-3"><?= esc($project_count ?? '—') ?></p>
            <p class="mt-1 text-sm text-[var(--color-primary)]/70">Total proyek yang sedang tayang.</p>
        </div>
        <div class="p-5 bg-[var(--color-accent)] brutal-border rounded-brutal shadow-brutal-1">
            <p class="text-sm uppercase tracking-[0.2em] font-bold text-[var(--color-primary)]">Articles</p>
            <p class="text-4xl font-extrabold mt-3"><?= esc($article_count ?? '—') ?></p>
            <p class="mt-1 text-sm text-[var(--color-primary)]/80">Jumlah artikel di blog.</p>
        </div>
        <div class="p-5 bg-white brutal-border rounded-brutal shadow-brutal-1">
            <p class="text-sm uppercase tracking-[0.2em] font-bold text-[var(--color-primary)]">Users</p>
            <p class="text-4xl font-extrabold mt-3"><?= esc($user_count ?? '—') ?></p>
            <p class="mt-1 text-sm text-[var(--color-primary)]/70">Administrator terdaftar.</p>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white brutal-border rounded-brutal shadow-brutal-2 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] font-bold text-[var(--color-primary)]/80">Quick Actions</p>
                    <h2 class="text-2xl font-extrabold">Buat konten seketika</h2>
                </div>
                <span class="px-3 py-1 bg-[var(--color-highlight)] brutal-border rounded-brutal text-sm font-semibold">modal</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <button
                    type="button"
                    data-ajax-url="/admin/projects/create"
                    data-ajax-target="#modal-content"
                    class="group w-full text-left px-4 py-3 bg-[var(--color-accent)] brutal-border rounded-brutal shadow-brutal-1 flex items-center justify-between"
                >
                    <span class="font-bold">Project baru</span>
                    <span class="text-xl">➕</span>
                </button>

                <button
                    type="button"
                    data-ajax-url="/admin/articles/create"
                    data-ajax-target="#modal-content"
                    class="group w-full text-left px-4 py-3 bg-[var(--color-secondary)] text-white brutal-border rounded-brutal shadow-brutal-1 flex items-center justify-between"
                >
                    <span class="font-bold">Artikel baru</span>
                    <span class="text-xl">📝</span>
                </button>

                <a
                    href="/admin/projects"
                    class="px-4 py-3 bg-white brutal-border rounded-brutal shadow-brutal-1 font-semibold flex items-center justify-between"
                >
                    Kelola proyek <span>↗</span>
                </a>
                <a
                    href="/admin/articles"
                    class="px-4 py-3 bg-white brutal-border rounded-brutal shadow-brutal-1 font-semibold flex items-center justify-between"
                >
                    Kelola artikel <span>↗</span>
                </a>
            </div>
            <p class="text-sm text-[var(--color-primary)]/70">Tombol di atas membuka form di dalam modal agar Anda tetap berada di dashboard.</p>
        </div>

        <div class="bg-[var(--color-highlight)] brutal-border rounded-brutal shadow-brutal-1 p-6 space-y-3">
            <p class="text-xs uppercase tracking-[0.3em] font-bold">Status cepat</p>
            <ul class="space-y-2 text-sm font-semibold">
                <li class="flex items-center gap-2"><span class="text-lg">⚡</span>Performa server stabil</li>
                <li class="flex items-center gap-2"><span class="text-lg">✅</span>Backup otomatis aktif</li>
                <li class="flex items-center gap-2"><span class="text-lg">📢</span>Jadwalkan artikel berikutnya</li>
            </ul>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
