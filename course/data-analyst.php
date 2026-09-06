<?php
require_once __DIR__ . '/../includes/layout.php';

nexus_head(
  'Data Analyst Roadmap 2026 — Step-by-Step Career Guide',
  'Complete step-by-step Data Analyst roadmap for 2026. Learn Excel, SQL, Python, Statistics, Data Visualization, Power BI, Machine Learning, and more to become a job-ready data analyst.',
  'data analyst roadmap 2026, how to become data analyst, data analyst skills, data analyst learning path, SQL for data analyst, Python for data analysis, data visualization, Power BI, Tableau, statistics for data science',
  URL_COURSES . '/data-analyst',
  ['type' => 'website', 'title' => 'Data Analyst Roadmap 2026 — Yaswant Dev'],
  null
);

$stages = [
  [
    'phase' => '01',
    'label' => 'Foundation',
    'icon' => 'foundation',
    'color' => 'emerald',
    'title' => 'Data & Spreadsheet Basics',
    'desc' => 'Start with fundamental data concepts, spreadsheets, and understanding what data analysts actually do day-to-day.',
    'topics' => [
      ['name' => 'What is Data Analysis?', 'icon' => 'help_outline', 'done' => true],
      ['name' => 'Types of Data (Structured/Unstructured)', 'icon' => 'category', 'done' => true],
      ['name' => 'Microsoft Excel / Google Sheets', 'icon' => 'table_chart', 'done' => false],
      ['name' => 'Pivot Tables & VLOOKUP', 'icon' => 'pivot_table_chart', 'done' => false],
      ['name' => 'Data Cleaning Techniques', 'icon' => 'cleaning_services', 'done' => false],
      ['name' => 'Basic Statistics Concepts', 'icon' => 'bar_chart', 'done' => false],
    ],
    'resources' => [
      ['title' => 'Google Data Analytics Certificate', 'url' => 'https://grow.google/intl/en_in/certificates/data-analytics/'],
      ['title' => 'Excel for Data Analysis – FreeCodeCamp', 'url' => 'https://www.freecodecamp.org/news/excel-for-data-analysis/'],
    ],
  ],
  [
    'phase' => '02',
    'label' => 'Core Skill',
    'icon' => 'storage',
    'color' => 'cyan',
    'title' => 'SQL & Database Querying',
    'desc' => 'SQL is the #1 skill for data analysts. Learn to query, join, aggregate, and manipulate data from relational databases.',
    'topics' => [
      ['name' => 'SQL SELECT, WHERE, ORDER BY', 'icon' => 'code', 'done' => false],
      ['name' => 'JOINs (INNER, LEFT, RIGHT, FULL)', 'icon' => 'merge_type', 'done' => false],
      ['name' => 'GROUP BY & Aggregate Functions', 'icon' => 'functions', 'done' => false],
      ['name' => 'Subqueries & CTEs', 'icon' => 'account_tree', 'done' => false],
      ['name' => 'Window Functions (RANK, LEAD, LAG)', 'icon' => 'grid_view', 'done' => false],
      ['name' => 'Database Design Basics', 'icon' => 'schema', 'done' => false],
      ['name' => 'PostgreSQL / MySQL / BigQuery', 'icon' => 'database', 'done' => false],
    ],
    'resources' => [
      ['title' => 'SQLZoo – Interactive SQL Practice', 'url' => 'https://sqlzoo.net/'],
      ['title' => 'Mode SQL Tutorial', 'url' => 'https://mode.com/sql-tutorial/'],
      ['title' => 'LeetCode SQL Problems', 'url' => 'https://leetcode.com/problemset/database/'],
    ],
  ],
  [
    'phase' => '03',
    'label' => 'Programming',
    'icon' => 'code',
    'color' => 'indigo',
    'title' => 'Python for Data Analysis',
    'desc' => 'Python is the power tool for data analysts. Master Pandas, NumPy, and Matplotlib to manipulate and visualize data at scale.',
    'topics' => [
      ['name' => 'Python Fundamentals', 'icon' => 'terminal', 'done' => false],
      ['name' => 'NumPy – Numerical Computing', 'icon' => 'calculate', 'done' => false],
      ['name' => 'Pandas – DataFrame Operations', 'icon' => 'table_rows', 'done' => false],
      ['name' => 'Data Cleaning with Pandas', 'icon' => 'cleaning_services', 'done' => false],
      ['name' => 'Matplotlib & Seaborn Visualization', 'icon' => 'insert_chart', 'done' => false],
      ['name' => 'Jupyter Notebooks', 'icon' => 'book_online', 'done' => false],
      ['name' => 'Working with CSV / JSON / Excel', 'icon' => 'folder_open', 'done' => false],
    ],
    'resources' => [
      ['title' => 'Kaggle Python Course (Free)', 'url' => 'https://www.kaggle.com/learn/python'],
      ['title' => 'Kaggle Pandas Course (Free)', 'url' => 'https://www.kaggle.com/learn/pandas'],
      ['title' => "Python for Data Analysis – O'Reilly", 'url' => 'https://wesmckinney.com/book/'],
    ],
  ],
  [
    'phase' => '04',
    'label' => 'Statistics',
    'icon' => 'query_stats',
    'color' => 'amber',
    'title' => 'Statistics & Probability',
    'desc' => 'Statistical thinking is what separates great analysts from average ones. Understand distributions, hypothesis testing, and correlation.',
    'topics' => [
      ['name' => 'Descriptive Statistics (Mean, Median, Mode)', 'icon' => 'analytics', 'done' => false],
      ['name' => 'Probability Distributions', 'icon' => 'area_chart', 'done' => false],
      ['name' => 'Hypothesis Testing (t-test, chi-squared)', 'icon' => 'science', 'done' => false],
      ['name' => 'Correlation & Causation', 'icon' => 'compare_arrows', 'done' => false],
      ['name' => 'Confidence Intervals & p-values', 'icon' => 'percent', 'done' => false],
      ['name' => 'A/B Testing Fundamentals', 'icon' => 'split_scene', 'done' => false],
      ['name' => 'Regression Analysis', 'icon' => 'trending_up', 'done' => false],
    ],
    'resources' => [
      ['title' => 'Khan Academy Statistics', 'url' => 'https://www.khanacademy.org/math/statistics-probability'],
      ['title' => 'StatQuest with Josh Starmer (YouTube)', 'url' => 'https://www.youtube.com/@statquest'],
      ['title' => 'Think Stats – Free eBook', 'url' => 'https://greenteapress.com/wp/think-stats-2e/'],
    ],
  ],
  [
    'phase' => '05',
    'label' => 'Visualization',
    'icon' => 'insert_chart',
    'color' => 'violet',
    'title' => 'Data Visualization & BI Tools',
    'desc' => 'Translate numbers into compelling stories. Master professional BI tools used in enterprise data teams worldwide.',
    'topics' => [
      ['name' => 'Principles of Data Visualization', 'icon' => 'palette', 'done' => false],
      ['name' => 'Tableau Desktop', 'icon' => 'bar_chart', 'done' => false],
      ['name' => 'Microsoft Power BI', 'icon' => 'insights', 'done' => false],
      ['name' => 'Google Looker Studio', 'icon' => 'dashboard', 'done' => false],
      ['name' => 'Plotly & Dash (Python)', 'icon' => 'scatter_plot', 'done' => false],
      ['name' => 'Dashboard Design Best Practices', 'icon' => 'space_dashboard', 'done' => false],
      ['name' => 'Storytelling with Data', 'icon' => 'auto_stories', 'done' => false],
    ],
    'resources' => [
      ['title' => 'Tableau Public (Free Training)', 'url' => 'https://public.tableau.com/en-us/s/resources'],
      ['title' => 'Power BI Microsoft Learn (Free)', 'url' => 'https://learn.microsoft.com/en-us/power-bi/'],
      ['title' => 'Storytelling with Data – Book', 'url' => 'https://www.storytellingwithdata.com/'],
    ],
  ],
  [
    'phase' => '06',
    'label' => 'Advanced',
    'icon' => 'psychology',
    'color' => 'rose',
    'title' => 'Machine Learning for Analysts',
    'desc' => 'Take your analysis to the next level with predictive modeling. Understand and apply ML algorithms for forecasting and classification.',
    'topics' => [
      ['name' => 'Supervised vs Unsupervised Learning', 'icon' => 'device_hub', 'done' => false],
      ['name' => 'Linear & Logistic Regression', 'icon' => 'trending_up', 'done' => false],
      ['name' => 'Decision Trees & Random Forests', 'icon' => 'account_tree', 'done' => false],
      ['name' => 'Clustering (K-Means)', 'icon' => 'bubble_chart', 'done' => false],
      ['name' => 'Scikit-Learn Library', 'icon' => 'science', 'done' => false],
      ['name' => 'Feature Engineering', 'icon' => 'construction', 'done' => false],
      ['name' => 'Model Evaluation Metrics', 'icon' => 'assessment', 'done' => false],
    ],
    'resources' => [
      ['title' => 'Kaggle Intro to ML (Free)', 'url' => 'https://www.kaggle.com/learn/intro-to-machine-learning'],
      ['title' => 'Google ML Crash Course', 'url' => 'https://developers.google.com/machine-learning/crash-course'],
      ['title' => 'Hands-On Machine Learning (Book)', 'url' => 'https://www.oreilly.com/library/view/hands-on-machine-learning/9781492032632/'],
    ],
  ],
  [
    'phase' => '07',
    'label' => 'Cloud & Big Data',
    'icon' => 'cloud',
    'color' => 'sky',
    'title' => 'Cloud Platforms & Big Data',
    'desc' => 'Work with massive datasets using cloud-native tools. Industry standard platforms used at Amazon, Google, and Meta.',
    'topics' => [
      ['name' => 'Google BigQuery', 'icon' => 'data_exploration', 'done' => false],
      ['name' => 'AWS Athena & S3', 'icon' => 'cloud_upload', 'done' => false],
      ['name' => 'Apache Spark Basics', 'icon' => 'bolt', 'done' => false],
      ['name' => 'Data Warehousing Concepts', 'icon' => 'warehouse', 'done' => false],
      ['name' => 'ETL / ELT Pipelines', 'icon' => 'sync_alt', 'done' => false],
      ['name' => 'dbt (Data Build Tool)', 'icon' => 'build_circle', 'done' => false],
      ['name' => 'Apache Airflow Basics', 'icon' => 'air', 'done' => false],
    ],
    'resources' => [
      ['title' => 'BigQuery Free Tier Sandbox', 'url' => 'https://cloud.google.com/bigquery/docs/sandbox'],
      ['title' => 'dbt Fundamentals Course (Free)', 'url' => 'https://courses.getdbt.com/courses/fundamentals'],
      ['title' => 'AWS Data Analytics Specialty', 'url' => 'https://aws.amazon.com/certification/certified-data-analytics-specialty/'],
    ],
  ],
  [
    'phase' => '08',
    'label' => 'Soft Skills',
    'icon' => 'groups',
    'color' => 'teal',
    'title' => 'Communication & Domain Expertise',
    'desc' => 'The best analysts can communicate findings clearly. Build business domain knowledge and presentation skills to drive real impact.',
    'topics' => [
      ['name' => 'Presenting Data to Stakeholders', 'icon' => 'present_to_all', 'done' => false],
      ['name' => 'Business Metrics & KPIs', 'icon' => 'monitoring', 'done' => false],
      ['name' => 'Data-Driven Decision Making', 'icon' => 'checklist', 'done' => false],
      ['name' => 'Domain Knowledge (Finance/Health/E-Commerce)', 'icon' => 'domain', 'done' => false],
      ['name' => 'Git & Version Control', 'icon' => 'merge', 'done' => false],
      ['name' => 'Building a Portfolio on Kaggle', 'icon' => 'work', 'done' => false],
      ['name' => 'Data Analyst Interview Prep', 'icon' => 'fact_check', 'done' => false],
    ],
    'resources' => [
      ['title' => 'Kaggle Portfolio Projects', 'url' => 'https://www.kaggle.com/competitions'],
      ['title' => 'Data Analyst Interview Questions – roadmap.sh', 'url' => 'https://roadmap.sh/questions/data-analyst'],
      ['title' => 'SQL Interview Questions – Mode', 'url' => 'https://mode.com/sql-tutorial/sql-data-analysis-examples/'],
    ],
  ],
];

$colorMap = [
  'emerald' => ['bg' => 'bg-emerald-500/10', 'border' => 'border-emerald-500/30', 'text' => 'text-emerald-400', 'badge' => 'bg-emerald-500/20 border-emerald-500/40 text-emerald-300'],
  'cyan' => ['bg' => 'bg-cyan-500/10', 'border' => 'border-cyan-500/30', 'text' => 'text-cyan-400', 'badge' => 'bg-cyan-500/20 border-cyan-500/40 text-cyan-300'],
  'indigo' => ['bg' => 'bg-indigo-500/10', 'border' => 'border-indigo-500/30', 'text' => 'text-indigo-400', 'badge' => 'bg-indigo-500/20 border-indigo-500/40 text-indigo-300'],
  'amber' => ['bg' => 'bg-amber-500/10', 'border' => 'border-amber-500/30', 'text' => 'text-amber-400', 'badge' => 'bg-amber-500/20 border-amber-500/40 text-amber-300'],
  'violet' => ['bg' => 'bg-violet-500/10', 'border' => 'border-violet-500/30', 'text' => 'text-violet-400', 'badge' => 'bg-violet-500/20 border-violet-500/40 text-violet-300'],
  'rose' => ['bg' => 'bg-rose-500/10', 'border' => 'border-rose-500/30', 'text' => 'text-rose-400', 'badge' => 'bg-rose-500/20 border-rose-500/40 text-rose-300'],
  'sky' => ['bg' => 'bg-sky-500/10', 'border' => 'border-sky-500/30', 'text' => 'text-sky-400', 'badge' => 'bg-sky-500/20 border-sky-500/40 text-sky-300'],
  'teal' => ['bg' => 'bg-teal-500/10', 'border' => 'border-teal-500/30', 'text' => 'text-teal-400', 'badge' => 'bg-teal-500/20 border-teal-500/40 text-teal-300'],
];

$totalTopics = array_sum(array_map(fn($s) => count($s['topics']), $stages));
$totalStages = count($stages);
?>
<style>
  .roadmap-stage {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }

  .roadmap-stage:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  }

  .topic-chip {
    transition: background 0.2s, border-color 0.2s;
  }

  .topic-chip:hover {
    background: rgba(16, 185, 129, 0.15);
    border-color: rgba(16, 185, 129, 0.4);
  }
</style>

<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('courses');
  nexus_topbar('courses'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-xl">

      <!-- Breadcrumbs -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
        <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
        <span class="text-zinc-600">/</span>
        <a href="<?= URL_COURSES ?>" class="hover:text-emerald-400 transition-colors">Free Engineering Courses</a>
        <span class="text-zinc-600">/</span>
        <span class="text-zinc-300">Data Analyst Roadmap</span>
      </nav>

      <!-- Hero Header -->
      <div
        class="relative overflow-hidden rounded-2xl border border-zinc-800 bg-gradient-to-br from-zinc-950 via-zinc-900 to-zinc-950 p-6 md:p-10 shadow-2xl">
        <div class="pointer-events-none absolute -top-20 -right-20 w-72 h-72 rounded-full bg-emerald-500/5 blur-3xl">
        </div>
        <div class="pointer-events-none absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-cyan-500/5 blur-3xl">
        </div>

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-8">
          <div class="flex-1 space-y-4">
            <div class="flex flex-wrap items-center gap-2">
              <span
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Free Roadmap
              </span>
              <span
                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-zinc-800 border border-zinc-700 text-zinc-300 text-xs font-mono">
                <span class="material-symbols-outlined text-[14px] text-amber-400">verified</span>
                roadmap.sh Inspired
              </span>
              <span
                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-zinc-800 border border-zinc-700 text-zinc-300 text-xs font-mono">
                <span class="material-symbols-outlined text-[14px] text-cyan-400">update</span>
                2026 Edition
              </span>
            </div>

            <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight leading-tight">
              Data Analyst <span class="gradient-text">Roadmap</span>
            </h1>

            <p class="text-sm md:text-base text-zinc-400 font-light leading-relaxed max-w-2xl">
              A complete step-by-step learning path from spreadsheet basics to machine learning. Everything you need to
              land your first Data Analyst role in 2026. Inspired by <a href="https://roadmap.sh/data-analyst"
                target="_blank" rel="noopener noreferrer"
                class="text-emerald-400 hover:underline">roadmap.sh/data-analyst</a>.
            </p>

            <!-- Stats row -->
            <div class="flex flex-wrap items-center gap-6 pt-2">
              <div class="text-center">
                <div class="text-2xl font-black text-white"><?= $totalStages ?></div>
                <div class="text-xs font-mono text-zinc-500 uppercase">Phases</div>
              </div>
              <div class="w-px h-8 bg-zinc-800"></div>
              <div class="text-center">
                <div class="text-2xl font-black text-white"><?= $totalTopics ?>+</div>
                <div class="text-xs font-mono text-zinc-500 uppercase">Topics</div>
              </div>
              <div class="w-px h-8 bg-zinc-800"></div>
              <div class="text-center">
                <div class="text-2xl font-black text-white">6–12</div>
                <div class="text-xs font-mono text-zinc-500 uppercase">Months</div>
              </div>
              <div class="w-px h-8 bg-zinc-800"></div>
              <div class="text-center">
                <div class="text-2xl font-black text-white">$80k+</div>
                <div class="text-xs font-mono text-zinc-500 uppercase">Avg Salary</div>
              </div>
            </div>
          </div>

          <!-- Skills cloud -->
          <div class="shrink-0 hidden md:flex flex-wrap gap-2 max-w-xs justify-end">
            <?php foreach (['Excel', 'SQL', 'Python', 'Pandas', 'NumPy', 'Tableau', 'Power BI', 'Statistics', 'A/B Testing', 'BigQuery', 'Scikit-Learn', 'Matplotlib'] as $skill): ?>
              <span
                class="px-2.5 py-1 rounded-lg bg-zinc-800/80 border border-zinc-700 text-zinc-300 text-xs font-mono"><?= $skill ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- How to Use Banner -->
      <div
        class="bg-zinc-950 border border-zinc-800 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center gap-4 shadow-lg">
        <span class="material-symbols-outlined text-amber-400 text-3xl shrink-0">tips_and_updates</span>
        <div class="text-xs font-mono text-zinc-400 leading-relaxed flex-1">
          <span class="text-white font-bold">How to use this roadmap:</span>
          Follow the phases in order. Each phase builds on the previous one. You do not need to master everything before
          moving forward — build a solid understanding and keep progressing. Free resources are linked in each phase.
        </div>
        <a href="https://roadmap.sh/data-analyst" target="_blank" rel="noopener noreferrer"
          class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-black text-xs font-mono font-bold transition-colors">
          <span class="material-symbols-outlined text-[15px]">open_in_new</span> Full Roadmap
        </a>
      </div>

      <!-- ── Mind Map ──────────────────────────────────────────────── -->
      <div class="bg-zinc-950 border border-zinc-800/80 rounded-2xl overflow-hidden shadow-2xl">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-800">
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-emerald-400 text-xl">hub</span>
            <div>
              <h2 class="text-sm font-black text-white">Data Analyst Mind Map</h2>
              <p class="text-[10px] font-mono text-zinc-500">Interactive overview — click any node to highlight</p>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <button id="mm-zoom-in"
              class="w-8 h-8 rounded-lg bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white flex items-center justify-center transition-colors"
              title="Zoom In">
              <span class="material-symbols-outlined text-[16px]">add</span>
            </button>
            <button id="mm-zoom-out"
              class="w-8 h-8 rounded-lg bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white flex items-center justify-center transition-colors"
              title="Zoom Out">
              <span class="material-symbols-outlined text-[16px]">remove</span>
            </button>
            <button id="mm-reset"
              class="w-8 h-8 rounded-lg bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white flex items-center justify-center transition-colors"
              title="Reset">
              <span class="material-symbols-outlined text-[16px]">refresh</span>
            </button>
          </div>
        </div>

        <!-- Canvas -->
        <div class="relative w-full overflow-hidden"
          style="height:580px; background: radial-gradient(ellipse at center, #0a1628 0%, #09090b 70%);">
          <canvas id="mindmap-canvas" class="absolute inset-0 w-full h-full" style="cursor:grab"></canvas>
          <div id="mm-tooltip"
            class="hidden absolute z-20 pointer-events-none bg-zinc-900 border border-zinc-700 text-xs font-mono text-zinc-200 px-3 py-2 rounded-xl shadow-2xl max-w-xs leading-relaxed">
          </div>
        </div>

        <!-- Legend -->
        <div class="px-6 py-3 border-t border-zinc-800 flex flex-wrap gap-4 items-center">
          <?php
          $legend = [
            ['color' => '#10b981', 'label' => 'Foundation'],
            ['color' => '#06b6d4', 'label' => 'SQL'],
            ['color' => '#6366f1', 'label' => 'Python'],
            ['color' => '#f59e0b', 'label' => 'Statistics'],
            ['color' => '#8b5cf6', 'label' => 'Visualization'],
            ['color' => '#f43f5e', 'label' => 'Machine Learning'],
            ['color' => '#0ea5e9', 'label' => 'Cloud & Big Data'],
            ['color' => '#14b8a6', 'label' => 'Soft Skills'],
          ];
          foreach ($legend as $l):
            ?>
            <div class="flex items-center gap-1.5">
              <span class="w-2.5 h-2.5 rounded-full" style="background:<?= $l['color'] ?>"></span>
              <span class="text-[10px] font-mono text-zinc-400"><?= $l['label'] ?></span>
            </div>
          <?php endforeach; ?>
          <span class="ml-auto text-[10px] font-mono text-zinc-600">Drag to pan &bull; Scroll to zoom &bull; Click node
            to inspect</span>
        </div>
      </div>

      <script>
        (function () {
          const canvas = document.getElementById('mindmap-canvas');
          const ctx = canvas.getContext('2d');
          const tip = document.getElementById('mm-tooltip');

          // ── Data ──────────────────────────────────────────────────────
          const CENTER = { label: 'Data\nAnalyst', color: '#10b981', r: 52 };

          const branches = [
            {
              label: '01 Foundation', color: '#10b981', angle: 270,
              children: ['What is Data?', 'Types of Data', 'Excel / Sheets', 'Pivot Tables', 'Data Cleaning', 'Basic Statistics']
            },
            {
              label: '02 SQL', color: '#06b6d4', angle: 315,
              children: ['SELECT / WHERE', 'JOINs', 'GROUP BY', 'Subqueries & CTEs', 'Window Functions', 'BigQuery / MySQL']
            },
            {
              label: '03 Python', color: '#6366f1', angle: 0,
              children: ['Python Basics', 'NumPy', 'Pandas', 'Data Cleaning', 'Matplotlib / Seaborn', 'Jupyter Notebooks']
            },
            {
              label: '04 Statistics', color: '#f59e0b', angle: 45,
              children: ['Descriptive Stats', 'Distributions', 'Hypothesis Tests', 'Correlation', 'A/B Testing', 'Regression']
            },
            {
              label: '05 Visualization', color: '#8b5cf6', angle: 90,
              children: ['Viz Principles', 'Tableau', 'Power BI', 'Looker Studio', 'Plotly / Dash', 'Data Storytelling']
            },
            {
              label: '06 ML', color: '#f43f5e', angle: 135,
              children: ['Supervised / Unsupervised', 'Linear Regression', 'Decision Trees', 'K-Means Clustering', 'Scikit-Learn', 'Model Evaluation']
            },
            {
              label: '07 Cloud', color: '#0ea5e9', angle: 180,
              children: ['BigQuery', 'AWS Athena / S3', 'Apache Spark', 'Data Warehousing', 'ETL / ELT', 'dbt + Airflow']
            },
            {
              label: '08 Soft Skills', color: '#14b8a6', angle: 225,
              children: ['Stakeholder Comms', 'KPIs & Metrics', 'Decision Making', 'Domain Knowledge', 'Git & Version Control', 'Portfolio Building']
            },
          ];

          // ── State ─────────────────────────────────────────────────────
          let scale = 1, ox = 0, oy = 0;
          let dragging = false, lastX = 0, lastY = 0;
          let activeNode = null;

          // Pre-compute node positions
          const BR = 180;  // branch radius from center
          const LR = 110;  // leaf radius from branch node
          const bNodes = [], lNodes = [];

          branches.forEach(b => {
            const rad = (b.angle * Math.PI) / 180;
            const bx = Math.cos(rad) * BR;
            const by = Math.sin(rad) * BR;
            bNodes.push({ ...b, bx, by });

            b.children.forEach((child, ci) => {
              const spread = 50;
              const off = (ci - (b.children.length - 1) / 2) * spread;
              const perpR = ((b.angle + 90) * Math.PI) / 180;
              const cx = bx + Math.cos(rad) * LR + Math.cos(perpR) * off * 0.6;
              const cy = by + Math.sin(rad) * LR + Math.sin(perpR) * off * 0.6;
              lNodes.push({ label: child, color: b.color, bx, by, cx, cy, branchAngle: b.angle });
            });
          });

          // ── DPR-aware resize ──────────────────────────────────────────
          function resize() {
            const dpr = window.devicePixelRatio || 1;
            const rect = canvas.parentElement.getBoundingClientRect();
            canvas.width = rect.width * dpr;
            canvas.height = rect.height * dpr;
            canvas.style.width = rect.width + 'px';
            canvas.style.height = rect.height + 'px';
            ctx.scale(dpr, dpr);
            draw();
          }

          // ── Draw ──────────────────────────────────────────────────────
          function draw() {
            const dpr = window.devicePixelRatio || 1;
            const W = canvas.width / dpr;
            const H = canvas.height / dpr;
            const cx_ = W / 2 + ox;
            const cy_ = H / 2 + oy;

            ctx.clearRect(0, 0, W, H);
            ctx.save();
            ctx.translate(cx_, cy_);
            ctx.scale(scale, scale);

            // Draw grid dots
            const gridStep = 50;
            ctx.fillStyle = 'rgba(255,255,255,0.03)';
            for (let gx = -500; gx < 500; gx += gridStep)
              for (let gy = -500; gy < 500; gy += gridStep) {
                ctx.beginPath();
                ctx.arc(gx, gy, 1, 0, Math.PI * 2);
                ctx.fill();
              }

            // Draw leaf lines
            lNodes.forEach(n => {
              ctx.beginPath();
              ctx.moveTo(n.bx, n.by);
              ctx.lineTo(n.cx, n.cy);
              const isActive = activeNode && activeNode.label === n.label;
              ctx.strokeStyle = isActive ? n.color : 'rgba(255,255,255,0.08)';
              ctx.lineWidth = isActive ? 1.5 : 0.8;
              ctx.stroke();
            });

            // Draw branch lines (center → branch)
            bNodes.forEach(b => {
              ctx.beginPath();
              ctx.moveTo(0, 0);
              ctx.lineTo(b.bx, b.by);
              const isActive = activeNode && activeNode.label === b.label;
              ctx.strokeStyle = isActive ? b.color : hexAlpha(b.color, 0.35);
              ctx.lineWidth = isActive ? 3 : 2;
              ctx.stroke();
            });

            // Draw leaf nodes
            lNodes.forEach(n => {
              const isActive = activeNode && activeNode.label === n.label;
              const pad = 6, fs = 9;
              ctx.font = `${isActive ? 600 : 400} ${fs}px 'JetBrains Mono', monospace`;
              const tw = ctx.measureText(n.label).width;
              const bw = tw + pad * 2, bh = fs + pad * 2;

              ctx.fillStyle = isActive ? hexAlpha(n.color, 0.25) : 'rgba(24,24,27,0.9)';
              roundRect(ctx, n.cx - bw / 2, n.cy - bh / 2, bw, bh, 5);
              ctx.fill();

              ctx.strokeStyle = isActive ? n.color : hexAlpha(n.color, 0.3);
              ctx.lineWidth = isActive ? 1.5 : 0.8;
              roundRect(ctx, n.cx - bw / 2, n.cy - bh / 2, bw, bh, 5);
              ctx.stroke();

              ctx.fillStyle = isActive ? '#fff' : '#a1a1aa';
              ctx.textAlign = 'center';
              ctx.textBaseline = 'middle';
              ctx.fillText(n.label, n.cx, n.cy);
            });

            // Draw branch nodes
            bNodes.forEach(b => {
              const isActive = activeNode && activeNode.label === b.label;
              const r = 34;
              // Glow
              if (isActive) {
                ctx.shadowColor = b.color;
                ctx.shadowBlur = 20;
              }
              ctx.beginPath();
              ctx.arc(b.bx, b.by, r, 0, Math.PI * 2);
              ctx.fillStyle = isActive ? hexAlpha(b.color, 0.3) : 'rgba(24,24,27,0.95)';
              ctx.fill();
              ctx.strokeStyle = b.color;
              ctx.lineWidth = isActive ? 2.5 : 1.5;
              ctx.stroke();
              ctx.shadowBlur = 0;

              ctx.fillStyle = '#fff';
              ctx.textAlign = 'center';
              ctx.textBaseline = 'middle';
              const lines = b.label.split(' ');
              lines.forEach((line, li) => {
                const fs = 8.5;
                ctx.font = `700 ${fs}px 'JetBrains Mono', monospace`;
                ctx.fillText(line, b.bx, b.by + (li - (lines.length - 1) / 2) * (fs + 2));
              });
            });

            // Draw center node
            const cr = CENTER.r;
            ctx.shadowColor = CENTER.color;
            ctx.shadowBlur = 30;
            const grad = ctx.createRadialGradient(0, 0, 0, 0, 0, cr);
            grad.addColorStop(0, hexAlpha(CENTER.color, 0.6));
            grad.addColorStop(1, hexAlpha(CENTER.color, 0.15));
            ctx.beginPath();
            ctx.arc(0, 0, cr, 0, Math.PI * 2);
            ctx.fillStyle = grad;
            ctx.fill();
            ctx.strokeStyle = CENTER.color;
            ctx.lineWidth = 2.5;
            ctx.stroke();
            ctx.shadowBlur = 0;

            ctx.fillStyle = '#fff';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            CENTER.label.split('\n').forEach((line, li) => {
              ctx.font = `900 13px 'JetBrains Mono', monospace`;
              ctx.fillText(line, 0, (li - 0.5) * 16);
            });

            ctx.restore();
          }

          // ── Helpers ───────────────────────────────────────────────────
          function hexAlpha(hex, a) {
            const r = parseInt(hex.slice(1, 3), 16);
            const g = parseInt(hex.slice(3, 5), 16);
            const b = parseInt(hex.slice(5, 7), 16);
            return `rgba(${r},${g},${b},${a})`;
          }
          function roundRect(ctx, x, y, w, h, r) {
            ctx.beginPath();
            ctx.moveTo(x + r, y);
            ctx.lineTo(x + w - r, y);
            ctx.quadraticCurveTo(x + w, y, x + w, y + r);
            ctx.lineTo(x + w, y + h - r);
            ctx.quadraticCurveTo(x + w, y + h, x + w - r, y + h);
            ctx.lineTo(x + r, y + h);
            ctx.quadraticCurveTo(x, y + h, x, y + h - r);
            ctx.lineTo(x, y + r);
            ctx.quadraticCurveTo(x, y, x + r, y);
            ctx.closePath();
          }

          // World coords from event
          function worldPos(e) {
            const dpr = window.devicePixelRatio || 1;
            const rect = canvas.getBoundingClientRect();
            const W = canvas.width / dpr;
            const H = canvas.height / dpr;
            const mx = (e.clientX - rect.left);
            const my = (e.clientY - rect.top);
            return {
              wx: (mx - W / 2 - ox) / scale,
              wy: (my - H / 2 - oy) / scale,
              mx, my
            };
          }

          function hitTest(wx, wy) {
            // Check branch nodes (r=34)
            for (const b of bNodes) {
              const d = Math.hypot(wx - b.bx, wy - b.by);
              if (d < 34) return { label: b.label, color: b.color, info: `Phase ${b.label} — ${b.children.length} topics` };
            }
            // Check leaf nodes
            for (const n of lNodes) {
              const pad = 6, fs = 9;
              ctx.font = `400 ${fs}px monospace`;
              const tw = ctx.measureText(n.label).width;
              const bw = tw + pad * 2, bh = fs + pad * 2;
              if (wx >= n.cx - bw / 2 && wx <= n.cx + bw / 2 && wy >= n.cy - bh / 2 && wy <= n.cy + bh / 2)
                return { label: n.label, color: n.color, info: n.label };
            }
            // Center node
            if (Math.hypot(wx, wy) < CENTER.r)
              return { label: 'Data\nAnalyst', color: CENTER.color, info: '8 Phases · 56 Topics · 6–12 Months' };
            return null;
          }

          // ── Mouse events ──────────────────────────────────────────────
          canvas.addEventListener('mousedown', e => {
            dragging = true; lastX = e.clientX; lastY = e.clientY;
            canvas.style.cursor = 'grabbing';
          });
          canvas.addEventListener('mousemove', e => {
            if (dragging) {
              ox += e.clientX - lastX;
              oy += e.clientY - lastY;
              lastX = e.clientX; lastY = e.clientY;
              draw();
            }
            const { wx, wy, mx, my } = worldPos(e);
            const hit = hitTest(wx, wy);
            if (hit) {
              tip.style.display = 'block';
              tip.style.left = (mx + 14) + 'px';
              tip.style.top = (my - 10) + 'px';
              tip.style.borderColor = hit.color;
              tip.innerHTML = `<span style="color:${hit.color};font-weight:700">${hit.info}</span>`;
              canvas.style.cursor = dragging ? 'grabbing' : 'pointer';
            } else {
              tip.style.display = 'none';
              canvas.style.cursor = dragging ? 'grabbing' : 'grab';
            }
          });
          canvas.addEventListener('mouseup', e => {
            if (!dragging) return;
            const dx = e.clientX - lastX, dy = e.clientY - lastY;
            if (Math.abs(dx) < 3 && Math.abs(dy) < 3) {
              const { wx, wy } = worldPos(e);
              const hit = hitTest(wx, wy);
              activeNode = (hit && activeNode && activeNode.label === hit.label) ? null : hit;
              draw();
            }
            dragging = false;
            canvas.style.cursor = 'grab';
          });
          canvas.addEventListener('mouseleave', () => {
            dragging = false; tip.style.display = 'none';
            canvas.style.cursor = 'grab';
          });
          canvas.addEventListener('wheel', e => {
            e.preventDefault();
            const factor = e.deltaY < 0 ? 1.1 : 0.91;
            scale = Math.min(3, Math.max(0.35, scale * factor));
            draw();
          }, { passive: false });

          // Touch support
          let lastTouchDist = 0;
          canvas.addEventListener('touchstart', e => {
            if (e.touches.length === 1) { dragging = true; lastX = e.touches[0].clientX; lastY = e.touches[0].clientY; }
            if (e.touches.length === 2) { lastTouchDist = Math.hypot(e.touches[0].clientX - e.touches[1].clientX, e.touches[0].clientY - e.touches[1].clientY); }
          });
          canvas.addEventListener('touchmove', e => {
            e.preventDefault();
            if (e.touches.length === 1 && dragging) {
              ox += e.touches[0].clientX - lastX; oy += e.touches[0].clientY - lastY;
              lastX = e.touches[0].clientX; lastY = e.touches[0].clientY; draw();
            }
            if (e.touches.length === 2) {
              const d = Math.hypot(e.touches[0].clientX - e.touches[1].clientX, e.touches[0].clientY - e.touches[1].clientY);
              scale = Math.min(3, Math.max(0.35, scale * (d / lastTouchDist)));
              lastTouchDist = d; draw();
            }
          }, { passive: false });
          canvas.addEventListener('touchend', () => { dragging = false; });

          // ── Toolbar ───────────────────────────────────────────────────
          document.getElementById('mm-zoom-in').addEventListener('click', () => { scale = Math.min(3, scale * 1.2); draw(); });
          document.getElementById('mm-zoom-out').addEventListener('click', () => { scale = Math.max(0.35, scale / 1.2); draw(); });
          document.getElementById('mm-reset').addEventListener('click', () => { scale = 1; ox = 0; oy = 0; activeNode = null; draw(); });

          // ── Init ──────────────────────────────────────────────────────
          window.addEventListener('resize', resize);
          resize();
        })();
      </script>

      <!-- Roadmap Stages -->
      <div class="space-y-0">
        <?php foreach ($stages as $i => $stage):
          $clr = $colorMap[$stage['color']];
          $isLast = ($i === count($stages) - 1);
          ?>
          <div class="relative flex flex-col items-center">

            <?php if ($i > 0): ?>
              <div class="w-0.5 h-10 bg-gradient-to-b from-zinc-700 to-transparent"></div>
            <?php endif; ?>

            <!-- Phase pill -->
            <div
              class="inline-flex items-center gap-2 mb-4 px-4 py-1.5 rounded-full border <?= $clr['border'] ?> <?= $clr['bg'] ?>">
              <span class="material-symbols-outlined text-[16px] <?= $clr['text'] ?>"><?= $stage['icon'] ?></span>
              <span class="text-[10px] font-mono uppercase font-bold <?= $clr['text'] ?>">Phase <?= $stage['phase'] ?>
                &mdash; <?= $stage['label'] ?></span>
            </div>

            <!-- Stage Card -->
            <article
              class="roadmap-stage w-full bg-zinc-950 border <?= $clr['border'] ?> rounded-2xl p-6 md:p-8 shadow-xl">
              <div class="flex flex-col lg:flex-row gap-8">

                <!-- Left: Meta -->
                <div class="lg:w-72 shrink-0 space-y-4">
                  <div class="flex items-center gap-4">
                    <div
                      class="w-14 h-14 rounded-2xl <?= $clr['bg'] ?> border <?= $clr['border'] ?> flex items-center justify-center">
                      <span class="material-symbols-outlined text-3xl <?= $clr['text'] ?>"><?= $stage['icon'] ?></span>
                    </div>
                    <div>
                      <div class="text-[10px] font-mono uppercase text-zinc-500">Phase <?= $stage['phase'] ?></div>
                      <h2 class="text-lg font-black text-white"><?= htmlspecialchars($stage['title']) ?></h2>
                    </div>
                  </div>

                  <p class="text-xs text-zinc-400 font-light leading-relaxed">
                    <?= htmlspecialchars($stage['desc']) ?>
                  </p>

                  <!-- Free Resources -->
                  <div class="space-y-2">
                    <div class="text-[10px] font-mono uppercase text-zinc-600 font-bold">Free Resources</div>
                    <?php foreach ($stage['resources'] as $res): ?>
                      <a href="<?= htmlspecialchars($res['url']) ?>" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-2 text-xs font-mono text-zinc-400 hover:text-emerald-400 transition-colors group">
                        <span
                          class="material-symbols-outlined text-[14px] text-zinc-600 group-hover:text-emerald-400">link</span>
                        <?= htmlspecialchars($res['title']) ?>
                        <span
                          class="material-symbols-outlined text-[12px] opacity-0 group-hover:opacity-100 transition-opacity ml-auto">open_in_new</span>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- Right: Topics Grid -->
                <div class="flex-1">
                  <div class="text-[10px] font-mono uppercase text-zinc-600 font-bold mb-3">Topics Covered
                    (<?= count($stage['topics']) ?>)</div>
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <?php foreach ($stage['topics'] as $topic): ?>
                      <div
                        class="topic-chip flex items-center gap-3 bg-zinc-900/60 border border-zinc-800/80 rounded-xl px-4 py-3 cursor-pointer select-none">
                        <div class="w-8 h-8 rounded-lg <?= $clr['bg'] ?> flex items-center justify-center shrink-0">
                          <span
                            class="material-symbols-outlined text-[16px] <?= $clr['text'] ?>"><?= $topic['icon'] ?></span>
                        </div>
                        <span
                          class="text-xs font-mono text-zinc-300 flex-1 leading-tight"><?= htmlspecialchars($topic['name']) ?></span>
                        <?php if ($topic['done']): ?>
                          <span class="material-symbols-outlined text-[16px] text-emerald-400">check_circle</span>
                        <?php else: ?>
                          <span class="material-symbols-outlined text-[16px] text-zinc-700">radio_button_unchecked</span>
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </article>

            <?php if (!$isLast): ?>
              <div class="w-0.5 h-10 bg-gradient-to-b from-zinc-700 to-transparent mt-0"></div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Finish Line Banner -->
      <div
        class="relative overflow-hidden bg-gradient-to-r from-emerald-950 via-zinc-900 to-emerald-950 border border-emerald-500/30 rounded-2xl p-8 text-center shadow-2xl">
        <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
          <div class="w-96 h-96 rounded-full bg-emerald-500/5 blur-3xl"></div>
        </div>
        <div class="relative z-10 space-y-4">
          <span class="material-symbols-outlined text-6xl text-emerald-400">emoji_events</span>
          <h2 class="text-2xl md:text-3xl font-black text-white">You are a Data Analyst!</h2>
          <p class="text-sm text-zinc-400 font-light max-w-xl mx-auto leading-relaxed">
            Completing this roadmap makes you job-ready. Build 2-3 portfolio projects on Kaggle, write case studies on
            Medium, and apply for junior data analyst roles. The journey does not end here — keep analyzing!
          </p>
          <div class="flex flex-wrap items-center justify-center gap-3 pt-4">
            <a href="https://www.kaggle.com" target="_blank" rel="noopener noreferrer"
              class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-black text-sm font-mono font-bold transition-colors shadow-lg">
              <span class="material-symbols-outlined text-[16px]">sports_score</span>
              Build on Kaggle
            </a>
            <a href="https://roadmap.sh/data-analyst" target="_blank" rel="noopener noreferrer"
              class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white text-sm font-mono font-bold transition-colors">
              <span class="material-symbols-outlined text-[16px]">map</span>
              Full roadmap.sh
            </a>
            <a href="<?= URL_COURSES ?>"
              class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-white text-sm font-mono font-bold transition-colors">
              <span class="material-symbols-outlined text-[16px]">school</span>
              More Courses
            </a>
          </div>
        </div>
      </div>

      <!-- FAQ -->
      <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-10 space-y-6">
        <div>
          <span
            class="text-xs font-mono text-emerald-400 uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">FAQ</span>
          <h2 class="text-xl md:text-3xl font-black text-white mt-3">Common Questions About <span
              class="gradient-text">Data Analysis</span></h2>
        </div>

        <div class="space-y-3">
          <?php
          $faqs = [
            [
              'q' => 'How long does it take to become a Data Analyst?',
              'a' => 'Typically 6-12 months of consistent learning (1-2 hours per day). If you already have programming basics, you can do it in 4-6 months. Focus on SQL and Python first — they are the core skills employers look for.'
            ],
            [
              'q' => 'Do I need a degree to be a Data Analyst?',
              'a' => 'No. Many data analysts are self-taught. A strong portfolio with real-world projects on Kaggle, solid SQL and Python skills, and a well-crafted LinkedIn profile matter more than a formal degree.'
            ],
            [
              'q' => 'What is the average salary for a Data Analyst in 2026?',
              'a' => 'In the US, entry-level data analysts earn $65k-$90k. Mid-level analysts earn $90k-$130k. Senior analysts and those specializing in ML can earn $130k+. Indian market: Rs4-15 LPA depending on company and city.'
            ],
            [
              'q' => 'Python or R for Data Analysis — which should I learn?',
              'a' => 'Python. It has a much larger ecosystem (Pandas, NumPy, Scikit-Learn, Plotly), a bigger community, and is used for both data analysis AND machine learning. R is popular in academia and statistics-heavy roles.'
            ],
            [
              'q' => 'What is the difference between a Data Analyst and a Data Scientist?',
              'a' => 'Data Analysts focus on interpreting existing data to answer business questions using SQL, Excel, and BI tools. Data Scientists build predictive models and have stronger math/ML foundations. This roadmap takes you to DA level — you can extend to DS from Phase 06 onward.'
            ],
          ];
          foreach ($faqs as $faq):
            ?>
            <details class="bg-zinc-900/80 rounded-xl p-4 border border-zinc-800/80 cursor-pointer group">
              <summary
                class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between select-none">
                <?= htmlspecialchars($faq['q']) ?>
                <span
                  class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform shrink-0 ml-4">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                <?= htmlspecialchars($faq['a']) ?>
              </p>
            </details>
          <?php endforeach; ?>
        </div>
      </section>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>