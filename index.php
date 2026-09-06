<?php require_once 'includes/layout.php';
require_once 'includes/data.php';

$recentResources = array_slice(get_resources(), 0, 2);
$recentJobs = array_slice(get_jobs(), 0, 2);

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
  /* ───── Homepage Black-Theme ───── */
  .home-page-wrap {
    background: #000;
    color: #fff;
  }

  /* Search */
  .search-wrap {
    position: relative;
  }

  .search-wrap::before {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: 1rem;
    background: linear-gradient(135deg, #10b981, #6366f1, #06b6d4);
    opacity: .22;
    filter: blur(10px);
    z-index: -1;
    transition: opacity .3s;
  }

  .search-wrap:focus-within::before {
    opacity: .55;
  }

  .search-inner {
    background: #111;
    border: 1px solid rgba(255, 255, 255, .1);
    border-radius: .875rem;
    transition: border-color .25s;
  }

  .search-inner:focus-within {
    border-color: rgba(16, 185, 129, .5);
  }

  /* Pill tags */
  .pill-tag {
    background: rgba(255, 255, 255, .05);
    border: 1px solid rgba(255, 255, 255, .1);
    color: #a1a1aa;
    border-radius: 9999px;
    padding: .3rem .85rem;
    font-size: .7rem;
    transition: background .2s, color .2s, border-color .2s;
    white-space: nowrap;
  }

  .pill-tag:hover {
    background: rgba(255, 255, 255, .1);
    color: #fff;
    border-color: rgba(255, 255, 255, .2);
  }

  /* Bento cards */
  .card-base {
    background: #0d0d0d;
    border-radius: 1rem;
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, .07);
    transition: border-color .25s, transform .25s, box-shadow .25s;
    position: relative;
    overflow: hidden;
  }

  .card-base:hover {
    border-color: rgba(255, 255, 255, .18);
    transform: translateY(-3px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, .7);
  }

  .card-green {
    border-color: rgba(16, 185, 129, .18);
  }

  .card-green:hover {
    border-color: rgba(16, 185, 129, .45);
    box-shadow: 0 20px 60px rgba(16, 185, 129, .1);
  }

  .card-blue {
    border-color: rgba(6, 182, 212, .18);
  }

  .card-blue:hover {
    border-color: rgba(6, 182, 212, .45);
    box-shadow: 0 20px 60px rgba(6, 182, 212, .08);
  }

  .card-indigo {
    border-color: rgba(99, 102, 241, .18);
  }

  .card-indigo:hover {
    border-color: rgba(99, 102, 241, .45);
    box-shadow: 0 20px 60px rgba(99, 102, 241, .08);
  }

  /* Inner row items */
  .inner-row {
    background: rgba(255, 255, 255, .04);
    border: 1px solid rgba(255, 255, 255, .06);
    border-radius: .6rem;
    transition: background .2s;
  }

  .inner-row:hover {
    background: rgba(255, 255, 255, .07);
  }

  /* Tool chips */
  .tool-chip {
    background: rgba(255, 255, 255, .04);
    border: 1px solid rgba(255, 255, 255, .07);
    border-radius: .6rem;
    transition: background .2s, border-color .2s;
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .625rem .75rem;
  }

  .tool-chip:hover {
    background: rgba(16, 185, 129, .09);
    border-color: rgba(16, 185, 129, .3);
  }

  /* Icon rings */
  .ring-green {
    background: rgba(16, 185, 129, .1);
    border: 1px solid rgba(16, 185, 129, .22);
  }

  .ring-blue {
    background: rgba(6, 182, 212, .1);
    border: 1px solid rgba(6, 182, 212, .22);
  }

  .ring-indigo {
    background: rgba(99, 102, 241, .1);
    border: 1px solid rgba(99, 102, 241, .22);
  }

  .ring-white {
    background: rgba(255, 255, 255, .06);
    border: 1px solid rgba(255, 255, 255, .1);
  }

  /* Stats strip */
  .stats-strip {
    background: #080808;
    border-top: 1px solid rgba(255, 255, 255, .07);
    border-bottom: 1px solid rgba(255, 255, 255, .07);
  }

  /* Gradient heading */
  @keyframes shimmer {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }

  .gradient-text {
    background: linear-gradient(135deg, #10b981, #06b6d4, #6366f1, #10b981);
    background-size: 300% 300%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shimmer 6s ease infinite;
    display: inline;
  }

  /* Pulse dot */
  @keyframes pulse-dot {

    0%,
    100% {
      opacity: 1;
      transform: scale(1);
    }

    50% {
      opacity: .5;
      transform: scale(1.4);
    }
  }

  .dot-live {
    animation: pulse-dot 2s ease-in-out infinite;
  }

  /* Grid background */
  .grid-bg {
    background-image:
      linear-gradient(rgba(255, 255, 255, .02) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255, 255, 255, .02) 1px, transparent 1px);
    background-size: 56px 56px;
  }

  .no-scrollbar::-webkit-scrollbar {
    display: none;
  }
  .no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  /* ───── Mobile-first font sizes ───── */
  .hero-h1 {
    font-size: clamp(1.85rem, 7.5vw, 4.75rem);
    font-weight: 900;
    line-height: 1.08;
    letter-spacing: -.03em;
  }

  .hero-sub {
    font-size: clamp(.85rem, 2.4vw, 1.125rem);
    line-height: 1.65;
  }

  /* Mobile bento: full-width cards, no side-by-side */
  @media(max-width:767px) {
    .bento-grid {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .card-base {
      padding: 1.125rem;
    }

    .card-base:active {
      transform: scale(0.99);
    }

    .stats-row {
      flex-direction: column;
      gap: 1.75rem;
    }

    .stats-divider {
      display: none;
    }

    .pill-tags-wrap {
      gap: .5rem;
    }

    .tool-grid {
      grid-template-columns: 1fr 1fr;
      gap: .625rem;
    }
  }

  /* Tablet / md */
  @media(min-width:768px) and (max-width:1023px) {
    .bento-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.125rem;
    }

    .span-2 {
      grid-column: span 2;
    }

    .tool-grid {
      grid-template-columns: repeat(4, 1fr);
    }
  }

  /* Desktop / lg */
  @media(min-width:1024px) {
    .bento-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.25rem;
    }

    .span-2 {
      grid-column: span 2;
    }

    .span-3 {
      grid-column: span 3;
    }

    .tool-grid {
      grid-template-columns: repeat(4, 1fr);
    }
  }
</style>

<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen home-page-wrap">
  <?php nexus_sidebar('home');
  nexus_topbar('home'); ?>

  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col w-full relative grid-bg">

      <!-- Ambient glow orbs -->
      <div class="absolute inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div
          class="absolute -top-24 right-0 w-72 h-72 md:w-[500px] md:h-[500px] rounded-full blur-[100px] md:blur-[140px]"
          style="background:radial-gradient(circle,rgba(16,185,129,.18) 0%,transparent 70%)"></div>
        <div
          class="absolute top-1/2 -left-20 w-60 h-60 md:w-[420px] md:h-[420px] rounded-full blur-[90px] md:blur-[120px]"
          style="background:radial-gradient(circle,rgba(99,102,241,.14) 0%,transparent 70%)"></div>
        <div
          class="absolute bottom-0 right-1/3 w-52 h-52 md:w-[360px] md:h-[360px] rounded-full blur-[80px] md:blur-[100px]"
          style="background:radial-gradient(circle,rgba(6,182,212,.1) 0%,transparent 70%)"></div>
      </div>

      <!-- ── Hero ──────────────────────────────────────────── -->
      <section class="relative z-10 flex flex-col items-center text-center px-2 pt-12 pb-16 md:pt-20 md:pb-24"
        aria-labelledby="hero-heading">

        <!-- Live badge -->
        <div
          class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-6 md:mb-8 text-[10px] sm:text-[11px] font-mono uppercase tracking-widest text-zinc-400"
          style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1)">
          <span class="w-2 h-2 rounded-full bg-emerald-400 dot-live" aria-hidden="true"></span>
          Yaswant Dev OS v2.5 &nbsp;&bull;&nbsp; All Systems Operational
        </div>

        <!-- Headline -->
        <h1 id="hero-heading" class="hero-h1 text-white max-w-[22ch] md:max-w-4xl mx-auto mb-4 md:mb-6">
          The Ultimate Ecosystem for
          <span class="gradient-text block mt-1"> Modern Engineers</span>
        </h1>

        <!-- Sub-text -->
        <p class="hero-sub text-zinc-400 max-w-xl mx-auto mb-6 md:mb-8 font-light px-2">
          Master your coursework, build ATS-winning resumes, practice developer tools, and land top-tier tech
          internships — all in one seamless workspace.
        </p>

        <!-- Search -->
        <div class="search-wrap w-full max-w-xl mx-auto mb-5 md:mb-7">
          <form method="GET" action="search.php" class="search-inner flex items-center p-1.5 shadow-2xl" role="search"
            aria-label="Search Yaswant Dev">
            <span class="material-symbols-outlined text-zinc-500 ml-2.5 text-[20px] shrink-0"
              aria-hidden="true">search</span>
            <label for="hero-search" class="sr-only">Search notes, courses, internships, tools</label>
            <input id="hero-search" name="q"
              class="flex-1 bg-transparent text-white text-xs sm:text-sm placeholder:text-zinc-600 border-none focus:outline-none px-2.5 py-2.5 font-light min-w-0"
              placeholder="Search notes, courses, tools..." />
            <button type="submit"
              class="bg-emerald-500 hover:bg-emerald-400 text-black font-bold px-3.5 sm:px-4 py-2 rounded-xl transition-all text-xs md:text-sm flex items-center gap-1.5 shrink-0 whitespace-nowrap active:scale-95">
              Search <span class="material-symbols-outlined text-[15px]" aria-hidden="true">arrow_forward</span>
            </button>
          </form>
        </div>

        <!-- Trending pills -->
        <div class="pill-tags-wrap flex items-center justify-start sm:justify-center overflow-x-auto max-w-full no-scrollbar gap-2 mb-8 md:mb-10 px-2 pb-1.5">
          <span class="text-[10px] font-mono uppercase tracking-widest text-zinc-600 shrink-0">Trending:</span>
          <a href="search.php?q=Data+Structures" class="pill-tag shrink-0 active:scale-95">#DataStructures</a>
          <a href="search.php?q=Operating+Systems" class="pill-tag shrink-0 active:scale-95">#OperatingSystems</a>
          <a href="search.php?q=Web+Dev" class="pill-tag shrink-0 active:scale-95">#WebDev</a>
          <a href="resume.php" class="pill-tag shrink-0 active:scale-95">#ATSResume</a>
          <a href="<?= URL_TOOLS ?>" class="pill-tag shrink-0 active:scale-95">#CyberTools</a>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 w-full max-w-sm sm:max-w-none mx-auto">
          <a href="<?= URL_COURSES ?>"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white text-black font-bold px-6 py-3.5 md:px-8 md:py-4 rounded-2xl text-sm hover:bg-zinc-100 transition-all shadow-[0_0_40px_rgba(255,255,255,.1)] hover:shadow-[0_0_60px_rgba(255,255,255,.18)] transform hover:-translate-y-1 active:scale-95">
            Explore Courses <span class="material-symbols-outlined text-[18px]" aria-hidden="true">rocket_launch</span>
          </a>
          <a href="<?= URL_RESUME ?>"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/20 hover:border-white/40 text-white px-6 py-3.5 md:px-8 md:py-4 rounded-2xl text-sm font-medium transition-all hover:bg-white/5 transform hover:-translate-y-1 active:scale-95">
            Build ATS Resume <span class="material-symbols-outlined text-[18px]" aria-hidden="true">description</span>
          </a>
        </div>

      </section>

      <!-- ── Bento Grid ─────────────────────────────────── -->
      <section class="relative z-10 w-full pb-16 px-0" aria-labelledby="capabilities-heading">

        <div class="flex items-center gap-3 mb-6 md:mb-8 border-b border-white/[0.06] pb-5">
          <div class="w-1 h-6 rounded-full bg-emerald-400 shrink-0"></div>
          <h2 id="capabilities-heading" class="text-xl md:text-2xl font-bold text-white">Ecosystem Core</h2>
          <p class="text-zinc-600 text-xs font-light hidden md:block ml-1">— High-yield tools to boost academic and
            career performance.</p>
        </div>

        <div class="bento-grid">

          <!-- Academic Resource Vault -->
          <article class="card-base card-green span-2 flex flex-col justify-between">
            <div class="absolute top-0 right-0 w-48 h-48 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"
              style="background:radial-gradient(circle,rgba(16,185,129,.07) 0%,transparent 70%)" aria-hidden="true">
            </div>
            <div class="relative z-10 mb-5">
              <div class="w-11 h-11 rounded-xl ring-green flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-emerald-400 text-[24px]" aria-hidden="true">school</span>
              </div>
              <h3 class="text-lg font-bold text-white mb-1.5">Academic Resource Vault</h3>
              <p class="text-sm text-zinc-400 font-light">Access verified lecture notes, semester PYQs, lab manuals, and
                syllabus roadmaps.</p>
            </div>
            <div class="relative z-10 space-y-2">
              <div
                class="flex items-center justify-between text-[11px] font-mono text-zinc-600 mb-2 uppercase tracking-widest">
                <span>Featured Modules</span>
                <a href="resources.php"
                  class="text-emerald-400 hover:text-emerald-300 flex items-center gap-1 transition-colors">View All
                  <span class="material-symbols-outlined text-[13px]">arrow_forward</span></a>
              </div>
              <?php foreach ($recentResources as $res): ?>
                <a href="resources.php" class="inner-row flex items-center justify-between p-2.5">
                  <div class="flex items-center gap-2 min-w-0">
                    <span class="material-symbols-outlined text-emerald-400 text-[17px] shrink-0">description</span>
                    <span class="text-xs text-white truncate font-light"><?= htmlspecialchars($res['title']) ?></span>
                  </div>
                  <span
                    class="text-[10px] font-mono text-zinc-600 uppercase ml-2 shrink-0"><?= htmlspecialchars($res['type'] ?? 'PDF') ?></span>
                </a>
              <?php endforeach; ?>
            </div>
          </article>

          <a href="https://trafficpeak.io">Boost Your Website Traffic with TrafficPeak</a>
          <!-- ATS Resume Studio -->
          <article class="card-base card-blue flex flex-col justify-between">
            <div class="absolute -right-4 -bottom-4 opacity-[0.05]" aria-hidden="true">
              <span class="material-symbols-outlined text-[110px] text-cyan-400">description</span>
            </div>
            <div class="relative z-10">
              <div class="w-11 h-11 rounded-xl ring-blue flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-cyan-400 text-[24px]"
                  aria-hidden="true">auto_fix_high</span>
              </div>
              <h3 class="text-lg font-bold text-white mb-1.5">ATS Resume Studio</h3>
              <p class="text-sm text-zinc-400 font-light">Real-time live preview, AI bullet enhancer, and 1-click PDF
                export.</p>
            </div>
            <div class="relative z-10 mt-5 pt-4 border-t border-white/[0.06]">
              <a href="<?= URL_RESUME ?>"
                class="w-full bg-cyan-500 hover:bg-cyan-400 text-black py-2.5 px-4 rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-2 shadow-md">
                Build Resume <span class="material-symbols-outlined text-[15px]">east</span>
              </a>
            </div>
          </article>

          <!-- Engineering AI Tutor -->
          <article class="card-base card-indigo flex flex-col justify-between">
            <div class="relative z-10">
              <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl ring-indigo flex items-center justify-center">
                  <span class="material-symbols-outlined text-indigo-400 text-[24px]" aria-hidden="true">robot_2</span>
                </div>
                <span
                  class="px-2 py-1 bg-indigo-500/10 text-indigo-400 rounded-lg text-[10px] font-mono uppercase tracking-wider border border-indigo-500/20">AI
                  Tutor</span>
              </div>
              <h3 class="text-lg font-bold text-white mb-1.5">Engineering AI Assistant</h3>
              <p class="text-sm text-zinc-400 font-light">Instant code debugging, concept explanations, and system
                design reviews.</p>
            </div>
            <div class="relative z-10 mt-4">
              <div class="inner-row px-3 py-2.5 flex items-center gap-2 text-[11px] text-indigo-400 font-mono">
                <span class="w-2 h-2 rounded-full bg-indigo-400 dot-live shrink-0"></span>
                Ready to debug code logs…
              </div>
            </div>
          </article>

          <!-- Career & Internships -->
          <article class="card-base flex flex-col justify-between">
            <div class="relative z-10">
              <div class="w-11 h-11 rounded-xl ring-white flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-white text-[24px]" aria-hidden="true">work</span>
              </div>
              <h3 class="text-lg font-bold text-white mb-1.5">Career & Internships</h3>
              <p class="text-sm text-zinc-400 font-light">Verified Software, ML, and DevOps internship opportunities.
              </p>
            </div>
            <div class="relative z-10 mt-5 pt-4 border-t border-white/[0.06]">
              <a href="internships.php"
                class="text-emerald-400 hover:text-emerald-300 font-mono text-xs flex items-center justify-between transition-colors">
                Browse Listings <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
              </a>
            </div>
          </article>

          <!-- Developer Utilities (3-col) -->
          <article class="card-base card-green span-3 flex flex-col justify-between">
            <div class="absolute top-0 right-0 w-64 h-64 rounded-full blur-[90px] -translate-y-1/2 translate-x-1/4"
              style="background:radial-gradient(circle,rgba(16,185,129,.06) 0%,transparent 70%)" aria-hidden="true">
            </div>
            <div class="relative z-10">
              <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl ring-green flex items-center justify-center">
                  <span class="material-symbols-outlined text-emerald-400 text-[24px]" aria-hidden="true">build</span>
                </div>
                <div class="flex items-center gap-2 text-[11px] font-mono text-zinc-600">
                  <span class="w-2 h-2 rounded-full bg-emerald-400 dot-live"></span>
                  26 Browser-Native Tools
                </div>
              </div>
              <h3 class="text-lg md:text-xl font-bold text-white mb-1.5">Developer & Cyber Security Utilities</h3>
              <p class="text-sm text-zinc-400 font-light mb-5">GPA Calculator, Code Formatter, JSON Validator, AES
                Encryptor, JWT Inspector, Base64 Encoder, and REST API Tester.</p>
              <div class="tool-grid grid">
                <a href="<?= URL_TOOLS ?>/23-gpa-sgpa-grade-calculator.php" class="tool-chip">
                  <span class="material-symbols-outlined text-emerald-400 text-[17px]">calculate</span>
                  <span class="text-xs text-white font-light">GPA Calculator</span>
                </a>
                <a href="<?= URL_TOOLS ?>/24-code-beautifier-formatter.php" class="tool-chip">
                  <span class="material-symbols-outlined text-cyan-400 text-[17px]">code</span>
                  <span class="text-xs text-white font-light">Code Formatter</span>
                </a>
                <a href="<?= URL_TOOLS ?>/25-json-validator-linter.php" class="tool-chip">
                  <span class="material-symbols-outlined text-indigo-400 text-[17px]">data_object</span>
                  <span class="text-xs text-white font-light">JSON Validator</span>
                </a>
                <a href="<?= URL_TOOLS ?>/26-rest-api-tester.php" class="tool-chip">
                  <span class="material-symbols-outlined text-emerald-400 text-[17px]">api</span>
                  <span class="text-xs text-white font-light">API Tester</span>
                </a>
              </div>
            </div>
          </article>
        </div>
      </section>

      <!-- ── Google Sitelinks Navigation Hub ─────────────────────────────────── -->
      <section id="sitelinks" class="relative z-10 w-full pb-12" aria-labelledby="sitelinks-heading">
        <div class="flex items-center justify-between mb-6 border-b border-white/[0.06] pb-4">
          <div class="flex items-center gap-3">
            <div class="w-1 h-6 rounded-full bg-cyan-400 shrink-0"></div>
            <h2 id="sitelinks-heading" class="text-xl md:text-2xl font-bold text-white">Platform Directory & Navigation
            </h2>
          </div>
          <span class="text-xs font-mono text-zinc-500 uppercase tracking-wider hidden sm:block">8 Core
            Ecosystems</span>
        </div>

        <nav aria-label="Ecosystem Directory" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <a href="<?= URL_RESUME ?>"
            class="card-base bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800/80 hover:border-cyan-500/40 p-5 rounded-2xl transition-all duration-300 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-cyan-400 text-2xl">description</span>
                <span
                  class="text-[10px] font-mono uppercase text-cyan-400 bg-cyan-500/10 px-2 py-0.5 rounded border border-cyan-500/20">Studio</span>
              </div>
              <h3 class="text-base font-bold text-white group-hover:text-cyan-400 transition-colors">ATS Resume Studio
              </h3>
              <p class="text-xs text-zinc-400 font-light mt-1.5 leading-relaxed">Build 100% ATS-compliant engineering
                resumes with live preview and instant PDF export.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center text-xs font-mono text-cyan-400">
              Open Studio <span
                class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_TOOLS ?>"
            class="card-base bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-5 rounded-2xl transition-all duration-300 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-emerald-400 text-2xl">terminal</span>
                <span
                  class="text-[10px] font-mono uppercase text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">26+
                  Tools</span>
              </div>
              <h3 class="text-base font-bold text-white group-hover:text-emerald-400 transition-colors">Developer &
                Cyber Tools</h3>
              <p class="text-xs text-zinc-400 font-light mt-1.5 leading-relaxed">Client-side security tools, SIEM
                analyzers, firewalls, password entropy, and JSON formatters.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center text-xs font-mono text-emerald-400">
              Explore Tools <span
                class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_PROJECT ?>"
            class="card-base bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-5 rounded-2xl transition-all duration-300 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-emerald-400 text-2xl">shield_lock</span>
                <span
                  class="text-[10px] font-mono uppercase text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">25+
                  Labs</span>
              </div>
              <h3 class="text-base font-bold text-white group-hover:text-emerald-400 transition-colors">Cyber Security
                Projects</h3>
              <p class="text-xs text-zinc-400 font-light mt-1.5 leading-relaxed">Hands-on open-source cybersecurity
                repositories, vulnerability scanners, and pentest labs.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center text-xs font-mono text-emerald-400">
              View Projects <span
                class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_COURSES ?>"
            class="card-base bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800/80 hover:border-indigo-500/40 p-5 rounded-2xl transition-all duration-300 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-indigo-400 text-2xl">school</span>
                <span
                  class="text-[10px] font-mono uppercase text-indigo-400 bg-indigo-500/10 px-2 py-0.5 rounded border border-indigo-500/20">Free</span>
              </div>
              <h3 class="text-base font-bold text-white group-hover:text-indigo-400 transition-colors">Free Engineering
                Courses</h3>
              <p class="text-xs text-zinc-400 font-light mt-1.5 leading-relaxed">Curated curriculum in DSA, Machine
                Learning, Operating Systems Kernel, and Web Dev.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center text-xs font-mono text-indigo-400">
              Start Learning <span
                class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_RESOURCES ?>"
            class="card-base bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-5 rounded-2xl transition-all duration-300 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-emerald-400 text-2xl">library_books</span>
                <span
                  class="text-[10px] font-mono uppercase text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">Academic</span>
              </div>
              <h3 class="text-base font-bold text-white group-hover:text-emerald-400 transition-colors">Study Notes &
                Solved PYQs</h3>
              <p class="text-xs text-zinc-400 font-light mt-1.5 leading-relaxed">Download semester lecture notes,
                previous year solved question papers, and lab manuals.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center text-xs font-mono text-emerald-400">
              Download Notes <span
                class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_IMAGE ?>"
            class="card-base bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800/80 hover:border-cyan-500/40 p-5 rounded-2xl transition-all duration-300 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-cyan-400 text-2xl">photo_size_select_large</span>
                <span
                  class="text-[10px] font-mono uppercase text-cyan-400 bg-cyan-500/10 px-2 py-0.5 rounded border border-cyan-500/20">Photo
                  Suite</span>
              </div>
              <h3 class="text-base font-bold text-white group-hover:text-cyan-400 transition-colors">Image Editing Suite
              </h3>
              <p class="text-xs text-zinc-400 font-light mt-1.5 leading-relaxed">Resize photos in KB, compress images
                without quality loss, transparent PNG remover, and meme maker.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center text-xs font-mono text-cyan-400">
              Launch Suite <span
                class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_INTERNSHIPS ?>"
            class="card-base bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-5 rounded-2xl transition-all duration-300 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-emerald-400 text-2xl">work</span>
                <span
                  class="text-[10px] font-mono uppercase text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">2026
                  Hiring</span>
              </div>
              <h3 class="text-base font-bold text-white group-hover:text-emerald-400 transition-colors">Tech Internships
                2026</h3>
              <p class="text-xs text-zinc-400 font-light mt-1.5 leading-relaxed">Verified engineering internships in
                Software, Machine Learning, Cloud DevOps, and Frontend.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center text-xs font-mono text-emerald-400">
              Apply to Roles <span
                class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>

          <a href="<?= URL_BLOG ?>"
            class="card-base bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800/80 hover:border-indigo-500/40 p-5 rounded-2xl transition-all duration-300 group flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="material-symbols-outlined text-indigo-400 text-2xl">article</span>
                <span
                  class="text-[10px] font-mono uppercase text-indigo-400 bg-indigo-500/10 px-2 py-0.5 rounded border border-indigo-500/20">Articles</span>
              </div>
              <h3 class="text-base font-bold text-white group-hover:text-indigo-400 transition-colors">Engineering Blog
              </h3>
              <p class="text-xs text-zinc-400 font-light mt-1.5 leading-relaxed">Deep-dive technical tutorials, system
                design architectures, and career roadmaps.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center text-xs font-mono text-indigo-400">
              Read Articles <span
                class="material-symbols-outlined text-[14px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </div>
          </a>
        </nav>
      </section>

      <!-- ── About Yaswant Pandey (Founder & Lead Architect) ───────────────── -->
      <section class="relative w-full py-6 mb-8" aria-labelledby="about-founder-heading">
        <div
          class="card-base border border-emerald-500/20 bg-gradient-to-r from-zinc-950 via-zinc-900 to-zinc-950 p-6 md:p-8 rounded-2xl flex flex-col md:flex-row items-center gap-6 shadow-2xl">
          <div
            class="w-20 h-20 md:w-24 md:h-24 rounded-2xl bg-gradient-to-tr from-emerald-500 via-cyan-500 to-indigo-500 p-0.5 shadow-xl shrink-0 flex items-center justify-center">
            <div
              class="w-full h-full bg-zinc-950 rounded-[14px] flex items-center justify-center text-emerald-400 font-bold text-3xl font-mono">
              YP
            </div>
          </div>
          <div class="flex-1 text-center md:text-left">
            <div
              class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[11px] font-mono uppercase tracking-widest mb-2">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Creator & Software Engineer
            </div>
            <h2 id="about-founder-heading" class="text-xl md:text-2xl font-black text-white mb-2">
              About <span class="gradient-text">Yaswant Pandey</span>
            </h2>
            <p class="text-xs md:text-sm text-zinc-300 font-light leading-relaxed mb-4 max-w-3xl">
              Yaswant Pandey is a software engineer, full-stack developer, and cybersecurity researcher. He architected
              the <strong>Yaswant Dev Ecosystem</strong> (<a href="https://yaswant.co.in"
                class="text-emerald-400 hover:underline">yaswant.co.in</a>) to provide engineering students and
              developers with free access to high-performance cyber tools, an interactive ATS resume builder, an online
              image editing suite, curated semester notes, and tech internships.
            </p>
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 text-xs font-mono">
              <a href="https://github.com/Yaswantpandey" target="_blank" rel="noopener"
                class="pill-tag flex items-center gap-1.5 !text-white hover:!border-emerald-400">
                <span class="material-symbols-outlined text-[15px] text-emerald-400">code</span> GitHub @Yaswantpandey
              </a>
              <a href="https://twitter.com/Yaswantpandey" target="_blank" rel="noopener"
                class="pill-tag flex items-center gap-1.5 !text-white hover:!border-cyan-400">
                <span class="material-symbols-outlined text-[15px] text-cyan-400">share</span> Twitter @Yaswantpandey
              </a>
              <a href="<?= URL_RESUME ?>"
                class="pill-tag flex items-center gap-1.5 !text-white hover:!border-indigo-400">
                <span class="material-symbols-outlined text-[15px] text-indigo-400">description</span> View Portfolio /
                ATS Studio
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- ── Stats Strip ─────────────────────────────────── -->
      <section class="relative w-full py-4 mb-12" aria-labelledby="stats-heading">
        <h2 id="stats-heading" class="sr-only">Platform Statistics</h2>
        <div class="stats-strip rounded-2xl py-10 px-4 md:px-8">
          <div class="stats-row flex flex-wrap justify-around items-center gap-8 max-w-3xl mx-auto">
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
                <div class="stats-divider w-px h-10 bg-white/[0.07] hidden md:block" aria-hidden="true"></div>
              <?php endif; ?>
              <div class="flex flex-col items-center text-center group cursor-default">
                <div
                  class="text-4xl md:text-5xl font-black text-white leading-none mb-2 group-hover:<?= $s['color'] ?> transition-colors duration-300">
                  <?= $s['val'] ?>
                </div>
                <div class="text-[10px] text-zinc-600 uppercase tracking-widest font-mono flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[14px] <?= $s['color'] ?>"
                    aria-hidden="true"><?= $s['icon'] ?></span><?= $s['label'] ?>
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