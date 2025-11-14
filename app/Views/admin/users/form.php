<?php /** @var array|null $user */ ?>
<?php $editing = ! empty($user); ?>

<div class="bg-white p-4 rounded shadow max-w-md">
    <form method="post" hx-post="/admin/users/store" hx-target="#admin-users-list" class="space-y-3">
        <?= csrf_field() ?>

        <div>
            <label class="block text-sm font-medium">Username</label>
            <input type="text" name="username" value="<?= $editing ? esc($user['username']) : '' ?>" class="mt-1 block w-full border rounded px-2 py-1" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="<?= $editing ? esc($user['email']) : '' ?>" class="mt-1 block w-full border rounded px-2 py-1" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" class="mt-1 block w-full border rounded px-2 py-1" <?= $editing ? '' : 'required' ?> >
        </div>

        <div>
            <label class="block text-sm font-medium">Role</label>
            <select name="role" class="mt-1 block w-full border rounded px-2 py-1">
                <option value="editor">Editor</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Save</button>
            <button type="button" onclick="document.getElementById('modal').innerHTML = ''" class="px-3 py-1 bg-gray-200 rounded">Cancel</button>
        </div>
    </form>
</div>
