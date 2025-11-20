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
    body{
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: radial-gradient(circle at 20% 20%, #ffe9d6, transparent 40%),
                  radial-gradient(circle at 80% 0%, #d7fff5, transparent 35%),
                  var(--color-bg);
      color: var(--color-primary);
    }
    a:hover { opacity: 0.85; }
    button:hover, .btn-primary:hover { background-color: #E85D50; }
    .btn-secondary:hover { background-color: #3FBFB8; }
    .shadow-brutal-1 { box-shadow: 8px 8px 0 rgba(0,0,0,1); }
    .shadow-brutal-2 { box-shadow: 12px 12px 0 rgba(0,0,0,1); }
    .brutal-border { border-width: 4px; border-style: solid; }
    .rounded-brutal { border-radius: 0; }
    .focus-brutal:focus { outline: 4px solid var(--color-stroke); outline-offset: 0; }
    .brutal-card {
      border: 4px solid var(--color-stroke);
      background: var(--color-surface);
      box-shadow: 10px 10px 0 rgba(0,0,0,1);
      border-radius: 0;
    }
    .brutal-card-accent { background: linear-gradient(135deg, #ffe27f 0%, #ffb25b 100%); }
    .brutal-card-alt { background: linear-gradient(135deg, #c8fff4 0%, #8fe1ff 100%); }
    .brutal-button {
      border: 3px solid var(--color-stroke);
      box-shadow: 6px 6px 0 rgba(0,0,0,1);
      transition: transform 120ms ease, box-shadow 120ms ease;
      border-radius: 0;
      font-weight: 800;
    }
    .brutal-button:hover { transform: translate(-2px, -2px); box-shadow: 8px 8px 0 rgba(0,0,0,1); }
    .brutal-pill {
      border: 3px solid var(--color-stroke);
      padding: 2px 10px;
      border-radius: 9999px;
      font-weight: 800;
      background: #fff3bf;
      color: #1f2a44;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .brutal-grid-bg {
      background-image: linear-gradient(#0000000f 1px, transparent 1px), linear-gradient(90deg, #0000000f 1px, transparent 1px);
      background-size: 24px 24px;
    }
  </style>
</head>
