<!doctype html>
<html lang="en">
<?= $this->include('partials/public_head') ?>
<body class="min-h-screen flex flex-col">

    <div class="neo-spot top-14 left-10 hidden md:block"></div>
    <div class="neo-spot alt bottom-10 right-14 hidden md:block"></div>

    <?= view('partials/public_header') ?>

    <main class="flex-1 w-full">
        <div class="page-shell relative z-10">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <?= view('partials/public_footer', isset($profile) ? ['profile' => $profile] : []) ?>

    <script src="/assets/js/app.js"></script>
</body>
</html>
