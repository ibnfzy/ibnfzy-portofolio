<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="py-12">
    <div class="neo-panel is-ghost p-8 space-y-6">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <p class="neo-meta">Insights</p>
                <h1 class="text-3xl font-heading font-extrabold">Articles</h1>
            </div>
            <span class="neo-chip is-ghost">Catatan desain</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if (! empty($articles)) : ?>
                <?php foreach ($articles as $a) : ?>
                    <?= view('partials/article_card', ['article' => $a]) ?>
                <?php endforeach ?>
            <?php else: ?>
                <div class="neo-panel is-soft p-6 text-[var(--ink)]">No articles found.</div>
            <?php endif ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
