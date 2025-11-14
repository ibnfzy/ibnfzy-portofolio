<?php $editing = ! empty($profile); ?>

<form
    method="post"
    enctype="multipart/form-data"
    action="/admin/profile/update"
    data-ajax-target="#admin-profile-form"
>
    <?= csrf_field() ?>

    <div>
        <label class="block text-sm font-medium">Full name</label>
        <input type="text" name="full_name" value="<?= $editing ? esc($profile['full_name']) : '' ?>" class="mt-1 block w-full border rounded px-2 py-1" required>
    </div>

    <div>
        <label class="block text-sm font-medium">Bio</label>
        <textarea name="bio" rows="4" class="mt-1 block w-full border rounded px-2 py-1"><?= $editing ? esc($profile['bio']) : '' ?></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium">Location</label>
            <input type="text" name="location" value="<?= $editing ? esc($profile['location']) : '' ?>" class="mt-1 block w-full border rounded px-2 py-1">
        </div>
        <div>
            <label class="block text-sm font-medium">Website</label>
            <input type="url" name="website" value="<?= $editing ? esc($profile['website']) : '' ?>" class="mt-1 block w-full border rounded px-2 py-1">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-3">
        <div>
            <label class="block text-sm font-medium">GitHub (URL)</label>
            <input type="url" name="github_url" value="<?= $editing ? esc($profile['github_url'] ?? '') : '' ?>" class="mt-1 block w-full border rounded px-2 py-1">
        </div>
        <div>
            <label class="block text-sm font-medium">LinkedIn (URL)</label>
            <input type="url" name="linkedin_url" value="<?= $editing ? esc($profile['linkedin_url'] ?? '') : '' ?>" class="mt-1 block w-full border rounded px-2 py-1">
        </div>
    </div>

    <div class="mt-3">
        <label class="block text-sm font-medium">Avatar (image)</label>
        <?php if ($editing && ! empty($profile['avatar_path'])): ?>
            <div class="mb-2">
                <img src="<?= esc($profile['avatar_path']) ?>" alt="avatar" class="w-24 h-24 object-cover rounded">
            </div>
        <?php endif; ?>
        <input type="file" name="avatar" accept="image/*" class="mt-1 block w-full">
    </div>

    <div class="mt-3">
        <label class="block text-sm font-medium">CV (PDF)</label>
        <?php if ($editing && ! empty($profile['cv_path'])): ?>
            <div class="mb-2">
                <a href="<?= esc($profile['cv_path']) ?>" target="_blank" class="text-indigo-600 underline">Download current CV</a>
            </div>
        <?php endif; ?>
        <input type="file" name="cv" accept="application/pdf" class="mt-1 block w-full">
    </div>

    <div class="mt-4 flex gap-2">
        <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Save</button>
        <a href="/admin" class="px-3 py-1 bg-gray-300 rounded inline-flex items-center justify-center">Back</a>
    </div>
</form>
