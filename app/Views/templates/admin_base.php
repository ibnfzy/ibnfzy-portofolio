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
    <div
        id="modal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 p-4"
        aria-hidden="true"
        role="dialog"
    ></div>

    <!-- HTMX -->
    <script src="https://unpkg.com/htmx.org@1.11.1"></script>
    <script>
        (function () {
            function getModal() {
                return document.getElementById('modal');
            }

            function hideModal(modal) {
                if (!modal) return;
                modal.innerHTML = '';
                modal.classList.add('hidden');
                modal.setAttribute('aria-hidden', 'true');
            }

            function showModal(modal) {
                if (!modal) return;
                if (modal.innerHTML.trim() === '') {
                    hideModal(modal);
                    return;
                }
                modal.classList.remove('hidden');
                modal.setAttribute('aria-hidden', 'false');
            }

            window.closeModal = function () {
                hideModal(getModal());
            };

            document.body.addEventListener('htmx:afterSwap', function (event) {
                if (event.target && event.target.id === 'modal') {
                    showModal(event.target);
                }
            });

            document.body.addEventListener('htmx:oobAfterSwap', function (event) {
                const target = event.detail && event.detail.target;
                if (target && target.id === 'modal') {
                    if (target.innerHTML.trim() === '') {
                        target.classList.add('hidden');
                        target.setAttribute('aria-hidden', 'true');
                    } else {
                        showModal(target);
                    }
                }
            });

            document.body.addEventListener('click', function (event) {
                if (event.target && event.target.id === 'modal') {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        })();
    </script>
</body>
</html>
