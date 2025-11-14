<div id="admin-users-list">
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Username</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr class="border-t">
                <td class="px-4 py-2"><?= esc($u['id']) ?></td>
                <td class="px-4 py-2"><?= esc($u['username']) ?></td>
                <td class="px-4 py-2"><?= esc($u['email']) ?></td>
                <td class="px-4 py-2"><?= esc($u['role']) ?></td>
                <td class="px-4 py-2">
                    <button hx-get="/admin/users/edit/<?= $u['id'] ?>" hx-target="#modal" hx-swap="modal" class="px-2 py-1 bg-blue-600 text-white rounded">Edit</button>
                    <a href="/admin/users/delete/<?= $u['id'] ?>" class="px-2 py-1 bg-red-600 text-white rounded" onclick="return confirm('Delete user?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
