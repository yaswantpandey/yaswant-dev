<?php require_once __DIR__ . '/../includes/layout.php';
require_once __DIR__ . '/../includes/data.php';

// CollectionPage schema — uses URL_RESOURCES canonical
$schema = schema_resources();

nexus_head(
  'Engineering Study Resources 2026 — Notes, Solved PYQs & Lab Manuals',
  'Download 100% free engineering lecture notes, semester previous year question papers (PYQs), lab manuals, and formula cheat sheets for CS, ME, and EC branches by Yaswant Dev.',
  'engineering study resources 2026, lecture notes free download, previous year questions, solved PYQ, engineering lab manuals, B.Tech computer science notes, semester cheat sheets, study notes by Yaswant Pandey',
  URL_RESOURCES,
  ['type' => 'website', 'title' => 'Engineering Study Resources 2026 — Yaswant Dev'],
  $schema
);
$resources = get_resources();

$filterBranch = $_GET['branch'] ?? '';
$filterSem    = $_GET['sem']    ?? '';
$search       = trim($_GET['q'] ?? '');

$filtered = array_values(array_filter($resources, function($r) use ($filterBranch, $filterSem, $search) {
  if ($filterBranch && $r['branch'] !== $filterBranch) return false;
  if ($filterSem    && $r['sem']    !== $filterSem)    return false;
  if ($search && stripos($r['title'], $search) === false) return false;
  return true;
}));
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('resources'); nexus_topbar('resources'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-xl">

      <!-- ── Breadcrumbs ─────────────────────────────────────────── -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
        <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
        <span class="text-zinc-600">/</span>
        <span class="text-zinc-300">Study Resources & PYQs</span>
      </nav>

      <!-- ── Header Banner ───────────────────────────────────────── -->
      <div class="bg-gradient-to-r from-zinc-950 via-zinc-900 to-zinc-950 rounded-2xl p-6 md:p-8 border border-zinc-800 shadow-xl relative overflow-hidden">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
          <div class="space-y-2 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Verified Academic Repository
            </div>
            <h1 class="text-2xl md:text-4xl font-black text-white tracking-tight">
              Engineering Notes & <span class="gradient-text">Solved PYQs</span>
            </h1>
            <p class="text-xs md:text-sm text-zinc-300 font-light leading-relaxed">
              Curated handwritten notes, end-semester solved question banks, laboratory experiment manuals, and quick revision formula cheat sheets.
            </p>
          </div>

          <div class="flex items-center gap-3 shrink-0">
            <a href="<?= URL_COURSES ?>" class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white px-4 py-2.5 rounded-xl font-mono text-xs font-bold transition-all shadow-md flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[16px] text-emerald-400">school</span> View Courses
            </a>
          </div>
        </div>
      </div>

      <!-- Mobile Quick Filter Chips Bar (lg:hidden) -->
      <div class="lg:hidden w-full space-y-2.5 bg-zinc-950/80 border border-zinc-800 rounded-2xl p-3.5 shadow-md">
        <!-- Search bar -->
        <form method="GET" class="relative w-full">
          <?php if ($filterBranch): ?><input type="hidden" name="branch" value="<?= htmlspecialchars($filterBranch) ?>"><?php endif; ?>
          <?php if ($filterSem): ?><input type="hidden" name="sem" value="<?= htmlspecialchars($filterSem) ?>"><?php endif; ?>
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-zinc-500 text-[18px]">search</span>
          <input name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search notes, subjects, PYQs…"
            class="w-full bg-black text-white text-xs font-mono pl-9 pr-8 py-2 rounded-xl border border-zinc-800 focus:outline-none focus:border-emerald-500 placeholder:text-zinc-600" />
          <?php if ($search): ?>
            <a href="<?= URL_RESOURCES ?>?branch=<?= urlencode($filterBranch) ?>&sem=<?= urlencode($filterSem) ?>" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-zinc-500 hover:text-white text-xs font-mono">✕</a>
          <?php endif; ?>
        </form>

        <!-- Branch Chips -->
        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-1">
          <span class="text-[10px] font-mono text-zinc-500 uppercase shrink-0 mr-1">Branch:</span>
          <?php 
          $branches = ['' => 'All', 'CS' => 'CS', 'ME' => 'ME', 'EC' => 'EC'];
          foreach ($branches as $bVal => $bLbl):
            $isActive = ($filterBranch === $bVal);
            $url = URL_RESOURCES . '?' . http_build_query(array_filter(['branch' => $bVal, 'sem' => $filterSem, 'q' => $search]));
          ?>
            <a href="<?= $url ?>" class="shrink-0 px-3 py-1 rounded-full text-[11px] font-mono font-medium transition-all active:scale-95 <?= $isActive ? 'bg-emerald-500 text-black font-bold shadow-[0_0_8px_rgba(16,185,129,0.3)]' : 'bg-zinc-900 text-zinc-400 border border-zinc-800 hover:text-white' ?>">
              <?= $bLbl ?>
            </a>
          <?php endforeach; ?>
        </div>

        <!-- Semester Chips -->
        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-0.5">
          <span class="text-[10px] font-mono text-zinc-500 uppercase shrink-0 mr-1">Sem:</span>
          <?php 
          $sems = ['' => 'All', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3', 'S4' => 'S4', 'S5' => 'S5', 'S6' => 'S6', 'S7' => 'S7', 'S8' => 'S8'];
          foreach ($sems as $sVal => $sLbl):
            $isActive = ($filterSem === $sVal);
            $url = URL_RESOURCES . '?' . http_build_query(array_filter(['branch' => $filterBranch, 'sem' => $sVal, 'q' => $search]));
          ?>
            <a href="<?= $url ?>" class="shrink-0 px-2.5 py-0.5 rounded-lg text-[10px] font-mono font-medium transition-all active:scale-95 <?= $isActive ? 'bg-cyan-400 text-black font-bold shadow-[0_0_8px_rgba(6,182,212,0.3)]' : 'bg-zinc-900 text-zinc-400 border border-zinc-800 hover:text-white' ?>">
              <?= $sLbl ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- ── Layout: Sidebar Filters + Main Results ──────────────── -->
      <div class="flex flex-col lg:flex-row gap-6 w-full items-start">

        <!-- Filters Sidebar (Desktop) -->
        <aside class="hidden lg:block w-full lg:w-72 shrink-0 bg-zinc-950 border border-zinc-800 rounded-2xl p-5 shadow-lg space-y-6 sticky top-20" aria-label="Filter resources">
          <form method="GET" class="space-y-5">
            <!-- Search -->
            <div class="space-y-1.5">
              <label for="res-search" class="text-xs font-mono text-zinc-400 uppercase tracking-wider block">Search Title</label>
              <div class="bg-black border border-zinc-800 rounded-xl px-3 py-2 flex items-center gap-2 focus-within:border-emerald-500 transition-colors">
                <span class="material-symbols-outlined text-zinc-500 text-[18px]">search</span>
                <input id="res-search" name="q" value="<?= htmlspecialchars($search) ?>" class="bg-transparent border-none outline-none text-white text-xs font-mono w-full placeholder:text-zinc-600" placeholder="e.g. DBMS, Operating Systems..."/>
              </div>
            </div>

            <!-- Branch Radios -->
            <div class="space-y-2">
              <span class="text-xs font-mono text-zinc-400 uppercase tracking-wider block">Branch</span>
              <div class="space-y-1.5">
                <?php foreach (['' => 'All Branches', 'CS' => 'Computer Science (CS)', 'ME' => 'Mechanical (ME)', 'EC' => 'Electronics (EC)'] as $val => $lbl): ?>
                  <label class="flex items-center gap-2 text-xs font-mono text-zinc-300 hover:text-white cursor-pointer py-1">
                    <input type="radio" name="branch" value="<?= $val ?>" <?= $filterBranch === $val ? 'checked' : '' ?> class="accent-emerald-500"/>
                    <span><?= $lbl ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Semester Pills -->
            <div class="space-y-2">
              <span class="text-xs font-mono text-zinc-400 uppercase tracking-wider block">Semester</span>
              <div class="grid grid-cols-4 gap-1.5">
                <?php for ($i = 1; $i <= 8; $i++): 
                  $s = "S$i";
                  $active = ($filterSem === $s);
                  $cls = $active ? 'bg-emerald-500 text-black font-bold' : 'bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white';
                ?>
                  <button type="submit" name="sem" value="<?= $s ?>" class="py-1.5 rounded-lg text-xs font-mono transition-colors <?= $cls ?>">
                    <?= $s ?>
                  </button>
                <?php endfor; ?>
              </div>
            </div>

            <div class="flex gap-2 pt-2 border-t border-zinc-900">
              <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-black py-2 rounded-xl text-xs font-mono font-bold transition-all shadow-md">
                Apply Filters
              </button>
              <?php if ($filterBranch || $filterSem || $search): ?>
                <a href="<?= URL_RESOURCES ?>" class="px-3 py-2 bg-zinc-900 hover:bg-zinc-800 text-zinc-400 text-xs font-mono rounded-xl flex items-center justify-center">
                  Reset
                </a>
              <?php endif; ?>
            </div>
          </form>
        </aside>

        <!-- Main Results Grid -->
        <div class="flex-1 flex flex-col gap-6 min-w-0">
          <div class="flex items-center justify-between border-b border-zinc-800 pb-3">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
              <span class="material-symbols-outlined text-emerald-400">library_books</span>
              Available Study Materials
            </h2>
            <span class="text-xs font-mono text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/20">
              <?= count($filtered) ?> Documents
            </span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
            <?php foreach ($filtered as $r): ?>
              <article class="bg-zinc-950 border border-zinc-800/80 hover:border-emerald-500/40 rounded-2xl p-5 flex flex-col justify-between transition-all duration-300 shadow-md group active:scale-[0.98]">
                <div class="space-y-3">
                  <div class="flex gap-1.5 flex-wrap">
                    <span class="bg-zinc-900 border border-zinc-800 text-zinc-300 px-2 py-0.5 rounded text-[10px] font-mono uppercase font-bold">
                      <?= htmlspecialchars($r['branch']) ?> &bull; <?= htmlspecialchars($r['sem']) ?>
                    </span>
                    <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-0.5 rounded text-[10px] font-mono uppercase font-bold">
                      <?= htmlspecialchars($r['type']) ?>
                    </span>
                  </div>

                  <h3 class="text-sm md:text-base font-bold text-white group-hover:text-emerald-400 transition-colors line-clamp-2">
                    <?= htmlspecialchars($r['title']) ?>
                  </h3>
                </div>

                <div class="mt-5 pt-3 border-t border-zinc-900 flex items-center justify-between">
                  <div class="text-[11px] font-mono text-zinc-400">
                    <div>By: <span class="text-zinc-300"><?= htmlspecialchars($r['by']) ?></span></div>
                    <div class="text-zinc-500"><?= htmlspecialchars($r['size']) ?> &bull; PDF</div>
                  </div>
                  <button onclick="alert('Downloading <?= htmlspecialchars($r['title']) ?> (<?= $r['size'] ?>)...')" class="bg-zinc-900 group-hover:bg-emerald-500 group-hover:text-black text-white px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1 border border-zinc-800 group-hover:border-transparent">
                    Get <span class="material-symbols-outlined text-[14px]">download</span>
                  </button>
                </div>
              </article>
            <?php endforeach; ?>

            <?php if (empty($filtered)): ?>
              <div class="col-span-full text-center py-16 text-zinc-400 font-mono">
                <span class="material-symbols-outlined text-[48px] text-zinc-600 mb-2 block">folder_off</span>
                No study resources match the selected branch/semester criteria. <a href="<?= URL_RESOURCES ?>" class="text-emerald-400 hover:underline">Reset Filters</a>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>

      <!-- ── On-Page SEO Guide & FAQ Section ──────────────────────── -->
      <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-10 shadow-2xl space-y-8 mt-6">
        <div>
          <span class="text-xs font-mono text-emerald-400 uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Exam Prep Strategy</span>
          <h2 class="text-xl md:text-3xl font-black text-white mt-3">
            How to Score a <span class="gradient-text">9+ CGPA in University Exams</span>
          </h2>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-2 leading-relaxed max-w-3xl">
            Maximize your examination performance with strategic revision frameworks and solved previous year questions curated by <strong>Yaswant Pandey</strong>.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-emerald-400 text-2xl mb-2">history_edu</span>
            <h3 class="text-sm font-bold text-white mb-1">1. Analyze 5-Year PYQs</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Over 70% of university exam questions follow recurring patterns. Practice 5-year solved papers to identify high-weightage topics.
            </p>
          </div>
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-cyan-400 text-2xl mb-2">draw</span>
            <h3 class="text-sm font-bold text-white mb-1">2. Diagrammatic Architecture</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              In technical evaluations, structured block diagrams, state machines, and code flowcharts score significantly higher than long paragraphs.
            </p>
          </div>
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-indigo-400 text-2xl mb-2">timer</span>
            <h3 class="text-sm font-bold text-white mb-1">3. Active Spaced Repetition</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Use our quick formula cheat sheets 24 hours and 7 days after initial study to cement technical definitions in long-term memory.
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
                Are these notes and question papers free to download?
                <span class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                Yes, 100% of study notes, previous year question papers, and laboratory experiment manuals are completely free with zero registration.
              </p>
            </details>

            <details class="bg-zinc-900/80 rounded-xl p-4 border border-zinc-800/80 cursor-pointer group">
              <summary class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                Which branches are supported in the repository?
                <span class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                We currently support Computer Science & Engineering (CS), Mechanical Engineering (ME), Electronics & Communication (EC), and Civil Engineering across semesters 1 to 8.
              </p>
            </details>
          </div>
        </div>

      </section>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>
