(function () {
    const ajaxHeaders = {
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json, text/html'
    };

    function init() {
        document.addEventListener('click', handleAjaxClick);
        document.addEventListener('submit', handleAjaxSubmit);
        document.addEventListener('click', handleModalClick);
        document.addEventListener('keydown', handleEscape);
        document.addEventListener('click', handleLightboxClick);
        document.addEventListener('DOMContentLoaded', () => {
            initSliders();
            initProjectForm();
        });
        // When the DOM is already ready (script loaded at end of body)
        if (document.readyState !== 'loading') {
            initSliders();
            initProjectForm();
        }
    }

    function handleAjaxClick(event) {
        const trigger = event.target.closest('[data-ajax-url]');
        if (!trigger || trigger.dataset.ajaxDisabled === 'true') {
            return;
        }

        if (trigger.tagName === 'A') {
            event.preventDefault();
        }

        if (trigger.type === 'submit') {
            return;
        }

        const confirmMessage = trigger.dataset.ajaxConfirm;
        if (confirmMessage && !window.confirm(confirmMessage)) {
            return;
        }

        let body = null;
        let contentType = null;
        try {
            ({ body, contentType } = extractBody(trigger));
        } catch (error) {
            console.error(error);
            return;
        }

        sendRequest({
            url: trigger.dataset.ajaxUrl,
            method: (trigger.dataset.ajaxMethod || 'GET').toUpperCase(),
            target: trigger.dataset.ajaxTarget || null,
            body,
            contentType
        });
    }

    function handleAjaxSubmit(event) {
        const form = event.target.closest('form[data-ajax-target]');
        if (!form) {
            return;
        }

        event.preventDefault();

        const url = form.dataset.ajaxUrl || form.getAttribute('action');
        const method = (form.dataset.ajaxMethod || form.method || 'POST').toUpperCase();
        const target = form.dataset.ajaxTarget || null;
        const formData = new FormData(form);

        sendRequest({ url, method, target, body: formData });
    }

    function handleModalClick(event) {
        const modal = document.querySelector('[data-modal]');
        if (!modal) {
            return;
        }

        if (event.target.matches('[data-modal-close]') || event.target.closest('[data-modal-close]')) {
            event.preventDefault();
            closeModal();
            return;
        }

        if (event.target === modal) {
            closeModal();
        }
    }

    function handleEscape(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    }

    function handleLightboxClick(event) {
        const trigger = event.target.closest('[data-lightbox-src]');
        if (!trigger) {
            return;
        }

        event.preventDefault();
        openLightbox(trigger.dataset.lightboxSrc);
    }

    function extractBody(trigger) {
        const sourceSelector = trigger.dataset.ajaxBodySource;
        if (!sourceSelector) {
            return { body: null, contentType: null };
        }

        const sourceElement = document.querySelector(sourceSelector);
        if (!sourceElement) {
            throw new Error(`Body source element not found for selector: ${sourceSelector}`);
        }

        const raw = 'value' in sourceElement ? sourceElement.value : sourceElement.textContent;
        const type = (trigger.dataset.ajaxBodyType || 'json').toLowerCase();

        if (type === 'json') {
            if (!raw || !raw.trim()) {
                alert('Please provide a JSON payload.');
                throw new Error('Empty JSON payload');
            }

            try {
                const parsed = JSON.parse(raw);
                return { body: parsed, contentType: 'json' };
            } catch (error) {
                alert('Invalid JSON payload');
                throw error;
            }
        }

        return { body: raw, contentType: type };
    }

    async function sendRequest({ url, method = 'GET', target = null, body = null, contentType = null }) {
        const options = {
            method,
            headers: { ...ajaxHeaders }
        };

        if (body instanceof FormData) {
            options.body = body;
            delete options.headers['Content-Type'];
        } else if (body !== null && body !== undefined) {
            if (contentType === 'json' || typeof body === 'object') {
                options.headers['Content-Type'] = 'application/json';
                options.body = typeof body === 'string' ? body : JSON.stringify(body);
            } else {
                options.headers['Content-Type'] = contentType || 'text/plain';
                options.body = typeof body === 'string' ? body : String(body);
            }
        }

        try {
            const response = await fetch(url, options);
            await handleResponse(response, target);
        } catch (error) {
            console.error('AJAX request failed', error);
            alert('Request failed. Please try again.');
        }
    }

    async function handleResponse(response, fallbackTarget) {
        const contentType = response.headers.get('content-type') || '';

        if (!response.ok) {
            const errorText = await response.text();
            console.error('Request failed', errorText);
            alert('Request failed. Please try again.');
            return;
        }

        if (contentType.includes('application/json')) {
            const payload = await response.json();
            if (payload.fragments) {
                applyFragments(payload.fragments);
            }
            if (payload.redirect) {
                window.location.href = payload.redirect;
            }
            return;
        }

        if (fallbackTarget) {
            const html = await response.text();
            updateFragment(fallbackTarget, html);
        }
    }

    function applyFragments(fragments) {
        Object.entries(fragments).forEach(([selector, html]) => updateFragment(selector, html));
    }

    function updateFragment(selector, html) {
        if (!selector) {
            return;
        }

        if (selector === '#modal' || selector === '#modal-content') {
            updateModalContent(html);
            return;
        }

        const target = document.querySelector(selector);
        if (!target) {
            console.warn('Target not found for selector', selector);
            return;
        }

        target.innerHTML = html || '';
        initSliders(target);
        initProjectForm(target);
    }

    function updateModalContent(html) {
        const modal = document.querySelector('[data-modal]');
        if (!modal) {
            return;
        }

        const container = modal.querySelector('[data-modal-content]');
        if (!container) {
            return;
        }

        container.innerHTML = html || '';
        const shouldShow = Boolean(html && html.trim());
        toggleModal(shouldShow);
        if (shouldShow) {
            initSliders(container);
            initProjectForm(container);
        }
    }

    function toggleModal(show) {
        const modal = document.querySelector('[data-modal]');
        if (!modal) {
            return;
        }

        if (show) {
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
        } else {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            const container = modal.querySelector('[data-modal-content]');
            if (container) {
                container.innerHTML = '';
            }
        }
    }

    function closeModal() {
        toggleModal(false);
    }

    window.closeModal = closeModal;

    function openLightbox(src) {
        if (!src) {
            return;
        }

        let modal = document.getElementById('lightbox-modal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'lightbox-modal';
            modal.className = 'fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50';
            modal.innerHTML = '\n                <div class="relative max-h-[90vh] max-w-[90vw]">\n                    <img class="max-h-[90vh] max-w-[90vw] rounded shadow-lg" alt="Lightbox image" />\n                    <button type="button" class="absolute top-2 right-2 text-white text-2xl" data-lightbox-close>&times;</button>\n                </div>\n            ';
            modal.addEventListener('click', (event) => {
                if (event.target === modal || event.target.hasAttribute('data-lightbox-close')) {
                    closeLightbox();
                }
            });
            document.body.appendChild(modal);
        }

        const img = modal.querySelector('img');
        if (img) {
            img.src = src;
        }

        modal.classList.remove('hidden');
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    window.openLightbox = openLightbox;
    window.closeLightbox = closeLightbox;

    function initProjectForm(root = document) {
        const forms = root.querySelectorAll('[data-project-form]');

        forms.forEach((form) => {
            if (form.__projectFormInitialised) {
                return;
            }
            form.__projectFormInitialised = true;

            const searchInput = form.querySelector('[data-stack-search]');
            const options = Array.from(form.querySelectorAll('[data-stack-option]'));
            const selectedList = form.querySelector('[data-stack-selected-list]');
            const selectedCount = form.querySelector('[data-stack-selected-count]');
            const emptyStateTemplate = form.querySelector('[data-stack-empty]');
            const getStackId = (option) => {
                const checkbox = option.querySelector('[data-stack-checkbox]');
                return checkbox?.value || option.dataset.stackId;
            };

            const selectedStack = new Set(
                options
                    .map((option) => {
                        const checkbox = option.querySelector('[data-stack-checkbox]');
                        return checkbox && checkbox.checked ? getStackId(option) : null;
                    })
                    .filter(Boolean)
            );

            const renderSelectedStack = () => {
                if (!selectedList) return;

                selectedList.innerHTML = '';

                if (!selectedStack.size) {
                    const emptyState = emptyStateTemplate?.cloneNode(true) ?? document.createElement('p');
                    emptyState.textContent = 'Belum ada teknologi dipilih.';
                    emptyState.className = 'text-sm text-gray-600';
                    selectedList.appendChild(emptyState);
                } else {
                    selectedStack.forEach((stackId) => {
                        const option = options.find((item) => getStackId(item) === stackId);
                        if (!option) return;

                        const item = document.createElement('div');
                        item.className = 'flex items-center gap-3 brutal-card border-2 border-[var(--color-stroke)] bg-white shadow-[4px_4px_0_var(--color-stroke)] p-3';

                        const icon = option.querySelector('[data-stack-icon]');
                        const iconWrapper = document.createElement('span');
                        iconWrapper.className = 'w-10 h-10 inline-flex items-center justify-center bg-[var(--color-highlight)]/40 rounded-brutal border-2 border-[var(--color-stroke)]';
                        if (icon) {
                            iconWrapper.appendChild(icon.cloneNode(true));
                        }

                        const name = option.dataset.stackName || option.dataset.stackLabel || 'Unknown';
                        const title = document.createElement('span');
                        title.className = 'font-semibold text-sm';
                        title.textContent = name;

                        item.appendChild(iconWrapper);
                        item.appendChild(title);

                        selectedList.appendChild(item);
                    });
                }

                if (selectedCount) {
                    selectedCount.textContent = selectedStack.size
                        ? `${selectedStack.size} dipilih`
                        : 'Belum ada pilihan';
                }
            };

            const syncSelected = (id, checked) => {
                if (!id) return;
                if (checked) {
                    selectedStack.add(id);
                } else {
                    selectedStack.delete(id);
                }
                renderSelectedStack();
            };

            if (searchInput) {
                searchInput.addEventListener('input', (event) => {
                    const query = (event.target.value || '').toLowerCase();
                    options.forEach((option) => {
                        const label = option.dataset.stackLabel || '';
                        const match = label.includes(query);
                        option.classList.toggle('hidden', !match);
                    });
                });
            }

            options.forEach((option) => {
                const checkbox = option.querySelector('[data-stack-checkbox]');
                const state = option.querySelector('[data-stack-state]');
                const stackId = getStackId(option);
                if (!checkbox) {
                    return;
                }
                const setState = (checked) => {
                    option.classList.toggle('ring-2', checked);
                    option.classList.toggle('ring-[var(--color-accent)]', checked);
                    if (state) {
                        state.textContent = checked ? 'Selected' : 'Choose';
                        state.className = 'ml-auto text-xs brutal-pill ' + (checked ? 'bg-[var(--color-accent)] text-[var(--color-stroke)]' : 'bg-white');
                    }
                };
                setState(checkbox.checked);
                syncSelected(stackId, checkbox.checked);

                option.addEventListener('click', (event) => {
                    if (event.target.tagName !== 'INPUT') {
                        checkbox.checked = !checkbox.checked;
                    }
                    setState(checkbox.checked);
                    syncSelected(stackId, checkbox.checked);
                });

                checkbox.addEventListener('change', () => {
                    setState(checkbox.checked);
                    syncSelected(stackId, checkbox.checked);
                });
            });

            renderSelectedStack();
        });
    }

    function initSliders(root = document) {
        const sliders = root.querySelectorAll('[data-slider]');
        sliders.forEach((slider) => {
            if (slider.__sliderInitialised) {
                return;
            }
            slider.__sliderInitialised = true;

            let images = [];
            try {
                images = JSON.parse(slider.dataset.sliderImages || '[]');
            } catch (error) {
                console.error('Failed to parse slider images', error);
                images = [];
            }

            if (!Array.isArray(images) || images.length === 0) {
                return;
            }

            let index = Number(slider.dataset.sliderIndex || 0) || 0;
            index = Math.min(Math.max(index, 0), images.length - 1);

            const imageElement = slider.querySelector('[data-slider-img]');
            const counterElement = slider.querySelector('[data-slider-counter]');
            const prevButton = slider.querySelector('[data-slider-prev]');
            const nextButton = slider.querySelector('[data-slider-next]');

            function render() {
                const image = images[index];
                if (imageElement) {
                    imageElement.src = image.path;
                    imageElement.alt = image.alt || '';
                    imageElement.dataset.lightboxSrc = image.path;
                }
                if (counterElement) {
                    counterElement.textContent = `${index + 1} / ${images.length}`;
                }
            }

            render();

            if (imageElement) {
                imageElement.addEventListener('click', () => openLightbox(images[index].path));
            }

            if (prevButton) {
                prevButton.addEventListener('click', (event) => {
                    event.preventDefault();
                    index = (index - 1 + images.length) % images.length;
                    render();
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', (event) => {
                    event.preventDefault();
                    index = (index + 1) % images.length;
                    render();
                });
            }
        });
    }

    init();
})();
