<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="py-12">
    <h1 class="text-3xl font-heading font-extrabold mb-6 text-[var(--color-secondary)]">Projects</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (! empty($projects)) : ?>
            <?php foreach ($projects as $p) : ?>
                <?= view('partials/project_card', ['project' => $p]) ?>
            <?php endforeach ?>
        <?php else: ?>
            <div class="bg-[var(--color-highlight)]/5 brutal-border border-[var(--color-highlight)] rounded-brutal p-6 text-[var(--color-primary)]">No projects found.</div>
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>
