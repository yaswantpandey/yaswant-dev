<?php require_once 'includes/layout.php';
$breadcrumb = json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://yaswant.co.in/'],
    ['@type' => 'ListItem', 'position' => 2, 'name' => 'App Tracker', 'item' => 'https://yaswant.co.in/tracker.php'],
  ]
]);
nexus_head(
  'Application Tracker — Manage Your Job Search Pipeline',
  'Track all your job and internship applications in one Kanban board. Monitor interview stages, upcoming deadlines, offer negotiations, and response rates.',
  'job application tracker, internship tracker, job search pipeline, Kanban job tracker, interview tracker, offer negotiation, engineering job search',
  'https://yaswant.co.in/tracker.php',
  [],
  $breadcrumb
);

$columns = [
  'Applied' => [
    'color' => 'outline-variant',
    'count' => 12,
    'cards' => [
      ['company' => 'Stripe', 'role' => 'Frontend Engineer', 'date' => 'Oct 12', 'location' => 'San Francisco, CA'],
      ['company' => 'Vercel', 'role' => 'Developer Advocate', 'date' => 'Oct 10', 'location' => 'Remote'],
    ]
  ],
  'Interviewing' => [
    'color' => 'primary',
    'count' => 6,
    'cards' => [
      ['company' => 'Netflix', 'role' => 'Senior UI Engineer', 'date' => 'Oct 8', 'location' => 'Los Gatos, CA', 'next' => 'System Design • Oct 25, 2:00 PM'],
    ]
  ],
  'Offer' => [
    'color' => 'secondary',
    'count' => 2,
    'cards' => [
      ['company' => 'Google', 'role' => 'L4 Software Engineer', 'date' => 'Oct 1', 'location' => 'Mountain View', 'pay' => '$185k Base + Equity'],
    ]
  ],
  'Rejected' => [
    'color' => 'outline',
    'count' => 8,
    'cards' => [
      ['company' => 'Meta', 'role' => 'Fullstack Eng', 'date' => 'Sep 20', 'location' => 'Menlo Park'],
    ]
  ],
];

$metrics = [
  ['label' => 'Total Sent', 'val' => '42', 'sub' => '+12 this week', 'icon' => 'send', 'color' => 'primary'],
  ['label' => 'Response Rate', 'val' => '28%', 'sub' => 'Avg: 15%', 'icon' => 'mark_email_read', 'color' => 'secondary'],
  ['label' => 'Interview Rate', 'val' => '14%', 'sub' => '6 Active', 'icon' => 'mic', 'color' => 'tertiary'],
  ['label' => 'Offers', 'val' => '2', 'sub' => 'Negotiating', 'icon' => 'workspace_premium', 'color' => 'primary'],
];
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('tracker');
  nexus_topbar('tracker'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-2xl">

      <!-- Header -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-md">
        <div>
          <h1 class="font-display-lg text-display-lg text-on-surface mb-sm">Application Tracker</h1>
          <p class="font-body-lg text-on-surface-variant">Manage your job search pipeline and track interviews.</p>
        </div>
        <button
          class="bg-primary hover:bg-primary-fixed text-on-primary font-label-sm px-lg py-md rounded-lg shadow-lg shadow-primary/20 transition-all flex items-center gap-sm shrink-0">
          <span class="material-symbols-outlined" aria-hidden="true">add</span> New Application
        </button>
      </div>

      <!-- Metrics -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-lg">
        <?php foreach ($metrics as $m): ?>
          <div class="bg-surface-container rounded-xl p-lg shadow-md relative overflow-hidden group">
            <div
              class="absolute -right-4 -top-4 w-24 h-24 bg-<?= $m['color'] ?>/10 rounded-full blur-2xl group-hover:bg-<?= $m['color'] ?>/20 transition-all"
              aria-hidden="true"></div>
            <div class="flex justify-between items-start mb-md relative z-10">
              <span class="font-label-sm uppercase tracking-wider text-outline"><?= $m['label'] ?></span>
              <span class="material-symbols-outlined text-<?= $m['color'] ?>" aria-hidden="true"><?= $m['icon'] ?></span>
            </div>
            <div class="flex items-baseline gap-sm relative z-10">
              <span class="font-display-lg-mobile text-display-lg-mobile text-on-surface"><?= $m['val'] ?></span>
              <span class="text-sm text-on-surface-variant"><?= $m['sub'] ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Kanban + Widgets -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-xl">

        <!-- Kanban Board -->
        <div class="col-span-1 lg:col-span-2 flex flex-col gap-lg">
          <h2 class="font-headline-md text-headline-md text-on-surface">Pipeline</h2>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-md overflow-x-auto pb-lg">
            <?php foreach ($columns as $colName => $col): ?>
              <div class="flex flex-col gap-sm min-w-[200px]">
                <div class="flex items-center gap-xs mb-sm px-xs">
                  <span
                    class="w-2 h-2 rounded-full bg-<?= $col['color'] ?> <?= $colName === 'Interviewing' ? 'animate-pulse' : '' ?>"
                    aria-hidden="true"></span>
                  <span class="font-label-sm uppercase tracking-wider text-<?= $col['color'] ?>"><?= $colName ?></span>
                  <span
                    class="bg-surface-variant text-on-surface-variant px-2 py-0.5 rounded-full text-[10px] ml-auto"><?= $col['count'] ?></span>
                </div>
                <?php foreach ($col['cards'] as $card): ?>
                  <article
                    class="bg-surface-container hover:bg-surface-container-high p-md rounded-xl shadow-sm transition-all cursor-pointer border border-transparent hover:border-outline-variant/30 <?= $colName === 'Rejected' ? 'opacity-60 grayscale' : '' ?>">
                    <div class="flex items-center gap-sm mb-md">
                      <div
                        class="w-8 h-8 rounded bg-surface-variant flex items-center justify-center text-on-surface font-bold text-xs shrink-0"
                        aria-hidden="true">
                        <?= strtoupper(substr($card['company'], 0, 1)) ?>
                      </div>
                      <div class="min-w-0">
                        <h3
                          class="font-label-sm text-on-surface truncate <?= $colName === 'Rejected' ? 'line-through decoration-outline' : '' ?>">
                          <?= htmlspecialchars($card['company']) ?>
                        </h3>
                        <p class="text-[12px] text-outline truncate"><?= htmlspecialchars($card['location']) ?></p>
                      </div>
                    </div>
                    <p class="font-body-md text-on-surface mb-sm text-sm"><?= htmlspecialchars($card['role']) ?></p>
                    <?php if (!empty($card['next'])): ?>
                      <div class="mt-md bg-surface rounded-lg p-sm flex items-start gap-sm border border-primary/20">
                        <span class="material-symbols-outlined text-primary text-[16px] mt-0.5 shrink-0"
                          aria-hidden="true">event</span>
                        <div>
                          <span class="text-[11px] font-bold text-primary block">Next Interview</span>
                          <span class="text-[11px] text-on-surface-variant"><?= htmlspecialchars($card['next']) ?></span>
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php if (!empty($card['pay'])): ?>
                      <div class="mt-md pt-sm border-t border-outline-variant/20">
                        <span class="text-secondary font-code-block text-[12px]"><?= htmlspecialchars($card['pay']) ?></span>
                      </div>
                    <?php endif; ?>
                    <div class="flex items-center justify-between text-[11px] text-outline-variant mt-md">
                      <span>Applied: <?= htmlspecialchars($card['date']) ?></span>
                    </div>
                  </article>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Right Widgets -->
        <div class="col-span-1 flex flex-col gap-xl">
          <!-- Upcoming Interviews -->
          <div class="bg-surface-container-low rounded-2xl p-lg shadow-md border border-outline-variant/10">
            <h3 class="font-headline-md text-[18px] text-on-surface flex items-center gap-sm mb-lg">
              <span class="material-symbols-outlined text-primary" aria-hidden="true">calendar_month</span> Upcoming
            </h3>
            <div class="space-y-md">
              <?php
              $upcoming = [
                ['month' => 'Oct', 'day' => '25', 'company' => 'Netflix', 'type' => 'System Design (Virtual)', 'time' => '2:00 PM'],
                ['month' => 'Oct', 'day' => '28', 'company' => 'Linear', 'type' => 'Founder Chat', 'time' => '10:30 AM'],
              ];
              foreach ($upcoming as $u): ?>
                <div class="flex gap-md group">
                  <div class="flex flex-col items-center min-w-[48px]">
                    <span class="text-[10px] uppercase font-bold text-outline-variant"><?= $u['month'] ?></span>
                    <span class="text-xl font-display-lg text-primary"><?= $u['day'] ?></span>
                  </div>
                  <div
                    class="bg-surface-container p-md rounded-xl flex-1 shadow-sm group-hover:-translate-y-1 transition-transform border border-transparent group-hover:border-primary/20">
                    <div class="flex justify-between items-start mb-xs">
                      <h4 class="font-label-sm text-on-surface"><?= htmlspecialchars($u['company']) ?></h4>
                      <span class="text-[11px] text-outline"><?= $u['time'] ?></span>
                    </div>
                    <p class="text-[13px] text-on-surface-variant"><?= htmlspecialchars($u['type']) ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- AI Resume CTA -->
          <div
            class="bg-gradient-to-br from-secondary-container to-surface-container p-lg rounded-2xl shadow-xl relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-secondary opacity-20 rounded-bl-full blur-xl"
              aria-hidden="true"></div>
            <div class="relative z-10 flex flex-col gap-md">
              <div class="bg-secondary/20 w-12 h-12 rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-secondary" aria-hidden="true">auto_awesome</span>
              </div>
              <h3 class="font-headline-md text-xl text-on-surface">AI Resume Polish</h3>
              <p class="text-sm text-on-surface-variant">Match your resume against job descriptions to increase callback
                rate.</p>
              <a href="resume.php"
                class="bg-secondary text-on-secondary font-label-sm px-md py-sm rounded-lg shadow-md hover:bg-secondary-fixed transition-colors flex justify-center items-center gap-xs">
                Scan Resume <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>