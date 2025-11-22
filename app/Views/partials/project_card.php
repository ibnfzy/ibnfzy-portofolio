<?php helper('stack'); ?>
<?php $stackItems = stack_resolved_list($project['tech_stack'] ?? null); ?>
<a href="/projects/<?= esc($project['slug'] ?? $project['id']) ?>" class="block neo-panel is-soft neo-hover h-full">
    <div class="neo-thumb h-44 relative">
        <span class="neo-chip is-ghost is-slim absolute top-3 right-3">Proyek</span>
        <?php if (! empty($project['image'] ?? null)): ?>
            <img src="<?= esc($project['image']) ?>" alt="<?= esc($project['title']) ?>" class="w-full h-full object-cover">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center neo-subtle">No image</div>
        <?php endif ?>
    </div>
    <div class="p-5 space-y-3">
        <div class="flex items-start justify-between gap-2">
          <h3 class="font-heading font-extrabold text-xl leading-tight">
            <?= esc($project['title']) ?>
          </h3>
          <span class="neo-meta">Detail</span>
        </div>
        <?php if (! empty($stackItems)): ?>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($stackItems as $item): ?>
                    <span class="neo-chip is-ghost is-slim inline-flex items-center gap-2">
                        <span class="inline-flex w-6 h-6 items-center justify-center">
                            <?= stack_icon_svg($item, 22) ?>
                        </span>
                        <?= esc($item['label']) ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <p class="text-sm neo-subtle leading-6"><?= word_limiter(strip_tags($project['description'] ?? ''), 20) ?></p>
        <div class="flex items-center justify-between text-sm font-semibold">
          <span class="inline-flex items-center gap-2">Lihat proyek <span aria-hidden="true">→</span></span>
          <span class="neo-chip is-slim">Go</span>
        </div>
    </div>
</a>
