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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@700;800&family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CDN (quick) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root{
      --color-primary: #0F172A;
      --color-secondary: #ff5f1f;
      --color-accent: #10b981;
      --color-bg: #F9F6EE;
      --color-surface: #FFFFFF;
      --color-stroke: #0F172A;
      --color-highlight: #ffd803;
      --color-magenta: #ff0099;
    }
    body{
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: radial-gradient(circle at 15% 20%, #ffe2f5 0 25%, transparent 35%),
                  radial-gradient(circle at 85% 10%, #c7f9cc 0 20%, transparent 32%),
                  linear-gradient(135deg, #fdf2e9 0%, #f3f7ff 100%);
      color: var(--color-primary);
    }
    a:hover { opacity: 0.92; }
    button:hover, .btn-primary:hover { background-color: #ff3b00; }
    .btn-secondary:hover { background-color: #0ea36d; }
    .font-heading { font-family: 'Montserrat', 'Space Grotesk', Inter, system-ui, sans-serif; }
    .shadow-brutal-1 { box-shadow: 10px 10px 0 rgba(0,0,0,1); }
    .shadow-brutal-2 { box-shadow: 14px 14px 0 rgba(0,0,0,1); }
    .brutal-border { border-width: 4px; border-style: solid; }
    .rounded-brutal { border-radius: 0; }
    .focus-brutal:focus { outline: 4px solid var(--color-stroke); outline-offset: 0; }
    .brutal-card {
      border: 4px solid var(--color-stroke);
      background: var(--color-surface);
      box-shadow: 12px 12px 0 rgba(0,0,0,1);
      border-radius: 0;
    }
    .brutal-card-accent { background: linear-gradient(135deg, #ffe27f 0%, #ffb25b 100%); }
    .brutal-card-alt { background: linear-gradient(135deg, #c8fff4 0%, #8fe1ff 100%); }
    .brutal-button {
      border: 3px solid var(--color-stroke);
      box-shadow: 8px 8px 0 rgba(0,0,0,1);
      transition: transform 160ms ease, box-shadow 160ms ease, filter 160ms ease;
      border-radius: 0;
      font-weight: 800;
      filter: saturate(1.05);
    }
    .brutal-button:hover { transform: translate(-3px, -3px); box-shadow: 11px 11px 0 rgba(0,0,0,1); }
    .brutal-pill {
      border: 3px solid var(--color-stroke);
      padding: 4px 12px;
      border-radius: 9999px;
      font-weight: 800;
      background: #fff3bf;
      color: #1f2a44;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      box-shadow: 6px 6px 0 rgba(0,0,0,1);
    }
    .brutal-grid-bg {
      background-image: linear-gradient(#00000011 1px, transparent 1px), linear-gradient(90deg, #00000011 1px, transparent 1px);
      background-size: 28px 28px;
    }
    .neo-brutal-outline { border: 3px solid #0f172a; box-shadow: 8px 8px 0 #0f172a; }
    .neo-sticker { border: 3px solid #000; background: #fff; box-shadow: 6px 6px 0 #000; }
    @keyframes floaty { 0% { transform: translateY(0);} 50% { transform: translateY(-8px);} 100% { transform: translateY(0);} }
    @keyframes wiggle { 0%, 100% { transform: rotate(-1deg);} 50% { transform: rotate(2deg);} }
    @keyframes pulse-brutal { 0% { box-shadow: 8px 8px 0 rgba(0,0,0,1);} 50% { box-shadow: 12px 12px 0 rgba(0,0,0,1);} 100% { box-shadow: 8px 8px 0 rgba(0,0,0,1);} }
    .animate-floaty { animation: floaty 6s ease-in-out infinite; }
    .animate-wiggle { animation: wiggle 3s ease-in-out infinite; }
    .animate-pulse-brutal { animation: pulse-brutal 2.6s ease-in-out infinite; }
    .gradient-border {
      position: relative;
      isolation: isolate;
    }
    .gradient-border::before {
      content: "";
      position: absolute;
      inset: -6px;
      background: linear-gradient(135deg, var(--color-secondary), var(--color-magenta), var(--color-accent));
      z-index: -1;
      box-shadow: 10px 10px 0 #000000;
    }
    .neo-grid-surface {
      background: repeating-linear-gradient(45deg, rgba(0,0,0,0.05) 0 8px, transparent 8px 16px);
    }
  </style>
</head>
