<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<div class="space-y-4 max-w-4xl">
    <div class="brutal-card brutal-card-accent p-6">
        <p class="text-xs uppercase tracking-[0.3em] font-black">Identity</p>
        <h1 class="text-3xl font-extrabold leading-tight">Edit Profile</h1>
        <p class="text-sm max-w-2xl">Keep your public information bold and cohesive with this neo-brutalist form.</p>
    </div>

    <div id="admin-profile-form">
        <?= $this->include('admin/profile/form') ?>
    </div>
</div>
<?= $this->endSection() ?>
