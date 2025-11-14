<?= $this->extend('templates/admin_base') ?>

<?= $this->section('content') ?>
<?= $this->include('partials/flash') ?>

<div class="max-w-3xl">
    <h1 class="text-2xl font-semibold mb-4">Edit Profile</h1>

    <div id="admin-profile-form">
        <?= $this->include('admin/profile/form') ?>
    </div>

</div>
<?= $this->endSection() ?>
