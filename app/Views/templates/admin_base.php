<!doctype html>
<html lang="en">
<?= $this->include('partials/public_head') ?>

<body class="bg-[var(--color-bg)] text-[var(--color-primary)] antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64">
            <?= $this->include('partials/admin_nav') ?>
        </aside>

        <div class="flex-1 p-6">
            <div id="flash-container">
                <?= $this->include('partials/flash') ?>
            </div>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <div
        id="modal"
        data-modal
        class="fixed inset-0 bg-black/60 flex items-center justify-center p-4 hidden"
        aria-hidden="true"
    >
        <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl relative" role="dialog">
            <button
                type="button"
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-900"
                data-modal-close
                aria-label="Close modal"
            >
                ✕
            </button>
            <div data-modal-content class="p-4"></div>
        </div>
    </div>

    <script src="/assets/js/app.js"></script>
</body>

</html>
