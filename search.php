<?php require_once 'includes/layout.php';
require_once 'includes/data.php';

$q = trim($_GET['q'] ?? '');
nexus_head(
  $q ? 'Search: ' . $q . ' — Yaswant Dev' : 'Search — Find Courses, Resources & Internships',
  'Search across all Yaswant Dev content: study notes, free courses, internship listings, developer tools, and blog articles.',
  'yaswant dev search, find engineering courses, search internships, engineering platform search',
  'https://yaswant.co.in/search.php'
);

$catalog = [];

// Fetch live resources from MySQL
foreach (get_resources() as $r) {
    $catalog[] = [
        'type'  => 'Resource',
        'title' => $r['title'] ?? '',
        'href'  => URL_RESOURCES,
        'color' => $r['color'] ?? 'primary',
        'icon'  => 'description'
    ];
}

// Fetch live courses from MySQL
foreach (get_courses() as $c) {
    $catalog[] = [
        'type'  => 'Course',
        'title' => $c['title'] ?? '',
        'href'  => URL_COURSES,
        'color' => $c['color'] ?? 'tertiary',
        'icon'  => $c['icon'] ?? 'school'
    ];
}

// Fetch live jobs/internships from MySQL
foreach (get_jobs() as $j) {
    $catalog[] = [
        'type'  => 'Internship',
        'title' => ($j['title'] ?? '') . ' – ' . ($j['company'] ?? ''),
        'href'  => URL_INTERNSHIPS,
        'color' => $j['color'] ?? 'secondary',
        'icon'  => 'work'
    ];
}

// Fetch live blog articles from MySQL
foreach (get_articles() as $a) {
    $catalog[] = [
        'type'  => 'Blog',
        'title' => $a['title'] ?? '',
        'href'  => URL_BLOG,
        'color' => 'primary',
        'icon'  => 'article'
    ];
}

// Platform utilities
$tools = [
    ['type' => 'Tool', 'title' => 'GPA Calculator', 'href' => URL_TOOLS, 'color' => 'primary', 'icon' => 'calculate'],
    ['type' => 'Tool', 'title' => 'Code Formatter', 'href' => URL_TOOLS, 'color' => 'secondary', 'icon' => 'code'],
    ['type' => 'Tool', 'title' => 'JSON Validator', 'href' => URL_TOOLS, 'color' => 'tertiary', 'icon' => 'data_object'],
    ['type' => 'Tool', 'title' => 'API Tester', 'href' => URL_TOOLS, 'color' => 'primary', 'icon' => 'api'],
    ['type' => 'Tool', 'title' => 'ATS Resume Builder', 'href' => URL_RESUME, 'color' => 'secondary', 'icon' => 'description'],
];
$catalog = array_merge($catalog, $tools);

$results = $q
  ? array_values(array_filter($catalog, fn($item) =>
    stripos($item['title'], $q) !== false || stripos($item['type'], $q) !== false))
  : [];
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('');
  nexus_topbar(''); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-xl">

      <form method="GET" class="w-full max-w-2xl" role="search" aria-label="Search Nexus">
        <div class="relative group">
          <div
            class="absolute -inset-1 bg-gradient-to-r from-primary to-secondary rounded-xl blur opacity-20 group-hover:opacity-40 transition duration-500">
          </div>
          <div
            class="relative flex items-center bg-surface-container-lowest/80 backdrop-blur-xl rounded-xl p-xs shadow-xl">
            <span class="material-symbols-outlined text-outline ml-sm" aria-hidden="true">search</span>
            <input name="q" value="<?= htmlspecialchars($q) ?>" autofocus aria-label="Search query"
              class="flex-1 bg-transparent text-on-surface font-body-md placeholder-outline border-none focus:outline-none px-md py-sm"
              placeholder="Search notes, courses, internships…" />
            <button type="submit"
              class="bg-primary text-on-primary font-label-sm px-lg py-sm rounded-lg transition-all shadow-md">Search</button>
          </div>
        </div>
      </form>

      <?php if ($q): ?>
        <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
          <h1 class="font-headline-md text-[20px] text-on-surface">
            Results for "<span class="text-primary"><?= htmlspecialchars($q) ?></span>"
            <span class="text-on-surface-variant text-[14px] font-normal ml-xs">(<?= count($results) ?> found)</span>
          </h1>
        </div>

        <?php if (!empty($results)): ?>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">
            <?php foreach ($results as $r): ?>
              <a href="<?= htmlspecialchars($r['href']) ?>"
                class="bg-surface-container hover:bg-surface-container-high rounded-xl p-md flex items-start gap-md shadow-sm hover:shadow-md transition-all group border border-outline-variant/10 hover:border-<?= $r['color'] ?>/30">
                <div
                  class="w-10 h-10 rounded-lg bg-<?= $r['color'] ?>/10 flex items-center justify-center text-<?= $r['color'] ?> shrink-0 group-hover:bg-<?= $r['color'] ?> group-hover:text-on-<?= $r['color'] ?> transition-colors">
                  <span class="material-symbols-outlined" aria-hidden="true"><?= $r['icon'] ?></span>
                </div>
                <div class="flex-1 min-w-0">
                  <span
                    class="text-[10px] font-label-sm uppercase text-<?= $r['color'] ?> bg-<?= $r['color'] ?>/10 px-xs py-[2px] rounded"><?= $r['type'] ?></span>
                  <h2
                    class="font-headline-md text-[15px] text-on-surface mt-xs line-clamp-2 group-hover:text-<?= $r['color'] ?> transition-colors">
                    <?= htmlspecialchars($r['title']) ?>
                  </h2>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="text-center py-2xl">
            <span class="material-symbols-outlined text-[64px] text-outline mb-md block"
              aria-hidden="true">search_off</span>
            <p class="font-body-lg text-on-surface-variant">No results found for "<?= htmlspecialchars($q) ?>".</p>
            <a href="index.php" class="text-primary hover:underline font-label-sm mt-md inline-block">Back to Home</a>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <div class="text-center py-2xl text-on-surface-variant font-body-md">
          <span class="material-symbols-outlined text-[64px] text-outline mb-md block"
            aria-hidden="true">manage_search</span>
          Enter a search term above to find resources, courses, internships, and more.
        </div>
      <?php endif; ?>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>