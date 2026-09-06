<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/seo.php';

function nexus_head(
  string $title = 'Engineering & Dev Ecosystem',
  string $description = 'Explore 26+ browser-based cyber security & developer utilities,ATS resume, tools,courses, and internships.',
  string $keywords = 'Yaswant Pandey, free ats friendly resume, hacking tools, yaswant dev, yaswant.co.in, lucifer developer, mr indian hacker, free resume builder, cyber security tools, image resizer online, compress image online, free engineering courses,btech semester study notes, btech notes, cse, free resources, tech internships 2026',
  string $canonical = '',
  array $og = [],
  string $schema = ''
): void {
  $siteName = 'Yaswant Dev';
  $siteUrl = URL_HOME;
  // Subdomain-aware canonical — resolves automatically in production & local dev
  if (!$canonical) {
    $reqFile = preg_replace('/\.php$/', '', basename(strtok($_SERVER['REQUEST_URI'] ?? '', '?')));
    $reqFile = ($reqFile === '' || $reqFile === 'index' || $reqFile === 'stitch_engihub_os') ? '' : $reqFile;
    $canonical = get_canonical_url($reqFile);
  }
  $ogImage = $og['image'] ?? $siteUrl . '/assets/og-cover.png';
  $ogTitle = $og['title'] ?? $title . ' | ' . $siteName;
  $ogDesc = $og['desc'] ?? $description;
  $ogType = $og['type'] ?? 'website';
  $fullTitle = htmlspecialchars($title . ' | ' . $siteName);
  ?>
  <!DOCTYPE html>
  <html lang="en" class="dark">

  <head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PVZPJM66WM"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() { dataLayer.push(arguments); }
      gtag('js', new Date());

      gtag('config', 'G-PVZPJM66WM');
    </script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Primary SEO -->
    <title><?= $fullTitle ?></title>
    <meta name="description" content="<?= htmlspecialchars($description) ?>" />
    <meta name="keywords" content="<?= htmlspecialchars($keywords) ?>" />
    <meta name="author" content="Yaswant Pandey" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="rating" content="general" />
    <meta name="revisit-after" content="2 days" />
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>" />

    <!-- Open Graph -->
    <meta property="og:type" content="<?= htmlspecialchars($ogType) ?>" />
    <meta property="og:site_name" content="<?= htmlspecialchars($siteName) ?>" />
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>" />
    <meta property="og:description" content="<?= htmlspecialchars($ogDesc) ?>" />
    <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>" />
    <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:locale" content="en_US" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Yaswantpandey" />
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle) ?>" />
    <meta name="twitter:description" content="<?= htmlspecialchars($ogDesc) ?>" />
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>" />

    <!-- Structured Data (JSON-LD) -->
    <?php if ($schema): ?>
      <script type="application/ld+json"><?= $schema ?></script>
    <?php endif; ?>

    <!-- Performance: DNS prefetch & preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!-- Subdomain prefetch for faster cross-subdomain navigation -->
    <link rel="dns-prefetch" href="https://resume.yaswant.co.in" />
    <link rel="dns-prefetch" href="https://resource.yaswant.co.in" />
    <link rel="dns-prefetch" href="https://course.yaswant.co.in" />

    <!-- Favicon — Futuristic 'Y' Monogram -->
    <link rel="icon" type="image/svg+xml" href="<?= $siteUrl ?>/favicon.svg" />
    <link rel="alternate icon" type="image/svg+xml"
      href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='bg' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%2309090b'/%3E%3Cstop offset='100%25' stop-color='%23000'/%3E%3C/linearGradient%3E%3ClinearGradient id='yg' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%2334d399'/%3E%3Cstop offset='50%25' stop-color='%2306b6d4'/%3E%3Cstop offset='100%25' stop-color='%23a78bfa'/%3E%3C/linearGradient%3E%3ClinearGradient id='bgB' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%2310b981'/%3E%3Cstop offset='100%25' stop-color='%238b5cf6'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect x='3' y='3' width='94' height='94' rx='24' fill='url(%23bg)' stroke='url(%23bgB)' stroke-width='3'/%3E%3Cpath d='M20 22 L37 22 L50 48 L50 80 L41 80 L41 52 L20 22 Z' fill='url(%23yg)'/%3E%3Cpath d='M80 22 L63 22 L50 48 L59 52 L80 22 Z' fill='%23a78bfa'/%3E%3Cpolygon points='50,43 55,48 50,53 45,48' fill='%23fff'/%3E%3C/svg%3E" />
    <link rel="apple-touch-icon" href="<?= $siteUrl ?>/favicon.svg" />

    <!-- Web App Meta -->
    <link rel="manifest" href="manifest.json" />
    <meta name="theme-color" content="#09090b" />
    <meta name="application-name" content="Yaswant Dev" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="Yaswant Pandey" />

    <style>
      @layer base {

        html,
        body {
          margin: 0;
          padding: 0;
        }

        body {
          overscroll-behavior: none;
        }
      }

      ::-webkit-scrollbar {
        display: none;
      }

      @font-face {
        font-family: 'Geist';
        font-display: swap;
      }

      @font-face {
        font-family: 'Inter';
        font-display: swap;
      }

      @font-face {
        font-family: 'JetBrains Mono';
        font-display: swap;
      }

      /* Touch & mobile ergonomics */
      * {
        -webkit-tap-highlight-color: transparent;
      }

      button, a {
        touch-action: manipulation;
      }

      /* Mobile sidebar overlay */
      #sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .7);
        z-index: 40;
        backdrop-filter: blur(4px);
      }

      #sidebar-overlay.open {
        display: block;
      }

      #nexus-sidebar {
        transition: transform .25s cubic-bezier(.4, 0, .2, 1);
      }

      /* Mobile Bottom Nav & Drawer */
      #drawer-overlay {
        opacity: 0;
        pointer-events: none;
        transition: opacity .25s ease;
      }

      #drawer-overlay.open {
        opacity: 1;
        pointer-events: auto;
      }

      #mobile-app-drawer {
        transform: translateY(100%);
        transition: transform .3s cubic-bezier(0.16, 1, 0.3, 1);
      }

      #mobile-app-drawer.open {
        transform: translateY(0);
      }

      @media(max-width:1023px) {
        body {
          padding-bottom: calc(4.5rem + env(safe-area-inset-bottom, 0px)) !important;
        }

        #nexus-sidebar {
          transform: translateX(-100%);
        }

        #nexus-sidebar.open {
          transform: translateX(0);
        }

        .sidebar-push {
          padding-left: 0 !important;
        }
      }

      @media print {
        #nexus-sidebar, #nexus-bottom-nav, #mobile-app-drawer, #drawer-overlay, #sidebar-overlay {
          display: none !important;
        }
      }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "background": "#000000",
              "surface": "#09090b",
              "surface-container-lowest": "#030303",
              "surface-container-low": "#0a0a0c",
              "surface-container": "#121215",
              "surface-container-high": "#18181c",
              "surface-container-highest": "#27272a",
              "surface-bright": "#3f3f46",
              "surface-variant": "#18181b",
              "surface-dim": "#050505",
              "on-background": "#ffffff",
              "on-surface": "#ffffff",
              "on-surface-variant": "#a1a1aa",
              "outline": "#71717a",
              "outline-variant": "#27272a",
              "primary": "#10b981",
              "primary-container": "#064e3b",
              "primary-fixed": "#34d399",
              "on-primary": "#000000",
              "on-primary-container": "#ecfdf5",
              "secondary": "#06b6d4",
              "secondary-container": "#164e63",
              "on-secondary": "#000000",
              "on-secondary-container": "#cffaff",
              "tertiary": "#6366f1",
              "tertiary-container": "#312e81",
              "on-tertiary": "#ffffff",
              "on-tertiary-container": "#e0e7ff",
              "error": "#f43f5e",
              "error-container": "#881337"
            },
            borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", "2xl": "1rem", full: "9999px" },
            spacing: { gutter: "24px", xl: "2.5rem", md: "1rem", base: "4px", "max-width-content": "1280px", sm: "0.5rem", xs: "0.25rem", "2xl": "4rem", "margin-mobile": "16px", lg: "1.5rem" },
            fontFamily: {
              "code-block": ["JetBrains Mono", "monospace"],
              "label-sm": ["JetBrains Mono", "monospace"],
              "headline-md": ["Geist", "sans-serif"],
              "body-lg": ["Inter", "sans-serif"],
              "body-md": ["Inter", "sans-serif"],
              "display-lg-mobile": ["Geist", "sans-serif"],
              "display-lg": ["Geist", "sans-serif"]
            }
          }
        }
      }
    </script>
    <link rel="preload" as="style"
      href="https://fonts.googleapis.com/css2?family=Geist:wght@400;600;700&family=Inter:wght@400;500&family=JetBrains+Mono:wght@400;500&display=swap"
      onload="this.onload=null;this.rel='stylesheet'" />
    <noscript>
      <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Geist:wght@400;600;700&family=Inter:wght@400;500&family=JetBrains+Mono:wght@400;500&display=swap" />
    </noscript>
    <link rel="preload" as="style"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap"
      onload="this.onload=null;this.rel='stylesheet'" />
    <noscript>
      <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap" />
    </noscript>
  </head>

  <body class="bg-black text-white font-body-md antialiased selection:bg-emerald-500 selection:text-black">
    <a href="#main-content"
      class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[9999] focus:bg-primary focus:text-on-primary focus:px-md focus:py-sm focus:rounded-lg focus:font-label-sm">Skip
      to main content</a>
    <div id="sidebar-overlay" onclick="closeSidebar()" aria-hidden="true"></div>
  <?php }

function nexus_sidebar(string $active = ''): void
{
  $GLOBALS['NEXUS_ACTIVE_PAGE'] = $active;
  $sections = [
    'Academic & Learning' => [
      ['path' => 'home', 'icon' => 'home', 'label' => 'Home', 'href' => URL_HOME],
      ['path' => 'resources', 'icon' => 'folder_open', 'label' => 'Study Notes & PYQs', 'href' => URL_RESOURCES],
      ['path' => 'courses', 'icon' => 'school', 'label' => 'Engineering Courses', 'href' => URL_COURSES],
      ['path' => 'tools', 'icon' => 'build', 'label' => 'Developer & Cyber Tools', 'href' => URL_TOOLS],
      ['path' => 'project', 'icon' => 'folder_special', 'label' => 'Cyber Security Projects', 'href' => URL_PROJECT],
      ['path' => 'image', 'icon' => 'image', 'label' => 'Image Editing Suite', 'href' => URL_IMAGE],
    ],
    'Career & Editorial' => [
      ['path' => 'resume', 'icon' => 'description', 'label' => 'ATS Resume Studio', 'href' => URL_RESUME],
      ['path' => 'internships', 'icon' => 'work', 'label' => 'Tech Internships 2026', 'href' => URL_INTERNSHIPS],
      ['path' => 'blog', 'icon' => 'article', 'label' => 'Engineering Blog', 'href' => URL_BLOG],
      ['path' => 'dashboard', 'icon' => 'dashboard', 'label' => 'Student Dashboard', 'href' => URL_DASHBOARD],
    ],
  ];

  if (!empty($_SESSION['admin_logged_in'])) {
    $sections['System Admin'] = [
      ['path' => 'admin', 'icon' => 'admin_panel_settings', 'label' => 'Admin Panel', 'href' => URL_HOME . '/admin.php'],
    ];
  }
  ?>
    <aside id="nexus-sidebar"
      class="fixed left-0 top-0 h-full w-72 bg-[#050507] z-50 flex flex-col border-r border-zinc-800/80"
      role="complementary" aria-label="Main navigation">
      <div class="h-16 flex items-center justify-between px-lg border-b border-zinc-800/60">
        <div class="flex items-center gap-xs">
          <div
            class="w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shadow-md">
            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">terminal</span>
          </div>
          <a href="<?= URL_HOME ?>"
            class="ml-xs font-display-lg text-lg font-bold tracking-tight text-white flex items-center gap-xs"
            aria-label="Yaswant Dev home">
            <span>Yaswant Dev</span>
            <span
              class="text-[9px] font-mono font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-1.5 py-0.5 rounded uppercase">OS
              v2.5</span>
          </a>
        </div>
        <button onclick="closeSidebar()"
          class="lg:hidden w-8 h-8 flex items-center justify-center rounded-lg text-zinc-400 hover:bg-zinc-800 transition-colors"
          aria-label="Close navigation">
          <span class="material-symbols-outlined text-[20px]" aria-hidden="true">close</span>
        </button>
      </div>
      <nav class="flex-1 px-md space-y-xs overflow-y-auto pt-md pb-lg" aria-label="Sidebar navigation">
        <?php foreach ($sections as $section => $items): ?>
          <div class="px-md mb-xs mt-md text-[10px] font-mono uppercase tracking-widest text-zinc-500 first:mt-0"
            role="heading" aria-level="3"><?= $section ?></div>
          <?php foreach ($items as $item):
            $isActive = ($active === $item['path']);
            $cls = $isActive
              ? 'bg-emerald-500/10 text-emerald-400 font-mono border-l-2 border-emerald-400 font-medium'
              : 'text-zinc-400 hover:bg-zinc-900/90 hover:text-white';
            ?>
            <a href="<?= $item['href'] ?>" class="flex items-center px-md py-2.5 rounded-lg transition-all <?= $cls ?>"
              <?= $isActive ? 'aria-current="page"' : '' ?> onclick="closeSidebar()">
              <span
                class="material-symbols-outlined mr-md text-[20px] <?= $isActive ? 'text-emerald-400' : 'text-zinc-500 group-hover:text-zinc-300' ?>"
                aria-hidden="true"><?= $item['icon'] ?></span>
              <span class="text-sm font-medium"><?= $item['label'] ?></span>
            </a>
          <?php endforeach; endforeach; ?>
      </nav>
    </aside>
  <?php }

function nexus_topbar(string $active = ''): void
{
  if ($active) {
    $GLOBALS['NEXUS_ACTIVE_PAGE'] = $active;
  }
  $links = [
    ['path' => 'home', 'label' => 'Home', 'href' => URL_HOME],
    ['path' => 'resume', 'label' => 'Resume Studio', 'href' => URL_RESUME],
    ['path' => 'tools', 'label' => 'Cyber Tools', 'href' => URL_TOOLS],
    ['path' => 'project', 'label' => 'Projects', 'href' => URL_PROJECT],
    ['path' => 'courses', 'label' => 'Courses', 'href' => URL_COURSES],
    ['path' => 'resources', 'label' => 'Notes & PYQs', 'href' => URL_RESOURCES],
    ['path' => 'image', 'label' => 'Image Suite', 'href' => URL_IMAGE],
    ['path' => 'internships', 'label' => 'Internships', 'href' => URL_INTERNSHIPS],
    ['path' => 'blog', 'label' => 'Blog', 'href' => URL_BLOG],
  ];
  ?>
    <header
      class="fixed top-0 left-0 lg:left-72 right-0 h-16 bg-black/90 backdrop-blur-xl z-40 border-b border-zinc-800/80 flex items-center justify-between px-4 sm:px-6 lg:px-8"
      role="banner">
      <div class="flex items-center gap-3">
        <!-- Hamburger (mobile only) -->
        <button onclick="openSidebar()"
          class="lg:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-zinc-900/80 border border-zinc-800 text-zinc-300 hover:text-white hover:bg-zinc-800 transition-colors active:scale-95"
          aria-label="Open navigation" aria-expanded="false" id="hamburger-btn">
          <span class="material-symbols-outlined text-[20px]" aria-hidden="true">menu</span>
        </button>
        <nav class="hidden lg:flex items-center gap-md h-full overflow-x-auto" aria-label="Top navigation">
          <?php foreach ($links as $l):
            $isCurrent = ($active === $l['path']);
            $cls = $isCurrent
              ? 'text-emerald-400 border-b-2 border-emerald-400 font-medium'
              : 'text-zinc-400 hover:text-white';
            ?>
            <a href="<?= $l['href'] ?>"
              class="font-mono text-xs h-16 flex items-center transition-colors whitespace-nowrap px-xs <?= $cls ?>"
              <?= $isCurrent ? 'aria-current="page"' : '' ?>><?= $l['label'] ?></a>
          <?php endforeach; ?>
        </nav>
        <!-- Mobile: show current brand / page name with live indicator -->
        <div class="lg:hidden flex items-center gap-2">
          <a href="<?= URL_HOME ?>" class="flex items-center gap-2" aria-label="Yaswant Dev home">
            <span class="font-display-lg text-white font-bold text-[15px] tracking-tight">
              <?php
              $currentLabel = 'Yaswant Dev';
              foreach ($links as $l) {
                if ($l['path'] === $active) {
                  $currentLabel = $l['label'];
                  break;
                }
              }
              echo htmlspecialchars($currentLabel);
              ?>
            </span>
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse" aria-hidden="true"></span>
          </a>
        </div>
      </div>
      <div class="flex items-center gap-2 sm:gap-md shrink-0">
        <form method="GET" action="<?= URL_SEARCH ?>"
          class="hidden lg:flex items-center bg-zinc-900 border border-zinc-800 rounded-xl px-md py-1.5 gap-xs"
          role="search" aria-label="Site search">
          <span class="material-symbols-outlined text-zinc-500 text-[18px]" aria-hidden="true">search</span>
          <input name="q" placeholder="Search docs, tools, internships…" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
            aria-label="Search Yaswant Dev"
            class="bg-transparent text-white text-xs outline-none w-44 placeholder:text-zinc-500 font-mono" />
          <kbd
            class="hidden xl:inline-block bg-zinc-800 text-zinc-400 text-[10px] font-mono px-1.5 py-0.5 rounded border border-zinc-700">⌘K</kbd>
        </form>
        <a href="<?= URL_SEARCH ?>"
          class="lg:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-zinc-900/80 border border-zinc-800 text-zinc-300 hover:text-white hover:bg-zinc-800 transition-colors active:scale-95"
          aria-label="Search">
          <span class="material-symbols-outlined text-[20px]" aria-hidden="true">search</span>
        </a>
        <button onclick="toggleAppDrawer()"
          class="lg:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500/20 transition-all active:scale-95 shadow-sm"
          role="button" aria-label="Open App Drawer" aria-controls="mobile-app-drawer">
          <span class="material-symbols-outlined text-[20px]" aria-hidden="true">widgets</span>
        </button>
        <div
          class="hidden sm:flex w-8 h-8 rounded-xl bg-zinc-900 border border-zinc-800 text-zinc-400 items-center justify-center cursor-pointer hover:bg-zinc-800 hover:text-white transition-all shadow-sm"
          role="button" aria-label="User profile" tabindex="0">
          <span class="material-symbols-outlined text-[18px]" aria-hidden="true">person</span>
        </div>
      </div>
    </header>
    <script>
      function openSidebar() {
        document.getElementById('nexus-sidebar').classList.add('open');
        document.getElementById('sidebar-overlay').classList.add('open');
        document.getElementById('hamburger-btn').setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
      }
      function closeSidebar() {
        document.getElementById('nexus-sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('open');
        document.getElementById('hamburger-btn').setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    </script>
  <?php }

function nexus_footer(): void
{ ?>
    <footer class="w-full bg-[#050507] border-t border-zinc-800/80 mt-2xl pt-2xl pb-xl relative z-10" role="contentinfo"
      aria-label="Site footer">
      <div class="max-w-max-width-content mx-auto px-lg grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-xl mb-2xl">

        <!-- Column 1: Brand Info & Socials -->
        <div class="lg:col-span-2 space-y-md">
          <div class="flex items-center gap-xs text-white font-display-lg text-lg font-bold">
            <div
              class="w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shadow-md">
              <span class="material-symbols-outlined text-[20px]" aria-hidden="true">terminal</span>
            </div>
            <span>Yaswant Dev</span>
          </div>
          <p class="text-zinc-400 text-sm max-w-sm leading-relaxed">
            The ultimate developer ecosystem for modern engineers. Build ATS resumes, practice browser dev tools, study
            coursework, and land top-tier tech roles.
          </p>
          <div class="flex items-center gap-sm pt-xs" aria-label="Social links">
            <a href="https://github.com/Yaswantpandey" target="_blank" rel="noopener noreferrer"
              class="w-9 h-9 rounded-xl bg-zinc-900 hover:bg-emerald-500/20 text-zinc-400 hover:text-emerald-400 border border-zinc-800 flex items-center justify-center transition-all shadow-sm"
              aria-label="GitHub">
              <span class="material-symbols-outlined text-[18px]">code</span>
            </a>
            <a href="https://www.linkedin.com/in/ecotechservices/" target="_blank" rel="noopener noreferrer"
              class="w-9 h-9 rounded-xl bg-zinc-900 hover:bg-cyan-500/20 text-zinc-400 hover:text-cyan-400 border border-zinc-800 flex items-center justify-center transition-all shadow-sm"
              aria-label="LinkedIn">
              <span class="material-symbols-outlined text-[18px]">work</span>
            </a>
            <a href="https://x.com/YaswantP86897" target="_blank" rel="noopener noreferrer"
              class="w-9 h-9 rounded-xl bg-zinc-900 hover:bg-indigo-500/20 text-zinc-400 hover:text-indigo-400 border border-zinc-800 flex items-center justify-center transition-all shadow-sm"
              aria-label="Twitter">
              <span class="material-symbols-outlined text-[18px]">share</span>
            </a>
          </div>
        </div>

        <!-- Column 2: Academic & Learning -->
        <div>
          <h4 class="font-mono text-xs uppercase tracking-widest text-emerald-400 font-bold mb-md">Academic & Learning
          </h4>
          <nav class="flex flex-col gap-xs text-sm text-zinc-400" aria-label="Academic links">
            <a class="hover:text-emerald-400 transition-colors flex items-center gap-xs" href="<?= URL_HOME ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Home</a>
            <a class="hover:text-emerald-400 transition-colors flex items-center gap-xs" href="<?= URL_RESOURCES ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Study Notes & Solved
              PYQs</a>
            <a class="hover:text-emerald-400 transition-colors flex items-center gap-xs" href="<?= URL_COURSES ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Free Engineering
              Courses</a>
            <a class="hover:text-emerald-400 transition-colors flex items-center gap-xs" href="<?= URL_PROJECT ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Cyber Security
              Projects</a>
            <a class="hover:text-emerald-400 transition-colors flex items-center gap-xs" href="<?= URL_BLOG ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Engineering Blog</a>
          </nav>
        </div>

        <!-- Column 3: Career & Engineering Tools -->
        <div>
          <h4 class="font-mono text-xs uppercase tracking-widest text-cyan-400 font-bold mb-md">Career & Developer Tools
          </h4>
          <nav class="flex flex-col gap-xs text-sm text-zinc-400" aria-label="Career and tool links">
            <a class="hover:text-cyan-400 transition-colors flex items-center gap-xs" href="<?= URL_RESUME ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>ATS Resume Studio</a>
            <a class="hover:text-cyan-400 transition-colors flex items-center gap-xs" href="<?= URL_TOOLS ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Developer & Cyber
              Tools</a>
            <a class="hover:text-cyan-400 transition-colors flex items-center gap-xs" href="<?= URL_IMAGE ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Image Editing Suite</a>
            <a class="hover:text-cyan-400 transition-colors flex items-center gap-xs" href="<?= URL_INTERNSHIPS ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Tech Internships 2026</a>
            <a class="hover:text-cyan-400 transition-colors flex items-center gap-xs" href="<?= URL_DASHBOARD ?>"><span
                class="material-symbols-outlined text-[14px] text-zinc-600">chevron_right</span>Student Dashboard</a>
          </nav>
        </div>

        <!-- Column 4: Newsletter Signup -->
        <div>
          <h4 class="font-mono text-xs uppercase tracking-widest text-indigo-400 font-bold mb-md">Stay Ahead</h4>
          <p class="text-xs text-zinc-400 mb-sm leading-relaxed">Get weekly tech internship alerts & new study resources
            delivered to your inbox.</p>
          <?php if (!empty($_GET['subscribed'])): ?>
            <div
              class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 p-xs rounded-xl text-xs font-mono flex items-center gap-xs">
              <span class="material-symbols-outlined text-[16px]">check_circle</span> Subscribed successfully!
            </div>
          <?php else: ?>
            <form method="POST" action="api/newsletter.php" class="flex flex-col gap-xs" aria-label="Newsletter signup">
              <label for="footer-email" class="sr-only">Email address</label>
              <input id="footer-email" name="email" type="email" required placeholder="your.email@university.edu"
                class="bg-zinc-950 border border-zinc-800 px-md py-2 rounded-xl text-xs text-white placeholder:text-zinc-600 w-full focus:outline-none focus:border-emerald-500 font-mono" />
              <button type="submit"
                class="bg-emerald-500 hover:bg-emerald-400 text-black px-md py-2 rounded-xl text-xs font-bold font-mono transition-all shadow-md flex items-center justify-center gap-xs">
                Subscribe <span class="material-symbols-outlined text-[14px]">send</span>
              </button>
            </form>
          <?php endif; ?>
        </div>

      </div>

      <!-- Bottom Bar -->
      <div
        class="max-w-max-width-content mx-auto px-lg pt-lg border-t border-zinc-800/80 flex flex-col sm:flex-row items-center justify-between gap-md text-xs text-zinc-500 font-mono">
        <div class="flex items-center gap-md">
          <span>&copy; <?= date('Y') ?> Yaswant Pandey (Yaswant Dev). All rights reserved.</span>
          <a href="<?= URL_HOME ?>/admin_login.php"
            class="hover:text-emerald-400 transition-colors text-[11px] flex items-center gap-xs">
            <span class="material-symbols-outlined text-[12px]">lock</span> Admin Portal
          </a>
        </div>

        <div class="flex items-center gap-lg">
          <div class="flex items-center gap-xs bg-zinc-900 px-sm py-1 rounded-full border border-zinc-800 text-[11px]">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-zinc-300 font-mono">All Systems Operational</span>
          </div>
          <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="hover:text-emerald-400 transition-colors flex items-center gap-xs text-[11px]">
            Back to Top <span class="material-symbols-outlined text-[14px]">arrow_upward</span>
          </button>
        </div>
      </div>
    </footer>
    <script>
      document.querySelectorAll('img:not([loading])').forEach(function (img) {
        img.setAttribute('loading', 'lazy');
        if (!img.getAttribute('decoding')) img.setAttribute('decoding', 'async');
      });
      if ('requestIdleCallback' in window) {
        requestIdleCallback(function () {
          ['<?= URL_COURSES ?>', '<?= URL_RESOURCES ?>', '<?= URL_INTERNSHIPS ?>', '<?= URL_RESUME ?>'].forEach(function (href) {
            var l = document.createElement('link'); l.rel = 'prefetch'; l.href = href;
            document.head.appendChild(l);
          });
        });
      }
    </script>
    <?php nexus_bottom_nav($GLOBALS['NEXUS_ACTIVE_PAGE'] ?? ''); ?>
  </body>

  </html>
<?php }

function nexus_bottom_nav(string $active = ''): void
{
  $isHome = ($active === 'home' || $active === '' || $active === 'index');
  $isTools = ($active === 'tools');
  $isResume = ($active === 'resume');
  $isCourses = ($active === 'courses' || $active === 'resources');
  $isHubActive = (!$isHome && !$isTools && !$isResume && !$isCourses);
  ?>
  <!-- Mobile App Bottom Navigation Bar -->
  <nav id="nexus-bottom-nav"
    class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#070709]/92 backdrop-blur-2xl border-t border-zinc-800/80 shadow-[0_-8px_30px_rgba(0,0,0,0.8)] px-2 pt-1 pb-[calc(0.5rem+env(safe-area-inset-bottom,0px))] select-none"
    role="navigation" aria-label="Mobile application bar">
    <div class="max-w-md mx-auto grid grid-cols-5 items-center justify-around">
      <!-- 1. Home -->
      <a href="<?= URL_HOME ?>"
        class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 group <?= $isHome ? 'text-emerald-400 font-semibold' : 'text-zinc-400 hover:text-zinc-200' ?>"
        aria-label="Home" <?= $isHome ? 'aria-current="page"' : '' ?>>
        <div class="w-12 h-7 flex items-center justify-center rounded-full transition-all <?= $isHome ? 'bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 shadow-[0_0_12px_rgba(16,185,129,0.25)]' : 'group-hover:bg-zinc-800/50' ?>">
          <span class="material-symbols-outlined text-[21px]" aria-hidden="true">home</span>
        </div>
        <span class="text-[10px] tracking-tight mt-0.5 whitespace-nowrap">Home</span>
      </a>

      <!-- 2. Tools -->
      <a href="<?= URL_TOOLS ?>"
        class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 group <?= $isTools ? 'text-emerald-400 font-semibold' : 'text-zinc-400 hover:text-zinc-200' ?>"
        aria-label="Cyber Tools" <?= $isTools ? 'aria-current="page"' : '' ?>>
        <div class="w-12 h-7 flex items-center justify-center rounded-full transition-all <?= $isTools ? 'bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 shadow-[0_0_12px_rgba(16,185,129,0.25)]' : 'group-hover:bg-zinc-800/50' ?>">
          <span class="material-symbols-outlined text-[21px]" aria-hidden="true">terminal</span>
        </div>
        <span class="text-[10px] tracking-tight mt-0.5 whitespace-nowrap">Tools</span>
      </a>

      <!-- 3. Resume Studio -->
      <a href="<?= URL_RESUME ?>"
        class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 group <?= $isResume ? 'text-cyan-400 font-semibold' : 'text-zinc-400 hover:text-zinc-200' ?>"
        aria-label="ATS Resume Studio" <?= $isResume ? 'aria-current="page"' : '' ?>>
        <div class="w-12 h-7 flex items-center justify-center rounded-full transition-all <?= $isResume ? 'bg-cyan-500/15 border border-cyan-500/30 text-cyan-400 shadow-[0_0_12px_rgba(6,182,212,0.25)]' : 'group-hover:bg-zinc-800/50' ?>">
          <span class="material-symbols-outlined text-[21px]" aria-hidden="true">description</span>
        </div>
        <span class="text-[10px] tracking-tight mt-0.5 whitespace-nowrap">Resume</span>
      </a>

      <!-- 4. Courses -->
      <a href="<?= URL_COURSES ?>"
        class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 group <?= $isCourses ? 'text-indigo-400 font-semibold' : 'text-zinc-400 hover:text-zinc-200' ?>"
        aria-label="Engineering Courses" <?= $isCourses ? 'aria-current="page"' : '' ?>>
        <div class="w-12 h-7 flex items-center justify-center rounded-full transition-all <?= $isCourses ? 'bg-indigo-500/15 border border-indigo-500/30 text-indigo-400 shadow-[0_0_12px_rgba(99,102,241,0.25)]' : 'group-hover:bg-zinc-800/50' ?>">
          <span class="material-symbols-outlined text-[21px]" aria-hidden="true">school</span>
        </div>
        <span class="text-[10px] tracking-tight mt-0.5 whitespace-nowrap">Courses</span>
      </a>

      <!-- 5. Apps / Ecosystem Hub Drawer -->
      <button onclick="toggleAppDrawer()" id="btn-app-drawer" type="button"
        class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 group <?= $isHubActive ? 'text-amber-400 font-semibold' : 'text-zinc-400 hover:text-zinc-200' ?>"
        aria-label="All Ecosystem Apps & Hub" aria-expanded="false" aria-controls="mobile-app-drawer">
        <div class="w-12 h-7 flex items-center justify-center rounded-full transition-all <?= $isHubActive ? 'bg-amber-500/15 border border-amber-500/30 text-amber-400 shadow-[0_0_12px_rgba(245,158,11,0.25)]' : 'group-hover:bg-zinc-800/50' ?>">
          <span class="material-symbols-outlined text-[21px]" aria-hidden="true">grid_view</span>
        </div>
        <span class="text-[10px] tracking-tight mt-0.5 whitespace-nowrap">Apps</span>
      </button>
    </div>
  </nav>

  <!-- Mobile Drawer Overlay -->
  <div id="drawer-overlay" onclick="closeAppDrawer()"
    class="fixed inset-0 bg-black/75 backdrop-blur-sm z-50 transition-opacity duration-300 lg:hidden"
    aria-hidden="true"></div>

  <!-- Mobile Bottom Sheet App Drawer -->
  <div id="mobile-app-drawer"
    class="fixed left-0 right-0 bottom-0 z-50 bg-[#09090c] border-t border-zinc-800/90 rounded-t-3xl shadow-[0_-12px_50px_rgba(0,0,0,0.9)] transition-transform duration-300 ease-out max-h-[88vh] overflow-y-auto lg:hidden pb-[calc(1.5rem+env(safe-area-inset-bottom,0px))]"
    role="dialog" aria-modal="true" aria-labelledby="drawer-heading">

    <!-- Sticky Header with Handle -->
    <div class="sticky top-0 bg-[#09090c]/95 backdrop-blur-xl px-5 pt-3 pb-3 border-b border-zinc-800/60 flex flex-col items-center z-10">
      <div class="w-12 h-1.5 bg-zinc-700/80 rounded-full mb-3 cursor-pointer hover:bg-zinc-600 transition-colors" onclick="closeAppDrawer()" aria-label="Dismiss drawer"></div>
      <div class="w-full flex items-center justify-between">
        <div class="flex items-center gap-2">
          <div class="w-7 h-7 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
            <span class="material-symbols-outlined text-[16px]">widgets</span>
          </div>
          <div>
            <h3 id="drawer-heading" class="font-display-lg font-bold text-sm text-white tracking-tight leading-none">Ecosystem Hub</h3>
            <span class="text-[10px] text-zinc-500 font-mono">yaswant.co.in suite</span>
          </div>
        </div>
        <button onclick="closeAppDrawer()"
          class="w-8 h-8 rounded-full bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white flex items-center justify-center transition-colors active:scale-95"
          aria-label="Close apps drawer">
          <span class="material-symbols-outlined text-[18px]">close</span>
        </button>
      </div>
    </div>

    <!-- Drawer Content -->
    <div class="p-5 space-y-5">
      <!-- Search Input inside Drawer -->
      <form method="GET" action="<?= URL_SEARCH ?>"
        class="relative flex items-center bg-zinc-950 border border-zinc-800 focus-within:border-emerald-500/60 rounded-xl px-3 py-2.5 transition-all shadow-inner">
        <span class="material-symbols-outlined text-zinc-500 text-[18px] mr-2">search</span>
        <input name="q" placeholder="Search 26+ tools, notes, courses, internships…"
          class="bg-transparent text-white text-xs outline-none w-full font-mono placeholder:text-zinc-600" />
        <button type="submit"
          class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-3 py-1 rounded-lg text-[10px] font-mono font-bold shrink-0 hover:bg-emerald-500/30 transition-colors">
          Search
        </button>
      </form>

      <!-- Academic & Engineering Section -->
      <div>
        <div class="text-[10px] font-mono uppercase tracking-widest text-zinc-500 mb-2.5 font-semibold flex items-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Academic & Engineering
        </div>
        <div class="grid grid-cols-2 gap-2.5">
          <a href="<?= URL_RESOURCES ?>" onclick="closeAppDrawer()"
            class="flex items-center gap-3 p-3 rounded-xl bg-zinc-900/50 hover:bg-zinc-900 border border-zinc-800/70 hover:border-emerald-500/40 transition-all active:scale-95 group">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[20px]">folder_open</span>
            </div>
            <div class="min-w-0">
              <div class="text-xs font-semibold text-white group-hover:text-emerald-400 transition-colors truncate">Study Notes</div>
              <div class="text-[10px] text-zinc-500 font-mono truncate">PYQs & Manuals</div>
            </div>
          </a>

          <a href="<?= URL_COURSES ?>" onclick="closeAppDrawer()"
            class="flex items-center gap-3 p-3 rounded-xl bg-zinc-900/50 hover:bg-zinc-900 border border-zinc-800/70 hover:border-indigo-500/40 transition-all active:scale-95 group">
            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[20px]">school</span>
            </div>
            <div class="min-w-0">
              <div class="text-xs font-semibold text-white group-hover:text-indigo-400 transition-colors truncate">Courses</div>
              <div class="text-[10px] text-zinc-500 font-mono truncate">Engineering Curricula</div>
            </div>
          </a>

          <a href="<?= URL_PROJECT ?>" onclick="closeAppDrawer()"
            class="flex items-center gap-3 p-3 rounded-xl bg-zinc-900/50 hover:bg-zinc-900 border border-zinc-800/70 hover:border-cyan-500/40 transition-all active:scale-95 group">
            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[20px]">folder_special</span>
            </div>
            <div class="min-w-0">
              <div class="text-xs font-semibold text-white group-hover:text-cyan-400 transition-colors truncate">Cyber Projects</div>
              <div class="text-[10px] text-zinc-500 font-mono truncate">25+ Security Labs</div>
            </div>
          </a>

          <a href="<?= URL_IMAGE ?>" onclick="closeAppDrawer()"
            class="flex items-center gap-3 p-3 rounded-xl bg-zinc-900/50 hover:bg-zinc-900 border border-zinc-800/70 hover:border-amber-500/40 transition-all active:scale-95 group">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[20px]">image</span>
            </div>
            <div class="min-w-0">
              <div class="text-xs font-semibold text-white group-hover:text-amber-400 transition-colors truncate">Image Suite</div>
              <div class="text-[10px] text-zinc-500 font-mono truncate">Resize & Compress</div>
            </div>
          </a>
        </div>
      </div>

      <!-- Career & Editorial Section -->
      <div>
        <div class="text-[10px] font-mono uppercase tracking-widest text-zinc-500 mb-2.5 font-semibold flex items-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span> Career & Opportunities
        </div>
        <div class="grid grid-cols-2 gap-2.5">
          <a href="<?= URL_RESUME ?>" onclick="closeAppDrawer()"
            class="flex items-center gap-3 p-3 rounded-xl bg-zinc-900/50 hover:bg-zinc-900 border border-zinc-800/70 hover:border-cyan-500/40 transition-all active:scale-95 group">
            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[20px]">description</span>
            </div>
            <div class="min-w-0">
              <div class="text-xs font-semibold text-white group-hover:text-cyan-400 transition-colors truncate">ATS Resume</div>
              <div class="text-[10px] text-zinc-500 font-mono truncate">Instant PDF Builder</div>
            </div>
          </a>

          <a href="<?= URL_INTERNSHIPS ?>" onclick="closeAppDrawer()"
            class="flex items-center gap-3 p-3 rounded-xl bg-zinc-900/50 hover:bg-zinc-900 border border-zinc-800/70 hover:border-emerald-500/40 transition-all active:scale-95 group">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[20px]">work</span>
            </div>
            <div class="min-w-0">
              <div class="text-xs font-semibold text-white group-hover:text-emerald-400 transition-colors truncate">Internships</div>
              <div class="text-[10px] text-zinc-500 font-mono truncate">2026 Tech Openings</div>
            </div>
          </a>

          <a href="<?= URL_BLOG ?>" onclick="closeAppDrawer()"
            class="flex items-center gap-3 p-3 rounded-xl bg-zinc-900/50 hover:bg-zinc-900 border border-zinc-800/70 hover:border-purple-500/40 transition-all active:scale-95 group">
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[20px]">article</span>
            </div>
            <div class="min-w-0">
              <div class="text-xs font-semibold text-white group-hover:text-purple-400 transition-colors truncate">Tech Blog</div>
              <div class="text-[10px] text-zinc-500 font-mono truncate">Engineering Insights</div>
            </div>
          </a>

          <a href="<?= URL_DASHBOARD ?>" onclick="closeAppDrawer()"
            class="flex items-center gap-3 p-3 rounded-xl bg-zinc-900/50 hover:bg-zinc-900 border border-zinc-800/70 hover:border-blue-500/40 transition-all active:scale-95 group">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[20px]">dashboard</span>
            </div>
            <div class="min-w-0">
              <div class="text-xs font-semibold text-white group-hover:text-blue-400 transition-colors truncate">Dashboard</div>
              <div class="text-[10px] text-zinc-500 font-mono truncate">Student Workspace</div>
            </div>
          </a>
        </div>
      </div>

      <!-- Quick Utilities & System Row -->
      <div class="pt-2 border-t border-zinc-800/80 flex items-center justify-between text-xs font-mono">
        <a href="<?= URL_HOME ?>/admin_login.php" onclick="closeAppDrawer()"
          class="flex items-center gap-1.5 text-zinc-500 hover:text-rose-400 transition-colors py-1">
          <span class="material-symbols-outlined text-[16px]">lock</span>
          <span>Admin Portal</span>
        </a>
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'}); closeAppDrawer();"
          class="flex items-center gap-1.5 text-emerald-400 hover:text-emerald-300 transition-colors py-1 font-semibold">
          <span>Back to Top</span>
          <span class="material-symbols-outlined text-[15px]">arrow_upward</span>
        </button>
      </div>
    </div>
  </div>

  <script>
    function openAppDrawer() {
      var d = document.getElementById('mobile-app-drawer');
      var o = document.getElementById('drawer-overlay');
      var b = document.getElementById('btn-app-drawer');
      if (d && o) {
        d.classList.add('open');
        o.classList.add('open');
        if (b) b.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
      }
    }
    function closeAppDrawer() {
      var d = document.getElementById('mobile-app-drawer');
      var o = document.getElementById('drawer-overlay');
      var b = document.getElementById('btn-app-drawer');
      if (d && o) {
        d.classList.remove('open');
        o.classList.remove('open');
        if (b) b.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    }
    function toggleAppDrawer() {
      var d = document.getElementById('mobile-app-drawer');
      if (d && d.classList.contains('open')) {
        closeAppDrawer();
      } else {
        openAppDrawer();
      }
    }
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAppDrawer();
        if (typeof closeSidebar === 'function') closeSidebar();
      }
    });
  </script>
  <?php
}
