<?php helper('stack'); ?>
<div id='admin-projects-list' class='grid grid-cols-1 lg:grid-cols-2 gap-4'>
    <?php if (! empty($projects)): ?>
        <?php foreach ($projects as $p): ?>
            <div class='brutal-card p-5 bg-white flex flex-col gap-3'>
                <div class='flex items-start justify-between gap-3'>
                    <div class='space-y-1'>
                        <p class='text-xs uppercase tracking-widest font-black text-[var(--color-stroke)]'>Project</p>
                        <h3 class='text-xl font-extrabold leading-tight'><?= esc($p['title']) ?></h3>
                        <div class='text-xs text-gray-600'>Slug: <?= esc($p['slug']) ?></div>
                        <div class='flex items-center gap-2 text-xs'>
                            <span class='brutal-pill bg-[var(--color-highlight)]/60 uppercase tracking-widest'><?= esc(strtoupper($p['visibility'] ?? 'public')) ?></span>
                            <?php if (! empty($p['github_url'])): ?>
                                <a href='<?= esc($p['github_url']) ?>' target='_blank' class='underline text-[var(--color-stroke)]'>GitHub</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <span class='brutal-pill bg-white'>#<?= esc($p['id']) ?></span>
                </div>
                <?php $stackItems = stack_resolved_list($p['tech_stack'] ?? null); ?>
                <?php if (! empty($stackItems)): ?>
                    <div class='flex flex-wrap gap-2'>
                        <?php foreach ($stackItems as $item): ?>
                            <span class='inline-flex items-center gap-2 brutal-pill bg-white border border-[var(--color-stroke)]'>
                                <span class='w-6 h-6 inline-flex items-center justify-center'>
                                    <?= stack_icon_svg($item, 24) ?>
                                </span>
                                <span class='text-xs font-bold text-[var(--color-stroke)]'><?= esc($item['label']) ?></span>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class='flex flex-wrap gap-2 justify-between items-center'>
                    <span class='text-sm text-gray-700 max-w-md block overflow-hidden' style='max-height: 3.5rem;'><?= esc($p['description'] ?? 'No description yet.') ?></span>
                    <div class='flex gap-2'>
                        <button
                            type='button'
                            class='brutal-button px-3 py-2 bg-white'
                            data-ajax-url='/admin/projects/edit/<?= $p['id'] ?>'
                            data-ajax-target='#modal-content'
                        >Edit</button>
                        <button
                            type='button'
                            class='brutal-button px-3 py-2 bg-[var(--color-secondary)] text-white'
                            data-ajax-url='/admin/projects/delete/<?= $p['id'] ?>'
                            data-ajax-target='#admin-projects-list'
                            data-ajax-confirm='Are you sure?'
                        >Delete</button>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php else: ?>
        <div class='brutal-card p-5 text-center font-extrabold'>No projects yet.</div>
    <?php endif ?>
</div>
