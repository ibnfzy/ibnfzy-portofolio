<div id="article-images" class="space-y-3">
    <div class="flex flex-wrap gap-3">
        <?php foreach ($images as $img): ?>
            <div class="brutal-card p-2 w-28 bg-white text-center">
                <img src="<?= esc($img['path']) ?>" alt="<?= esc($img['alt']) ?>" class="w-full h-24 object-cover rounded-brutal cursor-pointer" data-lightbox-src="<?= esc($img['path']) ?>">
                <div class="mt-2">
                    <button
                        type="button"
                        class="brutal-button px-2 py-1 bg-[var(--color-secondary)] text-white text-xs"
                        data-ajax-url="/admin/articles/<?= $img['article_id'] ?>/image/<?= $img['id'] ?>/delete"
                        data-ajax-method="DELETE"
                        data-ajax-target="#article-images"
                        data-ajax-confirm="Delete this image?"
                    >Delete</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="brutal-card p-4 bg-[var(--color-accent)]/20 space-y-2">
        <label class="block text-sm font-bold">Reorder (JSON)</label>
        <textarea
            id="reorder-json-<?= isset($article) ? $article['id'] : '0' ?>"
            class="w-full border-2 border-[var(--color-stroke)] rounded-brutal p-2"
            placeholder='{"order": [1,2,3]}'
        ></textarea>
        <div class="mt-2">
            <button
                type="button"
                class="brutal-button px-3 py-2 bg-white"
                data-ajax-url="/admin/articles/<?= isset($article) ? $article['id'] : '0' ?>/reorder-images"
                data-ajax-method="POST"
                data-ajax-target="#article-images"
                data-ajax-body-source="#reorder-json-<?= isset($article) ? $article['id'] : '0' ?>"
                data-ajax-body-type="json"
            >Send Order</button>
        </div>
    </div>
</div>
