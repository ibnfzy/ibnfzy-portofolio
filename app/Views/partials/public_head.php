<?php
/**
 * Public head partial: fonts, Tailwind CDN, and Neo-Brutalism helpers
 * Accepts optional ['title'] in $head
 */
$title = $title ?? ($head['title'] ?? 'Portfolio - Nama Anda');
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?= esc($title) ?></title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CDN (quick) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root{
      --color-primary: #2C3A47;
      --color-secondary: #FF6F61;
      --color-accent: #4ECDC4;
      --color-bg: #F5F6FA;
      --color-surface: #FFFFFF;
      --color-stroke: #2C3A47;
      --color-highlight: #FFC312;
    }
    body{ font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background: var(--color-bg); color: var(--color-primary); }
    a:hover { opacity: 0.85; }
    button:hover, .btn-primary:hover { background-color: #E85D50; }
    .btn-secondary:hover { background-color: #3FBFB8; }
    .shadow-brutal-1 { box-shadow: 8px 8px 0 rgba(0,0,0,1); }
    .shadow-brutal-2 { box-shadow: 12px 12px 0 rgba(0,0,0,1); }
    .brutal-border { border-width: 4px; border-style: solid; }
    .rounded-brutal { border-radius: 0; }
    .focus-brutal:focus { outline: 4px solid var(--color-stroke); outline-offset: 0; }
  </style>
</head>
