<?= $this->extend('templates/public_base') ?>

<?= $this->section('content') ?>

<article class="bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] rounded-brutal p-6 shadow-brutal-2">
    <header>
        <h1 class="text-3xl font-heading font-extrabold text-[var(--color-secondary)]"><?= esc($project['title']) ?></h1>
        <p class="text-sm text-[var(--color-primary)]/80">Published: <?= esc($project['published_at']) ?></p>
        <?php if (! empty($project['tags'] ?? [])): ?>
            <div class="mt-2">
                <?php foreach ($project['tags'] as $tag): ?>
                    <a href="/projects/tag/<?= urlencode($tag) ?>" class="inline-block bg-[var(--color-highlight)]/20 brutal-border border-[var(--color-highlight)] px-2 py-1 mr-2 rounded-brutal text-sm text-[var(--color-primary)]">#<?= esc($tag) ?></a>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </header>

    <section class="mt-6">
        <div class="mb-4">
            <div id="project-slider" class="relative">
                <?php if (! empty($project['images'])): ?>
                    <div class="aspect-w-16 aspect-h-9 bg-[var(--color-highlight)]/20 brutal-border border-[var(--color-secondary)] overflow-hidden rounded-brutal">
                        <img src="<?= esc($project['images'][0]['path']) ?>" alt="<?= esc($project['images'][0]['alt']) ?>" class="w-full h-full object-cover cursor-pointer" onclick="openLightbox(this.src)">
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <button class="px-3 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal bg-[var(--color-accent)] text-white btn-secondary" hx-get="/project/<?= $project['id'] ?>/image/0" hx-target="#project-slider">Prev</button>
                        <button class="px-3 py-1 brutal-border border-[var(--color-stroke)] rounded-brutal bg-[var(--color-secondary)] text-white btn-primary" hx-get="/project/<?= $project['id'] ?>/image/1" hx-target="#project-slider">Next</button>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <div class="text-[var(--color-primary)]/90">
            <?= $project['description'] ?>
        </div>
    </section>
</article>

<script>
function openLightbox(src) {
    let modal = document.getElementById('lightbox-modal');
    if (! modal) {
        modal = document.createElement('div');
        modal.id = 'lightbox-modal';
        modal.innerHTML = '<div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center" onclick="closeLightbox()"><img id="lightbox-img" src="" class="max-h-[90%] max-w-[90%]"/></div>';
        document.body.appendChild(modal);
    }
    document.getElementById('lightbox-img').src = src;
}
function closeLightbox(){
    const modal = document.getElementById('lightbox-modal');
    if (modal) modal.remove();
}
</script>

<?= $this->endSection() ?>
