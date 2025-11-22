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
    :root {
      --ink: #0f172a;
      --paper: #fdfbf6;
      --muted: #5f6472;
      --accent: #ff6b35;
      --accent-2: #0ea5e9;
      --accent-3: #fbbf24;
      --accent-soft: #d6d8ff;
      --radius: 18px;

      /* legacy tokens for admin area */
      --color-primary: var(--ink);
      --color-secondary: var(--accent);
      --color-accent: var(--accent-2);
      --color-bg: var(--paper);
      --color-surface: #ffffff;
      --color-stroke: var(--ink);
      --color-highlight: var(--accent-3);
      --color-magenta: #7c3aed;
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      font-family: 'Space Grotesk', Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background-color: var(--paper);
      background-image: linear-gradient(var(--ink) 1px, transparent 1px), linear-gradient(90deg, var(--ink) 1px, transparent 1px);
      background-size: 28px 28px;
      color: var(--ink);
      letter-spacing: -0.01em;
    }

    a { color: inherit; text-decoration: none; }
    a:hover { color: var(--ink); }
    img { border-radius: 14px; }

    .font-heading { font-family: 'Montserrat', 'Space Grotesk', Inter, sans-serif; }

    .page-shell { max-width: 1120px; margin: 0 auto; padding: 1.5rem; width: 100%; }
    .neo-panel {
      background: var(--paper);
      border: 3px solid var(--ink);
      border-radius: var(--radius);
      box-shadow: 10px 10px 0 var(--ink);
      position: relative;
      overflow: hidden;
    }
    .neo-panel.is-ghost { background: #ffffff; }
    .neo-panel.is-accent {
      background: linear-gradient(135deg, #fff3e8 0%, #e7f7ff 100%);
    }
    .neo-panel.is-soft { box-shadow: 6px 6px 0 var(--ink); }

    .neo-chip {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 14px;
      border: 2px solid var(--ink);
      border-radius: 999px;
      background: var(--accent-3);
      box-shadow: 5px 5px 0 var(--ink);
      font-weight: 700;
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }
    .neo-chip.is-ghost { background: #fff; }
    .neo-chip.is-slim {
      padding: 6px 10px;
      font-size: 0.7rem;
      box-shadow: 3px 3px 0 var(--ink);
    }

    .neo-btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 16px;
      border-radius: 14px;
      border: 3px solid var(--ink);
      box-shadow: 7px 7px 0 var(--ink);
      font-weight: 800;
      transition: transform 160ms ease, box-shadow 160ms ease, background-color 160ms ease;
    }
    .neo-btn.primary { background: var(--accent); color: #fff; }
    .neo-btn.secondary { background: var(--accent-2); color: #fff; }
    .neo-btn.ghost { background: #fff; color: var(--ink); }
    .neo-btn:hover { transform: translate(-3px, -3px); box-shadow: 10px 10px 0 var(--ink); }

    .neo-meta {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: var(--muted);
      font-weight: 700;
    }

    .neo-subtle { color: var(--muted); }
    .neo-divider { border-top: 2px solid var(--ink); opacity: 0.4; }

    .neo-thumb {
      border-bottom: 3px solid var(--ink);
      background: linear-gradient(120deg, #ffe2d2 0%, #cde9ff 100%);
      display: grid;
      place-items: center;
      overflow: hidden;
    }

    .neo-hover { transition: transform 160ms ease, box-shadow 160ms ease; }
    .neo-hover:hover { transform: translate(-4px, -4px); box-shadow: 12px 12px 0 var(--ink); }

    .neo-sticker {
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 20% 20%, rgba(255, 214, 102, 0.4), transparent 40%),
                  radial-gradient(circle at 80% 30%, rgba(14, 165, 233, 0.25), transparent 35%);
      opacity: 0.6;
      mix-blend-mode: multiply;
      pointer-events: none;
      animation: slow-pan 18s linear infinite;
    }

    .neo-spot {
      position: absolute;
      border: 3px solid var(--ink);
      border-radius: 999px;
      width: 120px;
      height: 120px;
      box-shadow: 8px 8px 0 var(--ink);
      background: var(--accent-soft);
      opacity: 0.75;
      animation: floaty 8s ease-in-out infinite;
    }
    .neo-spot.alt { background: #ffe7c7; animation-delay: 1.6s; }

    /* legacy helpers still used in admin */
    .brutal-border { border: 3px solid var(--ink); }
    .rounded-brutal { border-radius: 12px; }
    .shadow-brutal-1 { box-shadow: 8px 8px 0 var(--ink); }
    .shadow-brutal-2 { box-shadow: 12px 12px 0 var(--ink); }
    .brutal-card {
      border: 3px solid var(--ink);
      background: #ffffff;
      box-shadow: 10px 10px 0 var(--ink);
      border-radius: 14px;
    }
    .brutal-card-accent { background: linear-gradient(135deg, #fff0db 0%, #ffd89b 100%); }
    .brutal-card-alt { background: linear-gradient(135deg, #e6f7ff 0%, #d2e5ff 100%); }
    .brutal-pill {
      border: 2px solid var(--ink);
      padding: 6px 12px;
      border-radius: 999px;
      font-weight: 800;
      background: var(--accent-3);
      color: var(--ink);
      display: inline-flex;
      align-items: center;
      gap: 6px;
      box-shadow: 6px 6px 0 var(--ink);
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }
    .brutal-grid-bg {
      background-image: linear-gradient(#00000011 1px, transparent 1px), linear-gradient(90deg, #00000011 1px, transparent 1px);
      background-size: 28px 28px;
    }

    @keyframes floaty { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    @keyframes slow-pan {
      0% { background-position: 0 0, 0 0; }
      50% { background-position: 30px 40px, -40px 30px; }
      100% { background-position: 0 0, 0 0; }
    }

    @media (max-width: 768px) {
      .page-shell { padding: 1.25rem; }
      .neo-panel { box-shadow: 7px 7px 0 var(--ink); }
      .neo-btn { width: 100%; justify-content: center; }
    }
  </style>
</head>
