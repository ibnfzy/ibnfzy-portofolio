<a href="/articles/<?= esc($article['slug'] ?? $article['id']) ?>" class="block neo-panel is-soft neo-hover h-full">
    <div class="p-5 space-y-3">
        <div class="flex items-center justify-between">
          <span class="neo-meta">Artikel</span>
          <span class="neo-chip is-slim is-ghost">Baca</span>
        </div>
        <h3 class="font-heading font-extrabold text-lg leading-tight"><?= esc($article['title']) ?></h3>
        <p class="text-sm neo-subtle leading-6"><?= word_limiter(strip_tags($article['body'] ?? ''), 30) ?></p>
        <div class="neo-divider"></div>
        <div class="flex items-center gap-2 text-sm font-semibold">
          <span class="inline-block w-2 h-2 rounded-full bg-[var(--accent)]"></span>
          Baca selengkapnya
        </div>
    </div>
</a>
