<?php
// blog/post.php — Full Article Reader View with Rich On-Page SEO
require_once __DIR__ . '/../includes/layout.php';
require_once __DIR__ . '/../includes/data.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article = $id > 0 ? get_article_by_id($id) : null;

if (!$article) {
  header('Location: ' . URL_BLOG);
  exit;
}

$allArticles = get_articles();
$related = array_values(array_filter($allArticles, fn($a) => $a['id'] !== $article['id']));

$canonicalUrl = URL_BLOG . '/post.php?id=' . $article['id'];
$schema = schema_article($article);

$og = [
  'type' => 'article',
  'title' => $article['title'] . ' — Yaswant Pandey Blog',
  'desc' => $article['excerpt'],
  'image' => $article['img'] ?: (URL_HOME . '/assets/og-cover.png'),
];

nexus_head(
  htmlspecialchars($article['title']),
  htmlspecialchars($article['excerpt']),
  htmlspecialchars('Yaswant Pandey, ' . $article['title'] . ', ' . strtolower($article['cat']) . ', engineering tutorial, system design, software development'),
  $canonicalUrl,
  $og,
  $schema
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('blog'); nexus_topbar('blog'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-4xl mx-auto p-lg space-y-lg">
    
    <!-- ── Breadcrumbs ─────────────────────────────────────────── -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
      <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
      <span class="text-zinc-600">/</span>
      <a href="<?= URL_BLOG ?>" class="hover:text-emerald-400 transition-colors">Blog</a>
      <span class="text-zinc-600">/</span>
      <a href="<?= URL_BLOG ?>?cat=<?= urlencode($article['cat']) ?>" class="hover:text-cyan-400 transition-colors"><?= htmlspecialchars($article['cat']) ?></a>
      <span class="text-zinc-600">/</span>
      <span class="text-zinc-300 truncate max-w-[200px] md:max-w-md"><?= htmlspecialchars($article['title']) ?></span>
    </nav>

    <!-- ── Article Header ──────────────────────────────────────── -->
    <header class="space-y-md">
      <div class="flex items-center gap-sm flex-wrap">
        <span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono uppercase font-bold">
          <?= htmlspecialchars($article['cat']) ?>
        </span>
        <span class="text-zinc-400 text-xs font-mono flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px] text-cyan-400">schedule</span> <?= htmlspecialchars($article['read']) ?> read
        </span>
        <span class="text-zinc-500 text-xs font-mono">Published <?= date('M d, Y', strtotime($article['created_at'] ?? 'now')) ?></span>
      </div>

      <h1 class="font-display-lg text-2xl md:text-4xl text-white leading-tight font-black tracking-tight">
        <?= htmlspecialchars($article['title']) ?>
      </h1>

      <div class="flex items-center justify-between pt-sm border-t border-zinc-800">
        <div class="flex items-center gap-sm">
          <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-500 to-cyan-500 text-black flex items-center justify-center font-bold text-sm shadow-md">
            <?= strtoupper(substr($article['author'], 0, 1)) ?>
          </div>
          <div>
            <div class="text-sm font-bold text-white"><?= htmlspecialchars($article['author']) ?></div>
            <div class="text-xs text-zinc-400">Technical Writer & Engineer &bull; Yaswant Dev</div>
          </div>
        </div>
        
        <!-- Social Share Quick Action -->
        <div class="flex items-center gap-2">
          <button onclick="navigator.clipboard.writeText(window.location.href); alert('Article link copied to clipboard!');" class="p-2 rounded-xl bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-emerald-400 transition-colors flex items-center gap-1 text-xs font-mono" title="Copy Link">
            <span class="material-symbols-outlined text-[18px]">share</span> Share
          </button>
        </div>
      </div>
    </header>

    <!-- Cover Image with Semantic Alt -->
    <?php if (!empty($article['img'])): ?>
      <div class="w-full h-72 md:h-[400px] rounded-2xl overflow-hidden shadow-2xl border border-zinc-800 relative">
        <img src="<?= htmlspecialchars($article['img']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-full h-full object-cover" loading="eager" decoding="async"/>
      </div>
    <?php endif; ?>

    <!-- Abstract / Excerpt Box -->
    <div class="bg-zinc-900/80 border-l-4 border-emerald-500 p-lg rounded-r-2xl text-zinc-300 italic text-sm md:text-base leading-relaxed shadow-sm border-t border-r border-b border-zinc-800/80">
      "<?= htmlspecialchars($article['excerpt']) ?>"
    </div>

    <!-- Main Rich Content -->
    <article class="prose prose-invert max-w-none text-zinc-200 space-y-md leading-relaxed text-sm md:text-base border-b border-zinc-800 pb-xl">
      <?php if (!empty($article['content'])): ?>
        <?= $article['content'] ?>
      <?php else: ?>
        <p class="text-zinc-400">Full article content is being compiled for publication.</p>
      <?php endif; ?>
    </article>

    <!-- Author Bio Card (E-E-A-T Signal) -->
    <div class="bg-zinc-950 rounded-2xl p-6 flex flex-col sm:flex-row items-center sm:items-start gap-4 border border-zinc-800 shadow-md">
      <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-500 to-cyan-500 text-black flex items-center justify-center text-xl font-bold shrink-0 shadow-lg">
        <?= strtoupper(substr($article['author'], 0, 1)) ?>
      </div>
      <div class="text-center sm:text-left">
        <h3 class="text-base font-bold text-white">Written by <?= htmlspecialchars($article['author']) ?></h3>
        <p class="text-xs text-zinc-400 mt-1 leading-relaxed">
          Technical researcher & contributor at <strong>Yaswant Dev</strong>. Passionate about distributed systems, modern web architecture, and cybersecurity best practices.
        </p>
        <div class="mt-3 flex items-center justify-center sm:justify-start gap-2">
          <a href="<?= URL_HOME ?>" class="text-xs font-mono text-emerald-400 hover:underline flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">language</span> Yaswant Dev Ecosystem
          </a>
        </div>
      </div>
    </div>

    <!-- Related Articles Grid -->
    <?php if (!empty($related)): ?>
      <section class="space-y-md pt-lg border-t border-zinc-800" aria-labelledby="related-heading">
        <h2 id="related-heading" class="text-lg font-bold text-white flex items-center gap-2">
          <span class="material-symbols-outlined text-emerald-400">auto_stories</span> Recommended Reading
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
          <?php foreach (array_slice($related, 0, 2) as $rel): ?>
            <a href="post.php?id=<?= $rel['id'] ?>" class="p-md rounded-2xl bg-zinc-900 border border-zinc-800 hover:border-emerald-500/40 transition-all flex flex-col justify-between group">
              <div>
                <span class="text-[10px] font-mono uppercase text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded"><?= htmlspecialchars($rel['cat']) ?></span>
                <h3 class="text-sm font-bold text-white group-hover:text-emerald-400 transition-colors mt-2"><?= htmlspecialchars($rel['title']) ?></h3>
                <p class="text-xs text-zinc-400 line-clamp-2 mt-1 font-light"><?= htmlspecialchars($rel['excerpt']) ?></p>
              </div>
              <span class="text-xs font-mono text-cyan-400 flex items-center gap-1 mt-3">Read Article <span class="material-symbols-outlined text-[14px]">arrow_forward</span></span>
            </a>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>

  </main>
  <?php nexus_footer(); ?>
</div>
