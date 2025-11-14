<a href="/projects/<?= esc($project['slug'] ?? $project['id']) ?>" class="block bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal overflow-hidden shadow-brutal-1 hover:shadow-brutal-2 transition">
    <div class="h-40 bg-[var(--color-highlight)]/20 brutal-border border-[var(--color-secondary)] overflow-hidden">
        <?php if (! empty($project['image'] ?? null)): ?>
            <img src="<?= esc($project['image']) ?>" alt="<?= esc($project['title']) ?>" class="w-full h-full object-cover">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-[var(--color-primary)]/50">No image</div>
        <?php endif ?>
    </div>
    <div class="p-4">
        <h3 class="font-heading font-extrabold text-lg text-[var(--color-secondary)]"><?= esc($project['title']) ?></h3>
        <p class="text-sm text-[var(--color-primary)]/80 mt-2"><?= word_limiter(strip_tags($project['description'] ?? ''), 20) ?></p>
    </div>
</a>
