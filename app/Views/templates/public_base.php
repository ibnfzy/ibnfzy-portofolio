<!doctype html>
<html lang="en">
<?= $this->include('partials/public_head') ?>
<body class="bg-[var(--color-bg)] text-[var(--color-primary)] antialiased min-h-screen flex flex-col brutal-grid-bg">

    <?= view('partials/public_header') ?>

    <main class="flex-1 max-w-6xl mx-auto p-4 w-full relative">
        <div class="absolute -z-10 inset-4 bg-[var(--color-highlight)]/20 brutal-border border-[var(--color-stroke)] rounded-brutal opacity-70 animate-wiggle"></div>
        <div class="absolute -z-20 -top-10 -left-6 w-44 h-44 bg-[var(--color-magenta)]/20 brutal-border border-[var(--color-stroke)] rounded-brutal blur-[1px] animate-floaty"></div>
        <div class="absolute -z-20 -bottom-8 -right-8 w-52 h-52 bg-[var(--color-accent)]/20 brutal-border border-[var(--color-stroke)] rounded-brutal animate-floaty" style="animation-delay: 1s;"></div>
        <?= $this->renderSection('content') ?>
    </main>

    <?= view('partials/public_footer', isset($profile) ? ['profile' => $profile] : []) ?>

    <script src="/assets/js/app.js"></script>
</body>
</html>
