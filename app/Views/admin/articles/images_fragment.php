<div id="article-images">
    <?php foreach ($images as $img): ?>
        <div class="inline-block p-1">
            <img src="<?= esc($img['path']) ?>" alt="<?= esc($img['alt']) ?>" class="w-24 h-24 object-cover rounded">
            <div class="mt-1 text-center">
                <button hx-delete="/admin/articles/<?= $img['article_id'] ?>/image/<?= $img['id'] ?>/delete" hx-target="#article-images" class="px-2 py-1 bg-red-600 text-white rounded text-xs">Delete</button>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="mt-4">
        <label class="block text-sm font-medium">Reorder (JSON)</label>
        <textarea id="reorder-json" class="w-full border rounded p-2" placeholder='{"order": [1,2,3]}'></textarea>
        <div class="mt-2">
            <button id="send-order" class="px-3 py-1 bg-indigo-600 text-white rounded">Send Order</button>
        </div>
    </div>

    <script>
        document.getElementById('send-order')?.addEventListener('click', function () {
            const data = JSON.parse(document.getElementById('reorder-json').value || '{}');
            fetch('/admin/articles/<?= isset($article) ? $article['id'] : '0' ?>/reorder-images', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            }).then(r => r.json()).then(j => {
                // refresh images
                htmx.ajax('GET', '/admin/articles/<?= isset($article) ? $article['id'] : '0' ?>/images', { target: '#article-images' })
            })
        })
    </script>
</div>
