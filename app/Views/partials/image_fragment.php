<?php if (! empty($image)): ?>
    <div class="aspect-w-16 aspect-h-9 bg-[var(--color-secondary)]/10 brutal-border border-[var(--color-secondary)] rounded-brutal overflow-hidden">
        <img
            src="<?= esc($image['path']) ?>"
            alt="<?= esc($image['alt']) ?>"
            class="w-full h-full object-cover cursor-pointer"
            data-lightbox-src="<?= esc($image['path']) ?>"
        >
    </div>
<?php endif ?>
