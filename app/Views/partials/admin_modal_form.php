<?php
/**
 * @var callable $fields
 * @var array    $errors
 * @var string   $contextLabel
 * @var string   $titleText
 * @var string   $errorHeading
 * @var string   $action
 * @var array    $formAttributes
 * @var string   $submitLabel
 * @var string   $maxWidthClass
 */

$contextLabel = $contextLabel ?? 'Form';
$titleText = $titleText ?? 'Form';
$errorHeading = $errorHeading ?? 'Please check the fields below:';
$errors = $errors ?? [];
$formAction = $action ?? ($formAction ?? '#');
$formAttributes = $formAttributes ?? [];
$submitLabel = $submitLabel ?? 'Submit';
$maxWidthClass = $maxWidthClass ?? 'max-w-3xl';

$formAttributes = array_merge([
    'method' => 'post',
], $formAttributes);

$attrString = '';
foreach ($formAttributes as $attribute => $value) {
    if ($value === null) {
        continue;
    }

    $attrString .= ' ' . $attribute . '="' . esc($value, 'attr') . '"';
}
?>

<div class="w-full <?= esc($maxWidthClass, 'attr') ?>">
    <div class="brutal-card p-6 bg-white space-y-4">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs uppercase tracking-widest font-bold text-[var(--color-stroke)]"><?= esc($contextLabel) ?></p>
                <h3 class="text-2xl font-extrabold leading-tight"><?= esc($titleText) ?></h3>
            </div>
            <span class="brutal-pill">Modal Form</span>
        </div>

        <?php if (! empty($errors)): ?>
            <div class="brutal-card bg-[var(--color-highlight)]/50 text-[var(--color-stroke)] p-4">
                <p class="font-extrabold mb-2"><?= esc($errorHeading) ?></p>
                <ul class="list-disc space-y-1 pl-5 text-sm">
                    <?php foreach ($errors as $message): ?>
                        <li><?= esc($message) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= esc($formAction, 'attr') ?>"<?= $attrString ?>>
            <?= csrf_field() ?>
            <?php if (is_callable($fields)): ?>
                <?php $fields(); ?>
            <?php endif; ?>

            <div class="flex items-center gap-3">
                <button type="submit" class="brutal-button px-4 py-2 bg-[var(--color-accent)] text-[var(--color-stroke)]">
                    <?= esc($submitLabel) ?>
                </button>
                <button type="button" class="brutal-button px-4 py-2 bg-white" data-modal-close>Cancel</button>
            </div>
        </form>
    </div>
</div>
