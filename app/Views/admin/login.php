<?= $this->extend('templates/admin_login') ?>

<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center bg-[var(--color-bg)] p-6">
    <div class="w-full max-w-md bg-[var(--color-surface)] brutal-border border-[var(--color-stroke)] p-6 rounded-brutal shadow-brutal-2">
        <h1 class="text-2xl font-heading font-extrabold mb-4">Admin Login</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-4 p-3 brutal-border border-[var(--color-stroke)] bg-[var(--color-accent)] text-white font-extrabold rounded-brutal"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif ?>

        <form method="post" action="/admin/auth/attempt">
            <?= csrf_field() ?>
            <label class="block text-sm font-semibold">Email</label>
            <input type="email" name="email" class="w-full p-3 brutal-border border-[var(--color-stroke)] rounded-brutal mb-3 bg-[var(--color-bg)]" required>

            <label class="block text-sm font-semibold">Password</label>
            <input type="password" name="password" class="w-full p-3 brutal-border border-[var(--color-stroke)] rounded-brutal mb-4 bg-[var(--color-bg)]" required>

            <button type="submit" class="w-full bg-[var(--color-secondary)] text-black px-4 py-2 font-heading font-extrabold brutal-border border-[var(--color-stroke)] rounded-brutal">Login</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
