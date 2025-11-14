<!doctype html>
<html lang="en">
<?= $this->include('partials/public_head', isset($head) ? $head : []) ?>
<body class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6">
        <div id="flash-container">
            <?= $this->include('partials/flash') ?>
        </div>

        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>
