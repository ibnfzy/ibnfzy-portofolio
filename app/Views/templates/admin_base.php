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

    <div id="modalContainer" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <!-- Header -->
            <div class="flex justify-between items-center border-b px-4 py-2">
                <h2 class="text-lg font-semibold">Dynamic Modal</h2>
                <button
                    class="text-gray-500 hover:text-gray-700"
                    onclick="document.getElementById('modalContainer').classList.add('hidden')">
                    ✕
                </button>
            </div>
            <!-- Body -->
            <div id="modal-body" class="p-4">
                <p>Loading...</p>
            </div>
            <!-- Footer -->
            <div class="flex justify-end border-t px-4 py-2">
                <button
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                    onclick="document.getElementById('modalContainer').classList.add('hidden')">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- HTMX -->
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.8/dist/htmx.js" integrity="sha384-ezjq8118wdwdRMj+nX4bevEi+cDLTbhLAeFF688VK8tPDGeLUe0WoY2MZtSla72F" crossorigin="anonymous"></script>
    <script>
        (function() {
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

            window.closeModal = function() {
                hideModal(getModal());
            };

            document.body.addEventListener('htmx:afterSwap', function(event) {
                if (event.target && event.target.id === 'modal') {
                    showModal(event.target);
                }
            });

            document.body.addEventListener('htmx:oobAfterSwap', function(event) {
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

            document.body.addEventListener('click', function(event) {
                if (event.target && event.target.id === 'modal') {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        })();
    </script>
</body>

</html>