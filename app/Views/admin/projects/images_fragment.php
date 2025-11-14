<?php if (! empty($project['images'])): ?>
    <div id="project-images-<?= $project['id'] ?>" class="space-y-2">
        <div class="flex gap-2 flex-wrap">
            <?php foreach ($project['images'] as $img): ?>
                <div class="w-32 bg-gray-50 p-2 rounded relative">
                    <img src="<?= esc($img['path']) ?>" class="w-full h-20 object-cover rounded cursor-pointer" data-lightbox-src="<?= esc($img['path']) ?>">
                    <button
                        type="button"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded px-1 text-xs"
                        data-ajax-url="/admin/projects/delete-image/<?= $img['id'] ?>"
                        data-ajax-target="#project-images-<?= $project['id'] ?>"
                        data-ajax-confirm="Remove this image?"
                    >x</button>
                </div>
            <?php endforeach ?>
        </div>

        <div>
            <label class="block text-sm">Reorder images (JSON payload: {"order": [1,2,3]})</label>
            <input
                id="image-order-<?= $project['id'] ?>"
                type="text"
                class="w-full p-2 border rounded"
                placeholder='{"order": [1,2,3]}'
            >
            <div class="mt-2">
                <button
                    type="button"
                    class="px-3 py-1 bg-indigo-600 text-white rounded"
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
    <div>No images</div>
<?php endif ?>

