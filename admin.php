<?php
// admin.php — Yaswant Dev Admin Control Center (Full Management Dashboard)
session_start();

// Auto-expire admin session after 15 minutes of inactivity
if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
  session_unset();
  session_destroy();
  header('Location: admin_login.php?timeout=1');
  exit;
}
$_SESSION['last_activity'] = time();

if (empty($_SESSION['admin_logged_in'])) {
  if (!headers_sent()) {
    header('Location: admin_login.php');
  }
  echo '<script>window.location.href="admin_login.php";</script>';
  echo '<meta http-equiv="refresh" content="0;url=admin_login.php">';
  exit;
}

require_once 'includes/layout.php';
require_once 'includes/data.php';

$resources   = get_resources();
$courses     = get_courses();
$jobs        = get_jobs();
$articles    = get_articles();
$subscribers = get_subscribers();

$tab = $_GET['tab'] ?? 'overview';

// Cyber Tools list for Admin Tools tab
$cyberTools = [
  ['num' => '#01', 'file' => '01-password-strength-checker.php', 'name' => 'Password Strength & Shannon Entropy Checker', 'cat' => 'Security'],
  ['num' => '#02', 'file' => '02-csprng-password-generator.php', 'name' => 'CSPRNG Password Generator', 'cat' => 'Security'],
  ['num' => '#03', 'file' => '03-syslog-siem-log-analyzer.php', 'name' => 'Syslog SIEM & Auth Log Analyzer', 'cat' => 'Security'],
  ['num' => '#04', 'file' => '04-brute-force-rate-limiter.php', 'name' => 'Brute Force Rate Limiter Simulator', 'cat' => 'Security'],
  ['num' => '#05', 'file' => '05-wifi-security-analyzer.php', 'name' => 'Wi-Fi Network Security & Cipher Analyzer', 'cat' => 'Security'],
  ['num' => '#06', 'file' => '06-network-packet-sniffer.php', 'name' => 'Network Packet Sniffer & Stream Analyzer', 'cat' => 'Security'],
  ['num' => '#07', 'file' => '07-malware-yara-scanner.php', 'name' => 'Malware Signature & YARA Rule Scanner', 'cat' => 'Security'],
  ['num' => '#08', 'file' => '08-stateful-firewall-simulator.php', 'name' => 'Stateful Firewall Rule Simulator', 'cat' => 'Security'],
  ['num' => '#09', 'file' => '09-sqli-auditor-pdo-converter.php', 'name' => 'SQL Injection Auditor & PDO Converter', 'cat' => 'Security'],
  ['num' => '#10', 'file' => '10-2fa-totp-authenticator-generator.php', 'name' => '2FA TOTP Authenticator Generator', 'cat' => 'Security'],
  ['num' => '#11', 'file' => '11-keylogger-event-auditor.php', 'name' => 'Keylogger & Input Event Auditor', 'cat' => 'Security'],
  ['num' => '#12', 'file' => '12-ipv4-subnet-cidr-calculator.php', 'name' => 'IPv4 Subnet & CIDR Calculator', 'cat' => 'Security'],
  ['num' => '#13', 'file' => '13-http-security-headers-auditor.php', 'name' => 'HTTP Security Headers Auditor', 'cat' => 'Security'],
  ['num' => '#14', 'file' => '14-aes-256-gcm-web-encryptor.php', 'name' => 'AES-GCM Web Encryptor / Decryptor', 'cat' => 'Security'],
  ['num' => '#15', 'file' => '15-ip-geolocation-threat-inspector.php', 'name' => 'IP Geolocation & Threat Inspector', 'cat' => 'Security'],
  ['num' => '#16', 'file' => '16-sha256-sha1-hash-generator.php', 'name' => 'SHA-256 / SHA-1 Hash Generator', 'cat' => 'Security'],
  ['num' => '#17', 'file' => '17-jwt-token-decoder-inspector.php', 'name' => 'JWT Token Decoder & Inspector', 'cat' => 'Security'],
  ['num' => '#18', 'file' => '18-dns-email-policy-inspector.php', 'name' => 'DNS & Email Policy Inspector (SPF/DMARC)', 'cat' => 'Security'],
  ['num' => '#19', 'file' => '19-xss-payload-sanitizer-auditor.php', 'name' => 'XSS Sanitizer & Payload Auditor', 'cat' => 'Security'],
  ['num' => '#20', 'file' => '20-url-safety-redirect-inspector.php', 'name' => 'URL Safety & Redirect Inspector', 'cat' => 'Security'],
  ['num' => '#21', 'file' => '21-browser-port-reachability-scanner.php', 'name' => 'Browser Port Reachability Scanner', 'cat' => 'Security'],
  ['num' => '#22', 'file' => '22-base64-hex-encoder-decoder.php', 'name' => 'Base64 & Hex Encoder / Decoder', 'cat' => 'Security'],
  ['num' => '#23', 'file' => '23-gpa-sgpa-grade-calculator.php', 'name' => 'GPA / SGPA Calculator', 'cat' => 'Utility'],
  ['num' => '#24', 'file' => '24-code-beautifier-formatter.php', 'name' => 'Code Beautifier & Formatter', 'cat' => 'Utility'],
  ['num' => '#25', 'file' => '25-json-validator-linter.php', 'name' => 'JSON Validator & Linter', 'cat' => 'Utility'],
  ['num' => '#26', 'file' => '26-rest-api-tester.php', 'name' => 'REST API Tester', 'cat' => 'Utility'],
];

nexus_head(
  'Admin Control Center — Platform Management Dashboard',
  'Administrative management dashboard for Yaswant Dev platform: resources, courses, internships, blog CMS, cyber tools, and subscribers.',
  'admin panel, engineering platform management, yaswant dev admin',
  'https://yaswant.co.in/admin.php'
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('admin'); nexus_topbar('admin'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-xl">

      <!-- Admin Top Banner -->
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-md bg-surface-container-high rounded-2xl p-lg shadow-lg border border-outline-variant/20">
        <div class="flex items-center gap-md">
          <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center shadow-md">
            <span class="material-symbols-outlined text-[28px]" aria-hidden="true">admin_panel_settings</span>
          </div>
          <div>
            <div class="flex items-center gap-2">
              <h1 class="font-display-lg text-headline-md text-on-surface">Admin Control Center</h1>
              <span class="bg-primary/20 text-primary px-2 py-0.5 rounded text-[11px] font-label-sm uppercase tracking-wider">SuperAdmin</span>
            </div>
            <p class="font-body-md text-sm text-on-surface-variant">Full management over study notes, courses, internships, articles, security tools & subscribers.</p>
          </div>
        </div>
        <div class="flex items-center gap-xs flex-wrap">
          <button onclick="openModal('modal-add-resource')" class="bg-primary hover:bg-primary-fixed text-on-primary px-md py-sm rounded-lg font-label-sm transition-all flex items-center gap-xs text-xs shadow-md">
            <span class="material-symbols-outlined text-[16px]">add</span> Resource
          </button>
          <button onclick="openModal('modal-add-course')" class="bg-secondary hover:bg-secondary-fixed text-on-secondary px-md py-sm rounded-lg font-label-sm transition-all flex items-center gap-xs text-xs shadow-md">
            <span class="material-symbols-outlined text-[16px]">add</span> Course
          </button>
          <button onclick="openModal('modal-add-job')" class="bg-tertiary-container hover:bg-tertiary text-on-tertiary-container px-md py-sm rounded-lg font-label-sm transition-all flex items-center gap-xs text-xs shadow-md">
            <span class="material-symbols-outlined text-[16px]">add</span> Internship
          </button>
          <button onclick="openArticleStudio()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-md py-sm rounded-lg font-label-sm transition-all flex items-center gap-xs text-xs font-bold shadow-md">
            <span class="material-symbols-outlined text-[16px]">edit_note</span> Write Article
          </button>
          <a href="admin_logout.php" class="bg-error/20 hover:bg-error text-error hover:text-on-error px-md py-sm rounded-lg font-label-sm transition-all flex items-center gap-xs text-xs shadow-md">
            <span class="material-symbols-outlined text-[16px]">logout</span> Logout
          </a>
        </div>
      </div>

      <!-- Navigation Tabs -->
      <div class="flex items-center gap-2 overflow-x-auto pb-xs border-b border-outline-variant/20">
        <?php
        $tabs = [
          'overview'    => ['label' => 'Overview', 'icon' => 'dashboard'],
          'resources'   => ['label' => 'Resources (' . count($resources) . ')', 'icon' => 'folder_open'],
          'courses'     => ['label' => 'Courses (' . count($courses) . ')', 'icon' => 'school'],
          'internships' => ['label' => 'Internships (' . count($jobs) . ')', 'icon' => 'terminal'],
          'blog'        => ['label' => 'Blog CMS (' . count($articles) . ')', 'icon' => 'article'],
          'tools'       => ['label' => 'Cyber Tools (26)', 'icon' => 'build'],
          'subscribers' => ['label' => 'Subscribers (' . count($subscribers) . ')', 'icon' => 'mail'],
          'settings'    => ['label' => 'Diagnostics & Settings', 'icon' => 'settings'],
        ];
        foreach ($tabs as $key => $t):
          $active = ($tab === $key);
          $cls = $active ? 'bg-primary text-on-primary shadow-md' : 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface';
          ?>
          <a href="?tab=<?= $key ?>" class="px-md py-sm rounded-lg font-label-sm text-sm transition-all flex items-center gap-xs whitespace-nowrap <?= $cls ?>">
            <span class="material-symbols-outlined text-[18px]"><?= $t['icon'] ?></span><?= $t['label'] ?>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- TAB: OVERVIEW -->
      <?php if ($tab === 'overview'): ?>
        <div class="flex flex-col gap-2xl">
          <!-- KPI Metrics -->
          <div class="grid grid-cols-2 md:grid-cols-6 gap-md">
            <div class="bg-surface-container p-md rounded-xl shadow-sm border border-outline-variant/10">
              <div class="flex items-center justify-between text-outline text-xs mb-xs font-label-sm uppercase">Resources</div>
              <div class="text-2xl font-display-lg text-primary font-bold"><?= count($resources) ?></div>
              <span class="text-[11px] text-on-surface-variant">Active Study Files</span>
            </div>
            <div class="bg-surface-container p-md rounded-xl shadow-sm border border-outline-variant/10">
              <div class="flex items-center justify-between text-outline text-xs mb-xs font-label-sm uppercase">Courses</div>
              <div class="text-2xl font-display-lg text-secondary font-bold"><?= count($courses) ?></div>
              <span class="text-[11px] text-on-surface-variant">Free Modules</span>
            </div>
            <div class="bg-surface-container p-md rounded-xl shadow-sm border border-outline-variant/10">
              <div class="flex items-center justify-between text-outline text-xs mb-xs font-label-sm uppercase">Openings</div>
              <div class="text-2xl font-display-lg text-tertiary font-bold"><?= count($jobs) ?></div>
              <span class="text-[11px] text-on-surface-variant">Job Postings</span>
            </div>
            <div class="bg-surface-container p-md rounded-xl shadow-sm border border-outline-variant/10">
              <div class="flex items-center justify-between text-outline text-xs mb-xs font-label-sm uppercase">Blog Posts</div>
              <div class="text-2xl font-display-lg text-primary font-bold"><?= count($articles) ?></div>
              <span class="text-[11px] text-on-surface-variant">Articles</span>
            </div>
            <div class="bg-surface-container p-md rounded-xl shadow-sm border border-outline-variant/10">
              <div class="flex items-center justify-between text-outline text-xs mb-xs font-label-sm uppercase">Tools</div>
              <div class="text-2xl font-display-lg text-emerald-400 font-bold">26</div>
              <span class="text-[11px] text-on-surface-variant">Cyber Tools</span>
            </div>
            <div class="bg-surface-container p-md rounded-xl shadow-sm border border-outline-variant/10">
              <div class="flex items-center justify-between text-outline text-xs mb-xs font-label-sm uppercase">Subscribers</div>
              <div class="text-2xl font-display-lg text-secondary font-bold"><?= count($subscribers) ?></div>
              <span class="text-[11px] text-on-surface-variant">Subscribers</span>
            </div>
          </div>

          <!-- Quick Action Cards -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-lg">
            <div class="bg-surface-container p-lg rounded-2xl shadow-md border border-outline-variant/10 flex flex-col justify-between">
              <div>
                <div class="w-10 h-10 rounded-lg bg-primary/20 text-primary flex items-center justify-center mb-md">
                  <span class="material-symbols-outlined">upload_file</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Manage Resources</h3>
                <p class="text-xs text-on-surface-variant">Upload lecture notes, past sem PYQs, and lab manuals.</p>
              </div>
              <button onclick="openModal('modal-add-resource')" class="mt-lg w-full bg-primary text-on-primary py-sm rounded-lg font-label-sm text-xs hover:opacity-90 transition-opacity">
                + Add Resource
              </button>
            </div>

            <div class="bg-surface-container p-lg rounded-2xl shadow-md border border-outline-variant/10 flex flex-col justify-between">
              <div>
                <div class="w-10 h-10 rounded-lg bg-secondary/20 text-secondary flex items-center justify-center mb-md">
                  <span class="material-symbols-outlined">post_add</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Post Internship</h3>
                <p class="text-xs text-on-surface-variant">Publish software, DevOps, and ML internship roles.</p>
              </div>
              <button onclick="openModal('modal-add-job')" class="mt-lg w-full bg-secondary text-on-secondary py-sm rounded-lg font-label-sm text-xs hover:opacity-90 transition-opacity">
                + Post Internship
              </button>
            </div>

            <div class="bg-surface-container p-lg rounded-2xl shadow-md border border-outline-variant/10 flex flex-col justify-between">
              <div>
                <div class="w-10 h-10 rounded-lg bg-tertiary/20 text-tertiary flex items-center justify-center mb-md">
                  <span class="material-symbols-outlined">edit_note</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Write Blog Article</h3>
                <p class="text-xs text-on-surface-variant">Share technical guides with images, videos & code formatting.</p>
              </div>
              <button onclick="openArticleStudio()" class="mt-lg w-full bg-tertiary-container text-on-tertiary-container py-sm rounded-lg font-label-sm text-xs hover:opacity-90 transition-opacity font-bold">
                + Write Rich Article
              </button>
            </div>

            <div class="bg-surface-container p-lg rounded-2xl shadow-md border border-outline-variant/10 flex flex-col justify-between">
              <div>
                <div class="w-10 h-10 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center mb-md">
                  <span class="material-symbols-outlined">build</span>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Cyber Security Tools</h3>
                <p class="text-xs text-on-surface-variant">26 live security tools & web utility tools on domain.</p>
              </div>
              <a href="?tab=tools" class="mt-lg w-full bg-emerald-500 text-black py-sm rounded-lg font-label-sm text-xs text-center font-bold block hover:opacity-90 transition-opacity">
                Manage Tools
              </a>
            </div>
          </div>
        </div>

      <!-- TAB: RESOURCES MANAGER -->
      <?php elseif ($tab === 'resources'): ?>
        <div class="flex flex-col gap-md">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-md">
            <h2 class="font-headline-md text-headline-md text-on-surface">Study Resources Catalog</h2>
            <div class="flex items-center gap-xs w-full sm:w-auto">
              <input type="text" id="search-resources" oninput="filterTable('search-resources', 'tbl-resources')" placeholder="Filter resources..." class="bg-surface-container border border-outline-variant/30 rounded-lg px-md py-xs text-xs text-on-surface font-mono outline-none w-full sm:w-64"/>
              <button onclick="openModal('modal-add-resource')" class="bg-primary text-on-primary px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs whitespace-nowrap">
                <span class="material-symbols-outlined text-[16px]">add</span> Add Resource
              </button>
            </div>
          </div>
          <div class="bg-surface-container rounded-xl overflow-hidden shadow-md border border-outline-variant/10">
            <table id="tbl-resources" class="w-full text-left border-collapse text-sm">
              <thead>
                <tr class="bg-surface-container-high text-on-surface-variant font-label-sm text-xs uppercase border-b border-outline-variant/20">
                  <th class="p-md">Title</th>
                  <th class="p-md">Branch/Sem</th>
                  <th class="p-md">Type</th>
                  <th class="p-md">Author</th>
                  <th class="p-md">Size</th>
                  <th class="p-md text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-outline-variant/10">
                <?php foreach ($resources as $r): ?>
                  <tr class="hover:bg-surface-container-high/50 transition-colors">
                    <td class="p-md font-medium text-on-surface"><?= htmlspecialchars($r['title']) ?></td>
                    <td class="p-md text-on-surface-variant"><span class="bg-surface-variant px-2 py-0.5 rounded text-xs font-mono"><?= $r['branch'] ?> · <?= $r['sem'] ?></span></td>
                    <td class="p-md"><span class="bg-primary/10 text-primary px-2 py-0.5 rounded text-xs font-label-sm"><?= htmlspecialchars($r['type']) ?></span></td>
                    <td class="p-md text-on-surface-variant"><?= htmlspecialchars($r['by']) ?></td>
                    <td class="p-md text-on-surface-variant font-mono text-xs"><?= htmlspecialchars($r['size']) ?></td>
                    <td class="p-md text-right flex items-center justify-end gap-xs">
                      <button onclick='editResource(<?= json_encode($r) ?>)' class="text-primary hover:bg-primary/10 p-1.5 rounded-lg transition-colors" title="Edit Resource">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                      </button>
                      <button onclick="deleteItem('delete_resource', '<?= $r['id'] ?>')" class="text-error hover:bg-error/10 p-1.5 rounded-lg transition-colors" title="Delete">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      <!-- TAB: COURSES MANAGER -->
      <?php elseif ($tab === 'courses'): ?>
        <div class="flex flex-col gap-md">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-md">
            <h2 class="font-headline-md text-headline-md text-on-surface">Course Modules</h2>
            <div class="flex items-center gap-xs w-full sm:w-auto">
              <input type="text" id="search-courses" oninput="filterCards('search-courses', 'grid-courses')" placeholder="Filter courses..." class="bg-surface-container border border-outline-variant/30 rounded-lg px-md py-xs text-xs text-on-surface font-mono outline-none w-full sm:w-64"/>
              <button onclick="openModal('modal-add-course')" class="bg-secondary text-on-secondary px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs whitespace-nowrap">
                <span class="material-symbols-outlined text-[16px]">add</span> Add Course
              </button>
            </div>
          </div>
          <div id="grid-courses" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">
            <?php foreach ($courses as $c): ?>
              <div class="card-item bg-surface-container rounded-xl p-md shadow-md border border-outline-variant/10 flex flex-col justify-between">
                <div>
                  <div class="flex justify-between items-start mb-sm">
                    <span class="bg-secondary/10 text-secondary px-2 py-0.5 rounded text-xs font-label-sm uppercase"><?= htmlspecialchars($c['tag']) ?></span>
                    <div class="flex items-center gap-xs">
                      <button onclick='editCourse(<?= json_encode($c) ?>)' class="text-primary hover:bg-primary/10 p-1 rounded" title="Edit Course">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                      </button>
                      <button onclick="deleteItem('delete_course', '<?= $c['id'] ?>')" class="text-error hover:bg-error/10 p-1 rounded" title="Delete Course">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                      </button>
                    </div>
                  </div>
                  <h3 class="font-headline-md text-body-lg text-on-surface mb-xs"><?= htmlspecialchars($c['title']) ?></h3>
                  <p class="text-xs text-on-surface-variant font-mono"><?= $c['lessons'] ?> Lessons · <?= htmlspecialchars($c['level']) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

      <!-- TAB: INTERNSHIPS MANAGER -->
      <?php elseif ($tab === 'internships'): ?>
        <div class="flex flex-col gap-md">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-md">
            <h2 class="font-headline-md text-headline-md text-on-surface">Internships & Career Board</h2>
            <div class="flex items-center gap-xs w-full sm:w-auto">
              <input type="text" id="search-jobs" oninput="filterTable('search-jobs', 'tbl-jobs')" placeholder="Filter roles..." class="bg-surface-container border border-outline-variant/30 rounded-lg px-md py-xs text-xs text-on-surface font-mono outline-none w-full sm:w-64"/>
              <button onclick="openModal('modal-add-job')" class="bg-tertiary-container text-on-tertiary-container px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs whitespace-nowrap">
                <span class="material-symbols-outlined text-[16px]">add</span> Post Internship
              </button>
            </div>
          </div>
          <div class="bg-surface-container rounded-xl overflow-hidden shadow-md border border-outline-variant/10">
            <table id="tbl-jobs" class="w-full text-left border-collapse text-sm">
              <thead>
                <tr class="bg-surface-container-high text-on-surface-variant font-label-sm text-xs uppercase border-b border-outline-variant/20">
                  <th class="p-md">Role Title</th>
                  <th class="p-md">Company</th>
                  <th class="p-md">Location</th>
                  <th class="p-md">Stipend</th>
                  <th class="p-md">Tags</th>
                  <th class="p-md text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-outline-variant/10">
                <?php foreach ($jobs as $j): ?>
                  <tr class="hover:bg-surface-container-high/50 transition-colors">
                    <td class="p-md font-medium text-on-surface"><?= htmlspecialchars($j['title']) ?></td>
                    <td class="p-md text-on-surface-variant"><?= htmlspecialchars($j['company']) ?></td>
                    <td class="p-md text-on-surface-variant text-xs"><?= htmlspecialchars($j['location']) ?></td>
                    <td class="p-md text-secondary font-mono text-xs font-bold"><?= htmlspecialchars($j['pay']) ?></td>
                    <td class="p-md">
                      <div class="flex flex-wrap gap-1">
                        <?php foreach (($j['tags'] ?? []) as $t): ?>
                          <span class="bg-surface-variant px-1.5 py-0.5 rounded text-[10px] text-on-surface-variant"><?= htmlspecialchars($t) ?></span>
                        <?php endforeach; ?>
                      </div>
                    </td>
                    <td class="p-md text-right flex items-center justify-end gap-xs">
                      <button onclick='editJob(<?= json_encode($j) ?>)' class="text-primary hover:bg-primary/10 p-1.5 rounded-lg transition-colors" title="Edit Role">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                      </button>
                      <button onclick="deleteItem('delete_job', '<?= $j['id'] ?>')" class="text-error hover:bg-error/10 p-1.5 rounded-lg transition-colors" title="Delete Posting">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      <!-- TAB: BLOG CMS -->
      <?php elseif ($tab === 'blog'): ?>
        <div class="flex flex-col gap-md">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-md">
            <div>
              <h2 class="font-headline-md text-headline-md text-on-surface">Blog Articles CMS</h2>
              <p class="text-xs text-on-surface-variant">Publish technical articles with photos, videos, links & code formatting</p>
            </div>
            <div class="flex items-center gap-xs w-full sm:w-auto">
              <input type="text" id="search-articles" oninput="filterCards('search-articles', 'grid-articles')" placeholder="Filter articles..." class="bg-surface-container border border-outline-variant/30 rounded-lg px-md py-xs text-xs text-on-surface font-mono outline-none w-full sm:w-64"/>
              <button onclick="openArticleStudio()" class="bg-primary text-on-primary px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs whitespace-nowrap font-bold shadow-md">
                <span class="material-symbols-outlined text-[16px]">edit_note</span> Write Rich Article
              </button>
            </div>
          </div>
          <div id="grid-articles" class="grid grid-cols-1 md:grid-cols-2 gap-md">
            <?php foreach ($articles as $a): ?>
              <div class="card-item bg-surface-container rounded-xl p-md shadow-md border border-outline-variant/10 flex flex-col justify-between">
                <div>
                  <div class="flex justify-between items-start mb-sm">
                    <span class="bg-surface-variant px-2 py-0.5 rounded text-xs font-label-sm uppercase text-on-surface"><?= htmlspecialchars($a['cat']) ?></span>
                    <div class="flex items-center gap-xs">
                      <a href="<?= URL_BLOG ?>/post.php?id=<?= $a['id'] ?>" target="_blank" class="text-emerald-400 hover:bg-emerald-500/10 p-1 rounded" title="View Published Post">
                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                      </a>
                      <button onclick='editArticle(<?= json_encode($a) ?>)' class="text-primary hover:bg-primary/10 p-1 rounded" title="Edit Article Content">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                      </button>
                      <button onclick="deleteItem('delete_article', '<?= $a['id'] ?>')" class="text-error hover:bg-error/10 p-1 rounded" title="Delete Article">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                      </button>
                    </div>
                  </div>
                  <h3 class="font-headline-md text-body-lg text-on-surface mb-xs"><?= htmlspecialchars($a['title']) ?></h3>
                  <p class="text-xs text-on-surface-variant line-clamp-2 mb-sm"><?= htmlspecialchars($a['excerpt']) ?></p>
                </div>
                <div class="text-[11px] text-outline flex justify-between pt-sm border-t border-outline-variant/10">
                  <span>By <?= htmlspecialchars($a['author']) ?></span>
                  <span><?= htmlspecialchars($a['read']) ?> read</span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

      <!-- TAB: CYBER SECURITY TOOLS (26) MANAGER -->
      <?php elseif ($tab === 'tools'): ?>
        <div class="flex flex-col gap-md">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-md">
            <div>
              <h2 class="font-headline-md text-headline-md text-on-surface">Cyber Security & Dev Utilities (26)</h2>
              <p class="text-xs text-on-surface-variant">Live standalone files on <code class="text-emerald-400">tools.yaswant.co.in</code></p>
            </div>
            <input type="text" id="search-cyber-tools" oninput="filterTable('search-cyber-tools', 'tbl-cyber-tools')" placeholder="Search tools..." class="bg-surface-container border border-outline-variant/30 rounded-lg px-md py-xs text-xs text-on-surface font-mono outline-none w-full sm:w-64"/>
          </div>
          <div class="bg-surface-container rounded-xl overflow-hidden shadow-md border border-outline-variant/10">
            <table id="tbl-cyber-tools" class="w-full text-left border-collapse text-sm">
              <thead>
                <tr class="bg-surface-container-high text-on-surface-variant font-label-sm text-xs uppercase border-b border-outline-variant/20">
                  <th class="p-md">ID</th>
                  <th class="p-md">Tool Name</th>
                  <th class="p-md">File Name</th>
                  <th class="p-md">Category</th>
                  <th class="p-md text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-outline-variant/10">
                <?php foreach ($cyberTools as $ct): ?>
                  <tr class="hover:bg-surface-container-high/50 transition-colors">
                    <td class="p-md font-mono text-emerald-400 font-bold"><?= $ct['num'] ?></td>
                    <td class="p-md font-medium text-on-surface"><?= htmlspecialchars($ct['name']) ?></td>
                    <td class="p-md font-mono text-xs text-on-surface-variant"><?= $ct['file'] ?></td>
                    <td class="p-md"><span class="bg-emerald-500/10 text-emerald-400 px-2 py-0.5 rounded text-xs font-mono"><?= $ct['cat'] ?></span></td>
                    <td class="p-md text-right">
                      <a href="<?= URL_TOOLS . '/' . $ct['file'] ?>" target="_blank" class="text-emerald-400 hover:underline text-xs font-mono inline-flex items-center gap-xs">
                        Open Page <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      <!-- TAB: SUBSCRIBERS -->
      <?php elseif ($tab === 'subscribers'): ?>
        <div class="flex flex-col gap-md">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-md">
            <div>
              <h2 class="font-headline-md text-headline-md text-on-surface">Newsletter Subscribers List</h2>
              <p class="text-xs text-on-surface-variant font-mono">Live registered subscribers from public footer</p>
            </div>
            <div class="flex items-center gap-xs w-full sm:w-auto">
              <input type="text" id="search-subscribers" oninput="filterTable('search-subscribers', 'tbl-subscribers')" placeholder="Filter email..." class="bg-surface-container border border-outline-variant/30 rounded-lg px-md py-xs text-xs text-on-surface font-mono outline-none w-full sm:w-64"/>
              <button onclick="exportSubscribersCSV()" class="bg-emerald-500 text-black px-md py-xs rounded-lg font-mono text-xs font-bold flex items-center gap-xs whitespace-nowrap">
                <span class="material-symbols-outlined text-[16px]">download</span> Export CSV
              </button>
            </div>
          </div>
          <div class="bg-surface-container rounded-xl overflow-hidden shadow-md border border-outline-variant/10">
            <table id="tbl-subscribers" class="w-full text-left border-collapse text-sm">
              <thead>
                <tr class="bg-surface-container-high text-on-surface-variant font-label-sm text-xs uppercase border-b border-outline-variant/20">
                  <th class="p-md">Subscriber Email</th>
                  <th class="p-md">Date Subscribed</th>
                  <th class="p-md text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-outline-variant/10">
                <?php foreach ($subscribers as $s): ?>
                  <tr class="hover:bg-surface-container-high/50 transition-colors">
                    <td class="p-md font-medium text-on-surface"><?= htmlspecialchars($s['email']) ?></td>
                    <td class="p-md text-on-surface-variant font-mono text-xs"><?= htmlspecialchars($s['date']) ?></td>
                    <td class="p-md text-right">
                      <button onclick="deleteSubscriber('<?= htmlspecialchars($s['email']) ?>')" class="text-error hover:bg-error/10 p-1.5 rounded-lg transition-colors" title="Remove Email">
                        <span class="material-symbols-outlined text-[18px]">person_remove</span>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      <!-- TAB: DIAGNOSTICS & SETTINGS -->
      <?php elseif ($tab === 'settings'): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
          <div class="bg-surface-container rounded-2xl p-lg shadow-lg border border-outline-variant/10 space-y-md">
            <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-xs">
              <span class="material-symbols-outlined text-primary">dns</span> System Diagnostics
            </h2>
            <div class="space-y-sm text-xs font-mono">
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">PHP Runtime Engine</span>
                <span class="text-emerald-400 font-bold">PHP <?= phpversion() ?></span>
              </div>
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Database Provider</span>
                <span class="text-primary font-bold">MySQL PDO Engine (Hostinger/Local)</span>
              </div>
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Session Idle Timeout</span>
                <span class="text-secondary font-bold">15 Minutes Auto-Expire</span>
              </div>
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Server Timezone</span>
                <span class="text-tertiary font-bold"><?= date_default_timezone_get() ?> (<?= date('Y-m-d H:i:s') ?>)</span>
              </div>
            </div>
          </div>

          <div class="bg-surface-container rounded-2xl p-lg shadow-lg border border-outline-variant/10 space-y-md">
            <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-xs">
              <span class="material-symbols-outlined text-emerald-400">domain</span> Subdomain Routing Status
            </h2>
            <div class="space-y-sm text-xs font-mono">
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Main Website</span>
                <a href="<?= URL_MAIN ?>" target="_blank" class="text-emerald-400 hover:underline font-bold"><?= URL_MAIN ?></a>
              </div>
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Tools Domain</span>
                <a href="<?= URL_TOOLS ?>" target="_blank" class="text-emerald-400 hover:underline font-bold"><?= URL_TOOLS ?></a>
              </div>
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Projects Domain</span>
                <a href="<?= URL_PROJECT ?>" target="_blank" class="text-emerald-400 hover:underline font-bold"><?= URL_PROJECT ?></a>
              </div>
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Resume Domain</span>
                <a href="<?= URL_RESUME ?>" target="_blank" class="text-emerald-400 hover:underline font-bold"><?= URL_RESUME ?></a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<!-- MODAL: ADD / EDIT RESOURCE -->
<div id="modal-add-resource" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-md">
  <div class="bg-surface-container rounded-2xl p-lg max-w-md w-full shadow-2xl border border-outline-variant/20">
    <div class="flex justify-between items-center mb-md">
      <h3 id="res-modal-title" class="font-headline-md text-lg text-on-surface">Add Study Resource</h3>
      <button onclick="closeModal('modal-add-resource')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-resource" onsubmit="handleResourceSubmit(event)">
      <input type="hidden" id="res-id" name="id" value=""/>
      <div class="space-y-sm mb-md text-sm">
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Resource Title</label>
          <input id="res-title" name="title" required placeholder="e.g. Data Structures Notes Module 1" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Branch</label>
            <select id="res-branch" name="branch" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface">
              <option value="CS">Computer Science</option>
              <option value="ME">Mechanical</option>
              <option value="CE">Civil</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Semester</label>
            <select id="res-sem" name="sem" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface">
              <?php for ($s = 1; $s <= 8; $s++): ?>
                <option value="S<?= $s ?>">S<?= $s ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Type</label>
            <select id="res-type" name="type" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface">
              <option value="Notes">Notes</option>
              <option value="PYQ">PYQ</option>
              <option value="Lab Manual">Lab Manual</option>
              <option value="Cheat Sheet">Cheat Sheet</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Author / Source</label>
            <input id="res-by" name="by" value="Yaswant Admin" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
          </div>
        </div>
      </div>
      <button type="submit" id="res-btn-submit" class="w-full bg-primary text-on-primary py-sm rounded-lg font-label-sm">Save Resource</button>
    </form>
  </div>
</div>

<!-- MODAL: ADD / EDIT COURSE -->
<div id="modal-add-course" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-md">
  <div class="bg-surface-container rounded-2xl p-lg max-w-md w-full shadow-2xl border border-outline-variant/20">
    <div class="flex justify-between items-center mb-md">
      <h3 id="course-modal-title" class="font-headline-md text-lg text-on-surface">Create Course Module</h3>
      <button onclick="closeModal('modal-add-course')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-course" onsubmit="handleCourseSubmit(event)">
      <input type="hidden" id="course-id" name="id" value=""/>
      <div class="space-y-sm mb-md text-sm">
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Course Title</label>
          <input id="course-title" name="title" required placeholder="e.g. Distributed Systems 101" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Category Tag</label>
          <input id="course-tag" name="tag" value="Systems" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Lessons Count</label>
            <input id="course-lessons" name="lessons" type="number" value="30" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Level</label>
            <select id="course-level" name="level" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface">
              <option value="Beginner">Beginner</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Advanced">Advanced</option>
            </select>
          </div>
        </div>
      </div>
      <button type="submit" id="course-btn-submit" class="w-full bg-secondary text-on-secondary py-sm rounded-lg font-label-sm">Publish Course</button>
    </form>
  </div>
</div>

<!-- MODAL: ADD / EDIT JOB -->
<div id="modal-add-job" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-md">
  <div class="bg-surface-container rounded-2xl p-lg max-w-md w-full shadow-2xl border border-outline-variant/20">
    <div class="flex justify-between items-center mb-md">
      <h3 id="job-modal-title" class="font-headline-md text-lg text-on-surface">Post Internship Role</h3>
      <button onclick="closeModal('modal-add-job')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-job" onsubmit="handleJobSubmit(event)">
      <input type="hidden" id="job-id" name="id" value=""/>
      <div class="space-y-sm mb-md text-sm">
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Role Title</label>
          <input id="job-title" name="title" required placeholder="e.g. Backend Engineer Intern" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Company Name</label>
          <input id="job-company" name="company" required placeholder="e.g. Stripe, TechCorp" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Location</label>
            <input id="job-location" name="location" value="Remote" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Stipend / Pay</label>
            <input id="job-pay" name="pay" value="$45–$55/hr" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
          </div>
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Tech Stack Tags (comma separated)</label>
          <input id="job-tags" name="tags" value="React, Node.js, SQL" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
      </div>
      <button type="submit" id="job-btn-submit" class="w-full bg-tertiary-container text-on-tertiary-container py-sm rounded-lg font-label-sm">Post Role</button>
    </form>
  </div>
</div>

<!-- MODAL: RICH ARTICLE STUDIO (PHOTOS, VIDEOS, LINKS, FORMATTING, LIVE PREVIEW) -->
<div id="modal-add-article" class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 hidden items-center justify-center p-md">
  <div class="bg-surface-container rounded-2xl p-lg max-w-4xl w-full shadow-2xl border border-outline-variant/30 flex flex-col max-h-[90vh] overflow-hidden">
    
    <!-- Header -->
    <div class="flex justify-between items-center pb-sm border-b border-outline-variant/20 shrink-0">
      <div class="flex items-center gap-xs">
        <span class="material-symbols-outlined text-primary text-[24px]">edit_note</span>
        <h3 id="article-modal-title" class="font-headline-md text-lg font-bold text-on-surface">Rich Blog Article Studio</h3>
      </div>
      <button onclick="closeModal('modal-add-article')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
    </div>

    <!-- Mode Toggle: Write / Edit vs Live Preview -->
    <div class="flex items-center gap-xs bg-surface-container-lowest p-1 rounded-xl border border-outline-variant/20 my-sm shrink-0">
      <button id="btn-mode-write" onclick="switchArticleMode('write')" class="flex-1 py-1.5 rounded-lg text-xs font-mono font-bold bg-primary text-on-primary transition-all flex items-center justify-center gap-xs">
        <span class="material-symbols-outlined text-[16px]">edit</span> Write & Edit Article
      </button>
      <button id="btn-mode-preview" onclick="switchArticleMode('preview')" class="flex-1 py-1.5 rounded-lg text-xs font-mono font-bold text-on-surface-variant hover:text-on-surface transition-all flex items-center justify-center gap-xs">
        <span class="material-symbols-outlined text-[16px]">visibility</span> Live Article Preview
      </button>
    </div>

    <!-- Form Container -->
    <form id="form-article" onsubmit="handleArticleSubmit(event)" class="flex-1 flex flex-col overflow-y-auto pr-xs">
      <input type="hidden" id="article-id" name="id" value=""/>
      
      <!-- WRITE / EDIT MODE CONTENT -->
      <div id="pane-write" class="space-y-sm text-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Article Title</label>
            <input id="article-title" name="title" required placeholder="e.g. Master System Design Patterns in 2026" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-sm text-xs font-mono text-on-surface outline-none focus:ring-2 focus:ring-primary" />
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Header Cover Image URL</label>
            <input id="article-img" name="img" placeholder="https://images.unsplash.com/photo-..." value="https://images.unsplash.com/photo-1517694712202-14dd9538aa97" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-sm text-xs font-mono text-on-surface outline-none focus:ring-2 focus:ring-primary" />
          </div>
        </div>

        <div class="grid grid-cols-3 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Category</label>
            <select id="article-cat" name="cat" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-sm text-xs font-mono text-on-surface outline-none">
              <option value="Technical">Technical</option>
              <option value="Career">Career</option>
              <option value="Student Life">Student Life</option>
              <option value="Research">Research</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Author Name</label>
            <input id="article-author" name="author" value="Yaswant Team" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-sm text-xs font-mono text-on-surface outline-none" />
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Estimated Read Time</label>
            <input id="article-read" name="read" value="5 min" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-sm text-xs font-mono text-on-surface outline-none" />
          </div>
        </div>

        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Excerpt / Summary Abstract</label>
          <textarea id="article-excerpt" name="excerpt" rows="2" required class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-sm text-xs font-mono text-on-surface outline-none" placeholder="Brief article abstract displayed on cards..."></textarea>
        </div>

        <!-- Rich Toolbar for Images, Videos, Links & Formatting -->
        <div class="space-y-xs">
          <div class="flex items-center justify-between">
            <label class="block text-xs font-label-sm text-on-surface-variant">Full Rich Article Body (Supports HTML, Images & Video Embeds)</label>
            <span class="text-[10px] font-mono text-emerald-400">Toolbar Shortcuts:</span>
          </div>

          <div class="flex items-center gap-xs flex-wrap bg-surface-container-lowest p-2 rounded-xl border border-outline-variant/20 text-xs font-mono">
            <button type="button" onclick="insertArticleSnippet('img')" class="bg-surface-container hover:bg-primary/20 text-primary px-2 py-1 rounded border border-outline-variant/20 flex items-center gap-1">
              <span class="material-symbols-outlined text-[14px]">image</span> Add Photo
            </button>
            <button type="button" onclick="insertArticleSnippet('video')" class="bg-surface-container hover:bg-secondary/20 text-secondary px-2 py-1 rounded border border-outline-variant/20 flex items-center gap-1">
              <span class="material-symbols-outlined text-[14px]">video_library</span> Embed Video
            </button>
            <button type="button" onclick="insertArticleSnippet('link')" class="bg-surface-container hover:bg-tertiary/20 text-tertiary px-2 py-1 rounded border border-outline-variant/20 flex items-center gap-1">
              <span class="material-symbols-outlined text-[14px]">link</span> Insert Link
            </button>
            <button type="button" onclick="insertArticleSnippet('code')" class="bg-surface-container hover:bg-emerald-500/20 text-emerald-400 px-2 py-1 rounded border border-outline-variant/20 flex items-center gap-1">
              <span class="material-symbols-outlined text-[14px]">code</span> Code Block
            </button>
            <button type="button" onclick="insertArticleSnippet('h2')" class="bg-surface-container hover:bg-surface-variant text-on-surface px-2 py-1 rounded border border-outline-variant/20 font-bold">
              H2 Heading
            </button>
            <button type="button" onclick="insertArticleSnippet('quote')" class="bg-surface-container hover:bg-surface-variant text-on-surface px-2 py-1 rounded border border-outline-variant/20 italic">
              Quote
            </button>
          </div>

          <textarea id="article-content" name="content" rows="10" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none focus:ring-2 focus:ring-primary leading-relaxed" placeholder="Write full article body here... Use toolbar buttons above to insert images, videos, and links!"></textarea>
        </div>
      </div>

      <!-- LIVE PREVIEW PANE -->
      <div id="pane-preview" class="hidden space-y-md bg-surface-container-lowest p-lg rounded-xl border border-outline-variant/20">
        <div id="prev-cover" class="w-full h-48 rounded-xl overflow-hidden hidden">
          <img id="prev-img-el" src="" class="w-full h-full object-cover"/>
        </div>
        <div class="flex items-center gap-sm text-xs font-mono">
          <span id="prev-cat" class="px-2 py-0.5 rounded bg-primary/20 text-primary font-bold">TECHNICAL</span>
          <span id="prev-read" class="text-zinc-400">5 min read</span>
          <span id="prev-author" class="text-zinc-400">By Yaswant Team</span>
        </div>
        <h2 id="prev-title" class="text-xl font-bold text-on-surface font-display-lg">Article Title Preview</h2>
        <div id="prev-excerpt" class="bg-surface-container p-sm rounded-lg text-xs italic text-on-surface-variant border-l-2 border-primary">Excerpt preview...</div>
        <div id="prev-body" class="prose prose-invert max-w-none text-xs text-on-surface space-y-sm border-t border-outline-variant/20 pt-md">
          Body content preview...
        </div>
      </div>

      <div class="pt-md shrink-0 border-t border-outline-variant/20 mt-md">
        <button type="submit" id="article-btn-submit" class="w-full bg-primary text-on-primary py-sm rounded-xl font-label-sm font-bold text-sm shadow-md">Publish Rich Article</button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal(id) {
    const el = document.getElementById(id);
    if (el) { el.classList.remove('hidden'); el.classList.add('flex'); }
  }
  function closeModal(id) {
    const el = document.getElementById(id);
    if (el) { el.classList.add('hidden'); el.classList.remove('flex'); }
  }

  // Open Article Studio Fresh
  function openArticleStudio() {
    document.getElementById('article-modal-title').innerText = 'Rich Blog Article Studio';
    document.getElementById('article-id').value = '';
    document.getElementById('article-title').value = '';
    document.getElementById('article-cat').value = 'Technical';
    document.getElementById('article-author').value = 'Yaswant Team';
    document.getElementById('article-read').value = '5 min';
    document.getElementById('article-img').value = 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97';
    document.getElementById('article-excerpt').value = '';
    document.getElementById('article-content').value = '<p>Start typing your rich article body here...</p>\n<h2>1. Introduction</h2>\n<p>Write your detailed technical explanation or career advice.</p>';
    document.getElementById('article-btn-submit').innerText = 'Publish Rich Article';
    switchArticleMode('write');
    openModal('modal-add-article');
  }

  // Edit Existing Article in Studio
  function editArticle(a) {
    document.getElementById('article-modal-title').innerText = 'Edit Article Studio';
    document.getElementById('article-id').value = a.id;
    document.getElementById('article-title').value = a.title;
    document.getElementById('article-cat').value = a.cat || 'Technical';
    document.getElementById('article-author').value = a.author || 'Yaswant Team';
    document.getElementById('article-read').value = a.read || a.readTime || '5 min';
    document.getElementById('article-img').value = a.img || 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97';
    document.getElementById('article-excerpt').value = a.excerpt || '';
    document.getElementById('article-content').value = a.content || '<p>' + (a.excerpt || '') + '</p>';
    document.getElementById('article-btn-submit').innerText = 'Update Article';
    switchArticleMode('write');
    openModal('modal-add-article');
  }

  // Switch Mode between Write & Live Preview
  function switchArticleMode(mode) {
    const paneWrite = document.getElementById('pane-write');
    const panePrev = document.getElementById('pane-preview');
    const btnWrite = document.getElementById('btn-mode-write');
    const btnPrev = document.getElementById('btn-mode-preview');

    if (mode === 'write') {
      paneWrite.classList.remove('hidden');
      panePrev.classList.add('hidden');
      btnWrite.className = 'flex-1 py-1.5 rounded-lg text-xs font-mono font-bold bg-primary text-on-primary transition-all flex items-center justify-center gap-xs';
      btnPrev.className = 'flex-1 py-1.5 rounded-lg text-xs font-mono font-bold text-on-surface-variant hover:text-on-surface transition-all flex items-center justify-center gap-xs';
    } else {
      paneWrite.classList.add('hidden');
      panePrev.classList.remove('hidden');
      btnPrev.className = 'flex-1 py-1.5 rounded-lg text-xs font-mono font-bold bg-primary text-on-primary transition-all flex items-center justify-center gap-xs';
      btnWrite.className = 'flex-1 py-1.5 rounded-lg text-xs font-mono font-bold text-on-surface-variant hover:text-on-surface transition-all flex items-center justify-center gap-xs';
      
      // Update Live Preview fields
      const img = document.getElementById('article-img').value;
      const prevCover = document.getElementById('prev-cover');
      if (img) {
        document.getElementById('prev-img-el').src = img;
        prevCover.classList.remove('hidden');
      } else {
        prevCover.classList.add('hidden');
      }
      document.getElementById('prev-title').innerText = document.getElementById('article-title').value || 'Untitled Article';
      document.getElementById('prev-cat').innerText = (document.getElementById('article-cat').value || 'TECHNICAL').toUpperCase();
      document.getElementById('prev-read').innerText = (document.getElementById('article-read').value || '5 min') + ' read';
      document.getElementById('prev-author').innerText = 'By ' + (document.getElementById('article-author').value || 'Yaswant Team');
      document.getElementById('prev-excerpt').innerText = document.getElementById('article-excerpt').value || 'No summary excerpt entered.';
      document.getElementById('prev-body').innerHTML = document.getElementById('article-content').value || '<p class="text-zinc-500">No article body written yet.</p>';
    }
  }

  // Insert Rich Snippets (Photos, Videos, Links, Code, Quotes, Headings)
  function insertArticleSnippet(type) {
    const area = document.getElementById('article-content');
    let snippet = '';

    if (type === 'img') {
      const url = prompt('Enter Image URL:', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97');
      if (!url) return;
      const alt = prompt('Enter Photo Caption / Alt text:', 'Engineering Diagram');
      snippet = `\n<figure class="my-md">\n  <img src="${url}" alt="${alt || 'Image'}" class="w-full rounded-xl shadow-lg border border-outline-variant/20"/>\n  <figcaption class="text-center text-xs text-zinc-400 mt-xs font-mono">${alt || ''}</figcaption>\n</figure>\n`;
    } else if (type === 'video') {
      let url = prompt('Enter YouTube Embed / Video URL (e.g. https://www.youtube.com/embed/dQw4w9WgXcQ):', 'https://www.youtube.com/embed/dQw4w9WgXcQ');
      if (!url) return;
      if (url.includes('watch?v=')) {
        url = url.replace('watch?v=', 'embed/');
      }
      snippet = `\n<div class="aspect-video w-full my-md rounded-xl overflow-hidden shadow-xl border border-outline-variant/20">\n  <iframe src="${url}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>\n</div>\n`;
    } else if (type === 'link') {
      const url = prompt('Enter Hyperlink Target URL:', 'https://yaswant.co.in');
      if (!url) return;
      const text = prompt('Enter Link Text:', 'Visit Link');
      snippet = `<a href="${url}" target="_blank" class="text-primary hover:underline font-bold">${text || url}</a>`;
    } else if (type === 'code') {
      snippet = `\n<pre class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-emerald-400 border border-outline-variant/20 my-md overflow-x-auto"><code>// Enter sample code here\nfunction example() {\n  console.log("Hello World");\n}</code></pre>\n`;
    } else if (type === 'h2') {
      snippet = `\n<h2 class="text-xl font-bold text-on-surface font-display-lg mt-lg mb-xs">Subheading Title</h2>\n`;
    } else if (type === 'quote') {
      snippet = `\n<blockquote class="bg-surface-container-lowest border-l-4 border-primary p-md rounded-r-xl italic text-on-surface-variant my-md">\n  "Engineering is the art of modeling materials we do not wholly understand..."\n</blockquote>\n`;
    }

    const start = area.selectionStart;
    const end = area.selectionEnd;
    area.value = area.value.substring(0, start) + snippet + area.value.substring(end);
    area.focus();
  }

  // Filter tables by user input
  function filterTable(inputId, tableId) {
    const q = document.getElementById(inputId).value.toLowerCase();
    const rows = document.querySelectorAll(`#${tableId} tbody tr`);
    rows.forEach(r => {
      const text = r.innerText.toLowerCase();
      r.style.display = text.includes(q) ? '' : 'none';
    });
  }

  // Filter grid cards
  function filterCards(inputId, gridId) {
    const q = document.getElementById(inputId).value.toLowerCase();
    const cards = document.querySelectorAll(`#${gridId} .card-item`);
    cards.forEach(c => {
      const text = c.innerText.toLowerCase();
      c.style.display = text.includes(q) ? '' : 'none';
    });
  }

  // Export Subscribers to CSV
  function exportSubscribersCSV() {
    const rows = document.querySelectorAll('#tbl-subscribers tbody tr');
    let csv = 'Email,Date Subscribed\n';
    rows.forEach(r => {
      const cols = r.querySelectorAll('td');
      if (cols.length >= 2) {
        csv += `"${cols[0].innerText.trim()}","${cols[1].innerText.trim()}"\n`;
      }
    });
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'subscribers_list.csv';
    a.click();
  }

  // Edit Handlers for populated forms
  function editResource(r) {
    document.getElementById('res-modal-title').innerText = 'Edit Study Resource';
    document.getElementById('res-id').value = r.id;
    document.getElementById('res-title').value = r.title;
    document.getElementById('res-branch').value = r.branch || 'CS';
    document.getElementById('res-sem').value = r.sem || 'S1';
    document.getElementById('res-type').value = r.type || 'Notes';
    document.getElementById('res-by').value = r.by || 'Yaswant Admin';
    document.getElementById('res-btn-submit').innerText = 'Update Resource';
    openModal('modal-add-resource');
  }

  function editCourse(c) {
    document.getElementById('course-modal-title').innerText = 'Edit Course Module';
    document.getElementById('course-id').value = c.id;
    document.getElementById('course-title').value = c.title;
    document.getElementById('course-tag').value = c.tag || 'General';
    document.getElementById('course-lessons').value = c.lessons || 20;
    document.getElementById('course-level').value = c.level || 'Beginner';
    document.getElementById('course-btn-submit').innerText = 'Update Course';
    openModal('modal-add-course');
  }

  function editJob(j) {
    document.getElementById('job-modal-title').innerText = 'Edit Internship Role';
    document.getElementById('job-id').value = j.id;
    document.getElementById('job-title').value = j.title;
    document.getElementById('job-company').value = j.company;
    document.getElementById('job-location').value = j.location || 'Remote';
    document.getElementById('job-pay').value = j.pay || '$40/hr';
    document.getElementById('job-tags').value = Array.isArray(j.tags) ? j.tags.join(', ') : (j.tags || '');
    document.getElementById('job-btn-submit').innerText = 'Update Internship';
    openModal('modal-add-job');
  }

  // Form Submission Processors
  function handleResourceSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('res-id').value;
    const action = id ? 'edit_resource' : 'add_resource';
    submitAdminForm(e.target, action);
  }

  function handleCourseSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('course-id').value;
    const action = id ? 'edit_course' : 'add_course';
    submitAdminForm(e.target, action);
  }

  function handleJobSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('job-id').value;
    const action = id ? 'edit_job' : 'add_job';
    submitAdminForm(e.target, action);
  }

  function handleArticleSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('article-id').value;
    const action = id ? 'edit_article' : 'add_article';
    submitAdminForm(e.target, action);
  }

  function submitAdminForm(formEl, action) {
    const formData = new FormData(formEl);
    formData.append('action', action);
    fetch('api/admin_action.php', { method: 'POST', body: formData })
      .then(r => r.json())
      .then(res => {
        if (res.success) {
          window.location.reload();
        } else {
          alert(res.error || 'Operation failed');
        }
      });
  }

  function deleteItem(action, id) {
    if (!confirm('Are you sure you want to delete this item?')) return;
    const formData = new FormData();
    formData.append('action', action);
    formData.append('id', id);
    fetch('api/admin_action.php', { method: 'POST', body: formData })
      .then(r => r.json())
      .then(res => {
        if (res.success) window.location.reload();
        else alert(res.error || 'Delete failed');
      });
  }

  function deleteSubscriber(email) {
    if (!confirm('Remove subscriber ' + email + '?')) return;
    const formData = new FormData();
    formData.append('action', 'delete_subscriber');
    formData.append('email', email);
    fetch('api/admin_action.php', { method: 'POST', body: formData })
      .then(r => r.json())
      .then(res => {
        if (res.success) window.location.reload();
        else alert(res.error || 'Delete failed');
      });
  }
</script>