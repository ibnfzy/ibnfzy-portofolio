<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="py-12">
    <div class="neo-panel is-ghost p-8 space-y-6">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <p class="neo-meta">Showcase</p>
                <h1 class="text-3xl font-heading font-extrabold">Projects</h1>
            </div>
            <span class="neo-chip is-ghost">Semua karya</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (! empty($projects)) : ?>
                <?php foreach ($projects as $p) : ?>
                    <?= view('partials/project_card', ['project' => $p]) ?>
                <?php endforeach ?>
            <?php else: ?>
                <div class="neo-panel is-soft p-6 text-[var(--ink)]">No projects found.</div>
            <?php endif ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
