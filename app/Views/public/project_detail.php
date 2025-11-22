<?php helper('stack'); ?>
<?php $stackItems = stack_resolved_list($project['tech_stack'] ?? null); ?>
<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<article class="neo-panel is-ghost p-8 space-y-5">
    <header class="space-y-2">
        <div class="flex items-start justify-between gap-3 flex-wrap">
          <div>
            <p class="neo-meta">Project</p>
            <h1 class="text-3xl font-heading font-extrabold leading-tight"><?= esc($project['title']) ?></h1>
          </div>
          <span class="neo-chip is-slim"><?= esc($project['published_at']) ?></span>
        </div>
        <?php if (! empty($project['tags'] ?? [])): ?>
            <div class="mt-2 flex flex-wrap gap-2">
                <?php foreach ($project['tags'] as $tag): ?>
                    <a href="/projects/tag/<?= urlencode($tag) ?>" class="neo-chip is-ghost is-slim">#<?= esc($tag) ?></a>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <?php if (! empty($stackItems)): ?>
            <div class="mt-2 flex flex-wrap gap-2">
                <?php foreach ($stackItems as $item): ?>
                    <span class="neo-chip is-soft inline-flex items-center gap-2">
                        <span class="inline-flex w-7 h-7 items-center justify-center">
                            <?= stack_icon_svg($item, 26) ?>
                        </span>
                        <?= esc($item['label']) ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </header>

    <?php $sliderImages = array_map(static fn($img) => ['path' => $img['path'], 'alt' => $img['alt']], $project['images'] ?? []); ?>
    <section class="space-y-4">
        <?php if (! empty($sliderImages)): ?>
            <div
                id="project-slider"
                class="space-y-3"
                data-slider
                data-slider-images='<?= esc(json_encode($sliderImages), 'attr') ?>'
            >
                <div class="neo-thumb aspect-[16/9] overflow-hidden rounded-[14px]">
                    <img
                        data-slider-img
                        src="<?= esc($sliderImages[0]['path']) ?>"
                        alt="<?= esc($sliderImages[0]['alt']) ?>"
                        class="w-full h-full object-cover"
                        data-lightbox-src="<?= esc($sliderImages[0]['path']) ?>"
                    >
                </div>
                <div class="flex items-center justify-between">
                    <button type="button" class="neo-btn ghost" data-slider-prev>Prev</button>
                    <span class="text-sm neo-subtle" data-slider-counter></span>
                    <button type="button" class="neo-btn primary" data-slider-next>Next</button>
                </div>
            </div>
        <?php endif; ?>

        <div class="neo-divider"></div>

        <div class="leading-7 text-[var(--ink)]">
            <?= $project['description'] ?>
        </div>
    </section>
</article>

<?= $this->endSection() ?>
