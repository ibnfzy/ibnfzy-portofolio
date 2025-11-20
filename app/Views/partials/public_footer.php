<footer class="mt-16 brutal-border border-[var(--color-stroke)] border-t-4 bg-[var(--color-bg)] p-8 relative overflow-hidden">
  <div class="absolute -top-8 left-10 w-24 h-24 bg-[var(--color-magenta)]/25 brutal-border border-[var(--color-stroke)] rounded-brutal rotate-6 animate-wiggle"></div>
  <div class="absolute -bottom-10 right-6 w-32 h-32 bg-[var(--color-accent)]/25 brutal-border border-[var(--color-stroke)] rounded-brutal animate-floaty"></div>

  <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-start justify-between gap-6 relative z-10">
    <div class="bg-white brutal-border border-[var(--color-stroke)] rounded-brutal px-4 py-3 shadow-brutal-1">
      <div class="text-lg font-extrabold text-[var(--color-secondary)]">JULTDEV</div>
      <div class="text-xs text-[var(--color-primary)]/70">Web Developer & Designer</div>
      <span class="inline-block mt-3 brutal-pill">Let&apos;s collaborate</span>
    </div>

    <div class="text-sm bg-white brutal-border border-[var(--color-stroke)] rounded-brutal px-4 py-3 shadow-brutal-1 neo-grid-surface">
      <div class="mb-2 font-extrabold text-[var(--color-primary)]">Contact</div>
      <div class="text-xs text-[var(--color-primary)]/70">email@domain.com</div>
    </div>

    <div class="text-sm bg-white brutal-border border-[var(--color-stroke)] rounded-brutal px-4 py-3 shadow-brutal-1">
      <div class="mb-2 font-extrabold text-[var(--color-primary)]">Social</div>
      <div class="flex gap-2 flex-wrap">
        <?php if (! empty($profile['github_url'])): ?>
          <a class="px-3 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal text-xs text-[var(--color-primary)] hover:bg-[var(--color-accent)]/30 shadow-brutal-1" href="<?= esc($profile['github_url']) ?>" target="_blank" rel="noopener">GitHub</a>
        <?php else: ?>
          <a class="px-3 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal text-xs text-[var(--color-primary)] hover:bg-[var(--color-accent)]/30 shadow-brutal-1" href="https://github.com" target="_blank" rel="noopener">GitHub</a>
        <?php endif; ?>

        <?php if (! empty($profile['linkedin_url'])): ?>
          <a class="px-3 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal text-xs text-[var(--color-primary)] hover:bg-[var(--color-accent)]/30 shadow-brutal-1" href="<?= esc($profile['linkedin_url']) ?>" target="_blank" rel="noopener">LinkedIn</a>
        <?php else: ?>
          <a class="px-3 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal text-xs text-[var(--color-primary)] hover:bg-[var(--color-accent)]/30 shadow-brutal-1" href="https://www.linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="max-w-6xl mx-auto px-6 mt-6 pt-6 brutal-border border-[var(--color-stroke)] border-t-2 text-xs text-[var(--color-primary)]/70 relative z-10">
    © <?= date('Y') ?> Ibnu Fauzi — made with bold pixels
  </div>
</footer>
