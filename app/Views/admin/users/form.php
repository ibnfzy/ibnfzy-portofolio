<?php /** @var array|null $user */ ?>
<?php $editing = ! empty($user); ?>
<?php $errors = $errors ?? session('errors') ?? []; ?>
<?php $formData = $formData ?? []; ?>

<div class="w-full max-w-md" onclick="event.stopPropagation();">
    <div class="brutal-card p-6 bg-white space-y-4">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs uppercase tracking-widest font-bold text-[var(--color-stroke)]">Users</p>
                <h3 class="text-2xl font-extrabold leading-tight"><?= $editing ? 'Edit User' : 'Create User' ?></h3>
            </div>
            <span class="brutal-pill">Modal Form</span>
        </div>

        <?php if (! empty($errors)): ?>
            <div class="brutal-card bg-[var(--color-highlight)]/50 text-[var(--color-stroke)] p-4">
                <p class="font-extrabold mb-2">Please fix the following:</p>
                <ul class="list-disc space-y-1 pl-5 text-sm">
                    <?php foreach ($errors as $message): ?>
                        <li><?= esc($message) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form
            method="post"
            action="/admin/users/store"
            class="space-y-4"
            data-ajax-target="#admin-users-list"
        >
        <?= csrf_field() ?>

        <div class="space-y-1">
            <label class="block text-sm font-bold">Username</label>
            <input type="text" name="username" value="<?= esc($formData['username'] ?? old('username') ?? ($user['username'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal" required>
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-bold">Email</label>
            <input type="email" name="email" value="<?= esc($formData['email'] ?? old('email') ?? ($user['email'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal" required>
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-bold">Password</label>
            <input type="password" name="password" class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal" <?= $editing ? '' : 'required' ?> >
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-bold">Role</label>
            <select name="role" class="mt-1 block w-full border-2 border-[var(--color-stroke)] px-3 py-2 rounded-brutal focus-brutal">
                <?php $selectedRole = $formData['role'] ?? old('role') ?? ($user['role'] ?? 'editor'); ?>
                <option value="editor" <?= ($selectedRole === 'editor') ? 'selected' : '' ?>>Editor</option>
                <option value="admin" <?= ($selectedRole === 'admin') ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="brutal-button px-4 py-2 bg-[var(--color-accent)] text-[var(--color-stroke)]">Save</button>
                <button type="button" class="brutal-button px-4 py-2 bg-white" data-modal-close>Cancel</button>
            </div>
        </form>
    </div>
</div>
