<?php require_once 'includes/layout.php';
nexus_head(
    'Dashboard — Your Learning & Career Hub',
    'Your personal Nexus dashboard. Track course progress, study analytics, upcoming deadlines, recent files, and quick access to all engineering tools.',
    'engineering student dashboard, course progress tracker, study analytics, learning dashboard, engineering platform dashboard',
    'https://yaswant.co.in/dashboard.php'
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
<?php nexus_sidebar('dashboard'); nexus_topbar('dashboard'); ?>
<main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
<div class="flex flex-col w-full gap-2xl">

  <!-- Welcome + Daily Goal -->
  <section class="grid grid-cols-1 md:grid-cols-12 gap-gutter items-stretch" aria-labelledby="welcome-heading">
    <div class="col-span-1 md:col-span-8 bg-surface-container-high rounded-xl p-xl shadow-lg relative overflow-hidden flex flex-col justify-center min-h-[240px] md:min-h-[280px]">
      <div class="absolute -right-24 -top-24 w-96 h-96 bg-primary/20 rounded-full blur-[80px] pointer-events-none" aria-hidden="true"></div>
      <div class="absolute -left-12 -bottom-12 w-64 h-64 bg-secondary/10 rounded-full blur-[60px] pointer-events-none" aria-hidden="true"></div>
      <div class="relative z-10 flex flex-col gap-md md:w-3/4">
        <div class="flex items-center gap-sm">
          <div class="h-2 w-8 bg-primary rounded-full" aria-hidden="true"></div>
          <span class="font-label-sm text-primary uppercase tracking-widest">Dashboard</span>
        </div>
        <h1 id="welcome-heading" class="font-display-lg text-display-lg-mobile md:text-display-lg text-on-surface">
          Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Alex!</span>
        </h1>
        <p class="font-body-lg text-on-surface-variant">You're making great progress this semester. Keep up the momentum in Data Structures.</p>
        <div class="mt-md">
          <a href="resources.php" class="bg-primary text-on-primary px-lg py-sm rounded-lg font-label-sm hover:shadow-[0_0_15px_rgba(180,197,255,0.4)] transition-all inline-flex items-center gap-sm">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">play_arrow</span> Resume Learning
          </a>
        </div>
      </div>
    </div>
    <!-- Daily Goal -->
    <div class="col-span-1 md:col-span-4 bg-surface-container rounded-xl p-lg shadow-md flex flex-col items-center justify-center relative">
      <h2 class="font-headline-md text-body-lg text-on-surface absolute top-lg left-lg">Daily Goal</h2>
      <div class="relative w-36 h-36 md:w-40 md:h-40 mt-xl flex items-center justify-center" role="img" aria-label="Daily goal progress: 78%">
        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100" aria-hidden="true">
          <circle class="text-surface-variant" cx="50" cy="50" fill="none" r="45" stroke="currentColor" stroke-width="8"/>
          <circle class="text-primary" cx="50" cy="50" fill="none" r="45" stroke="currentColor" stroke-dasharray="283" stroke-dashoffset="62" stroke-linecap="round" stroke-width="8"/>
        </svg>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center" aria-hidden="true">
          <span class="font-display-lg-mobile text-display-lg-mobile text-on-surface">78<span class="text-body-md text-on-surface-variant">%</span></span>
          <span class="font-label-sm text-on-surface-variant">3h 12m left</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Courses + Widgets -->
  <section class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
    <div class="col-span-1 md:col-span-8 flex flex-col gap-xl">

      <!-- Continue Learning -->
      <div class="bg-surface-container rounded-xl overflow-hidden shadow-md group cursor-pointer hover:shadow-xl transition-all">
        <div class="h-28 md:h-32 relative bg-surface-container-high">
          <div class="absolute inset-0 bg-gradient-to-t from-surface-container to-transparent" aria-hidden="true"></div>
          <div class="absolute bottom-md left-lg">
            <span class="bg-primary/20 text-primary px-sm py-xs rounded font-label-sm text-[10px] uppercase tracking-widest backdrop-blur-sm">Last Viewed</span>
          </div>
        </div>
        <div class="p-lg flex justify-between items-center gap-md">
          <div class="flex-1 min-w-0">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-xs group-hover:text-primary transition-colors truncate">Advanced Tree Traversal Algorithms</h2>
            <p class="font-body-md text-on-surface-variant">CS301: Data Structures &amp; Algorithms</p>
          </div>
          <button class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-on-primary shadow-lg group-hover:scale-110 transition-transform shrink-0" aria-label="Continue learning">
            <span class="material-symbols-outlined" aria-hidden="true">play_arrow</span>
          </button>
        </div>
        <div class="w-full h-1 bg-surface-variant" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" aria-label="Course progress 65%">
          <div class="h-full bg-primary w-[65%]"></div>
        </div>
      </div>

      <!-- Active Courses -->
      <div>
        <div class="flex items-center justify-between mb-lg">
          <h2 class="font-headline-md text-[20px] text-on-surface flex items-center gap-sm">
            <span class="material-symbols-outlined text-primary" aria-hidden="true">school</span> Active Courses
          </h2>
          <a href="courses.php" class="font-label-sm text-primary hover:underline">View All</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
          <?php
          $activeCourses = [
            ['code'=>'OS','subject'=>'Operating Systems',    'num'=>'CS402','pct'=>42,'color'=>'secondary'],
            ['code'=>'ML','subject'=>'Machine Learning Basics','num'=>'CS510','pct'=>89,'color'=>'tertiary'],
          ];
          foreach ($activeCourses as $c): ?>
          <div class="bg-surface-container rounded-xl p-md shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between min-h-[140px] border border-outline-variant/10 hover:border-primary/30">
            <div>
              <div class="flex justify-between items-start mb-sm">
                <span class="w-8 h-8 rounded bg-<?= $c['color'] ?>/20 text-<?= $c['color'] ?> flex items-center justify-center text-sm font-bold"><?= $c['code'] ?></span>
                <span class="font-label-sm text-[11px] text-on-surface-variant bg-surface-variant px-2 py-1 rounded"><?= $c['num'] ?></span>
              </div>
              <h3 class="font-headline-md text-body-lg text-on-surface"><?= htmlspecialchars($c['subject']) ?></h3>
            </div>
            <div class="mt-md">
              <div class="flex justify-between font-label-sm text-[11px] mb-xs">
                <span class="text-on-surface-variant">Progress</span>
                <span class="text-<?= $c['color'] ?>"><?= $c['pct'] ?>%</span>
              </div>
              <div class="w-full h-1.5 bg-surface-variant rounded-full overflow-hidden" role="progressbar" aria-valuenow="<?= $c['pct'] ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?= htmlspecialchars($c['subject']) ?> progress">
                <div class="h-full bg-<?= $c['color'] ?> rounded-full" style="width:<?= $c['pct'] ?>%"></div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Study Analytics -->
      <div class="bg-surface-container rounded-xl p-lg shadow-md">
        <div class="flex justify-between items-center mb-xl">
          <h2 class="font-headline-md text-body-lg text-on-surface">Study Analytics</h2>
          <span class="font-label-sm text-xs text-on-surface-variant bg-surface-variant px-3 py-1 rounded">This Week</span>
        </div>
        <div class="h-48 w-full flex items-end justify-between gap-2 px-md pb-6" role="img" aria-label="Study hours bar chart for the week">
          <?php
          $days = [['Mon',30],['Tue',60],['Wed',90],['Thu',40],['Fri',20],['Sat',5],['Sun',5]];
          foreach ($days as [$day, $h]): ?>
          <div class="flex-1 flex flex-col items-center gap-2 group">
            <div class="w-full max-w-[40px] bg-primary/30 rounded-t-sm group-hover:bg-primary/60 transition-colors" style="height:<?= $h ?>%" aria-label="<?= $day ?>: <?= $h ?>% study time"></div>
            <span class="font-label-sm text-[10px] text-on-surface-variant"><?= $day ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Right Widgets -->
    <div class="col-span-1 md:col-span-4 flex flex-col gap-xl">
      <!-- Deadlines -->
      <div class="bg-surface-container rounded-xl p-lg shadow-md">
        <h2 class="font-headline-md text-body-lg text-on-surface mb-md flex items-center gap-sm">
          <span class="material-symbols-outlined text-error" aria-hidden="true">event</span> Upcoming Deadlines
        </h2>
        <div class="flex flex-col gap-md">
          <?php
          $deadlines = [
            ['month'=>'Oct','day'=>'14','title'=>'Midterm Exam',   'sub'=>'CS301 • 10:00 AM','color'=>'error'],
            ['month'=>'Oct','day'=>'18','title'=>'Project Phase 1','sub'=>'CS402 • 11:59 PM','color'=>'primary'],
          ];
          foreach ($deadlines as $d): ?>
          <div class="flex gap-md bg-surface-container-high p-sm rounded-lg border-l-2 border-<?= $d['color'] ?>">
            <div class="flex flex-col items-center justify-center min-w-[48px] bg-surface-variant rounded p-xs">
              <span class="font-label-sm text-[10px] text-<?= $d['color'] ?> uppercase"><?= $d['month'] ?></span>
              <span class="font-headline-md text-body-lg text-on-surface"><?= $d['day'] ?></span>
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-body-md text-sm text-on-surface truncate"><?= htmlspecialchars($d['title']) ?></h3>
              <p class="font-label-sm text-[11px] text-on-surface-variant"><?= htmlspecialchars($d['sub']) ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="grid grid-cols-2 gap-sm">
        <a href="tools.php" class="bg-primary-container text-on-primary-container p-md rounded-xl flex flex-col items-center justify-center gap-sm hover:opacity-90 transition-opacity shadow-sm min-h-[100px]">
          <span class="material-symbols-outlined text-[32px]" aria-hidden="true">calculate</span>
          <span class="font-label-sm text-xs">GPA Calc</span>
        </a>
        <a href="resources.php" class="bg-tertiary-container text-on-tertiary-container p-md rounded-xl flex flex-col items-center justify-center gap-sm hover:opacity-90 transition-opacity shadow-sm min-h-[100px]">
          <span class="material-symbols-outlined text-[32px]" aria-hidden="true">smart_toy</span>
          <span class="font-label-sm text-xs">AI Tutor</span>
        </a>
      </div>

      <!-- Recent Files -->
      <div class="bg-surface-container rounded-xl p-lg shadow-md flex-1">
        <h2 class="font-headline-md text-body-lg text-on-surface mb-md">Recent Files</h2>
        <ul class="flex flex-col gap-sm">
          <?php
          $files = [
            ['icon'=>'picture_as_pdf','color'=>'primary',  'name'=>'Lecture04_Memory.pdf',  'time'=>'2 hrs ago'],
            ['icon'=>'description',   'color'=>'secondary','name'=>'Notes_Graph_Algos.md',  'time'=>'Yesterday'],
            ['icon'=>'code',          'color'=>'tertiary', 'name'=>'assignment2.py',         'time'=>'3 days ago'],
          ];
          foreach ($files as $f): ?>
          <li class="flex items-center gap-md hover:bg-surface-variant p-2 -mx-2 rounded cursor-pointer transition-colors">
            <div class="text-<?= $f['color'] ?> bg-<?= $f['color'] ?>/10 p-1.5 rounded shrink-0">
              <span class="material-symbols-outlined text-[20px]" aria-hidden="true"><?= $f['icon'] ?></span>
            </div>
            <div class="flex-1 min-w-0">
              <p class="font-body-md text-sm text-on-surface truncate"><?= htmlspecialchars($f['name']) ?></p>
              <p class="font-label-sm text-[10px] text-on-surface-variant">Opened <?= $f['time'] ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

</div>
</main>
<?php nexus_footer(); ?>
</div>
