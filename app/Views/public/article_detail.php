<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<article class="bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal p-6 shadow-brutal-2 relative overflow-hidden">
    <div class="absolute -top-8 -right-6 w-32 h-32 bg-[var(--color-highlight)]/30 brutal-border border-[var(--color-stroke)] rounded-brutal rotate-3 animate-floaty"></div>
    <header class="relative z-10 space-y-2">
        <h1 class="text-3xl font-heading font-extrabold text-[var(--color-secondary)] flex items-center gap-2">
          <span class="w-4 h-4 bg-[var(--color-magenta)] brutal-border border-[var(--color-stroke)] rounded-full"></span>
          <?= esc($article['title']) ?>
        </h1>
        <p class="text-sm text-[var(--color-primary)]/80">Published: <?= esc($article['published_at']) ?></p>
        <?php if (! empty($article['tags'] ?? [])): ?>
            <div class="mt-2 flex flex-wrap gap-2">
                <?php foreach ($article['tags'] as $tag): ?>
                    <a href="/articles/tag/<?= urlencode($tag) ?>" class="inline-block bg-[var(--color-accent)]/30 brutal-border border-[var(--color-accent)] px-3 py-1 rounded-brutal text-xs text-[var(--color-primary)] shadow-brutal-1">#<?= esc($tag) ?></a>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </header>

    <section class="mt-6 relative z-10 space-y-4">
        <div class="mb-4">
            <?php if (! empty($article['images'])): ?>
                <div class="aspect-w-16 aspect-h-9 bg-[var(--color-accent)]/20 brutal-border border-[var(--color-accent)] rounded-brutal overflow-hidden neo-grid-surface">
                    <img
                        src="<?= esc($article['images'][0]['path']) ?>"
                        alt="<?= esc($article['images'][0]['alt']) ?>"
                        class="w-full h-full object-cover cursor-pointer mix-blend-multiply"
                        data-lightbox-src="<?= esc($article['images'][0]['path']) ?>"
                    >
                </div>
            <?php endif ?>
        </div>

        <div class="text-[var(--color-primary)]/90 leading-7">
            <?= $article['body'] ?>
        </div>
    </section>
</article>

<?= $this->endSection() ?>
