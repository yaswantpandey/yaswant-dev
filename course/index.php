<?php require_once __DIR__ . '/../includes/layout.php';
require_once __DIR__ . '/../includes/data.php';

// Fetch courses first so schema_courses() can include real course data
$courses = get_courses();

// ItemList + Course schema — uses URL_COURSES canonical
$schema = schema_courses($courses);

nexus_head(
  'Free Computer Science & Engineering Courses 2026 — DSA, ML, OS & Web Dev',
  'Access 100% free open-source engineering courses curated by Yaswant Pandey: Data Structures & Algorithms, Machine Learning, Linux OS Kernel, Full-Stack Web Development, and Databases.',
  'free engineering courses 2026, data structures algorithms course, machine learning course, operating systems course, web development course, SQL database course, computer networks course, free CS curriculum, courses by Yaswant Pandey',
  URL_COURSES,
  ['type' => 'website', 'title' => 'Free Engineering Courses 2026 — Yaswant Dev'],
  $schema
);

$search = trim($_GET['q'] ?? '');
if ($search) {
  $courses = array_filter($courses, function ($c) use ($search) {
    return stripos($c['title'], $search) !== false || stripos($c['tag'], $search) !== false;
  });
}
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('courses');
  nexus_topbar('courses'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-xl">

      <!-- ── Breadcrumbs ─────────────────────────────────────────── -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
        <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
        <span class="text-zinc-600">/</span>
        <span class="text-zinc-300">Free Engineering Courses</span>
      </nav>

      <!-- ── Header Banner ───────────────────────────────────────── -->
      <div
        class="bg-gradient-to-r from-zinc-950 via-zinc-900 to-zinc-950 rounded-2xl p-6 md:p-8 border border-zinc-800 shadow-xl relative overflow-hidden">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
          <div class="space-y-2 max-w-2xl">
            <div
              class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> 100% Free Open-Source
              Curriculum
            </div>
            <h1 class="text-2xl md:text-4xl font-black text-white tracking-tight">
              Computer Science & <span class="gradient-text">Engineering Courses</span>
            </h1>
            <p class="text-xs md:text-sm text-zinc-300 font-light leading-relaxed">
              Curated syllabus covering foundational to advanced engineering topics: Data Structures, Operating Systems
              Kernel, Applied AI/ML, and Full-Stack Systems.
            </p>
          </div>

          <div class="flex items-center gap-3 shrink-0">
            <a href="<?= URL_RESOURCES ?>"
              class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white px-4 py-2.5 rounded-xl font-mono text-xs font-bold transition-all shadow-md flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[16px] text-cyan-400">library_books</span> Notes & PYQs
            </a>
          </div>
        </div>
      </div>

      <!-- ── Search & Filter Bar ─────────────────────────────────── -->
      <form method="GET"
        class="bg-zinc-950 border border-zinc-800 rounded-2xl p-4 shadow-lg flex flex-col md:flex-row items-center gap-3"
        role="search" aria-label="Search courses">
        <div
          class="flex-1 w-full bg-black border border-zinc-800 rounded-xl flex items-center px-4 py-2.5 focus-within:border-emerald-500 transition-colors">
          <span class="material-symbols-outlined text-zinc-500 mr-2 text-[20px]">search</span>
          <label for="course-search" class="sr-only">Search courses</label>
          <input id="course-search" name="q" value="<?= htmlspecialchars($search) ?>"
            class="bg-transparent border-none outline-none text-white text-xs md:text-sm font-mono w-full placeholder:text-zinc-600"
            placeholder="Search courses (e.g. DSA, Machine Learning, Operating Systems, Backend)..." />
        </div>
        <button type="submit"
          class="bg-emerald-500 hover:bg-emerald-400 text-black px-6 py-2.5 rounded-xl font-mono text-xs font-bold flex items-center gap-1.5 shrink-0 transition-colors shadow-md">
          Filter Courses <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
        </button>
        <?php if ($search): ?>
          <a href="<?= URL_COURSES ?>" class="text-zinc-400 text-xs font-mono hover:text-white px-2">Clear</a>
        <?php endif; ?>
      </form>

      <!-- ── Course Grid ─────────────────────────────────────────── -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($courses as $c):
          $courseLink = !empty($c['playlist_url']) ? $c['playlist_url'] : null;
          // isRoadmap = any internal relative URL (starts with /) = a detail/roadmap page we built
          $isRoadmap = !empty($c['playlist_url']) && substr($c['playlist_url'], 0, 1) === '/';
          $tagClass = 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20';
          ?>
          <article
            class="bg-zinc-950 border border-zinc-800/80 hover:border-emerald-500/40 rounded-2xl p-6 transition-all duration-300 shadow-md hover:shadow-xl group flex flex-col justify-between<?= $courseLink ? ' cursor-pointer' : '' ?>"
            <?= $courseLink ? ' onclick="window.location=\'' . htmlspecialchars($courseLink) . '\'"' : '' ?>
            role="<?= $courseLink ? 'link' : 'article' ?>">
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <div
                  class="w-12 h-12 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-emerald-400 group-hover:bg-emerald-500/10 transition-colors">
                  <span
                    class="material-symbols-outlined text-[26px]"><?= htmlspecialchars($c['icon'] ?? 'school') ?></span>
                </div>
                <div class="flex items-center gap-2">
                  <?php if ($isRoadmap): ?>
                    <span
                      class="text-[10px] font-mono uppercase text-amber-400 bg-amber-500/10 px-2 py-1 rounded-md border border-amber-500/20 flex items-center gap-1">
                      <span class="material-symbols-outlined text-[12px]">map</span> Roadmap
                    </span>
                  <?php endif; ?>
                  <span class="text-[10px] font-mono uppercase <?= $tagClass ?> px-2.5 py-1 rounded-md border">
                    <?= htmlspecialchars($c['tag']) ?>
                  </span>
                </div>
              </div>

              <div>
                <h3
                  class="text-base md:text-lg font-bold text-white group-hover:text-emerald-400 transition-colors line-clamp-2">
                  <?= htmlspecialchars($c['title']) ?>
                </h3>
                <div class="flex items-center gap-3 mt-3 text-xs font-mono text-zinc-400">
                  <span class="flex items-center gap-1"><span
                      class="material-symbols-outlined text-[15px] text-cyan-400">play_lesson</span> <?= $c['lessons'] ?>
                    Lessons</span>
                  <span>&bull;</span>
                  <span class="text-zinc-300"><?= htmlspecialchars($c['level']) ?></span>
                </div>
              </div>
            </div>

            <div class="mt-6 pt-4 border-t border-zinc-900">
              <?php if ($courseLink): ?>
                <a href="<?= htmlspecialchars($courseLink) ?>"
                  class="w-full bg-zinc-900 hover:bg-emerald-500 hover:text-black text-white text-xs font-mono font-bold py-2.5 rounded-xl transition-all flex items-center justify-center gap-1.5 border border-zinc-800 hover:border-transparent">
                  <?= $isRoadmap ? 'View Roadmap' : 'Start Learning Free' ?> <span
                    class="material-symbols-outlined text-[15px]">arrow_forward</span>
                </a>
              <?php else: ?>
                <button onclick="alert('Launching free syllabus and playlist for <?= htmlspecialchars($c['title']) ?>...')"
                  class="w-full bg-zinc-900 hover:bg-emerald-500 hover:text-black text-white text-xs font-mono font-bold py-2.5 rounded-xl transition-all flex items-center justify-center gap-1.5 border border-zinc-800 hover:border-transparent">
                  Start Learning Free <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
                </button>
              <?php endif; ?>
            </div>
          </article>
        <?php endforeach; ?>

        <?php if (empty($courses)): ?>
          <div class="col-span-full text-center py-16 text-zinc-400 font-mono">
            <span class="material-symbols-outlined text-[48px] text-zinc-600 mb-2 block">search_off</span>
            No courses found matching "<?= htmlspecialchars($search) ?>". <a href="<?= URL_COURSES ?>"
              class="text-emerald-400 hover:underline">Reset Filters</a>
          </div>
        <?php endif; ?>
      </div>

      <!-- ── On-Page SEO Guide & FAQ Section ──────────────────────── -->
      <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-10 shadow-2xl space-y-8 mt-6">
        <div>
          <span
            class="text-xs font-mono text-emerald-400 uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Learning
            Architecture</span>
          <h2 class="text-xl md:text-3xl font-black text-white mt-3">
            Self-Taught <span class="gradient-text">Computer Science Curriculum</span> in 2026
          </h2>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-2 leading-relaxed max-w-3xl">
            A comprehensive, zero-cost engineering roadmap designed to take undergraduate students from fundamental
            programming logic to distributed system architecture.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-emerald-400 text-2xl mb-2">account_tree</span>
            <h3 class="text-sm font-bold text-white mb-1">1. Algorithms & Complexity</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Master Big-O asymptotic analysis, dynamic programming, recursion trees, and binary search trees with
              hands-on practice.
            </p>
          </div>
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-cyan-400 text-2xl mb-2">memory</span>
            <h3 class="text-sm font-bold text-white mb-1">2. Systems & Linux Internals</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Understand CPU thread scheduling, POSIX sockets, virtual memory page tables, and file system block
              management.
            </p>
          </div>
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-indigo-400 text-2xl mb-2">storage</span>
            <h3 class="text-sm font-bold text-white mb-1">3. Databases & Distributed Scale</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              SQL B-Tree indexing, ACID isolation levels, Redis caching, microservices, and asynchronous event
              streaming.
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
              <summary
                class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                Do I need prior coding experience to start these courses?
                <span
                  class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                No. Courses marked with the "Beginner" tag introduce programming syntax from scratch in C++, Python, or
                JavaScript before diving into complex data structures.
              </p>
            </details>

            <details class="bg-zinc-900/80 rounded-xl p-4 border border-zinc-800/80 cursor-pointer group">
              <summary
                class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                Are certificates provided for course completion?
                <span
                  class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                Our courses focus on practical engineering competence and building real-world projects that you can
                showcase on your GitHub and ATS resume.
              </p>
            </details>
          </div>
        </div>

      </section>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>