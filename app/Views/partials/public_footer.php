<footer class="mt-16 brutal-border border-[var(--color-stroke)] border-t-4 bg-[var(--color-bg)] p-8">
  <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-start justify-between gap-6">
    <div>
      <div class="text-lg font-extrabold text-[var(--color-secondary)]">JULTDEV</div>
      <div class="text-xs text-[var(--color-primary)]/70">Web Developer & Designer</div>
    </div>

    <div class="text-sm">
      <div class="mb-2 font-extrabold text-[var(--color-primary)]">Contact</div>
      <div class="text-xs text-[var(--color-primary)]/70">email@domain.com</div>
    </div>

    <div class="text-sm">
      <div class="mb-2 font-extrabold text-[var(--color-primary)]">Social</div>
      <div class="flex gap-2">
        <?php if (! empty($profile['github_url'])): ?>
          <a class="px-2 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal text-xs text-[var(--color-primary)] hover:bg-[var(--color-accent)]/20" href="<?= esc($profile['github_url']) ?>" target="_blank" rel="noopener">GitHub</a>
        <?php else: ?>
          <a class="px-2 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal text-xs text-[var(--color-primary)] hover:bg-[var(--color-accent)]/20" href="https://github.com" target="_blank" rel="noopener">GitHub</a>
        <?php endif; ?>

        <?php if (! empty($profile['linkedin_url'])): ?>
          <a class="px-2 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal text-xs text-[var(--color-primary)] hover:bg-[var(--color-accent)]/20" href="<?= esc($profile['linkedin_url']) ?>" target="_blank" rel="noopener">LinkedIn</a>
        <?php else: ?>
          <a class="px-2 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal text-xs text-[var(--color-primary)] hover:bg-[var(--color-accent)]/20" href="https://www.linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="max-w-6xl mx-auto px-6 mt-6 pt-6 brutal-border border-[var(--color-stroke)] border-t-2 text-xs text-[var(--color-primary)]/70">
    © <?= date('Y') ?> Ibnu Fauzi
  </div>
</footer>
