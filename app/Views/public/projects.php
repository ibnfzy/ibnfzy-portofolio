<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="py-12 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] text-[var(--color-primary)]/60">Showcase</p>
            <h1 class="text-3xl font-heading font-extrabold text-[var(--color-secondary)]">Projects</h1>
        </div>
        <span class="brutal-pill bg-[var(--color-highlight)]/50">Semua karya</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (! empty($projects)) : ?>
            <?php foreach ($projects as $p) : ?>
                <?= view('partials/project_card', ['project' => $p]) ?>
            <?php endforeach ?>
        <?php else: ?>
            <div class="bg-[var(--color-highlight)]/10 brutal-border border-[var(--color-highlight)] rounded-brutal p-6 text-[var(--color-primary)] shadow-brutal-1">No projects found.</div>
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>
