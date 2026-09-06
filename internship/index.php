<?php require_once __DIR__ . '/../includes/layout.php';
require_once __DIR__ . '/../includes/data.php';

// Fetch jobs first so schema_internships() includes real JobPosting data
$jobs = get_jobs();

// CollectionPage + JobPosting schema — uses URL_INTERNSHIPS canonical
$schema = schema_internships($jobs);

nexus_head(
  'Tech Internships 2026 — Software, ML, DevOps & Frontend Openings by Yaswant Dev',
  'Browse verified 2026 engineering internships in Software Engineering, Machine Learning, Cloud DevOps, Frontend, and Embedded Systems. Apply directly with ATS resume tips.',
  'engineering internships 2026, software engineering intern, ML research intern, DevOps intern, frontend developer intern, paid tech internships, remote internships for students, computer science internships, internships by Yaswant Pandey, Yaswant Dev internships',
  URL_INTERNSHIPS,
  ['type' => 'website', 'title' => 'Tech Internships 2026 — Yaswant Dev'],
  $schema
);

$search = trim($_GET['q'] ?? '');
if ($search) {
  $jobs = array_filter($jobs, function($j) use ($search) {
    $tags = is_array($j['tags']) ? $j['tags'] : [];
    return stripos($j['title'], $search) !== false ||
           stripos($j['company'], $search) !== false ||
           array_filter($tags, fn($t) => stripos($t, $search) !== false);
  });
}
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('internships'); nexus_topbar('internships'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-xl">

      <!-- ── Breadcrumbs ─────────────────────────────────────────── -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
        <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
        <span class="text-zinc-600">/</span>
        <span class="text-zinc-300">Tech Internships 2026</span>
      </nav>

      <!-- ── Header Banner ───────────────────────────────────────── -->
      <div class="bg-gradient-to-r from-zinc-950 via-zinc-900 to-zinc-950 rounded-2xl p-6 md:p-8 border border-zinc-800 shadow-xl relative overflow-hidden">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
          <div class="space-y-2 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Verified 2026 Hiring Cycles
            </div>
            <h1 class="text-2xl md:text-4xl font-black text-white tracking-tight">
              Software & Tech <span class="gradient-text">Internship Board</span>
            </h1>
            <p class="text-xs md:text-sm text-zinc-300 font-light leading-relaxed">
              Curated engineering internships with verified compensation, remote/hybrid flexibility, and direct hiring portals. Tailored for undergraduate engineers.
            </p>
          </div>
          
          <div class="flex items-center gap-3 shrink-0">
            <a href="<?= URL_RESUME ?>" class="bg-emerald-500 hover:bg-emerald-400 text-black px-4 py-2.5 rounded-xl font-mono text-xs font-bold transition-all shadow-md flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[16px]">description</span> Build ATS Resume
            </a>
          </div>
        </div>
      </div>

      <!-- ── Search & Filter ─────────────────────────────────────── -->
      <form method="GET" class="bg-zinc-950 border border-zinc-800 rounded-2xl p-4 shadow-lg flex flex-col md:flex-row items-center gap-3" role="search" aria-label="Search internships">
        <div class="flex-1 w-full bg-black border border-zinc-800 rounded-xl flex items-center px-4 py-2.5 focus-within:border-emerald-500 transition-colors">
          <span class="material-symbols-outlined text-zinc-500 mr-2 text-[20px]">search</span>
          <label for="search-input" class="sr-only">Search roles, companies, keywords</label>
          <input id="search-input" name="q" value="<?= htmlspecialchars($search) ?>" class="bg-transparent border-none outline-none text-white text-xs md:text-sm font-mono w-full placeholder:text-zinc-600" placeholder="Search roles (e.g. React, Python, Remote, Machine Learning)..."/>
        </div>
        <button type="submit" class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white px-6 py-2.5 rounded-xl font-mono text-xs font-bold flex items-center gap-1.5 shrink-0 transition-colors">
          Search <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
        </button>
        <?php if ($search): ?>
          <a href="<?= URL_INTERNSHIPS ?>" class="text-zinc-400 text-xs font-mono hover:text-white px-2">Clear</a>
        <?php endif; ?>
      </form>

      <!-- ── Openings Count & Status ──────────────────────────────── -->
      <div class="flex items-center justify-between border-b border-zinc-800 pb-3">
        <h2 class="text-base font-bold text-white flex items-center gap-2">
          <span class="material-symbols-outlined text-emerald-400">work</span>
          <?= $search ? 'Filtered Results' : 'Active Openings' ?>
        </h2>
        <span class="text-xs font-mono text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/20">
          <?= count($jobs) ?> Roles Open
        </span>
      </div>

      <!-- ── Job Cards Grid ──────────────────────────────────────── -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($jobs as $j): 
          $tags = is_array($j['tags']) ? $j['tags'] : [];
        ?>
          <article class="bg-zinc-950 border border-zinc-800/80 hover:border-emerald-500/40 rounded-2xl p-5 flex flex-col justify-between transition-all duration-300 shadow-md group">
            <div class="space-y-3">
              <div class="flex justify-between items-start gap-2">
                <div>
                  <h3 class="text-base font-bold text-white group-hover:text-emerald-400 transition-colors line-clamp-1">
                    <?= htmlspecialchars($j['title']) ?>
                  </h3>
                  <p class="text-xs text-zinc-400 font-light mt-0.5"><?= htmlspecialchars($j['company']) ?> &bull; <span class="text-zinc-300"><?= htmlspecialchars($j['location']) ?></span></p>
                </div>
                <span class="w-8 h-8 rounded-lg bg-zinc-900 border border-zinc-800 text-emerald-400 flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-[18px]">business_center</span>
                </span>
              </div>

              <div class="flex flex-wrap gap-1.5">
                <?php foreach ($tags as $tag): ?>
                  <span class="bg-zinc-900 border border-zinc-800 text-zinc-300 px-2 py-0.5 rounded text-[11px] font-mono"><?= htmlspecialchars($tag) ?></span>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="flex items-center justify-between mt-5 pt-3 border-t border-zinc-900">
              <span class="text-xs font-mono font-bold text-emerald-400"><?= htmlspecialchars($j['pay']) ?></span>
              <button onclick="alert('Application Portal: Opening official recruitment portal for <?= htmlspecialchars($j['company']) ?>...')" class="bg-emerald-500 hover:bg-emerald-400 text-black px-3.5 py-1.5 rounded-lg text-xs font-mono font-bold transition-all flex items-center gap-1 shadow-sm">
                Apply Now <span class="material-symbols-outlined text-[13px]">open_in_new</span>
              </button>
            </div>
          </article>
        <?php endforeach; ?>

        <?php if (empty($jobs)): ?>
          <div class="col-span-full text-center py-16 text-zinc-400 font-mono">
            <span class="material-symbols-outlined text-[48px] text-zinc-600 mb-2 block">search_off</span>
            No internship listings found matching "<?= htmlspecialchars($search) ?>". <a href="<?= URL_INTERNSHIPS ?>" class="text-emerald-400 hover:underline">Reset Filters</a>
          </div>
        <?php endif; ?>
      </div>

      <!-- ── On-Page SEO Guide & FAQ Section ──────────────────────── -->
      <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-10 shadow-2xl space-y-8 mt-6">
        <div>
          <span class="text-xs font-mono text-emerald-400 uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Internship Roadmap</span>
          <h2 class="text-xl md:text-3xl font-black text-white mt-3">
            How to Land <span class="gradient-text">Top-Tier Tech Internships</span> in 2026
          </h2>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-2 leading-relaxed max-w-3xl">
            Engineering internships provide the fastest path to high-paying full-time return offers. Follow these proven strategies curated by <strong>Yaswant Pandey</strong>.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-emerald-400 text-2xl mb-2">description</span>
            <h3 class="text-sm font-bold text-white mb-1">1. Tailor Your ATS Resume</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Use our <a href="<?= URL_RESUME ?>" class="text-emerald-400 hover:underline">ATS Resume Studio</a> to format your projects with quantifiable metrics and relevant tech keywords.
            </p>
          </div>
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-cyan-400 text-2xl mb-2">code</span>
            <h3 class="text-sm font-bold text-white mb-1">2. Master DSA Patterns</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Focus on Two Pointers, Sliding Window, Trees, Graphs, and Dynamic Programming in C++ or Python to ace technical coding rounds.
            </p>
          </div>
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-indigo-400 text-2xl mb-2">hub</span>
            <h3 class="text-sm font-bold text-white mb-1">3. Ship Full-Stack / Cyber Projects</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Demonstrate hands-on engineering ability by building real-world projects from our <a href="<?= URL_PROJECT ?>" class="text-cyan-400 hover:underline">Cyber Projects Hub</a>.
            </p>
          </div>
        </div>

        <!-- FAQ Accordions -->
        <div class="space-y-4 pt-6 border-t border-zinc-800">
          <h3 class="text-base font-bold text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-400">help</span> Frequently Asked Questions
          </h3>
          
          <div class="space-y-3">
            <details class="bg-zinc-900/80 rounded-xl p-4 border border-zinc-800/80 cursor-pointer group">
              <summary class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                When should engineering students apply for summer internships?
                <span class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                Tech hiring cycles peak between August and November for the following summer. Applying within the first 48 hours of an opening maximizes your interview callback rate.
              </p>
            </details>

            <details class="bg-zinc-900/80 rounded-xl p-4 border border-zinc-800/80 cursor-pointer group">
              <summary class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                Are remote internships open to international applicants?
                <span class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                Many remote software roles hire globally through platforms like Deel or Remote.com. Check each role's specific location tag for work authorization details.
              </p>
            </details>
          </div>
        </div>

      </section>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>
