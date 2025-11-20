<a href="/articles/<?= esc($article['slug'] ?? $article['id']) ?>" class="block bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal overflow-hidden shadow-brutal-1 hover:shadow-brutal-2 transition transform hover:-translate-x-1 hover:-translate-y-1">
    <div class="p-5 border-l-4 border-[var(--color-accent)] bg-[var(--color-accent)]/15 neo-grid-surface space-y-2">
        <div class="flex items-center justify-between text-[11px] uppercase tracking-[0.2em] text-[var(--color-primary)]/70">
          <span>Artikel</span>
          <span class="brutal-pill bg-[var(--color-highlight)]/60">Baca</span>
        </div>
        <h3 class="font-heading font-extrabold text-lg text-[var(--color-secondary)] leading-tight"><?= esc($article['title']) ?></h3>
        <p class="text-sm text-[var(--color-primary)]/80 leading-6"><?= word_limiter(strip_tags($article['body'] ?? ''), 30) ?></p>
    </div>
</a>
