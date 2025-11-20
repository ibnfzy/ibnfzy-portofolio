<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="py-12 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] text-[var(--color-primary)]/60">Insights</p>
            <h1 class="text-3xl font-heading font-extrabold text-[var(--color-secondary)]">Articles</h1>
        </div>
        <span class="brutal-pill bg-[var(--color-accent)]/50">Catatan desain</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php if (! empty($articles)) : ?>
            <?php foreach ($articles as $a) : ?>
                <?= view('partials/article_card', ['article' => $a]) ?>
            <?php endforeach ?>
        <?php else: ?>
            <div class="bg-[var(--color-accent)]/10 brutal-border border-[var(--color-accent)] rounded-brutal p-6 text-[var(--color-primary)] shadow-brutal-1">No articles found.</div>
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>
