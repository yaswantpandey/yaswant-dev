<?php require_once 'includes/layout.php';
require_once 'includes/data.php';

$recentResources = array_slice(get_resources(), 0, 3);
$recentJobs = array_slice(get_jobs(), 0, 3);

$schema = schema_home();

nexus_head(
  'Yaswant Pandey — Official Website | Engineering & Developer Ecosystem',
  'Official website of Yaswant Pandey (Yaswant Dev). Explore 26+ browser-based cyber security & developer utilities, online image editing tools, interactive ATS resume studio, engineering study notes, and internships.',
  'Yaswant Pandey, yaswant pandey developer, yaswant pandey website, yaswant pandey portfolio, yaswant dev, yaswant kumar pandey, yaswant.co.in, iamlucifer, lucifer developer, ats resume builder, free engineering courses, cyber security tools online, photo resizer, image compressor, semester study notes, tech internships 2026',
  URL_HOME,
  ['type' => 'profile', 'title' => 'Yaswant Pandey — Official Website | Engineering & Dev Ecosystem'],
  $schema
);
?>
<style>
  /* ───── Hand-Crafted Technical Dark Theme (Vercel / Linear Aesthetic) ───── */
  .home-page-wrap {
    background: #09090b;
    color: #f4f4f5;
    font-feature-settings: "cv02", "cv03", "cv04", "cv11";
  }

  /* Dot Grid Pattern */
  .dot-grid-pattern {
    background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
    background-size: 24px 24px;
  }

  /* Minimalist Product Cards */
  .product-card {
    background: rgba(18, 18, 22, 0.75);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1rem;
    transition: border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
  }

  .product-card:hover {
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 12px 32px -8px rgba(0, 0, 0, 0.7);
  }

  /* Command Search Bar */
  .cmd-search-box {
    background: #121215;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 0.85rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .cmd-search-box:focus-within {
    border-color: #10b981;
    box-shadow: 0 0 0 1px #10b981, 0 8px 24px -4px rgba(16, 185, 129, 0.15);
  }

  /* Terminal Window Widget */
  .terminal-box {
    background: #0c0c0e;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.85rem;
    font-family: 'JetBrains Mono', monospace;
  }

  /* Pill Tags */
  .tech-pill {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: #a1a1aa;
    border-radius: 9999px;
    padding: 0.3rem 0.85rem;
    font-size: 0.725rem;
    font-family: 'JetBrains Mono', monospace;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .tech-pill:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    border-color: rgba(255, 255, 255, 0.2);
  }

  /* Fast App Dock */
  .dock-item {
    background: rgba(24, 24, 28, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 0.85rem;
    transition: all 0.2s ease;
  }

  .dock-item:hover {
    background: rgba(32, 32, 38, 0.95);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
  }

  .no-scrollbar::-webkit-scrollbar { display: none; }
  .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

  /* Grid Layout */
  @media (max-width: 767px) {
    .bento-grid { display: flex; flex-direction: column; gap: 1rem; }
    .span-2, .span-3, .span-4 { grid-column: span 1 !important; }
  }

  @media (min-width: 768px) and (max-width: 1023px) {
    .bento-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    .span-2 { grid-column: span 2; }
    .span-3 { grid-column: span 2; }
    .span-4 { grid-column: span 2; }
  }

  @media (min-width: 1024px) {
    .bento-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.15rem; }
    .span-2 { grid-column: span 2; }
    .span-3 { grid-column: span 3; }
    .span-4 { grid-column: span 4; }
  }
</style>

<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen home-page-wrap">
  <?php nexus_sidebar('home');
  nexus_topbar('home'); ?>

  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-[1320px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-col w-full relative dot-grid-pattern">

      <!-- ── HERO SECTION ──────────────────────────────────────────── -->
      <section class="relative z-10 flex flex-col items-center text-center px-2 pt-8 pb-12 md:pt-14 md:pb-16" aria-labelledby="hero-heading">

        <!-- Version Badge -->
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full mb-6 text-[11px] font-mono text-zinc-400 bg-zinc-900/90 border border-zinc-800">
          <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
          <span>v2.5 &nbsp;&bull;&nbsp; Zero-Knowledge Developer Platform</span>
        </div>

        <!-- Headline -->
        <h1 id="hero-heading" class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight max-w-4xl leading-[1.1] mb-5">
          Engineering Utilities, ATS Resumes & Academic Vault
        </h1>

        <!-- Subheading -->
        <p class="text-sm sm:text-base text-zinc-400 max-w-2xl mx-auto font-normal leading-relaxed mb-8 px-2">
          Built by <strong class="text-zinc-200 font-semibold">Yaswant Pandey</strong>. Access 26+ browser security tools, 4 Harvard-standard ATS resume templates, smart image utilities, and semester notes — fast, private, zero signup.
        </p>

        <!-- Command Search Bar -->
        <div class="w-full max-w-xl mx-auto mb-6">
          <form method="GET" action="search.php" class="cmd-search-box flex items-center p-2 shadow-xl" role="search" aria-label="Search Yaswant Dev Ecosystem">
            <span class="material-symbols-outlined text-zinc-500 ml-2.5 text-[20px] shrink-0" aria-hidden="true">search</span>
            <label for="hero-search" class="sr-only">Search notes, tools, courses, internships</label>
            <input id="hero-search" name="q"
              class="flex-1 bg-transparent text-white text-xs sm:text-sm placeholder:text-zinc-500 border-none focus:outline-none px-3 py-2 font-mono min-w-0"
              placeholder="Search notes, tools, courses, internships…" />
            <div class="hidden sm:flex items-center text-[10px] font-mono text-zinc-500 bg-zinc-900 px-2 py-1 rounded border border-zinc-800 mr-2">
              ⌘K
            </div>
            <button type="submit"
              class="bg-emerald-500 hover:bg-emerald-400 text-black font-mono font-bold px-4 py-2 rounded-lg transition-all text-xs flex items-center gap-1.5 shrink-0 active:scale-95">
              Search <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
            </button>
          </form>
        </div>

        <!-- Trending Pills Bar -->
        <div class="pill-tags-wrap flex items-center justify-start sm:justify-center overflow-x-auto max-w-full no-scrollbar gap-2 mb-8 px-2">
          <span class="text-[10px] font-mono uppercase tracking-widest text-zinc-500 shrink-0 font-semibold">Quick Tags:</span>
          <a href="search.php?q=Data+Structures" class="tech-pill shrink-0 active:scale-95">#DataStructures</a>
          <a href="resume.php" class="tech-pill shrink-0 active:scale-95">#ATSResume</a>
          <a href="<?= URL_TOOLS ?>" class="tech-pill shrink-0 active:scale-95">#CyberTools</a>
          <a href="<?= URL_IMAGE ?>" class="tech-pill shrink-0 active:scale-95">#ImageCompressor</a>
          <a href="<?= URL_RESOURCES ?>" class="tech-pill shrink-0 active:scale-95">#PYQNotes</a>
        </div>

        <!-- ── App Dock (Fast Launch) ── -->
        <div class="w-full max-w-3xl mx-auto mb-8 px-1">
          <div class="flex items-center justify-between px-1 mb-3">
            <span class="text-[11px] font-mono uppercase tracking-wider text-zinc-400 font-semibold flex items-center gap-2">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Ecosystem App Dock
            </span>
            <span class="text-[10px] font-mono text-zinc-500 hidden sm:inline">Direct Launch</span>
          </div>

          <div class="grid grid-cols-3 sm:grid-cols-5 md:grid-cols-9 gap-2">
            <a href="<?= URL_TOOLS ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-emerald-400 text-[22px] group-hover:scale-110 transition-transform">terminal</span>
              <span class="text-[11px] font-mono text-zinc-300">Tools</span>
            </a>
            <a href="<?= URL_RESUME ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-cyan-400 text-[22px] group-hover:scale-110 transition-transform">description</span>
              <span class="text-[11px] font-mono text-zinc-300">Resume</span>
            </a>
            <a href="<?= URL_RESOURCES ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-indigo-400 text-[22px] group-hover:scale-110 transition-transform">folder_open</span>
              <span class="text-[11px] font-mono text-zinc-300">Notes</span>
            </a>
            <a href="<?= URL_IMAGE ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-amber-400 text-[22px] group-hover:scale-110 transition-transform">image</span>
              <span class="text-[11px] font-mono text-zinc-300">Image</span>
            </a>
            <a href="<?= URL_PROJECT ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-rose-400 text-[22px] group-hover:scale-110 transition-transform">shield_lock</span>
              <span class="text-[11px] font-mono text-zinc-300">Labs</span>
            </a>
            <a href="<?= URL_INTERNSHIPS ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-teal-400 text-[22px] group-hover:scale-110 transition-transform">work</span>
              <span class="text-[11px] font-mono text-zinc-300">Jobs</span>
            </a>
            <a href="<?= URL_COURSES ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-violet-400 text-[22px] group-hover:scale-110 transition-transform">school</span>
              <span class="text-[11px] font-mono text-zinc-300">Courses</span>
            </a>
            <a href="<?= URL_BLOG ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-purple-400 text-[22px] group-hover:scale-110 transition-transform">article</span>
              <span class="text-[11px] font-mono text-zinc-300">Blog</span>
            </a>
            <a href="<?= URL_DASHBOARD ?>" class="dock-item p-2.5 flex flex-col items-center gap-1 text-center group">
              <span class="material-symbols-outlined text-blue-400 text-[22px] group-hover:scale-110 transition-transform">dashboard</span>
              <span class="text-[11px] font-mono text-zinc-300">Admin</span>
            </a>
          </div>
        </div>

        <!-- Primary Action Callouts -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 w-full max-w-sm sm:max-w-none mx-auto">
          <a href="<?= URL_TOOLS ?>"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-black font-mono font-bold px-6 py-3 rounded-xl text-xs sm:text-sm transition-all active:scale-95">
            Launch 26+ Cyber Tools <span class="material-symbols-outlined text-[16px]">terminal</span>
          </a>
          <a href="<?= URL_RESUME ?>"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-mono px-6 py-3 rounded-xl text-xs sm:text-sm transition-all active:scale-95">
            Build ATS Resume <span class="material-symbols-outlined text-[16px] text-cyan-400">description</span>
          </a>
        </div>

      </section>

      <!-- ── LIVE INTERACTIVE PRODUCT WORKFLOW (Terminal Preview) ── -->
      <section class="relative z-10 w-full max-w-4xl mx-auto mb-12" aria-label="Interactive Product Console">
        <div class="terminal-box p-4 md:p-5 shadow-2xl">
          <div class="flex items-center justify-between border-b border-zinc-800 pb-3 mb-4">
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded-full bg-red-500/80 inline-block"></span>
              <span class="w-3 h-3 rounded-full bg-amber-500/80 inline-block"></span>
              <span class="w-3 h-3 rounded-full bg-emerald-500/80 inline-block"></span>
              <span class="text-xs text-zinc-500 ml-2 font-mono">yaswant-dev-cli ~ zsh</span>
            </div>
            <div class="flex items-center gap-3 text-[11px] text-zinc-400 font-mono">
              <span class="text-emerald-400 font-bold">● Active</span>
              <span class="text-zinc-500 hidden sm:inline">Zero-Knowledge Sandbox</span>
            </div>
          </div>
          <div class="space-y-2 text-xs font-mono leading-relaxed">
            <div class="text-zinc-400">
              <span class="text-emerald-400 font-bold">$</span> yaswant-dev tools --status
            </div>
            <div class="text-zinc-300 pl-4">
              ✔ 26 Client-side WebCrypto utilities initialized.<br/>
              ✔ 4 ATS Resume templates active (Classic, Modern, Harvard, Compact).<br/>
              ✔ 0 External network logs transmitted (100% Zero-Knowledge).
            </div>
            <div class="text-zinc-400 pt-1">
              <span class="text-emerald-400 font-bold">$</span> cat ./status.json
            </div>
            <div class="text-zinc-400 pl-4 bg-zinc-950 p-3 rounded-lg border border-zinc-800 text-[11px] overflow-x-auto">
              <span class="text-emerald-400">"platform"</span>: <span class="text-cyan-300">"Yaswant Dev OS v2.5"</span>,<br/>
              <span class="text-emerald-400">"author"</span>: <span class="text-cyan-300">"Yaswant Pandey"</span>,<br/>
              <span class="text-emerald-400">"modules"</span>: [<span class="text-amber-300">"Tools"</span>, <span class="text-amber-300">"ATS Resume"</span>, <span class="text-amber-300">"Study Notes"</span>, <span class="text-amber-300">"Image Suite"</span>]
            </div>
          </div>
        </div>
      </section>

      <!-- ── BENTO GRID SECTION ─────────────────────────────────── -->
      <section class="relative z-10 w-full pb-14 px-0" aria-labelledby="core-features-heading">

        <div class="flex items-center justify-between mb-6 border-b border-zinc-800/80 pb-4">
          <div class="flex items-center gap-2.5">
            <div class="w-1.5 h-6 rounded bg-emerald-400"></div>
            <h2 id="core-features-heading" class="text-xl font-bold text-white tracking-tight">Core Product Modules</h2>
          </div>
          <span class="text-xs font-mono text-zinc-500 uppercase tracking-wider hidden md:block">Hand-crafted Architecture</span>
        </div>

        <div class="bento-grid">

          <!-- Academic Resource Vault -->
          <article class="product-card span-2 p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-emerald-400 text-2xl">school</span>
                  <h3 class="text-base font-bold text-white">Academic Study Vault</h3>
                </div>
                <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-400 rounded text-[10px] font-mono uppercase font-bold border border-emerald-500/20">Notes & PYQs</span>
              </div>
              <p class="text-xs text-zinc-400 font-normal mb-4 leading-relaxed">Verified semester lecture notes, 5-year solved end-sem question papers, and laboratory experiment manuals.</p>
              
              <div class="space-y-2">
                <?php foreach ($recentResources as $res): ?>
                  <a href="resources.php" class="flex items-center justify-between p-2.5 rounded-lg bg-zinc-900/90 border border-zinc-800 hover:border-zinc-700 transition-colors">
                    <div class="flex items-center gap-2 min-w-0">
                      <span class="material-symbols-outlined text-emerald-400 text-[16px] shrink-0">description</span>
                      <span class="text-xs text-zinc-200 truncate font-mono"><?= htmlspecialchars($res['title']) ?></span>
                    </div>
                    <span class="text-[10px] font-mono text-zinc-500 uppercase shrink-0 ml-2"><?= htmlspecialchars($res['branch']) ?> &bull; <?= htmlspecialchars($res['sem']) ?></span>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center justify-between">
              <span class="text-xs font-mono text-zinc-500">100% Free Downloads</span>
              <a href="<?= URL_RESOURCES ?>" class="text-xs font-mono text-emerald-400 hover:underline flex items-center gap-1 font-bold">
                Browse Vault <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
              </a>
            </div>
          </article>

          <!-- ATS Resume Studio -->
          <article class="product-card p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-cyan-400 text-2xl">description</span>
                <span class="px-2 py-0.5 bg-cyan-500/10 text-cyan-400 rounded text-[10px] font-mono uppercase font-bold border border-cyan-500/20">98/100 ATS</span>
              </div>
              <h3 class="text-base font-bold text-white mb-1.5">ATS Resume Studio</h3>
              <p class="text-xs text-zinc-400 font-normal leading-relaxed">4 recruiter-tested templates, real-time live preview, and 1-click clean PDF export.</p>
              
              <div class="mt-4 p-3 bg-zinc-950 rounded-lg border border-zinc-800 text-[11px] font-mono space-y-1 text-zinc-400">
                <div class="text-cyan-400 font-bold">✓ ATS Headings Compliant</div>
                <div>✓ 1-Page Compact Layout</div>
                <div>✓ Zero Third-Party Branding</div>
              </div>
            </div>
            <div class="mt-5 pt-3 border-t border-zinc-800">
              <a href="<?= URL_RESUME ?>" class="w-full bg-cyan-500 hover:bg-cyan-400 text-black py-2 px-3 rounded-lg font-mono font-bold text-xs transition-colors flex items-center justify-center gap-1.5">
                Launch Resume Studio <span class="material-symbols-outlined text-[14px]">east</span>
              </a>
            </div>
          </article>

          <!-- Career & Internships 2026 -->
          <article class="product-card p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-violet-400 text-2xl">work</span>
                <span class="px-2 py-0.5 bg-violet-500/10 text-violet-400 rounded text-[10px] font-mono uppercase font-bold border border-violet-500/20">2026 Roles</span>
              </div>
              <h3 class="text-base font-bold text-white mb-1.5">Tech Internships</h3>
              <p class="text-xs text-zinc-400 font-normal leading-relaxed">Verified hiring listings in Software Engineering, Cybersecurity, AI/ML, and DevOps.</p>
            </div>
            <div class="mt-5 pt-3 border-t border-zinc-800">
              <a href="internships.php" class="text-xs font-mono text-violet-400 hover:underline flex items-center justify-between font-bold">
                Browse Hiring <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
              </a>
            </div>
          </article>

          <!-- 26+ Cyber Security & Dev Utilities (Span 3) -->
          <article class="product-card span-3 p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-emerald-400 text-2xl">terminal</span>
                  <h3 class="text-base font-bold text-white">Developer & Cyber Security Suite</h3>
                </div>
                <span class="text-xs font-mono text-emerald-400 bg-emerald-500/10 px-2.5 py-0.5 rounded border border-emerald-500/20">26 Client-Side Utilities</span>
              </div>
              <p class="text-xs text-zinc-400 font-normal mb-4 leading-relaxed">Shannon Password Entropy, YARA Malware Rule Scanner, Syslog SIEM Analyzer, 2FA TOTP Generator, AES-256 Encryptor, GPA Calculator, and REST API Tester.</p>
              
              <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                <a href="<?= URL_TOOLS ?>/23-gpa-sgpa-grade-calculator.php" class="p-2.5 rounded-lg bg-zinc-900/80 border border-zinc-800 hover:border-zinc-700 flex items-center gap-2 transition-colors">
                  <span class="material-symbols-outlined text-emerald-400 text-[18px]">calculate</span>
                  <span class="text-xs font-mono text-zinc-200 truncate">GPA Calc</span>
                </a>
                <a href="<?= URL_TOOLS ?>/24-code-beautifier-formatter.php" class="p-2.5 rounded-lg bg-zinc-900/80 border border-zinc-800 hover:border-zinc-700 flex items-center gap-2 transition-colors">
                  <span class="material-symbols-outlined text-cyan-400 text-[18px]">code</span>
                  <span class="text-xs font-mono text-zinc-200 truncate">Formatter</span>
                </a>
                <a href="<?= URL_TOOLS ?>/25-json-validator-linter.php" class="p-2.5 rounded-lg bg-zinc-900/80 border border-zinc-800 hover:border-zinc-700 flex items-center gap-2 transition-colors">
                  <span class="material-symbols-outlined text-indigo-400 text-[18px]">data_object</span>
                  <span class="text-xs font-mono text-zinc-200 truncate">JSON Linter</span>
                </a>
                <a href="<?= URL_TOOLS ?>/26-rest-api-tester.php" class="p-2.5 rounded-lg bg-zinc-900/80 border border-zinc-800 hover:border-zinc-700 flex items-center gap-2 transition-colors">
                  <span class="material-symbols-outlined text-emerald-400 text-[18px]">api</span>
                  <span class="text-xs font-mono text-zinc-200 truncate">API Tester</span>
                </a>
              </div>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center justify-between">
              <span class="text-xs font-mono text-zinc-500">Zero Network Requests</span>
              <a href="<?= URL_TOOLS ?>" class="text-xs font-mono text-emerald-400 hover:underline flex items-center gap-1 font-bold">
                Launch Suite <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
              </a>
            </div>
          </article>

          <!-- Image Suite Callout -->
          <article class="product-card p-5 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-amber-400 text-2xl">image</span>
                <span class="px-2 py-0.5 bg-amber-500/10 text-amber-400 rounded text-[10px] font-mono uppercase font-bold border border-amber-500/20">Target KB</span>
              </div>
              <h3 class="text-base font-bold text-white mb-1.5">Image Processing</h3>
              <p class="text-xs text-zinc-400 font-normal leading-relaxed">Compress JPG/PNG photos to exact KB requirements (<50KB, <100KB) and resize by pixels.</p>
            </div>
            <div class="mt-5 pt-3 border-t border-zinc-800">
              <a href="<?= URL_IMAGE ?>" class="text-xs font-mono text-amber-400 hover:underline flex items-center justify-between font-bold">
                Open Photo Suite <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
              </a>
            </div>
          </article>

        </div>
      </section>

      <!-- ── ECOSYSTEM DIRECTORY / SITELINKS NAVIGATION ─────────────────── -->
      <section id="sitelinks" class="relative z-10 w-full pb-14" aria-labelledby="sitelinks-heading">
        <div class="flex items-center justify-between mb-6 border-b border-zinc-800/80 pb-4">
          <div class="flex items-center gap-2.5">
            <div class="w-1.5 h-6 rounded bg-cyan-400"></div>
            <h2 id="sitelinks-heading" class="text-xl font-bold text-white tracking-tight">Platform Directory & Portals</h2>
          </div>
          <span class="text-xs font-mono text-zinc-500 uppercase tracking-wider hidden sm:block">8 Specialized Subdomains</span>
        </div>

        <nav aria-label="Ecosystem Directory" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          
          <a href="<?= URL_RESUME ?>" class="product-card p-5 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-cyan-400 text-2xl">description</span>
                <span class="text-[10px] font-mono uppercase text-cyan-400 bg-cyan-500/10 px-2 py-0.5 rounded border border-cyan-500/20">Studio</span>
              </div>
              <h3 class="text-sm font-bold text-white group-hover:text-cyan-400 transition-colors">ATS Resume Studio</h3>
              <p class="text-xs text-zinc-400 font-normal mt-1.5 leading-relaxed">Build 100% ATS-compliant resumes with real-time preview and instant PDF export.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center text-xs font-mono text-cyan-400 font-semibold">
              Open Studio <span class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_TOOLS ?>" class="product-card p-5 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-emerald-400 text-2xl">terminal</span>
                <span class="text-[10px] font-mono uppercase text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">26+ Tools</span>
              </div>
              <h3 class="text-sm font-bold text-white group-hover:text-emerald-400 transition-colors">Cyber Security Utilities</h3>
              <p class="text-xs text-zinc-400 font-normal mt-1.5 leading-relaxed">Client-side security tools, SIEM analyzers, firewalls, password entropy, and JSON formatters.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center text-xs font-mono text-emerald-400 font-semibold">
              Explore Suite <span class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_PROJECT ?>" class="product-card p-5 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-rose-400 text-2xl">shield_lock</span>
                <span class="text-[10px] font-mono uppercase text-rose-400 bg-rose-500/10 px-2 py-0.5 rounded border border-rose-500/20">25+ Labs</span>
              </div>
              <h3 class="text-sm font-bold text-white group-hover:text-rose-400 transition-colors">Cyber Security Projects</h3>
              <p class="text-xs text-zinc-400 font-normal mt-1.5 leading-relaxed">Hands-on open-source cybersecurity repositories, vulnerability scanners, and pentest labs.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center text-xs font-mono text-rose-400 font-semibold">
              View Projects <span class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_COURSES ?>" class="product-card p-5 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-violet-400 text-2xl">school</span>
                <span class="text-[10px] font-mono uppercase text-violet-400 bg-violet-500/10 px-2 py-0.5 rounded border border-violet-500/20">Free</span>
              </div>
              <h3 class="text-sm font-bold text-white group-hover:text-violet-400 transition-colors">Engineering Courses</h3>
              <p class="text-xs text-zinc-400 font-normal mt-1.5 leading-relaxed">Curated curriculum in DSA, Machine Learning, Operating Systems Kernel, and Web Dev.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center text-xs font-mono text-violet-400 font-semibold">
              Start Learning <span class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_RESOURCES ?>" class="product-card p-5 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-emerald-400 text-2xl">library_books</span>
                <span class="text-[10px] font-mono uppercase text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">Academic</span>
              </div>
              <h3 class="text-sm font-bold text-white group-hover:text-emerald-400 transition-colors">Study Notes & PYQs</h3>
              <p class="text-xs text-zinc-400 font-normal mt-1.5 leading-relaxed">Download semester lecture notes, previous year solved question papers, and lab manuals.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center text-xs font-mono text-emerald-400 font-semibold">
              Download Notes <span class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_IMAGE ?>" class="product-card p-5 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-amber-400 text-2xl">photo_size_select_large</span>
                <span class="text-[10px] font-mono uppercase text-amber-400 bg-amber-500/10 px-2 py-0.5 rounded border border-amber-500/20">Photo Suite</span>
              </div>
              <h3 class="text-sm font-bold text-white group-hover:text-amber-400 transition-colors">Image Editing Suite</h3>
              <p class="text-xs text-zinc-400 font-normal mt-1.5 leading-relaxed">Resize photos in KB, compress images without quality loss, transparent PNG remover, and meme maker.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center text-xs font-mono text-amber-400 font-semibold">
              Launch Suite <span class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_INTERNSHIPS ?>" class="product-card p-5 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-teal-400 text-2xl">work</span>
                <span class="text-[10px] font-mono uppercase text-teal-400 bg-teal-500/10 px-2 py-0.5 rounded border border-teal-500/20">2026 Hiring</span>
              </div>
              <h3 class="text-sm font-bold text-white group-hover:text-teal-400 transition-colors">Tech Internships 2026</h3>
              <p class="text-xs text-zinc-400 font-normal mt-1.5 leading-relaxed">Verified engineering internships in Software, Machine Learning, Cloud DevOps, and Frontend.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center text-xs font-mono text-teal-400 font-semibold">
              Apply to Roles <span class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_BLOG ?>" class="product-card p-5 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-indigo-400 text-2xl">article</span>
                <span class="text-[10px] font-mono uppercase text-indigo-400 bg-indigo-500/10 px-2 py-0.5 rounded border border-indigo-500/20">Articles</span>
              </div>
              <h3 class="text-sm font-bold text-white group-hover:text-indigo-400 transition-colors">Engineering Blog</h3>
              <p class="text-xs text-zinc-400 font-normal mt-1.5 leading-relaxed">Deep-dive technical tutorials, system design architectures, and career roadmaps.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-800 flex items-center text-xs font-mono text-indigo-400 font-semibold">
              Read Articles <span class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

        </nav>
      </section>

      <!-- ── CREATOR PROFILE SPOTLIGHT ───────────────────────── -->
      <section class="relative w-full py-2 mb-10" aria-labelledby="about-founder-heading">
        <div class="product-card p-6 md:p-8 rounded-2xl flex flex-col md:flex-row items-center gap-6 shadow-xl">
          <div class="w-20 h-20 md:w-22 md:h-22 rounded-2xl bg-zinc-900 border border-zinc-700 p-0.5 shrink-0 flex items-center justify-center">
            <div class="w-full h-full bg-zinc-950 rounded-[14px] flex items-center justify-center text-emerald-400 font-bold text-2xl font-mono">
              YP
            </div>
          </div>
          <div class="flex-1 text-center md:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[11px] font-mono uppercase tracking-wider mb-2">
              ● Creator & Lead Software Engineer
            </div>
            <h2 id="about-founder-heading" class="text-xl md:text-2xl font-bold text-white mb-2">
              Yaswant Pandey
            </h2>
            <p class="text-xs md:text-sm text-zinc-300 font-normal leading-relaxed mb-4 max-w-3xl">
              Software engineer and cybersecurity researcher. Architected the <strong>Yaswant Dev Ecosystem</strong> (<a href="https://yaswant.co.in" class="text-emerald-400 hover:underline">yaswant.co.in</a>) to provide developers and students with 100% free access to high-performance cyber tools, an ATS resume builder, image editing utilities, and semester study materials.
            </p>
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-2.5 text-xs font-mono">
              <a href="https://github.com/Yaswantpandey" target="_blank" rel="noopener"
                class="tech-pill flex items-center gap-1.5 hover:!border-emerald-400">
                <span class="material-symbols-outlined text-[15px] text-emerald-400">code</span> GitHub @Yaswantpandey
              </a>
              <a href="https://twitter.com/Yaswantpandey" target="_blank" rel="noopener"
                class="tech-pill flex items-center gap-1.5 hover:!border-cyan-400">
                <span class="material-symbols-outlined text-[15px] text-cyan-400">share</span> Twitter @Yaswantpandey
              </a>
              <a href="<?= URL_RESUME ?>"
                class="tech-pill flex items-center gap-1.5 hover:!border-indigo-400">
                <span class="material-symbols-outlined text-[15px] text-indigo-400">description</span> ATS Resume Studio
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- ── STATS STRIP ─────────────────────────────────── -->
      <section class="relative w-full py-2 mb-12" aria-labelledby="stats-heading">
        <h2 id="stats-heading" class="sr-only">Platform Statistics</h2>
        <div class="product-card rounded-2xl py-7 px-4 md:px-8">
          <div class="stats-row flex flex-wrap justify-around items-center gap-8 max-w-4xl mx-auto">
            <?php
            $stats = [
              ['val' => '15,000+', 'label' => 'Active Engineers', 'icon' => 'groups', 'color' => 'text-emerald-400'],
              ['val' => '5,000+', 'label' => 'Curated Materials', 'icon' => 'library_books', 'color' => 'text-cyan-400'],
              ['val' => '300+', 'label' => 'Tech Placements', 'icon' => 'business_center', 'color' => 'text-indigo-400'],
              ['val' => '26', 'label' => 'Cyber Dev Tools', 'icon' => 'build', 'color' => 'text-emerald-400'],
            ];
            foreach ($stats as $i => $s):
              ?>
              <?php if ($i > 0): ?>
                <div class="stats-divider w-px h-10 bg-zinc-800 hidden md:block" aria-hidden="true"></div>
              <?php endif; ?>
              <div class="flex flex-col items-center text-center group cursor-default">
                <div class="text-3xl md:text-4xl font-extrabold text-white leading-none mb-1.5 group-hover:<?= $s['color'] ?> transition-colors duration-200">
                  <?= $s['val'] ?>
                </div>
                <div class="text-[10px] text-zinc-400 uppercase tracking-widest font-mono flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[14px] <?= $s['color'] ?>" aria-hidden="true"><?= $s['icon'] ?></span>
                  <?= $s['label'] ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>