<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="px-0 space-y-14">
  <!-- Hero (uses profile from DB if available) -->
  <section class="flex flex-col lg:flex-row items-start gap-8">
    <article class="flex-1 bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal p-8 shadow-brutal-2 gradient-border">
      <div class="flex items-center gap-3 mb-4">
        <span class="brutal-pill bg-[var(--color-highlight)]/70">AVAILABLE FOR FREELANCE</span>
        <span class="text-xs uppercase tracking-[0.25em] text-[var(--color-primary)]/60">Neo Brutalism</span>
      </div>
      <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-3 text-[var(--color-secondary)] leading-[1.1]"><?php echo esc($profile['full_name'] ?? 'Nama Anda'); ?></h1>
      <p class="text-base leading-7 mb-6 text-[var(--color-primary)]/90 max-w-2xl"><?php echo esc($profile['bio'] ?? 'Saya pengembang web & desainer produk yang fokus pada pengalaman sederhana namun kuat. Neo-brutalism membuat interface terasa jujur, tegas, dan menyenangkan.'); ?></p>

      <div class="flex flex-wrap gap-3 items-center">
        <a href="#projects" class="inline-flex items-center gap-2 px-6 py-3 bg-[var(--color-secondary)] text-white font-heading font-extrabold brutal-border border-[var(--color-stroke)] rounded-brutal btn-primary animate-pulse-brutal">
          ⚡ Lihat Proyek
        </a>
        <a href="#about" class="inline-flex items-center gap-2 px-5 py-3 bg-[var(--color-accent)] text-white font-heading font-extrabold brutal-border border-[var(--color-stroke)] rounded-brutal btn-secondary">
          👀 Tentang Saya
        </a>
        <span class="inline-flex items-center gap-2 text-xs font-semibold text-[var(--color-primary)]">
          <span class="w-3 h-3 bg-[var(--color-magenta)] brutal-border border-[var(--color-stroke)] rounded-full animate-wiggle"></span>
          Membuat visual yang berani + fungsional
        </span>
      </div>
    </article>

    <aside class="w-full lg:w-80">
      <div class="bg-[var(--color-surface)] brutal-border border-[var(--color-secondary)] border-4 p-4 rounded-brutal shadow-brutal-2 translate-y-6 neo-grid-surface relative overflow-hidden">
        <div class="absolute -top-6 right-4 w-16 h-16 bg-[var(--color-highlight)] brutal-border border-[var(--color-stroke)] rounded-brutal rotate-6 animate-floaty"></div>
        <img src="<?= esc($profile['avatar_path'] ?? '/public_site_assets/images/profile.jpg') ?>" alt="Foto Profil" class="w-full h-64 object-cover brutal-border border-[var(--color-stroke)] rounded-brutal mb-3 relative z-10">
        <div class="text-sm relative z-10">
          <div class="font-extrabold text-[var(--color-secondary)]" style="font-family: Montserrat, Inter, sans-serif;"><?php echo esc($profile['full_name'] ?? 'Nama Anda'); ?></div>
          <div class="text-xs text-[var(--color-primary)]/80"><?php echo esc($profile['website'] ?? 'Web Developer • UI/UX • Open Source'); ?></div>
        </div>
      </div>
    </aside>
  </section>

  <!-- About -->
  <section id="about">
    <div class="bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] p-8 rounded-brutal shadow-brutal-2 relative overflow-hidden">
      <div class="absolute -left-10 -top-10 w-36 h-36 bg-[var(--color-accent)]/20 brutal-border border-[var(--color-stroke)] rounded-brutal rotate-3 animate-floaty"></div>
      <div class="absolute -right-8 -bottom-8 w-28 h-28 bg-[var(--color-highlight)]/30 brutal-border border-[var(--color-stroke)] rounded-brutal animate-wiggle"></div>
      <div class="relative z-10">
        <h2 class="text-2xl font-heading font-extrabold mb-3 text-[var(--color-secondary)]">Tentang Saya</h2>
        <p class="mb-4 text-[var(--color-primary)]/90">Saya membuat website dan produk digital dengan fokus ke performa dan kegunaan. Desain brutalist modern menjaga antarmuka tetap lugas, kontras, dan mudah dipahami.</p>

        <ul class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <li class="p-4 bg-[var(--color-highlight)]/30 brutal-border border-[var(--color-highlight)] rounded-brutal shadow-brutal-1 animate-floaty">
            <div class="text-sm font-extrabold text-[var(--color-secondary)]">Frontend</div>
            <div class="text-xs text-[var(--color-primary)]/80">React, HTMX, Tailwind</div>
          </li>
          <li class="p-4 bg-[var(--color-accent)]/30 brutal-border border-[var(--color-accent)] rounded-brutal shadow-brutal-1 animate-wiggle">
            <div class="text-sm font-extrabold text-[var(--color-accent)]">Backend</div>
            <div class="text-xs text-[var(--color-primary)]/80">PHP, CodeIgniter, REST</div>
          </li>
          <li class="p-4 bg-[var(--color-secondary)]/20 brutal-border border-[var(--color-secondary)] rounded-brutal shadow-brutal-1 animate-floaty" style="animation-delay: .4s;">
            <div class="text-sm font-extrabold text-[var(--color-secondary)]">Desain</div>
            <div class="text-xs text-[var(--color-primary)]/80">UI/UX, Prototyping</div>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Projects -->
  <section id="projects" class="space-y-6">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-xs uppercase tracking-[0.25em] text-[var(--color-primary)]/60">Showcase</p>
        <h2 class="text-2xl font-heading font-extrabold text-[var(--color-secondary)]">Proyek Terbaru</h2>
      </div>
      <span class="brutal-pill bg-[var(--color-magenta)]/20">3 pilihan teratas</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php if (! empty($projects)): ?>
        <?php foreach (array_slice($projects, 0, 3) as $p): ?>
          <?= view('partials/project_card', ['project' => $p]) ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-1 md:col-span-3 bg-[var(--color-highlight)]/5 brutal-border border-[var(--color-highlight)] p-6 rounded-brutal text-center shadow-brutal-1">
          <div class="text-lg font-heading font-extrabold mb-2 text-[var(--color-primary)]">Belum ada proyek</div>
          <div class="text-sm text-[var(--color-primary)]/80">Proyek akan muncul di sini ketika Anda menambahkannya.</div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Articles -->
  <section id="articles" class="space-y-6">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-xs uppercase tracking-[0.25em] text-[var(--color-primary)]/60">Insights</p>
        <h2 class="text-2xl font-heading font-extrabold text-[var(--color-secondary)]">Artikel Terbaru</h2>
      </div>
      <span class="brutal-pill bg-[var(--color-accent)]/30">Diperbarui rutin</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php if (! empty($articles)): ?>
        <?php foreach (array_slice($articles, 0, 3) as $a): ?>
          <?= view('partials/article_card', ['article' => $a]) ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-1 md:col-span-3 bg-[var(--color-accent)]/5 brutal-border border-[var(--color-accent)] p-6 rounded-brutal text-center shadow-brutal-1">
          <div class="text-lg font-heading font-extrabold mb-2 text-[var(--color-primary)]">Belum ada artikel</div>
          <div class="text-sm text-[var(--color-primary)]/80">Artikel akan muncul di sini ketika Anda menambahkannya.</div>
        </div>
      <?php endif; ?>
    </div>
  </section>

</section>

<?= $this->endSection() ?>
