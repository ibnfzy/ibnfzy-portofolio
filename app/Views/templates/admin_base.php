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
            <!-- flash container for HTMX out-of-band updates -->
            <div id="flash-container">
                <?= $this->include('partials/flash') ?>
            </div>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

</div>

    <!-- global modal target for HTMX -->
    <div id="modal"></div>

    <!-- HTMX -->
    <script src="https://unpkg.com/htmx.org@1.11.1"></script>
</body>
</html>
