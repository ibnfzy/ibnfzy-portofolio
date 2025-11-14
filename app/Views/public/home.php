<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="px-0">
  <!-- Hero (uses profile from DB if available) -->
  <section class="flex flex-col lg:flex-row items-start gap-8">
    <article class="flex-1 bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal p-8 shadow-brutal-2">
      <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-3 text-[var(--color-secondary)]"><?php echo esc($profile['full_name'] ?? 'Nama Anda'); ?></h1>
      <p class="text-base leading-7 mb-6 text-[var(--color-primary)]/90"><?php echo esc($profile['bio'] ?? 'Saya pengembang web & desainer produk yang fokus pada membangun pengalaman sederhana namun kuat. Saya suka menyelesaikan masalah kompleks menjadi antarmuka yang jelas dan tegas.'); ?></p>

      <div class="flex gap-3 items-center">
        <a href="#projects" class="inline-block px-6 py-2 bg-[var(--color-secondary)] text-white font-heading font-extrabold brutal-border border-[var(--color-stroke)] rounded-brutal btn-primary">Lihat Proyek</a>
        <a href="#about" class="inline-block px-5 py-2 bg-[var(--color-accent)] text-white font-heading font-extrabold brutal-border border-[var(--color-stroke)] rounded-brutal btn-secondary">Tentang Saya</a>
      </div>
    </article>

    <aside class="w-full lg:w-80">
      <div class="bg-[var(--color-surface)] brutal-border border-[var(--color-secondary)] border-4 p-4 rounded-brutal shadow-brutal-1 translate-y-6">
        <img src="<?= esc($profile['avatar_path'] ?? '/public_site_assets/images/profile.jpg') ?>" alt="Foto Profil" class="w-full h-64 object-cover brutal-border border-[var(--color-stroke)] rounded-brutal mb-3">
        <div class="text-sm">
          <div class="font-extrabold text-[var(--color-secondary)]" style="font-family: Montserrat, Inter, sans-serif;"><?php echo esc($profile['full_name'] ?? 'Nama Anda'); ?></div>
          <div class="text-xs text-[var(--color-primary)]/80"><?php echo esc($profile['website'] ?? 'Web Developer • UI/UX • Open Source'); ?></div>
        </div>
      </div>
    </aside>
  </section>

  <!-- About -->
  <section id="about" class="mt-12">
    <div class="bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] p-8 rounded-brutal shadow-brutal-1">
      <h2 class="text-2xl font-heading font-extrabold mb-3 text-[var(--color-secondary)]">Tentang Saya</h2>
      <p class="mb-4 text-[var(--color-primary)]/90">Saya membuat website dan produk digital dengan fokus ke performa dan kegunaan. Saya percaya desain yang tegas dan jelas membantu pengguna membuat keputusan lebih cepat.</p>

      <ul class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <li class="p-4 bg-[var(--color-highlight)]/10 brutal-border border-[var(--color-highlight)] rounded-brutal">
          <div class="text-sm font-extrabold text-[var(--color-secondary)]">Frontend</div>
          <div class="text-xs text-[var(--color-primary)]/80">React, HTMX, Tailwind</div>
        </li>
        <li class="p-4 bg-[var(--color-accent)]/10 brutal-border border-[var(--color-accent)] rounded-brutal">
          <div class="text-sm font-extrabold text-[var(--color-accent)]">Backend</div>
          <div class="text-xs text-[var(--color-primary)]/80">PHP, CodeIgniter, REST</div>
        </li>
        <li class="p-4 bg-[var(--color-secondary)]/10 brutal-border border-[var(--color-secondary)] rounded-brutal">
          <div class="text-sm font-extrabold text-[var(--color-secondary)]">Desain</div>
          <div class="text-xs text-[var(--color-primary)]/80">UI/UX, Prototyping</div>
        </li>
      </ul>
    </div>
  </section>

  <!-- Projects -->
  <section id="projects" class="mt-12">
    <h2 class="text-2xl font-heading font-extrabold mb-6 text-[var(--color-secondary)]">Showcase — Proyek Terbaru</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php if (! empty($projects)): ?>
        <?php foreach (array_slice($projects, 0, 3) as $p): ?>
          <?= view('partials/project_card', ['project' => $p]) ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-1 md:col-span-3 bg-[var(--color-highlight)]/5 brutal-border border-[var(--color-highlight)] p-6 rounded-brutal text-center">
          <div class="text-lg font-heading font-extrabold mb-2 text-[var(--color-primary)]">Belum ada proyek</div>
          <div class="text-sm text-[var(--color-primary)]/80">Proyek akan muncul di sini ketika Anda menambahkannya.</div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Articles -->
  <section id="articles" class="mt-12">
    <h2 class="text-2xl font-heading font-extrabold mb-6 text-[var(--color-secondary)]">Artikel Terbaru</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php if (! empty($articles)): ?>
        <?php foreach (array_slice($articles, 0, 3) as $a): ?>
          <?= view('partials/article_card', ['article' => $a]) ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-1 md:col-span-3 bg-[var(--color-accent)]/5 brutal-border border-[var(--color-accent)] p-6 rounded-brutal text-center">
          <div class="text-lg font-heading font-extrabold mb-2 text-[var(--color-primary)]">Belum ada artikel</div>
          <div class="text-sm text-[var(--color-primary)]/80">Artikel akan muncul di sini ketika Anda menambahkannya.</div>
        </div>
      <?php endif; ?>
    </div>
  </section>

</section>

<?= $this->endSection() ?>
