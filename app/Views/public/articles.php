<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="py-12">
    <h1 class="text-3xl font-heading font-extrabold mb-6 text-[var(--color-secondary)]">Articles</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php if (! empty($articles)) : ?>
            <?php foreach ($articles as $a) : ?>
                <?= view('partials/article_card', ['article' => $a]) ?>
            <?php endforeach ?>
        <?php else: ?>
            <div class="bg-[var(--color-accent)]/5 brutal-border border-[var(--color-accent)] rounded-brutal p-6 text-[var(--color-primary)]">No articles found.</div>
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>
