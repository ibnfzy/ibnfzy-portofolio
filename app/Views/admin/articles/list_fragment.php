<div id="admin-articles-list" class="w-full">
    <div class="overflow-x-auto">
        <table class="min-w-full text-left">
            <thead class="bg-[var(--color-stroke)] text-white">
                <tr>
                    <th class="px-4 py-3 text-sm font-black">ID</th>
                    <th class="px-4 py-3 text-sm font-black">Title</th>
                    <th class="px-4 py-3 text-sm font-black">Published</th>
                    <th class="px-4 py-3 text-sm font-black text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $a): ?>
                    <tr class="odd:bg-white even:bg-[var(--color-accent)]/20 border-b-4 border-[var(--color-stroke)]">
                        <td class="px-4 py-3 font-extrabold text-[var(--color-stroke)]">#<?= esc($a['id']) ?></td>
                        <td class="px-4 py-3 font-semibold">
                            <div class="flex flex-col">
                                <span><?= esc($a['title']) ?></span>
                                <span class="text-xs text-gray-600">Slug: <?= esc($a['slug']) ?></span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="brutal-pill <?= $a['is_published'] ? 'bg-[var(--color-accent)]' : 'bg-[var(--color-highlight)]' ?>">
                                <?= $a['is_published'] ? 'Live' : 'Draft' ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <button
                                type="button"
                                class="brutal-button px-3 py-2 bg-white"
                                data-ajax-url="/admin/articles/edit/<?= $a['id'] ?>"
                                data-ajax-target="#modal-content"
                            >Edit</button>
                            <button
                                type="button"
                                class="brutal-button px-3 py-2 bg-[var(--color-secondary)] text-white"
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
</div>
