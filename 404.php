<?php
// 404.php — Custom 404 Error Page for Yaswant Dev Ecosystem
http_response_code(404);

require_once __DIR__ . '/includes/layout.php';

nexus_head(
  '404 — Page Not Found | Yaswant Dev Ecosystem',
  'The requested page or resource could not be found on Yaswant Dev. Explore our 26+ cyber tools, ATS resume studio, study resources, and courses.',
  '404 page not found, yaswant dev, error 404, page missing',
  URL_HOME . '/404.php',
  ['type' => 'website', 'title' => '404 — Page Not Found | Yaswant Dev Ecosystem']
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('');
  nexus_topbar(''); ?>
  <main id="main-content" role="main"
    class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg flex items-center justify-center">
    <div class="w-full max-w-2xl text-center space-y-8 py-12">

      <!-- Glitch / Terminal 404 Header -->
      <div class="relative inline-block">
        <div class="absolute -inset-4 bg-emerald-500/10 rounded-full blur-3xl" aria-hidden="true"></div>
        <div class="relative z-10 space-y-2">
          <div
            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/10 border border-rose-500/30 text-rose-400 font-mono text-xs uppercase tracking-widest">
            <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span> HTTP 404 ERROR
          </div>
          <h1
            class="text-7xl md:text-9xl font-black font-mono text-transparent bg-clip-text bg-gradient-to-b from-white via-zinc-200 to-zinc-600 tracking-tighter">
            404
          </h1>
          <p class="text-lg md:text-xl font-bold text-zinc-200">I have lost my connection</p>
        </div>
      </div>

      <!-- Description -->
      <p class="text-sm md:text-base text-zinc-400 font-light max-w-lg mx-auto leading-relaxed">
        The page you are looking for might have been removed, renamed, or is temporarily unavailable. Double-check the
        URL or explore our ecosystem below.
      </p>

      <!-- Live Search Bar -->
      <form method="GET" action="<?= URL_SEARCH ?>"
        class="max-w-md mx-auto relative flex items-center bg-zinc-900 border border-zinc-800 focus-within:border-emerald-500/60 rounded-2xl p-1.5 transition-all shadow-xl">
        <span class="material-symbols-outlined text-zinc-500 text-[20px] pl-3" aria-hidden="true">search</span>
        <input name="q" placeholder="Search tools, notes, courses, internships…" required
          class="bg-transparent text-white text-xs outline-none w-full px-3 py-2 placeholder:text-zinc-500 font-mono">
        <button type="submit"
          class="bg-emerald-500 hover:bg-emerald-400 text-black font-bold font-mono px-4 py-2 rounded-xl text-xs transition-colors shrink-0 flex items-center gap-1">
          Search <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
        </button>
      </form>

      <!-- Quick Section Links -->
      <div class="pt-4 border-t border-zinc-900">
        <p class="text-xs font-mono text-zinc-500 uppercase tracking-widest mb-4">Popular Ecosystem Destinations</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-left">
          <a href="<?= URL_HOME ?>"
            class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-3 rounded-xl transition-all group">
            <span class="material-symbols-outlined text-emerald-400 text-lg block mb-1">home</span>
            <span
              class="text-xs font-bold text-white group-hover:text-emerald-400 transition-colors block">Homepage</span>
            <span class="text-[10px] text-zinc-500 font-mono">Main Portal</span>
          </a>

          <a href="<?= URL_RESUME ?>"
            class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-cyan-500/40 p-3 rounded-xl transition-all group">
            <span class="material-symbols-outlined text-cyan-400 text-lg block mb-1">description</span>
            <span class="text-xs font-bold text-white group-hover:text-cyan-400 transition-colors block">Resume
              Studio</span>
            <span class="text-[10px] text-zinc-500 font-mono">ATS Builder</span>
          </a>

          <a href="<?= URL_TOOLS ?>"
            class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-3 rounded-xl transition-all group">
            <span class="material-symbols-outlined text-emerald-400 text-lg block mb-1">build</span>
            <span class="text-xs font-bold text-white group-hover:text-emerald-400 transition-colors block">Cyber
              Tools</span>
            <span class="text-[10px] text-zinc-500 font-mono">26+ Utilities</span>
          </a>

          <a href="<?= URL_PROJECT ?>"
            class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-3 rounded-xl transition-all group">
            <span class="material-symbols-outlined text-emerald-400 text-lg block mb-1">folder_special</span>
            <span class="text-xs font-bold text-white group-hover:text-emerald-400 transition-colors block">Projects
              Hub</span>
            <span class="text-[10px] text-zinc-500 font-mono">25+ Repos</span>
          </a>

          <a href="<?= URL_COURSES ?>"
            class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-indigo-500/40 p-3 rounded-xl transition-all group">
            <span class="material-symbols-outlined text-indigo-400 text-lg block mb-1">school</span>
            <span
              class="text-xs font-bold text-white group-hover:text-indigo-400 transition-colors block">Courses</span>
            <span class="text-[10px] text-zinc-500 font-mono">Free Curriculum</span>
          </a>

          <a href="<?= URL_RESOURCES ?>"
            class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-3 rounded-xl transition-all group">
            <span class="material-symbols-outlined text-emerald-400 text-lg block mb-1">folder_open</span>
            <span class="text-xs font-bold text-white group-hover:text-emerald-400 transition-colors block">Study
              Notes</span>
            <span class="text-[10px] text-zinc-500 font-mono">PYQs & Guides</span>
          </a>

          <a href="<?= URL_INTERNSHIPS ?>"
            class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-emerald-500/40 p-3 rounded-xl transition-all group">
            <span class="material-symbols-outlined text-emerald-400 text-lg block mb-1">work</span>
            <span
              class="text-xs font-bold text-white group-hover:text-emerald-400 transition-colors block">Internships</span>
            <span class="text-[10px] text-zinc-500 font-mono">2026 Roles</span>
          </a>

          <a href="<?= URL_IMAGE ?>"
            class="bg-zinc-900/60 hover:bg-zinc-900 border border-zinc-800/80 hover:border-cyan-500/40 p-3 rounded-xl transition-all group">
            <span class="material-symbols-outlined text-cyan-400 text-lg block mb-1">photo_size_select_large</span>
            <span
              class="text-[10px] font-mono text-white group-hover:text-cyan-400 transition-colors font-bold block">Image
              Suite</span>
            <span class="text-[10px] text-zinc-500 font-mono">Resize & Crop</span>
          </a>
        </div>
      </div>

      <!-- Action Button -->
      <div class="pt-2">
        <a href="<?= URL_HOME ?>"
          class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-black font-bold font-mono px-6 py-3 rounded-xl text-xs transition-all shadow-lg hover:shadow-emerald-500/20">
          <span class="material-symbols-outlined text-[18px]">home</span> Return to Home Page
        </a>
      </div>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>