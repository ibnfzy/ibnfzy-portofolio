<div id="admin-users-list" class="w-full">
    <div class="overflow-x-auto">
        <table class="min-w-full text-left">
            <thead class="bg-[var(--color-stroke)] text-white">
                <tr>
                    <th class="px-4 py-3 text-sm font-black">ID</th>
                    <th class="px-4 py-3 text-sm font-black">Username</th>
                    <th class="px-4 py-3 text-sm font-black">Email</th>
                    <th class="px-4 py-3 text-sm font-black">Role</th>
                    <th class="px-4 py-3 text-sm font-black text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr class="odd:bg-white even:bg-[var(--color-accent)]/20 border-b-4 border-[var(--color-stroke)]">
                    <td class="px-4 py-3 font-extrabold text-[var(--color-stroke)]">#<?= esc($u['id']) ?></td>
                    <td class="px-4 py-3 font-semibold"><?= esc($u['username']) ?></td>
                    <td class="px-4 py-3">
                        <span class="brutal-pill bg-white">
                            <?= esc($u['email']) ?>
                        </span>
                    </td>
                    <td class="px-4 py-3"><span class="brutal-pill bg-[var(--color-highlight)]/70"><?= esc($u['role']) ?></span></td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <button
                            type="button"
                            class="brutal-button px-3 py-2 bg-white"
                            data-ajax-url="/admin/users/edit/<?= $u['id'] ?>"
                            data-ajax-target="#modal-content"
                        >Edit</button>
                        <a href="/admin/users/delete/<?= $u['id'] ?>" class="brutal-button px-3 py-2 bg-[var(--color-secondary)] text-white" onclick="return confirm('Delete user?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
