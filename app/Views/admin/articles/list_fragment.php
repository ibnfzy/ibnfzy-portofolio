<div id="admin-articles-list">
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Published</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $a): ?>
                <tr class="border-t">
                    <td class="px-4 py-2"><?= esc($a['id']) ?></td>
                    <td class="px-4 py-2"><?= esc($a['title']) ?></td>
                    <td class="px-4 py-2"><?= $a['is_published'] ? 'Yes' : 'No' ?></td>
                    <td class="px-4 py-2">
                        <button
                            type="button"
                            class="px-2 py-1 bg-blue-600 text-white rounded"
                            data-ajax-url="/admin/articles/edit/<?= $a['id'] ?>"
                            data-ajax-target="#modal-content"
                        >Edit</button>
                        <button
                            type="button"
                            class="px-2 py-1 bg-red-600 text-white rounded"
                            data-ajax-url="/admin/articles/delete/<?= $a['id'] ?>"
                            data-ajax-target="#admin-articles-list"
                            data-ajax-confirm="Are you sure?"
                        >Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
