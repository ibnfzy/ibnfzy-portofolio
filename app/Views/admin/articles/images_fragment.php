<div id="article-images">
    <?php foreach ($images as $img): ?>
        <div class="inline-block p-1">
            <img src="<?= esc($img['path']) ?>" alt="<?= esc($img['alt']) ?>" class="w-24 h-24 object-cover rounded" data-lightbox-src="<?= esc($img['path']) ?>">
            <div class="mt-1 text-center">
                <button
                    type="button"
                    class="px-2 py-1 bg-red-600 text-white rounded text-xs"
                    data-ajax-url="/admin/articles/<?= $img['article_id'] ?>/image/<?= $img['id'] ?>/delete"
                    data-ajax-method="DELETE"
                    data-ajax-target="#article-images"
                    data-ajax-confirm="Delete this image?"
                >Delete</button>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="mt-4">
        <label class="block text-sm font-medium">Reorder (JSON)</label>
        <textarea
            id="reorder-json-<?= isset($article) ? $article['id'] : '0' ?>"
            class="w-full border rounded p-2"
            placeholder='{"order": [1,2,3]}'
        ></textarea>
        <div class="mt-2">
            <button
                type="button"
                class="px-3 py-1 bg-indigo-600 text-white rounded"
                data-ajax-url="/admin/articles/<?= isset($article) ? $article['id'] : '0' ?>/reorder-images"
                data-ajax-method="POST"
                data-ajax-target="#article-images"
                data-ajax-body-source="#reorder-json-<?= isset($article) ? $article['id'] : '0' ?>"
                data-ajax-body-type="json"
            >Send Order</button>
        </div>
    </div>
</div>
