<footer class="mt-16 border-t-4 border-[var(--ink)] bg-[var(--paper)]">
  <div class="page-shell grid md:grid-cols-3 gap-6 py-10">
    <div class="neo-panel is-soft p-5 space-y-3">
      <p class="neo-meta">Portfolio</p>
      <div class="text-2xl font-heading font-extrabold">JULTDEV</div>
      <p class="neo-subtle">Web developer & designer yang fokus pada visual berani, layout sederhana, dan pengalaman ringan.</p>
      <span class="neo-chip">Let&apos;s collaborate</span>
    </div>

    <div class="neo-panel is-soft p-5 space-y-3">
      <p class="neo-meta">Contact</p>
      <p class="font-semibold text-lg"><?= esc($profile['email'] ?? 'email@domain.com') ?></p>
      <p class="neo-subtle">Buka untuk proyek freelance, konsultasi, atau kolaborasi komunitas.</p>
    </div>

    <div class="neo-panel is-soft p-5 space-y-3">
      <p class="neo-meta">Social</p>
      <div class="flex gap-2 flex-wrap">
        <?php if (! empty($profile['github_url'])): ?>
          <a class="neo-chip is-ghost is-slim" href="<?= esc($profile['github_url']) ?>" target="_blank" rel="noopener">GitHub</a>
        <?php else: ?>
          <a class="neo-chip is-ghost is-slim" href="https://github.com" target="_blank" rel="noopener">GitHub</a>
        <?php endif; ?>

        <?php if (! empty($profile['linkedin_url'])): ?>
          <a class="neo-chip is-ghost is-slim" href="<?= esc($profile['linkedin_url']) ?>" target="_blank" rel="noopener">LinkedIn</a>
        <?php else: ?>
          <a class="neo-chip is-ghost is-slim" href="https://www.linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="page-shell text-sm text-[var(--muted)] border-t-2 border-[var(--ink)] pt-6 pb-8">
    © <?= date('Y') ?> Ibnu Fauzi — digambar ulang dengan neo-brutal minimalis
  </div>
</footer>
