<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<article class="bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal p-6 shadow-brutal-2 relative overflow-hidden">
    <div class="absolute -top-8 -left-6 w-32 h-32 bg-[var(--color-highlight)]/30 brutal-border border-[var(--color-stroke)] rounded-brutal rotate-3 animate-wiggle"></div>
    <header class="relative z-10 space-y-2">
        <h1 class="text-3xl font-heading font-extrabold text-[var(--color-secondary)] flex items-center gap-2">
          <span class="w-4 h-4 bg-[var(--color-magenta)] brutal-border border-[var(--color-stroke)] rounded-full"></span>
          <?= esc($project['title']) ?>
        </h1>
        <p class="text-sm text-[var(--color-primary)]/80">Published: <?= esc($project['published_at']) ?></p>
        <?php if (! empty($project['tags'] ?? [])): ?>
            <div class="mt-2 flex flex-wrap gap-2">
                <?php foreach ($project['tags'] as $tag): ?>
                    <a href="/projects/tag/<?= urlencode($tag) ?>" class="inline-block bg-[var(--color-highlight)]/30 brutal-border border-[var(--color-highlight)] px-3 py-1 mr-2 rounded-brutal text-xs text-[var(--color-primary)] shadow-brutal-1">#<?= esc($tag) ?></a>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </header>

    <?php $sliderImages = array_map(static fn($img) => ['path' => $img['path'], 'alt' => $img['alt']], $project['images'] ?? []); ?>
    <section class="mt-6">
        <div class="mb-4">
            <?php if (! empty($sliderImages)): ?>
                <div
                    id="project-slider"
                    class="relative"
                    data-slider
                    data-slider-images='<?= esc(json_encode($sliderImages), 'attr') ?>'
                >
                    <div class="aspect-w-16 aspect-h-9 bg-[var(--color-highlight)]/20 brutal-border border-[var(--color-secondary)] overflow-hidden rounded-brutal neo-grid-surface">
                        <img
                            data-slider-img
                            src="<?= esc($sliderImages[0]['path']) ?>"
                            alt="<?= esc($sliderImages[0]['alt']) ?>"
                            class="w-full h-full object-cover cursor-pointer mix-blend-multiply"
                            data-lightbox-src="<?= esc($sliderImages[0]['path']) ?>"
                        >
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <button type="button" class="px-3 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal bg-[var(--color-accent)] text-white btn-secondary" data-slider-prev>Prev</button>
                        <span class="text-sm text-[var(--color-primary)]/70" data-slider-counter></span>
                        <button type="button" class="px-3 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal bg-[var(--color-secondary)] text-white btn-primary" data-slider-next>Next</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-[var(--color-primary)]/90 leading-7">
            <?= $project['description'] ?>
        </div>
    </section>
</article>

<?= $this->endSection() ?>
