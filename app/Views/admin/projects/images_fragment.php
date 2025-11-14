<?php if (! empty($project['images'])): ?>
    <div id="project-images-<?= $project['id'] ?>" class="space-y-2">
        <div class="flex gap-2 flex-wrap">
            <?php foreach ($project['images'] as $img): ?>
                <div class="w-32 bg-gray-50 p-2 rounded relative">
                    <img src="<?= esc($img['path']) ?>" class="w-full h-20 object-cover rounded cursor-pointer" onclick="openLightbox('<?= esc($img['path']) ?>')">
                    <form method="post" action="/admin/projects/delete-image/<?= $img['id'] ?>" style="display:inline">
                        <?= csrf_field() ?>
                        <button class="absolute top-1 right-1 bg-red-500 text-white rounded px-1 text-xs">x</button>
                    </form>
                </div>
            <?php endforeach ?>
        </div>

        <div>
            <label class="block text-sm">Reorder images (drag & drop not implemented): provide comma-separated image ids in desired order</label>
            <input id="image-order-<?= $project['id'] ?>" type="text" class="w-full p-2 border rounded" placeholder="e.g. 5,3,2,1">
            <div class="mt-2">
                <button type="button" class="px-3 py-1 bg-indigo-600 text-white rounded" onclick="reorderImages(<?= $project['id'] ?>)">Save Order</button>
            </div>
        </div>
    </div>
<?php else: ?>
    <div>No images</div>
<?php endif ?>

<script>
function reorderImages(projectId) {
    const val = document.getElementById('image-order-' + projectId).value.trim();
    if (! val) return alert('Enter comma-separated ids');
    const ids = val.split(',').map(s => parseInt(s.trim())).filter(Boolean);
    fetch('/admin/projects/' + projectId + '/reorder-images', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({order: ids})
    }).then(r => r.json()).then(j => {
        if (j.success) alert('Order saved'); else alert('Error');
    });
}
</script>
