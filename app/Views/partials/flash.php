<?php $session = session(); ?>
<?php if ($session->getFlashdata('success')): ?>
    <div class="p-3 brutal-border border-[var(--color-stroke)] bg-[var(--color-secondary)] text-black font-extrabold mb-4"><?= esc($session->getFlashdata('success')) ?></div>
<?php endif ?>
<?php if ($session->getFlashdata('error')): ?>
    <div class="p-3 brutal-border border-[var(--color-stroke)] bg-[var(--color-accent)] text-white font-extrabold mb-4"><?= esc($session->getFlashdata('error')) ?></div>
<?php endif ?>
<?php if ($session->getFlashdata('warning')): ?>
    <div class="p-3 brutal-border border-[var(--color-stroke)] bg-[var(--color-secondary)]/80 text-black font-extrabold mb-4"><?= esc($session->getFlashdata('warning')) ?></div>
<?php endif ?>
