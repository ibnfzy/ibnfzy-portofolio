<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<article class="neo-panel is-ghost p-8 space-y-5">
    <header class="space-y-2">
        <div class="flex items-start justify-between gap-3 flex-wrap">
          <div>
            <p class="neo-meta">Artikel</p>
            <h1 class="text-3xl font-heading font-extrabold leading-tight"><?= esc($article['title']) ?></h1>
          </div>
          <span class="neo-chip is-slim"><?= esc($article['published_at']) ?></span>
        </div>
        <?php if (! empty($article['tags'] ?? [])): ?>
            <div class="mt-2 flex flex-wrap gap-2">
                <?php foreach ($article['tags'] as $tag): ?>
                    <a href="/articles/tag/<?= urlencode($tag) ?>" class="neo-chip is-ghost is-slim">#<?= esc($tag) ?></a>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </header>

    <section class="space-y-4">
        <?php if (! empty($article['images'])): ?>
            <div class="neo-thumb aspect-[16/9] overflow-hidden rounded-[14px]">
                <img
                    src="<?= esc($article['images'][0]['path']) ?>"
                    alt="<?= esc($article['images'][0]['alt']) ?>"
                    class="w-full h-full object-cover"
                    data-lightbox-src="<?= esc($article['images'][0]['path']) ?>"
                >
            </div>
        <?php endif ?>

        <div class="neo-divider"></div>

        <div class="leading-7 text-[var(--ink)]">
            <?= $article['body'] ?>
        </div>
    </section>
</article>

<?= $this->endSection() ?>
