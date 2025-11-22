<?php

use App\Config\TechStack;

if (! function_exists('stack_catalog')) {
    /**
     * Return a keyed catalog of stack icons using their id as the key.
     */
    function stack_catalog(): array
    {
        $config = config(TechStack::class);
        $catalog = [];
        foreach ($config->icons as $icon) {
            $catalog[$icon['id']] = $icon;
        }

        return $catalog;
    }
}

if (! function_exists('stack_decode')) {
    /**
     * Decode stack data from JSON (or array) into a clean array of ids.
     */
    function stack_decode(string|array|null $raw): array
    {
        if (is_string($raw)) {
            $raw = json_decode($raw, true);
        }

        return is_array($raw) ? array_values(array_filter($raw)) : [];
    }
}

if (! function_exists('stack_resolved_list')) {
    /**
     * Resolve stack ids to their catalog entries.
     */
    function stack_resolved_list(string|array|null $raw): array
    {
        $ids = stack_decode($raw);
        if (empty($ids)) {
            return [];
        }

        $catalog = stack_catalog();
        $resolved = [];
        foreach ($ids as $id) {
            if (isset($catalog[$id])) {
                $resolved[] = $catalog[$id];
            }
        }

        return $resolved;
    }
}

if (! function_exists('stack_icon_svg')) {
    /**
     * Render a simple SVG badge for a tech stack item.
     */
    function stack_icon_svg(array $icon, int $size = 36): string
    {
        $bg = $icon['color'] ?? '#0ea5e9';
        $badge = strtoupper($icon['badge'] ?? substr($icon['label'] ?? 'T', 0, 2));
        $label = esc($icon['label'] ?? $badge);

        return '<svg aria-hidden="true" width="' . $size . '" height="' . $size . '" viewBox="0 0 64 64" role="img" focusable="false">'
            . '<defs><linearGradient id="grad-' . esc($badge) . '" x1="0%" y1="0%" x2="100%" y2="100%">'
            . '<stop offset="0%" stop-color="' . esc($bg) . '" stop-opacity="0.95" />'
            . '<stop offset="100%" stop-color="' . esc($bg) . '" stop-opacity="0.75" />'
            . '</linearGradient></defs>'
            . '<rect width="64" height="64" rx="12" fill="url(#grad-' . esc($badge) . ')" stroke="rgba(0,0,0,0.15)" stroke-width="2" />'
            . '<text x="32" y="38" text-anchor="middle" font-family="\'Inter\', system-ui" font-size="18" font-weight="700" fill="#0f172a">' . esc($badge) . '</text>'
            . '<title>' . $label . '</title>'
            . '</svg>';
    }
}
