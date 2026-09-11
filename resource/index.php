<?php require_once __DIR__ . '/../includes/layout.php';
require_once __DIR__ . '/../includes/data.php';

// CollectionPage schema — uses URL_RESOURCES canonical
$schema = schema_resources();

nexus_head(
  'Engineering Study Resources 2026 — Notes, Solved PYQs & Lab Manuals',
  'Download 100% free engineering lecture notes, semester previous year question papers (PYQs), lab manuals, and formula cheat sheets for CS, ME, EC, and Civil branches by Yaswant Dev.',
  'engineering study resources 2026, lecture notes free download, previous year questions, solved PYQ, engineering lab manuals, B.Tech computer science notes, semester cheat sheets, study notes by Yaswant Pandey',
  URL_RESOURCES,
  ['type' => 'website', 'title' => 'Engineering Study Resources 2026 — Yaswant Dev'],
  $schema
);

// Fetch resources from DB with rich curated fallback
$dbResources = get_resources();
if (empty($dbResources)) {
  $resources = [
    [
      'id' => 101,
      'branch' => 'CS',
      'sem' => 'S3',
      'type' => 'Notes',
      'title' => 'Data Structures & Algorithms — Complete Handwritten Notes & Code',
      'by' => 'Yaswant Pandey',
      'size' => '4.8 MB',
      'downloads' => 1240,
      'color' => 'emerald'
    ],
    [
      'id' => 102,
      'branch' => 'CS',
      'sem' => 'S4',
      'type' => 'PYQ',
      'title' => 'Operating Systems — 5-Year Solved End-Sem Question Papers (2020-2025)',
      'by' => 'Engineering Faculty',
      'size' => '3.2 MB',
      'downloads' => 980,
      'color' => 'cyan'
    ],
    [
      'id' => 103,
      'branch' => 'CS',
      'sem' => 'S5',
      'type' => 'Lab Manual',
      'title' => 'Database Management Systems (DBMS) — SQL & PDO Lab Experiments',
      'by' => 'Yaswant Dev',
      'size' => '2.5 MB',
      'downloads' => 870,
      'color' => 'indigo'
    ],
    [
      'id' => 104,
      'branch' => 'CS',
      'sem' => 'S6',
      'type' => 'Formula Sheet',
      'title' => 'Computer Networks — Protocol Architecture & CIDR Formula Cheat Sheet',
      'by' => 'Yaswant Pandey',
      'size' => '1.4 MB',
      'downloads' => 1560,
      'color' => 'amber'
    ],
    [
      'id' => 105,
      'branch' => 'CS',
      'sem' => 'S7',
      'type' => 'Notes',
      'title' => 'Cyber Security & Cryptography — Complete RSA, AES & SHA Modules',
      'by' => 'Yaswant Pandey',
      'size' => '5.1 MB',
      'downloads' => 2100,
      'color' => 'emerald'
    ],
    [
      'id' => 106,
      'branch' => 'CS',
      'sem' => 'S5',
      'type' => 'PYQ',
      'title' => 'Compiler Design — Solved End-Sem Question Bank & Syntax Trees',
      'by' => 'Academic Vault',
      'size' => '3.8 MB',
      'downloads' => 740,
      'color' => 'cyan'
    ],
    [
      'id' => 107,
      'branch' => 'EC',
      'sem' => 'S3',
      'type' => 'Notes',
      'title' => 'Digital Electronics & Logic Design — Gates, Flip-Flops & K-Maps',
      'by' => 'EC Department',
      'size' => '4.2 MB',
      'downloads' => 610,
      'color' => 'violet'
    ],
    [
      'id' => 108,
      'branch' => 'ME',
      'sem' => 'S4',
      'type' => 'Notes',
      'title' => 'Thermodynamics & Heat Transfer — Formulae, Solved Numerical Problems',
      'by' => 'ME Faculty',
      'size' => '6.0 MB',
      'downloads' => 520,
      'color' => 'rose'
    ],
    [
      'id' => 109,
      'branch' => 'CS',
      'sem' => 'S4',
      'type' => 'PYQ',
      'title' => 'Object Oriented Programming with C++ — Solved Mid & End-Sem PYQs',
      'by' => 'Yaswant Dev',
      'size' => '2.9 MB',
      'downloads' => 1120,
      'color' => 'cyan'
    ],
    [
      'id' => 110,
      'branch' => 'CS',
      'sem' => 'S3',
      'type' => 'Formula Sheet',
      'title' => 'Discrete Mathematics — Graph Theory & Boolean Algebra Revision Sheet',
      'by' => 'Yaswant Pandey',
      'size' => '1.2 MB',
      'downloads' => 1430,
      'color' => 'amber'
    ]
  ];
} else {
  $resources = $dbResources;
}

$filterBranch = $_GET['branch'] ?? '';
$filterSem    = $_GET['sem']    ?? '';
$filterType   = $_GET['type']   ?? '';
$search       = trim($_GET['q'] ?? '');

$filtered = array_values(array_filter($resources, function($r) use ($filterBranch, $filterSem, $filterType, $search) {
  if ($filterBranch && $r['branch'] !== $filterBranch) return false;
  if ($filterSem    && $r['sem']    !== $filterSem)    return false;
  if ($filterType   && strcasecmp($r['type'], $filterType) !== 0) return false;
  if ($search && stripos($r['title'], $search) === false && stripos($r['branch'], $search) === false) return false;
  return true;
}));
?>

<style>
  .resource-page-wrap {
    background: #040406;
    color: #f4f4f5;
  }

  .glass-card {
    background: rgba(13, 13, 16, 0.7);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1.25rem;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .glass-card:hover {
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.8);
  }

  .gradient-text-shimmer {
    background: linear-gradient(135deg, #10b981 0%, #06b6d4 50%, #6366f1 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .filter-pill {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: #a1a1aa;
    border-radius: 9999px;
    padding: 0.35rem 0.9rem;
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .filter-pill:hover, .filter-pill.active {
    background: rgba(16, 185, 129, 0.15);
    color: #ffffff;
    border-color: rgba(16, 185, 129, 0.4);
  }

  .no-scrollbar::-webkit-scrollbar { display: none; }
  .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen resource-page-wrap">
  <?php nexus_sidebar('resources'); nexus_topbar('resources'); ?>

  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-[1340px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col w-full gap-8 relative">

      <!-- Ambient Glow Orbs -->
      <div class="absolute top-0 right-10 w-96 h-96 rounded-full blur-[140px] pointer-events-none z-0"
        style="background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, transparent 70%);"></div>
      <div class="absolute top-1/2 left-0 w-80 h-80 rounded-full blur-[120px] pointer-events-none z-0"
        style="background: radial-gradient(circle, rgba(6, 182, 212, 0.1) 0%, transparent 70%);"></div>

      <!-- ── Breadcrumbs ─────────────────────────────────────────── -->
      <nav aria-label="Breadcrumb" class="relative z-10 flex items-center gap-2 text-xs font-mono text-zinc-400">
        <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
        <span class="text-zinc-600">/</span>
        <span class="text-zinc-200 font-medium">Academic Resource Vault</span>
      </nav>

      <!-- ── Header Banner ───────────────────────────────────────── -->
      <section class="relative z-10 glass-card bg-gradient-to-r from-zinc-950 via-zinc-900/90 to-zinc-950 p-6 md:p-8 rounded-2xl border border-emerald-500/20 shadow-2xl overflow-hidden">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
          <div class="space-y-3 max-w-3xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[11px] font-mono uppercase tracking-widest">
              <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Verified Academic Repository 2026
            </div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-white tracking-tight">
              Engineering Study Notes & <span class="gradient-text-shimmer">Solved PYQs</span>
            </h1>
            <p class="text-xs md:text-sm text-zinc-300 font-light leading-relaxed">
              Access handwritten semester notes, 5-year end-semester solved question banks, laboratory experiment manuals, and quick revision formula cheat sheets.
            </p>
            <div class="flex flex-wrap gap-2 pt-1 text-[11px] font-mono text-zinc-400">
              <span class="bg-zinc-900/80 px-2.5 py-1 rounded border border-zinc-800 text-zinc-300">✓ 100% Free Downloads</span>
              <span class="bg-zinc-900/80 px-2.5 py-1 rounded border border-zinc-800 text-zinc-300">✓ Verified Syllabus</span>
              <span class="bg-zinc-900/80 px-2.5 py-1 rounded border border-zinc-800 text-zinc-300">✓ Instant PDF Access</span>
            </div>
          </div>

          <div class="flex flex-wrap items-center gap-3 shrink-0">
            <a href="<?= URL_COURSES ?>" class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 hover:border-emerald-400 text-white px-5 py-3 rounded-xl font-mono text-xs font-bold transition-all shadow-lg flex items-center gap-2">
              <span class="material-symbols-outlined text-[18px] text-emerald-400">school</span> View Free Courses
            </a>
          </div>
        </div>
      </section>

      <!-- ── Mobile Quick Filter Bar (lg:hidden) ── -->
      <div class="lg:hidden relative z-10 w-full space-y-3 glass-card p-4 shadow-md">
        <!-- Search bar -->
        <form method="GET" class="relative w-full">
          <?php if ($filterBranch): ?><input type="hidden" name="branch" value="<?= htmlspecialchars($filterBranch) ?>"><?php endif; ?>
          <?php if ($filterSem): ?><input type="hidden" name="sem" value="<?= htmlspecialchars($filterSem) ?>"><?php endif; ?>
          <?php if ($filterType): ?><input type="hidden" name="type" value="<?= htmlspecialchars($filterType) ?>"><?php endif; ?>
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-[20px]">search</span>
          <input name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search notes, subjects, PYQs…"
            class="w-full bg-zinc-950 text-white text-xs font-mono pl-10 pr-8 py-2.5 rounded-xl border border-zinc-800 focus:outline-none focus:border-emerald-500 placeholder:text-zinc-500" />
          <?php if ($search): ?>
            <a href="<?= URL_RESOURCES ?>?branch=<?= urlencode($filterBranch) ?>&sem=<?= urlencode($filterSem) ?>&type=<?= urlencode($filterType) ?>" class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-white text-xs font-mono">✕</a>
          <?php endif; ?>
        </form>

        <!-- Branch Chips -->
        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-1">
          <span class="text-[10px] font-mono text-zinc-500 uppercase shrink-0 font-bold mr-1">Branch:</span>
          <?php 
          $branches = ['' => 'All', 'CS' => 'CS', 'ME' => 'ME', 'EC' => 'EC', 'CE' => 'Civil'];
          foreach ($branches as $bVal => $bLbl):
            $isActive = ($filterBranch === $bVal);
            $url = URL_RESOURCES . '?' . http_build_query(array_filter(['branch' => $bVal, 'sem' => $filterSem, 'type' => $filterType, 'q' => $search]));
          ?>
            <a href="<?= $url ?>" class="shrink-0 px-3 py-1 rounded-full text-[11px] font-mono transition-all active:scale-95 <?= $isActive ? 'bg-emerald-500 text-black font-bold shadow-md shadow-emerald-500/20' : 'bg-zinc-900 text-zinc-400 border border-zinc-800 hover:text-white' ?>">
              <?= $bLbl ?>
            </a>
          <?php endforeach; ?>
        </div>

        <!-- Resource Type Chips -->
        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-0.5">
          <span class="text-[10px] font-mono text-zinc-500 uppercase shrink-0 font-bold mr-1">Type:</span>
          <?php 
          $types = ['' => 'All', 'Notes' => 'Notes', 'PYQ' => 'PYQ', 'Lab Manual' => 'Lab', 'Formula Sheet' => 'Formula'];
          foreach ($types as $tVal => $tLbl):
            $isActive = (strcasecmp($filterType, $tVal) === 0);
            $url = URL_RESOURCES . '?' . http_build_query(array_filter(['branch' => $filterBranch, 'sem' => $filterSem, 'type' => $tVal, 'q' => $search]));
          ?>
            <a href="<?= $url ?>" class="shrink-0 px-2.5 py-0.5 rounded-lg text-[10px] font-mono transition-all active:scale-95 <?= $isActive ? 'bg-cyan-400 text-black font-bold shadow-md shadow-cyan-400/20' : 'bg-zinc-900 text-zinc-400 border border-zinc-800 hover:text-white' ?>">
              <?= $tLbl ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- ── Layout: Sidebar Filters + Main Results ──────────────── -->
      <div class="relative z-10 flex flex-col lg:flex-row gap-6 w-full items-start">

        <!-- Desktop Filters Sidebar -->
        <aside class="hidden lg:block w-full lg:w-72 shrink-0 glass-card p-5 space-y-6 sticky top-20" aria-label="Filter resources">
          <form method="GET" class="space-y-5">
            <!-- Search -->
            <div class="space-y-2">
              <label for="res-search" class="text-xs font-mono text-zinc-400 uppercase tracking-wider block font-semibold">Search Title</label>
              <div class="bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2.5 flex items-center gap-2 focus-within:border-emerald-500 transition-colors">
                <span class="material-symbols-outlined text-zinc-500 text-[18px]">search</span>
                <input id="res-search" name="q" value="<?= htmlspecialchars($search) ?>" class="bg-transparent border-none outline-none text-white text-xs font-mono w-full placeholder:text-zinc-600" placeholder="e.g. DBMS, Operating Systems..."/>
              </div>
            </div>

            <!-- Branch Radios -->
            <div class="space-y-2">
              <span class="text-xs font-mono text-zinc-400 uppercase tracking-wider block font-semibold">Engineering Branch</span>
              <div class="space-y-1.5">
                <?php foreach (['' => 'All Branches', 'CS' => 'Computer Science (CS)', 'ME' => 'Mechanical (ME)', 'EC' => 'Electronics (EC)', 'CE' => 'Civil Engineering (CE)'] as $val => $lbl): ?>
                  <label class="flex items-center gap-2.5 text-xs font-mono text-zinc-300 hover:text-white cursor-pointer py-1">
                    <input type="radio" name="branch" value="<?= $val ?>" <?= $filterBranch === $val ? 'checked' : '' ?> class="accent-emerald-500"/>
                    <span><?= $lbl ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Resource Type Selector -->
            <div class="space-y-2">
              <span class="text-xs font-mono text-zinc-400 uppercase tracking-wider block font-semibold">Resource Type</span>
              <div class="space-y-1.5">
                <?php foreach (['' => 'All Types', 'Notes' => 'Lecture Notes', 'PYQ' => 'Solved PYQs', 'Lab Manual' => 'Lab Manuals', 'Formula Sheet' => 'Formula Sheets'] as $val => $lbl): ?>
                  <label class="flex items-center gap-2.5 text-xs font-mono text-zinc-300 hover:text-white cursor-pointer py-1">
                    <input type="radio" name="type" value="<?= $val ?>" <?= strcasecmp($filterType, $val) === 0 ? 'checked' : '' ?> class="accent-emerald-500"/>
                    <span><?= $lbl ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Semester Pills -->
            <div class="space-y-2">
              <span class="text-xs font-mono text-zinc-400 uppercase tracking-wider block font-semibold">Semester Filter</span>
              <div class="grid grid-cols-4 gap-1.5">
                <?php for ($i = 1; $i <= 8; $i++): 
                  $s = "S$i";
                  $active = ($filterSem === $s);
                  $cls = $active ? 'bg-emerald-500 text-black font-bold shadow-md shadow-emerald-500/20' : 'bg-zinc-950 border border-zinc-800 text-zinc-400 hover:text-white';
                ?>
                  <button type="submit" name="sem" value="<?= $s ?>" class="py-1.5 rounded-lg text-xs font-mono transition-colors <?= $cls ?>">
                    <?= $s ?>
                  </button>
                <?php endfor; ?>
              </div>
            </div>

            <div class="flex gap-2 pt-3 border-t border-white/[0.08]">
              <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-black py-2.5 rounded-xl text-xs font-mono font-bold transition-all shadow-lg shadow-emerald-500/20">
                Apply Filters
              </button>
              <?php if ($filterBranch || $filterSem || $filterType || $search): ?>
                <a href="<?= URL_RESOURCES ?>" class="px-3 py-2.5 bg-zinc-900 hover:bg-zinc-800 text-zinc-400 hover:text-white text-xs font-mono rounded-xl flex items-center justify-center border border-zinc-800">
                  Reset
                </a>
              <?php endif; ?>
            </div>
          </form>
        </aside>

        <!-- Main Results Grid -->
        <div class="flex-1 flex flex-col gap-6 min-w-0">
          <div class="flex items-center justify-between border-b border-white/[0.08] pb-3">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
              <span class="material-symbols-outlined text-emerald-400">library_books</span>
              Available Study Materials
            </h2>
            <span class="text-xs font-mono text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">
              <?= count($filtered) ?> Documents Found
            </span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
            <?php foreach ($filtered as $r): 
              $badgeColor = match(strtoupper($r['branch'] ?? 'CS')) {
                'CS' => 'border-emerald-500/30 text-emerald-400 bg-emerald-500/10',
                'ME' => 'border-rose-500/30 text-rose-400 bg-rose-500/10',
                'EC' => 'border-violet-500/30 text-violet-400 bg-violet-500/10',
                'CE' => 'border-amber-500/30 text-amber-400 bg-amber-500/10',
                default => 'border-cyan-500/30 text-cyan-400 bg-cyan-500/10'
              };
            ?>
              <article class="glass-card p-5 flex flex-col justify-between group active:scale-[0.99] transition-all">
                <div class="space-y-3">
                  <div class="flex items-center justify-between gap-2 flex-wrap">
                    <span class="border px-2.5 py-0.5 rounded text-[10px] font-mono uppercase font-bold <?= $badgeColor ?>">
                      <?= htmlspecialchars($r['branch']) ?> &bull; <?= htmlspecialchars($r['sem']) ?>
                    </span>
                    <span class="bg-zinc-800/80 text-zinc-300 border border-zinc-700/50 px-2 py-0.5 rounded text-[10px] font-mono uppercase font-bold">
                      <?= htmlspecialchars($r['type']) ?>
                    </span>
                  </div>

                  <h3 class="text-sm md:text-base font-bold text-white group-hover:text-emerald-400 transition-colors line-clamp-2 leading-snug">
                    <?= htmlspecialchars($r['title']) ?>
                  </h3>
                </div>

                <div class="mt-6 pt-3.5 border-t border-white/[0.08] flex items-center justify-between">
                  <div class="text-[11px] font-mono text-zinc-400">
                    <div class="truncate">By: <span class="text-zinc-200"><?= htmlspecialchars($r['by']) ?></span></div>
                    <div class="text-zinc-500 text-[10px]"><?= htmlspecialchars($r['size'] ?? 'PDF') ?> &bull; Direct Download</div>
                  </div>
                  <button onclick="alert('Downloading <?= htmlspecialchars(addslashes($r['title'])) ?> (<?= $r['size'] ?? 'PDF' ?>)...')" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-black px-3.5 py-2 rounded-xl text-xs font-mono font-bold transition-all flex items-center gap-1.5 shadow-md shadow-emerald-500/20 active:scale-95">
                    Get <span class="material-symbols-outlined text-[15px]">download</span>
                  </button>
                </div>
              </article>
            <?php endforeach; ?>

            <?php if (empty($filtered)): ?>
              <div class="col-span-full text-center py-16 text-zinc-400 font-mono glass-card p-8">
                <span class="material-symbols-outlined text-[48px] text-zinc-600 mb-3 block">folder_off</span>
                No study resources match the selected criteria.
                <div class="mt-3">
                  <a href="<?= URL_RESOURCES ?>" class="text-emerald-400 hover:underline font-bold">Reset Filters</a>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>

      <!-- ── Exam Prep Strategy & FAQ Section ──────────────────────── -->
      <section class="glass-card p-6 md:p-10 shadow-2xl space-y-8 mt-6">
        <div>
          <span class="text-xs font-mono text-emerald-400 uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Exam Strategy</span>
          <h2 class="text-xl md:text-3xl font-black text-white mt-3">
            How to Score a <span class="gradient-text-shimmer">9+ CGPA in University Exams</span>
          </h2>
          <p class="text-xs md:text-sm text-zinc-300 font-light mt-2 leading-relaxed max-w-3xl">
            Maximize your examination performance with strategic revision frameworks and solved previous year questions curated by <strong>Yaswant Pandey</strong>.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="glass-card p-5 border-zinc-800">
            <span class="material-symbols-outlined text-emerald-400 text-3xl mb-3">history_edu</span>
            <h3 class="text-sm font-bold text-white mb-1.5">1. Analyze 5-Year PYQs</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Over 70% of university exam questions follow recurring patterns. Practice 5-year solved papers to identify high-weightage topics.
            </p>
          </div>
          <div class="glass-card p-5 border-zinc-800">
            <span class="material-symbols-outlined text-cyan-400 text-3xl mb-3">draw</span>
            <h3 class="text-sm font-bold text-white mb-1.5">2. Diagrammatic Architecture</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              In technical evaluations, structured block diagrams, state machines, and code flowcharts score significantly higher than long paragraphs.
            </p>
          </div>
          <div class="glass-card p-5 border-zinc-800">
            <span class="material-symbols-outlined text-indigo-400 text-3xl mb-3">timer</span>
            <h3 class="text-sm font-bold text-white mb-1.5">3. Active Spaced Repetition</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Use our quick formula cheat sheets 24 hours and 7 days after initial study to cement technical definitions in long-term memory.
            </p>
          </div>
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-4 pt-6 border-t border-white/[0.08]">
          <h3 class="text-base font-bold text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-400">help</span> Frequently Asked Questions
          </h3>
          
          <div class="space-y-3">
            <details class="glass-card p-4 cursor-pointer group">
              <summary class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                Are these notes and question papers free to download?
                <span class="material-symbols-outlined text-zinc-400 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                Yes, 100% of study notes, previous year question papers, and laboratory experiment manuals are completely free with zero registration required.
              </p>
            </details>

            <details class="glass-card p-4 cursor-pointer group">
              <summary class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                Which engineering branches are supported in the repository?
                <span class="material-symbols-outlined text-zinc-400 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                We support Computer Science & Engineering (CS), Mechanical Engineering (ME), Electronics & Communication (EC), and Civil Engineering (CE) across semesters 1 to 8.
              </p>
            </details>
          </div>
        </div>

      </section>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>
