<!doctype html>
<html lang="en">
<?= $this->include('partials/public_head') ?>
<body class="bg-[var(--color-bg)] text-[var(--color-primary)] antialiased min-h-screen flex flex-col">

    <?= view('partials/public_header') ?>

    <main class="flex-1 max-w-6xl mx-auto p-4 w-full">
        <?= $this->renderSection('content') ?>
    </main>

    <?= view('partials/public_footer', isset($profile) ? ['profile' => $profile] : []) ?>

    <!-- HTMX -->
    <script src="https://unpkg.com/htmx.org@1.11.1"></script>
</body>
</html>
