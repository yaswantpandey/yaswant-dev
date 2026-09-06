<?php require_once __DIR__ . '/../includes/layout.php';
require_once __DIR__ . '/../includes/data.php';

// Fetch articles first so schema_blog() includes real post data
$articles = get_articles();

// Blog schema — uses URL_BLOG canonical
$schema = schema_blog($articles);

nexus_head(
  'Yaswant Pandey Tech & Engineering Blog — System Design & Tutorials',
  'Read in-depth technical articles, system design guides, React performance tips, and career advice by Yaswant Pandey and the engineering team.',
  'Yaswant Pandey blog, engineering blog by Yaswant Pandey, technical articles, system design, software engineering career advice, React performance, Kubernetes tutorials',
  URL_BLOG,
  ['type' => 'blog', 'title' => 'Yaswant Pandey Tech & Engineering Blog'],
  $schema
);

$activeFilter = $_GET['cat'] ?? 'All';
if ($activeFilter !== 'All') {
  $articles = array_filter($articles, fn($a) => $a['cat'] === $activeFilter);
}
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('blog');
  nexus_topbar('blog'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-xl">
      
      <!-- ── Breadcrumbs ─────────────────────────────────────────── -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
        <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
        <span class="text-zinc-600">/</span>
        <span class="text-zinc-300">Engineering Blog</span>
      </nav>

      <!-- ── Header Banner ───────────────────────────────────────── -->
      <div class="bg-gradient-to-r from-zinc-950 via-zinc-900 to-zinc-950 rounded-2xl p-6 md:p-8 border border-zinc-800 shadow-xl relative overflow-hidden">
        <div class="space-y-2 max-w-3xl">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Technical Knowledge Base
          </div>
          <h1 class="text-2xl md:text-4xl font-black text-white tracking-tight">
            Yaswant Pandey <span class="gradient-text">Engineering Blog</span>
          </h1>
          <p class="text-xs md:text-sm text-zinc-300 font-light leading-relaxed">
            In-depth engineering tutorials, distributed system architecture breakdowns, frontend performance optimization, and practical cybersecurity research.
          </p>
        </div>
      </div>

      <div class="flex flex-col lg:flex-row gap-xl">

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col gap-lg">

          <!-- Category Filter Tabs -->
          <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-zinc-800 sticky top-16 z-20 bg-black/90 backdrop-blur-md py-2">
            <?php foreach (['All', 'Technical', 'Career', 'Student Life', 'Research'] as $cat):
              $active = ($activeFilter === $cat);
              $cls = $active ? 'bg-emerald-500 text-black font-bold' : 'bg-zinc-900 text-zinc-400 hover:text-white hover:bg-zinc-800';
              ?>
              <a href="?cat=<?= urlencode($cat) ?>" class="px-4 py-1.5 rounded-xl text-xs font-mono transition-all whitespace-nowrap <?= $cls ?>"><?= $cat ?></a>
            <?php endforeach; ?>
          </div>

          <!-- Article Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($articles as $a): ?>
              <article class="flex flex-col bg-zinc-950 rounded-2xl overflow-hidden border border-zinc-800/80 hover:border-emerald-500/40 transition-all duration-300 shadow-md group">
                <a href="<?= URL_BLOG ?>/post.php?id=<?= $a['id'] ?>" class="block relative h-48 w-full overflow-hidden">
                  <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image:url('<?= htmlspecialchars($a['img'] ?: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800') ?>')"></div>
                  <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                  <div class="absolute top-3 right-3 bg-black/80 backdrop-blur-sm px-2.5 py-1 rounded-lg text-[10px] font-mono text-emerald-400 border border-emerald-500/20 uppercase font-bold">
                    <?= htmlspecialchars($a['cat']) ?>
                  </div>
                </a>
                <div class="p-5 flex flex-col flex-1 gap-3">
                  <h2 class="text-base md:text-lg font-bold text-white group-hover:text-emerald-400 transition-colors line-clamp-2">
                    <a href="<?= URL_BLOG ?>/post.php?id=<?= $a['id'] ?>"><?= htmlspecialchars($a['title']) ?></a>
                  </h2>
                  <p class="text-xs text-zinc-400 line-clamp-3 font-light leading-relaxed"><?= htmlspecialchars($a['excerpt']) ?></p>
                  <div class="mt-auto pt-4 flex items-center justify-between border-t border-zinc-900 text-xs font-mono">
                    <span class="text-zinc-300"><?= htmlspecialchars($a['author']) ?></span>
                    <span class="text-zinc-500 flex items-center gap-1">
                      <span class="material-symbols-outlined text-[14px] text-cyan-400">schedule</span> <?= $a['read'] ?? '5 min' ?>
                    </span>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>

        </div>

        <!-- Sidebar -->
        <aside class="w-full lg:w-[320px] flex flex-col gap-6 shrink-0">
          
          <!-- Author Card -->
          <div class="bg-zinc-950 p-6 rounded-2xl border border-zinc-800 shadow-md">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-emerald-500 to-cyan-500 text-black flex items-center justify-center font-bold text-lg font-mono">
                YP
              </div>
              <div>
                <h3 class="text-sm font-bold text-white">Yaswant Pandey</h3>
                <p class="text-[11px] text-emerald-400 font-mono">Creator & Chief Architect</p>
              </div>
            </div>
            <p class="text-xs text-zinc-400 font-light leading-relaxed mb-4">
              Building open-source cyber security utilities, developer tools, and learning materials for engineering students worldwide.
            </p>
            <a href="<?= URL_HOME ?>" class="text-xs font-mono text-cyan-400 hover:underline flex items-center gap-1">
              Explore Portfolio & Ecosystem <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
          </div>

          <!-- Newsletter Signup -->
          <div class="bg-gradient-to-br from-zinc-950 to-zinc-900 p-6 rounded-2xl border border-zinc-800 shadow-lg relative overflow-hidden">
            <h3 class="text-base font-bold text-white mb-1">Tech Dispatch</h3>
            <p class="text-xs text-zinc-400 mb-4 font-light leading-relaxed">Weekly deep dives into system architecture & internships.</p>
            <form method="POST" action="api/newsletter.php" class="flex flex-col gap-2.5">
              <input name="email" type="email" required placeholder="name@university.edu" class="w-full bg-black border border-zinc-800 text-white placeholder:text-zinc-600 text-xs px-3.5 py-2.5 rounded-xl focus:outline-none focus:border-emerald-500 font-mono" />
              <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-black text-xs font-mono font-bold py-2.5 rounded-xl transition-all shadow-md">Subscribe Free</button>
            </form>
          </div>

        </aside>

      </div>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>
