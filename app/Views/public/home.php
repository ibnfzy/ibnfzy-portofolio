<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<section class="space-y-14">
  <!-- Hero (uses profile from DB if available) -->
  <section class="grid lg:grid-cols-[1.25fr_0.9fr] gap-6 items-start">
    <article class="neo-panel is-accent p-8 space-y-6">
      <div class="neo-sticker"></div>
      <div class="flex items-center gap-3">
        <span class="neo-chip is-ghost">Available for freelance</span>
        <span class="neo-meta">Neo brutal minimal</span>
      </div>
      <div class="space-y-2 relative z-10">
        <h1 class="text-4xl md:text-5xl font-heading font-extrabold leading-[1.05]">
          <?= esc($profile['full_name'] ?? 'Nama Anda') ?>
        </h1>
        <p class="text-base leading-7 neo-subtle max-w-2xl">
          <?= esc($profile['bio'] ?? 'Saya pengembang web & desainer produk yang fokus pada pengalaman sederhana, modern, dan berani. Interface dibuat jujur, tegas, dengan sedikit animasi yang hidup.') ?>
        </p>
      </div>

      <div class="flex flex-wrap gap-3 items-center relative z-10">
        <a href="#projects" class="neo-btn primary">⚡ Lihat Proyek</a>
        <a href="#about" class="neo-btn secondary">👀 Tentang Saya</a>
        <span class="neo-chip is-slim">Clean motion</span>
      </div>

      <div class="grid sm:grid-cols-3 gap-4 relative z-10">
        <div class="neo-panel is-soft p-4 space-y-1">
          <p class="neo-meta">Frontend</p>
          <p class="font-semibold">React, HTMX, Tailwind</p>
        </div>
        <div class="neo-panel is-soft p-4 space-y-1">
          <p class="neo-meta">Backend</p>
          <p class="font-semibold">PHP, CodeIgniter, REST</p>
        </div>
        <div class="neo-panel is-soft p-4 space-y-1">
          <p class="neo-meta">Desain</p>
          <p class="font-semibold">UI/UX, Prototyping</p>
        </div>
      </div>
    </article>

    <aside class="neo-panel is-ghost p-6 space-y-4">
      <div class="neo-thumb h-64 rounded-[14px] overflow-hidden">
        <img src="<?= esc($profile['avatar_path'] ?? '/public_site_assets/images/profile.jpg') ?>" alt="Foto Profil" class="w-full h-full object-cover">
      </div>
      <div class="flex items-start justify-between gap-3">
        <div>
          <div class="text-lg font-heading font-extrabold"><?= esc($profile['full_name'] ?? 'Nama Anda') ?></div>
          <div class="neo-subtle text-sm"><?= esc($profile['website'] ?? 'Web Developer • UI/UX • Open Source') ?></div>
        </div>
        <span class="neo-chip is-slim">Trust</span>
      </div>
      <div class="neo-divider"></div>
      <p class="neo-subtle text-sm">Membangun antarmuka yang mudah dibaca, responsif, dan siap produksi.</p>
    </aside>
  </section>

  <!-- About -->
  <section id="about" class="neo-panel p-8 space-y-5">
    <div class="flex items-start justify-between gap-3 flex-wrap">
      <div>
        <p class="neo-meta">Tentang</p>
        <h2 class="text-3xl font-heading font-extrabold">Cara saya bekerja</h2>
      </div>
      <span class="neo-chip is-ghost">Sederhana & jujur</span>
    </div>
    <p class="neo-subtle text-base leading-7">Saya membuat website dan produk digital dengan struktur tajam, kontras tinggi, dan hierarki visual yang jelas. Desain neo-brutalism yang disederhanakan membuat pesan utama mudah tertangkap.</p>

    <div class="grid md:grid-cols-3 gap-4">
      <div class="neo-panel is-soft p-4 space-y-2">
        <div class="neo-meta">01</div>
        <div class="font-heading font-extrabold text-lg">Discovery</div>
        <p class="neo-subtle text-sm">Memahami kebutuhan, menyusun scope, dan menyiapkan gaya visual yang relevan.</p>
      </div>
      <div class="neo-panel is-soft p-4 space-y-2">
        <div class="neo-meta">02</div>
        <div class="font-heading font-extrabold text-lg">Design</div>
        <p class="neo-subtle text-sm">Menyusun layout lugas, tipografi tegas, dan interaksi mikro yang ringan.</p>
      </div>
      <div class="neo-panel is-soft p-4 space-y-2">
        <div class="neo-meta">03</div>
        <div class="font-heading font-extrabold text-lg">Build</div>
        <p class="neo-subtle text-sm">Mengembangkan komponen cepat, responsif, dan mudah dirawat untuk produksi.</p>
      </div>
    </div>
  </section>

  <!-- Projects -->
  <section id="projects" class="neo-panel is-ghost p-8 space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
      <div>
        <p class="neo-meta">Showcase</p>
        <h2 class="text-2xl font-heading font-extrabold">Proyek Terbaru</h2>
      </div>
      <span class="neo-chip is-slim">3 pilihan teratas</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php if (! empty($projects)): ?>
        <?php foreach (array_slice($projects, 0, 3) as $p): ?>
          <?= view('partials/project_card', ['project' => $p]) ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-1 md:col-span-3 neo-panel is-soft p-6 text-center">
          <div class="text-lg font-heading font-extrabold mb-2">Belum ada proyek</div>
          <div class="neo-subtle">Proyek akan muncul di sini ketika Anda menambahkannya.</div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Articles -->
  <section id="articles" class="neo-panel is-ghost p-8 space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
      <div>
        <p class="neo-meta">Insights</p>
        <h2 class="text-2xl font-heading font-extrabold">Artikel Terbaru</h2>
      </div>
      <span class="neo-chip is-slim">Diperbarui rutin</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php if (! empty($articles)): ?>
        <?php foreach (array_slice($articles, 0, 3) as $a): ?>
          <?= view('partials/article_card', ['article' => $a]) ?>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-1 md:col-span-3 neo-panel is-soft p-6 text-center">
          <div class="text-lg font-heading font-extrabold mb-2">Belum ada artikel</div>
          <div class="neo-subtle">Artikel akan muncul di sini ketika Anda menambahkannya.</div>
        </div>
      <?php endif; ?>
    </div>
  </section>

</section>

<?= $this->endSection() ?>
