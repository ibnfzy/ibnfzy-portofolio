<a href="/projects/<?= esc($project['slug'] ?? $project['id']) ?>" class="block bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal overflow-hidden shadow-brutal-1 hover:shadow-brutal-2 transition transform hover:-translate-x-1 hover:-translate-y-1">
    <div class="h-44 bg-[var(--color-highlight)]/30 brutal-border border-[var(--color-secondary)] overflow-hidden neo-grid-surface relative">
        <div class="absolute top-2 right-2 brutal-pill bg-[var(--color-magenta)]/60 text-[10px] text-[var(--color-primary)]">Proyek</div>
        <?php if (! empty($project['image'] ?? null)): ?>
            <img src="<?= esc($project['image']) ?>" alt="<?= esc($project['title']) ?>" class="w-full h-full object-cover mix-blend-multiply">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-[var(--color-primary)]/50">No image</div>
        <?php endif ?>
    </div>
    <div class="p-5 space-y-2">
        <h3 class="font-heading font-extrabold text-lg text-[var(--color-secondary)] flex items-center gap-2">
          <span class="inline-block w-3 h-3 bg-[var(--color-secondary)] brutal-border border-[var(--color-stroke)] rounded-full"></span>
          <?= esc($project['title']) ?>
        </h3>
        <p class="text-sm text-[var(--color-primary)]/80 leading-6"><?= word_limiter(strip_tags($project['description'] ?? ''), 20) ?></p>
      <div class="flex items-center justify-between text-[11px] text-[var(--color-primary)]/70">
        <span class="uppercase tracking-[0.2em]">Detail</span>
        <span class="brutal-pill bg-[var(--color-highlight)]/60">View</span>
      </div>
    </div>
</a>
