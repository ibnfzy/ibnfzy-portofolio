<div id="admin-projects-list" class="grid grid-cols-1 gap-4">
    <?php if (! empty($projects)): ?>
        <?php foreach ($projects as $p): ?>
            <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                <div>
                    <h3 class="font-semibold"><?= esc($p['title']) ?></h3>
                    <div class="text-sm text-gray-600">Slug: <?= esc($p['slug']) ?></div>
                </div>
                <div class="space-x-2">
                    <a class="px-2 py-1 bg-blue-500 text-white rounded" href="/admin/projects/edit/<?= $p['id'] ?>">Edit</a>
                    <a class="px-2 py-1 bg-red-500 text-white rounded" href="/admin/projects/delete/<?= $p['id'] ?>" onclick="return confirm('Delete project?')">Delete</a>
                </div>
            </div>
        <?php endforeach ?>
    <?php else: ?>
        <div>No projects yet.</div>
    <?php endif ?>
</div>
