<?php $editing = ! empty($profile); ?>
<?php $errors = $errors ?? session('errors') ?? []; ?>

<form
    method="post"
    enctype="multipart/form-data"
    action="/admin/profile/update"
    data-ajax-target="#admin-profile-form"
    class="brutal-card p-6 bg-white space-y-4"
>
    <?= csrf_field() ?>

    <div class="flex items-start justify-between">
        <div>
            <p class="text-xs uppercase tracking-widest font-bold text-[var(--color-stroke)]">Profile</p>
            <h3 class="text-2xl font-extrabold leading-tight">Update your presence</h3>
        </div>
        <span class="brutal-pill">Live Preview</span>
    </div>

    <?php if (! empty($errors)): ?>
        <div class="brutal-card bg-[var(--color-highlight)]/50 text-[var(--color-stroke)] p-4">
            <p class="font-extrabold mb-2">We need a bit more info:</p>
            <ul class="list-disc space-y-1 pl-5 text-sm">
                <?php foreach ($errors as $message): ?>
                    <li><?= esc($message) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="space-y-1">
        <label class="block text-sm font-bold">Full name</label>
        <input type="text" name="full_name" value="<?= esc(old('full_name') ?? ($profile['full_name'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] rounded-brutal px-3 py-2 focus-brutal" required>
    </div>

    <div class="space-y-1">
        <label class="block text-sm font-bold">Bio</label>
        <textarea name="bio" rows="4" class="mt-1 block w-full border-2 border-[var(--color-stroke)] rounded-brutal px-3 py-2 focus-brutal"><?= esc(old('bio') ?? ($profile['bio'] ?? '')) ?></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-1">
            <label class="block text-sm font-bold">Location</label>
            <input type="text" name="location" value="<?= esc(old('location') ?? ($profile['location'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] rounded-brutal px-3 py-2 focus-brutal">
        </div>
        <div class="space-y-1">
            <label class="block text-sm font-bold">Website</label>
            <input type="url" name="website" value="<?= esc(old('website') ?? ($profile['website'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] rounded-brutal px-3 py-2 focus-brutal">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-2">
        <div class="space-y-1">
            <label class="block text-sm font-bold">GitHub (URL)</label>
            <input type="url" name="github_url" value="<?= esc(old('github_url') ?? ($profile['github_url'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] rounded-brutal px-3 py-2 focus-brutal">
        </div>
        <div class="space-y-1">
            <label class="block text-sm font-bold">LinkedIn (URL)</label>
            <input type="url" name="linkedin_url" value="<?= esc(old('linkedin_url') ?? ($profile['linkedin_url'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] rounded-brutal px-3 py-2 focus-brutal">
        </div>
    </div>

    <div class="space-y-1">
        <label class="block text-sm font-bold">Nomor WhatsApp</label>
        <input type="text" name="whatsapp_number" value="<?= esc(old('whatsapp_number') ?? ($profile['whatsapp_number'] ?? '')) ?>" class="mt-1 block w-full border-2 border-[var(--color-stroke)] rounded-brutal px-3 py-2 focus-brutal" placeholder="Contoh: 6281234567890">
        <p class="text-xs text-gray-600">Digunakan untuk tombol hubungi pada proyek dengan visibility Private.</p>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-2">
            <label class="block text-sm font-bold">Avatar (image)</label>
            <?php if ($editing && ! empty($profile['avatar_path'])): ?>
                <div class="brutal-card p-2 inline-block bg-white">
                    <img src="<?= esc($profile['avatar_path']) ?>" alt="avatar" class="w-24 h-24 object-cover rounded-brutal">
                </div>
            <?php endif; ?>
            <input type="file" name="avatar" accept="image/*" class="mt-1 block w-full">
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-bold">CV (PDF)</label>
            <?php if ($editing && ! empty($profile['cv_path'])): ?>
                <div class="brutal-card p-3 bg-white">
                    <a href="<?= esc($profile['cv_path']) ?>" target="_blank" class="font-extrabold underline">Download current CV</a>
                </div>
            <?php endif; ?>
            <input type="file" name="cv" accept="application/pdf" class="mt-1 block w-full">
        </div>
    </div>

    <div class="pt-2 flex gap-3 flex-wrap">
        <button type="submit" class="brutal-button px-4 py-2 bg-[var(--color-accent)] text-[var(--color-stroke)]">Save</button>
        <a href="/admin" class="brutal-button px-4 py-2 bg-white inline-flex items-center justify-center">Back</a>
    </div>
</form>
