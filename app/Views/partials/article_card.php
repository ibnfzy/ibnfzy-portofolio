<a href="/articles/<?= esc($article['slug'] ?? $article['id']) ?>" class="block bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal overflow-hidden shadow-brutal-1 hover:shadow-brutal-2 transition">
    <div class="p-4 border-l-4 border-[var(--color-accent)]">
        <h3 class="font-heading font-extrabold text-lg text-[var(--color-secondary)]"><?= esc($article['title']) ?></h3>
        <p class="text-sm text-[var(--color-primary)]/80 mt-2"><?= word_limiter(strip_tags($article['body'] ?? ''), 30) ?></p>
    </div>
</a>
