<?php if (! empty($project['images'])): ?>
    <div id="project-images-<?= $project['id'] ?>" class="space-y-3">
        <div class="flex gap-3 flex-wrap">
            <?php foreach ($project['images'] as $img): ?>
                <div class="brutal-card p-2 w-32 bg-white relative">
                    <img src="<?= esc($img['path']) ?>" class="w-full h-20 object-cover rounded-brutal cursor-pointer" data-lightbox-src="<?= esc($img['path']) ?>">
                    <button
                        type="button"
                        class="absolute -top-3 -right-3 brutal-button px-2 py-1 bg-[var(--color-secondary)] text-white"
                        data-ajax-url="/admin/projects/delete-image/<?= $img['id'] ?>"
                        data-ajax-target="#project-images-<?= $project['id'] ?>"
                        data-ajax-confirm="Remove this image?"
                    >x</button>
                </div>
            <?php endforeach ?>
        </div>

        <div class="brutal-card p-4 bg-[var(--color-accent)]/20 space-y-2">
            <label class="block text-sm font-bold">Reorder images (JSON payload: {"order": [1,2,3]})</label>
            <input
                id="image-order-<?= $project['id'] ?>"
                type="text"
                class="w-full p-2 border-2 border-[var(--color-stroke)] rounded-brutal"
                placeholder='{"order": [1,2,3]}'
            >
            <div class="mt-2">
                <button
                    type="button"
                    class="brutal-button px-3 py-2 bg-white"
                    data-ajax-url="/admin/projects/<?= $project['id'] ?>/reorder-images"
                    data-ajax-method="POST"
                    data-ajax-target="#project-images-<?= $project['id'] ?>"
                    data-ajax-body-source="#image-order-<?= $project['id'] ?>"
                    data-ajax-body-type="json"
                >Save Order</button>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="brutal-card p-4 bg-white">No images</div>
<?php endif ?>

