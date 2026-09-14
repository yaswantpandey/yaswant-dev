<?php
// admin.php — Yaswant Dev Admin Control Center (Full Management Dashboard)
session_start();

// Auto-expire admin session after 2 hours of inactivity
if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 7200)) {
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
          <button onclick="openResourceModal()" class="bg-primary hover:bg-primary-fixed text-on-primary px-md py-sm rounded-lg font-label-sm transition-all flex items-center gap-xs text-xs shadow-md">
            <span class="material-symbols-outlined text-[16px]">add</span> Resource
          </button>
          <button onclick="openCourseModal()" class="bg-secondary hover:bg-secondary-fixed text-on-secondary px-md py-sm rounded-lg font-label-sm transition-all flex items-center gap-xs text-xs shadow-md">
            <span class="material-symbols-outlined text-[16px]">add</span> Course
          </button>
          <button onclick="openJobModal()" class="bg-tertiary-container hover:bg-tertiary text-on-tertiary-container px-md py-sm rounded-lg font-label-sm transition-all flex items-center gap-xs text-xs shadow-md">
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
          'overview'      => ['label' => 'Overview', 'icon' => 'dashboard'],
          'resources'     => ['label' => 'Resources (' . count($resources) . ')', 'icon' => 'folder_open'],
          'courses'       => ['label' => 'Courses (' . count($courses) . ')', 'icon' => 'school'],
          'internships'   => ['label' => 'Internships (' . count($jobs) . ')', 'icon' => 'terminal'],
          'blog'          => ['label' => 'Blog CMS (' . count($articles) . ')', 'icon' => 'article'],
          'tools'         => ['label' => 'Cyber Tools (26)', 'icon' => 'build'],
          'subscribers'   => ['label' => 'Subscribers (' . count($subscribers) . ')', 'icon' => 'mail'],
          'announcements' => ['label' => 'Announcements', 'icon' => 'campaign'],
          'analytics'     => ['label' => 'Analytics', 'icon' => 'analytics'],
          'activity'      => ['label' => 'Activity Log', 'icon' => 'history'],
          'settings'      => ['label' => 'Settings', 'icon' => 'settings'],
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
              <button onclick="openResourceModal()" class="bg-primary text-on-primary px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs whitespace-nowrap">
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
                      <?php if (!empty($r['download_url'])): ?>
                        <a href="<?= htmlspecialchars($r['download_url']) ?>" target="_blank" rel="noopener" class="text-emerald-400 hover:bg-emerald-500/10 p-1.5 rounded-lg transition-colors" title="Download Resource">
                          <span class="material-symbols-outlined text-[18px]">download</span>
                        </a>
                      <?php endif; ?>
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
              <button onclick="openCourseModal()" class="bg-secondary text-on-secondary px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs whitespace-nowrap">
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
                      <?php if (!empty($c['playlist_url'])): ?>
                        <a href="<?= htmlspecialchars($c['playlist_url']) ?>" target="_blank" rel="noopener" class="text-emerald-400 hover:bg-emerald-500/10 p-1 rounded" title="View Syllabus / Playlist">
                          <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        </a>
                      <?php endif; ?>
                      <button onclick='editCourse(<?= json_encode($c) ?>)' class="text-primary hover:bg-primary/10 p-1 rounded" title="Edit Course">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                      </button>
                      <button onclick="deleteItem('delete_course', '<?= $c['id'] ?>')" class="text-error hover:bg-error/10 p-1 rounded" title="Delete Course">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                      </button>
                    </div>
                  </div>
                  <h3 class="font-headline-md text-body-lg text-on-surface mb-xs"><?= htmlspecialchars($c['title']) ?></h3>
                  <?php if (!empty($c['description'])): ?>
                    <p class="text-xs text-on-surface-variant line-clamp-2 mb-xs"><?= htmlspecialchars($c['description']) ?></p>
                  <?php endif; ?>
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
              <button onclick="openJobModal()" class="bg-tertiary-container text-on-tertiary-container px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs whitespace-nowrap">
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
                      <?php if (!empty($j['apply_url'])): ?>
                        <a href="<?= htmlspecialchars($j['apply_url']) ?>" target="_blank" rel="noopener" class="text-emerald-400 hover:bg-emerald-500/10 p-1.5 rounded-lg transition-colors" title="Visit Application Portal">
                          <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        </a>
                      <?php endif; ?>
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
            <?php foreach ($articles as $a):
              $status = $a['status'] ?? 'published';
            ?>
              <div class="card-item bg-surface-container rounded-xl p-md shadow-md border border-outline-variant/10 flex flex-col justify-between <?= $status === 'draft' ? 'opacity-60' : '' ?>">
                <div>
                  <div class="flex justify-between items-start mb-sm">
                    <div class="flex items-center gap-xs">
                      <span class="bg-surface-variant px-2 py-0.5 rounded text-xs font-label-sm uppercase text-on-surface"><?= htmlspecialchars($a['cat']) ?></span>
                      <span class="px-2 py-0.5 rounded text-[10px] font-bold <?= $status === 'published' ? 'bg-emerald-500/15 text-emerald-400' : 'bg-amber-500/15 text-amber-400' ?>"><?= strtoupper($status) ?></span>
                    </div>
                    <div class="flex items-center gap-xs">
                      <a href="<?= URL_BLOG ?>/post.php?id=<?= $a['id'] ?>" target="_blank" class="text-emerald-400 hover:bg-emerald-500/10 p-1 rounded" title="View Post">
                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                      </a>
                      <button onclick="toggleArticleStatus(<?= $a['id'] ?>, this)" class="<?= $status === 'published' ? 'text-amber-400 hover:bg-amber-500/10' : 'text-emerald-400 hover:bg-emerald-500/10' ?> p-1 rounded" title="Toggle Draft/Published">
                        <span class="material-symbols-outlined text-[18px]"><?= $status === 'published' ? 'archive' : 'unarchive' ?></span>
                      </button>
                      <button onclick='editArticle(<?= json_encode($a) ?>)' class="text-primary hover:bg-primary/10 p-1 rounded" title="Edit Article">
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
            <div class="flex items-center gap-xs w-full sm:w-auto flex-wrap">
              <input type="text" id="search-subscribers" oninput="filterTable('search-subscribers', 'tbl-subscribers')" placeholder="Filter email..." class="bg-surface-container border border-outline-variant/30 rounded-lg px-md py-xs text-xs text-on-surface font-mono outline-none w-full sm:w-48"/>
              <button id="btn-bulk-delete" onclick="bulkDeleteSubscribers()" class="hidden bg-error text-on-error px-md py-xs rounded-lg font-mono text-xs font-bold flex items-center gap-xs whitespace-nowrap">
                <span class="material-symbols-outlined text-[16px]">delete_sweep</span> Delete Selected
              </button>
              <button onclick="exportSubscribersCSV()" class="bg-emerald-500 text-black px-md py-xs rounded-lg font-mono text-xs font-bold flex items-center gap-xs whitespace-nowrap">
                <span class="material-symbols-outlined text-[16px]">download</span> Export CSV
              </button>
            </div>
          </div>
          <div class="bg-surface-container rounded-xl overflow-hidden shadow-md border border-outline-variant/10">
            <table id="tbl-subscribers" class="w-full text-left border-collapse text-sm">
              <thead>
                <tr class="bg-surface-container-high text-on-surface-variant font-label-sm text-xs uppercase border-b border-outline-variant/20">
                  <th class="p-md w-10"><input type="checkbox" id="cb-select-all" onchange="toggleAllSubscribers(this)" class="rounded" title="Select All"/></th>
                  <th class="p-md">Subscriber Email</th>
                  <th class="p-md">Date Subscribed</th>
                  <th class="p-md text-right">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-outline-variant/10">
                <?php foreach ($subscribers as $s): ?>
                  <tr class="hover:bg-surface-container-high/50 transition-colors">
                    <td class="p-md"><input type="checkbox" class="sub-cb rounded" value="<?= htmlspecialchars($s['email']) ?>" onchange="updateBulkBtn()"/></td>
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

      <!-- TAB: ANNOUNCEMENTS -->
      <?php elseif ($tab === 'announcements'): ?>
        <div class="flex flex-col gap-md">
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-md">
            <div>
              <h2 class="font-headline-md text-headline-md text-on-surface">Site Announcements</h2>
              <p class="text-xs text-on-surface-variant">Publish visible banners on your website for visitors</p>
            </div>
            <button onclick="openModal('modal-add-announcement')" class="bg-primary text-on-primary px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs whitespace-nowrap shadow-md">
              <span class="material-symbols-outlined text-[16px]">campaign</span> New Announcement
            </button>
          </div>
          <div id="announcements-list" class="flex flex-col gap-sm">
            <div class="text-xs text-on-surface-variant font-mono animate-pulse">Loading announcements...</div>
          </div>
        </div>

      <!-- TAB: ANALYTICS -->
      <?php elseif ($tab === 'analytics'): ?>
        <div class="flex flex-col gap-xl">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="font-headline-md text-headline-md text-on-surface">Platform Analytics</h2>
              <p class="text-xs text-on-surface-variant">Live content counts and platform health metrics</p>
            </div>
            <button onclick="refreshStats()" id="btn-refresh-stats" class="bg-surface-container hover:bg-surface-container-high text-on-surface px-md py-sm rounded-lg font-label-sm text-xs flex items-center gap-xs border border-outline-variant/20 transition-all">
              <span class="material-symbols-outlined text-[16px]">refresh</span> Refresh Live Stats
            </button>
          </div>

          <!-- Live Stats Grid -->
          <div id="analytics-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-md">
            <?php
            $analyticsItems = [
              ['label'=>'Resources','value'=>count($resources),'icon'=>'folder_open','color'=>'text-primary','bg'=>'bg-primary/10'],
              ['label'=>'Courses','value'=>count($courses),'icon'=>'school','color'=>'text-secondary','bg'=>'bg-secondary/10'],
              ['label'=>'Internships','value'=>count($jobs),'icon'=>'terminal','color'=>'text-tertiary','bg'=>'bg-tertiary/10'],
              ['label'=>'Articles','value'=>count($articles),'icon'=>'article','color'=>'text-primary','bg'=>'bg-primary/10'],
              ['label'=>'Subscribers','value'=>count($subscribers),'icon'=>'mail','color'=>'text-emerald-400','bg'=>'bg-emerald-500/10'],
            ];
            foreach ($analyticsItems as $ai): ?>
              <div class="bg-surface-container p-lg rounded-2xl shadow-md border border-outline-variant/10 flex flex-col gap-sm">
                <div class="w-10 h-10 rounded-xl <?= $ai['bg'] ?> <?= $ai['color'] ?> flex items-center justify-center">
                  <span class="material-symbols-outlined"><?= $ai['icon'] ?></span>
                </div>
                <div class="stat-value text-3xl font-bold <?= $ai['color'] ?>" data-stat="<?= strtolower($ai['label']) ?>"><?= $ai['value'] ?></div>
                <div class="text-xs text-on-surface-variant font-label-sm"><?= $ai['label'] ?></div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- System Health -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
            <div class="bg-surface-container rounded-2xl p-lg shadow-md border border-outline-variant/10">
              <h3 class="font-headline-md text-sm font-bold text-on-surface mb-md flex items-center gap-xs">
                <span class="material-symbols-outlined text-emerald-400 text-[20px]">health_and_safety</span> System Health
              </h3>
              <div class="space-y-sm text-xs font-mono">
                <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg">
                  <span class="text-on-surface-variant">PHP Version</span>
                  <span class="text-emerald-400 font-bold">PHP <?= phpversion() ?></span>
                </div>
                <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg">
                  <span class="text-on-surface-variant">Memory Usage</span>
                  <span class="text-secondary font-bold"><?= round(memory_get_usage(true)/1048576, 2) ?> MB</span>
                </div>
                <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg">
                  <span class="text-on-surface-variant">Peak Memory</span>
                  <span class="text-tertiary font-bold"><?= round(memory_get_peak_usage(true)/1048576, 2) ?> MB</span>
                </div>
                <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg">
                  <span class="text-on-surface-variant">Server Time</span>
                  <span id="live-clock" class="text-primary font-bold"><?= date('H:i:s') ?></span>
                </div>
                <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg">
                  <span class="text-on-surface-variant">Uptime Since</span>
                  <span class="text-on-surface font-bold"><?= date('Y-m-d', $_SESSION['last_activity'] - 7200) ?></span>
                </div>
              </div>
            </div>
            <div class="bg-surface-container rounded-2xl p-lg shadow-md border border-outline-variant/10">
              <h3 class="font-headline-md text-sm font-bold text-on-surface mb-md flex items-center gap-xs">
                <span class="material-symbols-outlined text-primary text-[20px]">pie_chart</span> Content Distribution
              </h3>
              <div class="space-y-sm">
                <?php
                $total = count($resources) + count($courses) + count($jobs) + count($articles);
                $distItems = [
                  ['label'=>'Resources','count'=>count($resources),'color'=>'bg-primary'],
                  ['label'=>'Courses','count'=>count($courses),'color'=>'bg-secondary'],
                  ['label'=>'Internships','count'=>count($jobs),'color'=>'bg-tertiary'],
                  ['label'=>'Articles','count'=>count($articles),'color'=>'bg-emerald-500'],
                ];
                foreach ($distItems as $d):
                  $pct = $total > 0 ? round($d['count'] / $total * 100) : 0;
                ?>
                  <div>
                    <div class="flex justify-between text-xs mb-1">
                      <span class="text-on-surface-variant"><?= $d['label'] ?></span>
                      <span class="text-on-surface font-bold"><?= $d['count'] ?> <span class="text-outline">(<?= $pct ?>%)</span></span>
                    </div>
                    <div class="w-full bg-surface-container-lowest rounded-full h-1.5">
                      <div class="<?= $d['color'] ?> h-1.5 rounded-full transition-all duration-700" style="width:<?= $pct ?>%"></div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

      <!-- TAB: ACTIVITY LOG -->
      <?php elseif ($tab === 'activity'): ?>
        <div class="flex flex-col gap-md">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="font-headline-md text-headline-md text-on-surface">Admin Activity Log</h2>
              <p class="text-xs text-on-surface-variant">Last 100 admin actions recorded by the system</p>
            </div>
            <button onclick="clearActivityLog()" class="bg-error/10 hover:bg-error text-error hover:text-on-error px-md py-xs rounded-lg font-label-sm text-xs flex items-center gap-xs transition-all">
              <span class="material-symbols-outlined text-[16px]">delete_forever</span> Clear Log
            </button>
          </div>
          <div id="activity-log-container" class="flex flex-col gap-xs">
            <div class="text-xs text-on-surface-variant font-mono animate-pulse p-md">Loading activity log...</div>
          </div>
        </div>

      <!-- TAB: DIAGNOSTICS & SETTINGS -->
      <?php elseif ($tab === 'settings'): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
          <!-- System Diagnostics -->
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
                <span class="text-secondary font-bold">2 Hours Auto-Expire</span>
              </div>
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Server Timezone</span>
                <span class="text-tertiary font-bold"><?= date_default_timezone_get() ?> (<?= date('Y-m-d H:i:s') ?>)</span>
              </div>
              <div class="flex justify-between p-sm bg-surface-container-lowest rounded-lg border border-outline-variant/10">
                <span class="text-on-surface-variant">Memory Usage</span>
                <span class="text-emerald-400 font-bold"><?= round(memory_get_usage(true)/1048576, 2) ?> MB / <?= round(memory_get_peak_usage(true)/1048576, 2) ?> MB peak</span>
              </div>
            </div>
          </div>

          <!-- Subdomain Routing -->
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

          <!-- Change Admin Password -->
          <div class="bg-surface-container rounded-2xl p-lg shadow-lg border border-outline-variant/10 space-y-md">
            <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-xs">
              <span class="material-symbols-outlined text-error">lock_reset</span> Change Admin Password
            </h2>
            <form id="form-change-pass" onsubmit="handlePasswordChange(event)" class="space-y-sm">
              <div>
                <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Current Password</label>
                <input type="password" id="cp-current" name="current_password" required placeholder="Enter current password" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface text-sm" />
              </div>
              <div>
                <label class="block text-xs font-label-sm text-on-surface-variant mb-1">New Password (min 8 chars)</label>
                <input type="password" id="cp-new" name="new_password" required minlength="8" placeholder="Enter new password" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface text-sm" />
              </div>
              <div>
                <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Confirm New Password</label>
                <input type="password" id="cp-confirm" name="confirm_password" required minlength="8" placeholder="Re-enter new password" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface text-sm" />
              </div>
              <button type="submit" id="cp-btn" class="w-full bg-error text-on-error py-sm rounded-lg font-label-sm font-bold text-sm hover:opacity-90 transition-opacity">Update Password</button>
            </form>
          </div>

          <!-- Admin Quick Notes -->
          <div class="bg-surface-container rounded-2xl p-lg shadow-lg border border-outline-variant/10 space-y-md">
            <h2 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-xs">
              <span class="material-symbols-outlined text-amber-400">sticky_note_2</span> Admin Quick Notes
            </h2>
            <p class="text-xs text-on-surface-variant">Private notes visible only to you. Auto-saved to database.</p>
            <textarea id="admin-note-area" rows="6" placeholder="Write your private admin notes here..." class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface text-sm font-mono resize-none outline-none focus:border-primary/60 transition-colors"></textarea>
            <div class="flex items-center justify-between">
              <span id="note-saved-at" class="text-xs text-outline font-mono">Loading...</span>
              <button onclick="saveAdminNote()" class="bg-amber-500 text-black px-md py-xs rounded-lg font-label-sm text-xs font-bold flex items-center gap-xs">
                <span class="material-symbols-outlined text-[16px]">save</span> Save Note
              </button>
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
  <div class="bg-surface-container rounded-2xl p-lg max-w-lg w-full shadow-2xl border border-outline-variant/20 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-md">
      <h3 id="res-modal-title" class="font-headline-md text-lg text-on-surface">Add Study Resource</h3>
      <button onclick="closeModal('modal-add-resource')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-resource" onsubmit="handleResourceSubmit(event)">
      <input type="hidden" id="res-id" name="id" value=""/>
      <div class="space-y-sm mb-md text-sm">
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Resource Title *</label>
          <input id="res-title" name="title" required placeholder="e.g. Data Structures Notes Module 1" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Branch</label>
            <select id="res-branch" name="branch" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface">
              <option value="CS">Computer Science</option>
              <option value="ME">Mechanical</option>
              <option value="CE">Civil</option>
              <option value="EE">Electrical</option>
              <option value="EC">Electronics</option>
              <option value="IT">Information Technology</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Semester</label>
            <select id="res-sem" name="sem" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface">
              <?php for ($s = 1; $s <= 8; $s++): ?>
                <option value="S<?= $s ?>">Semester <?= $s ?></option>
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
              <option value="Assignment">Assignment</option>
              <option value="Syllabus">Syllabus</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Author / Source</label>
            <input id="res-by" name="by" value="Yaswant Admin" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
          </div>
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">File Size</label>
            <input id="res-size" name="size" value="2.0 MB" placeholder="e.g. 2.5 MB" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface text-xs" />
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Color Theme</label>
            <select id="res-color" name="color" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface text-xs">
              <option value="primary">Primary (Blue)</option>
              <option value="secondary">Secondary (Purple)</option>
              <option value="tertiary">Tertiary (Cyan)</option>
              <option value="green">Green (Emerald)</option>
              <option value="amber">Amber (Orange)</option>
            </select>
          </div>
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Download / Drive URL (optional)</label>
          <input id="res-download-url" name="download_url" type="url" placeholder="https://drive.google.com/file/..." class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface font-mono text-xs" />
        </div>
      </div>
      <button type="submit" id="res-btn-submit" class="w-full bg-primary text-on-primary py-sm rounded-lg font-label-sm font-bold">Save Resource</button>
    </form>
  </div>
</div>

<!-- MODAL: ADD / EDIT COURSE -->
<div id="modal-add-course" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-md">
  <div class="bg-surface-container rounded-2xl p-lg max-w-lg w-full shadow-2xl border border-outline-variant/20 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-md">
      <h3 id="course-modal-title" class="font-headline-md text-lg text-on-surface">Create Course Module</h3>
      <button onclick="closeModal('modal-add-course')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-course" onsubmit="handleCourseSubmit(event)">
      <input type="hidden" id="course-id" name="id" value=""/>
      <div class="space-y-sm mb-md text-sm">
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Course Title *</label>
          <input id="course-title" name="title" required placeholder="e.g. Distributed Systems 101" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Short Description</label>
          <textarea id="course-description" name="description" rows="2" placeholder="Brief description of this course..." class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface resize-none text-xs"></textarea>
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Category Tag</label>
            <input id="course-tag" name="tag" value="Systems" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Material Icon Name</label>
            <input id="course-icon" name="icon" value="school" placeholder="school, code, terminal..." class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface font-mono text-xs" />
          </div>
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Lessons Count</label>
            <input id="course-lessons" name="lessons" type="number" min="1" value="30" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
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
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Color Theme</label>
          <select id="course-color" name="color" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface">
            <option value="primary">Primary (Blue)</option>
            <option value="secondary">Secondary (Purple)</option>
            <option value="tertiary">Tertiary (Teal)</option>
            <option value="green">Green (Emerald)</option>
            <option value="red">Red (Rose)</option>
            <option value="amber">Amber (Gold)</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">YouTube Playlist URL (optional)</label>
          <input id="course-playlist" name="playlist_url" type="url" placeholder="https://youtube.com/playlist?list=..." class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface font-mono text-xs" />
        </div>
      </div>
      <button type="submit" id="course-btn-submit" class="w-full bg-secondary text-on-secondary py-sm rounded-lg font-label-sm font-bold">Publish Course</button>
    </form>
  </div>
</div>

<!-- MODAL: ADD / EDIT JOB -->
<div id="modal-add-job" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-md">
  <div class="bg-surface-container rounded-2xl p-lg max-w-lg w-full shadow-2xl border border-outline-variant/20 max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-md">
      <h3 id="job-modal-title" class="font-headline-md text-lg text-on-surface">Post Internship Role</h3>
      <button onclick="closeModal('modal-add-job')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-job" onsubmit="handleJobSubmit(event)">
      <input type="hidden" id="job-id" name="id" value=""/>
      <div class="space-y-sm mb-md text-sm">
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Role Title *</label>
          <input id="job-title" name="title" required placeholder="e.g. Backend Engineer Intern" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Company Name *</label>
          <input id="job-company" name="company" required placeholder="e.g. Stripe, TechCorp, Google" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div class="grid grid-cols-2 gap-sm">
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Location</label>
            <input id="job-location" name="location" value="Remote" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
          </div>
          <div>
            <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Stipend / Pay</label>
            <input id="job-pay" name="pay" value="₹20,000/month" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
          </div>
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Tech Stack Tags (comma separated)</label>
          <input id="job-tags" name="tags" value="React, Node.js, SQL" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Apply URL (optional)</label>
          <input id="job-apply-url" name="apply_url" type="url" placeholder="https://company.com/careers/apply" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface font-mono text-xs" />
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Application Deadline (optional)</label>
          <input id="job-deadline" name="deadline" type="date" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface" />
        </div>
      </div>
      <button type="submit" id="job-btn-submit" class="w-full bg-tertiary-container text-on-tertiary-container py-sm rounded-lg font-label-sm font-bold">Post Internship Role</button>
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

<style>
  .toast-container { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.5rem; pointer-events: none; }
  .toast { pointer-events: auto; display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.25rem; border-radius: 1rem; font-size: 0.8rem; font-weight: 600; font-family: monospace; box-shadow: 0 8px 32px rgba(0,0,0,.4); backdrop-filter: blur(8px); animation: slideIn 0.25s ease; }
  .toast.success { background: rgba(16,185,129,0.15); border: 1px solid rgba(16,185,129,0.4); color: #34d399; }
  .toast.error   { background: rgba(239,68,68,0.15);  border: 1px solid rgba(239,68,68,0.4);  color: #f87171; }
  .toast.info    { background: rgba(99,102,241,0.15); border: 1px solid rgba(99,102,241,0.4); color: #a5b4fc; }
  @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
  .btn-loading { opacity: 0.7; pointer-events: none; }
</style>
<div class="toast-container" id="toast-container"></div>

<script>
  // ── Toast Notification System ──────────────────────────────
  function toast(msg, type = 'success', duration = 3500) {
    const container = document.getElementById('toast-container');
    const el = document.createElement('div');
    el.className = `toast ${type}`;
    const icon = type === 'success' ? 'check_circle' : type === 'error' ? 'error' : 'info';
    el.innerHTML = `<span class="material-symbols-outlined" style="font-size:18px">${icon}</span>${msg}`;
    container.appendChild(el);
    setTimeout(() => { el.style.opacity = '0'; el.style.transform = 'translateX(100%)'; el.style.transition = '0.3s'; setTimeout(() => el.remove(), 300); }, duration);
  }

  // ── Modal Helpers ──────────────────────────────────────────
  function openModal(id) {
    const el = document.getElementById(id);
    if (el) { el.classList.remove('hidden'); el.classList.add('flex'); }
  }
  function closeModal(id) {
    const el = document.getElementById(id);
    if (el) { el.classList.add('hidden'); el.classList.remove('flex'); }
  }

  function openResourceModal() {
    const f = document.getElementById('form-resource');
    if (f) f.reset();
    document.getElementById('res-id').value = '';
    document.getElementById('res-modal-title').innerText = 'Add Study Resource';
    document.getElementById('res-btn-submit').innerText = 'Save Resource';
    openModal('modal-add-resource');
  }

  function openCourseModal() {
    const f = document.getElementById('form-course');
    if (f) f.reset();
    document.getElementById('course-id').value = '';
    document.getElementById('course-modal-title').innerText = 'Create Course Module';
    document.getElementById('course-btn-submit').innerText = 'Publish Course';
    openModal('modal-add-course');
  }

  function openJobModal() {
    const f = document.getElementById('form-job');
    if (f) f.reset();
    document.getElementById('job-id').value = '';
    document.getElementById('job-modal-title').innerText = 'Post Internship Role';
    document.getElementById('job-btn-submit').innerText = 'Post Internship Role';
    openModal('modal-add-job');
  }

  // ── Article Studio ─────────────────────────────────────────
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

  function switchArticleMode(mode) {
    const paneWrite = document.getElementById('pane-write');
    const panePrev  = document.getElementById('pane-preview');
    const btnWrite  = document.getElementById('btn-mode-write');
    const btnPrev   = document.getElementById('btn-mode-preview');
    if (mode === 'write') {
      paneWrite.classList.remove('hidden'); panePrev.classList.add('hidden');
      btnWrite.className = 'flex-1 py-1.5 rounded-lg text-xs font-mono font-bold bg-primary text-on-primary transition-all flex items-center justify-center gap-xs';
      btnPrev.className  = 'flex-1 py-1.5 rounded-lg text-xs font-mono font-bold text-on-surface-variant hover:text-on-surface transition-all flex items-center justify-center gap-xs';
    } else {
      paneWrite.classList.add('hidden'); panePrev.classList.remove('hidden');
      btnPrev.className  = 'flex-1 py-1.5 rounded-lg text-xs font-mono font-bold bg-primary text-on-primary transition-all flex items-center justify-center gap-xs';
      btnWrite.className = 'flex-1 py-1.5 rounded-lg text-xs font-mono font-bold text-on-surface-variant hover:text-on-surface transition-all flex items-center justify-center gap-xs';
      const img = document.getElementById('article-img').value;
      const prevCover = document.getElementById('prev-cover');
      if (img) { document.getElementById('prev-img-el').src = img; prevCover.classList.remove('hidden'); } else { prevCover.classList.add('hidden'); }
      document.getElementById('prev-title').innerText  = document.getElementById('article-title').value || 'Untitled Article';
      document.getElementById('prev-cat').innerText    = (document.getElementById('article-cat').value || 'TECHNICAL').toUpperCase();
      document.getElementById('prev-read').innerText   = (document.getElementById('article-read').value || '5 min') + ' read';
      document.getElementById('prev-author').innerText = 'By ' + (document.getElementById('article-author').value || 'Yaswant Team');
      document.getElementById('prev-excerpt').innerText = document.getElementById('article-excerpt').value || 'No summary excerpt entered.';
      document.getElementById('prev-body').innerHTML   = document.getElementById('article-content').value || '<p class="text-zinc-500">No article body written yet.</p>';
    }
  }

  function insertArticleSnippet(type) {
    const area = document.getElementById('article-content');
    let snippet = '';
    if (type === 'img') {
      const url = prompt('Enter Image URL:', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97'); if (!url) return;
      const alt = prompt('Enter Photo Caption / Alt text:', 'Engineering Diagram');
      snippet = `\n<figure class="my-md">\n  <img src="${url}" alt="${alt || 'Image'}" class="w-full rounded-xl shadow-lg border border-outline-variant/20"/>\n  <figcaption class="text-center text-xs text-zinc-400 mt-xs font-mono">${alt || ''}</figcaption>\n</figure>\n`;
    } else if (type === 'video') {
      let url = prompt('Enter YouTube Embed URL (e.g. https://www.youtube.com/embed/...):', 'https://www.youtube.com/embed/dQw4w9WgXcQ'); if (!url) return;
      if (url.includes('watch?v=')) url = url.replace('watch?v=', 'embed/');
      snippet = `\n<div class="aspect-video w-full my-md rounded-xl overflow-hidden shadow-xl border border-outline-variant/20">\n  <iframe src="${url}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>\n</div>\n`;
    } else if (type === 'link') {
      const url = prompt('Enter URL:', 'https://yaswant.co.in'); if (!url) return;
      const text = prompt('Enter Link Text:', 'Visit Link');
      snippet = `<a href="${url}" target="_blank" class="text-primary hover:underline font-bold">${text || url}</a>`;
    } else if (type === 'code') {
      snippet = `\n<pre class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-emerald-400 border border-outline-variant/20 my-md overflow-x-auto"><code>// Enter sample code here\nfunction example() {\n  console.log("Hello World");\n}</code></pre>\n`;
    } else if (type === 'h2') {
      snippet = `\n<h2 class="text-xl font-bold text-on-surface font-display-lg mt-lg mb-xs">Subheading Title</h2>\n`;
    } else if (type === 'quote') {
      snippet = `\n<blockquote class="bg-surface-container-lowest border-l-4 border-primary p-md rounded-r-xl italic text-on-surface-variant my-md">\n  "Engineering is the art of modeling materials we do not wholly understand..."\n</blockquote>\n`;
    }
    const start = area.selectionStart, end = area.selectionEnd;
    area.value = area.value.substring(0, start) + snippet + area.value.substring(end);
    area.focus();
  }

  // ── Table / Card Filters ───────────────────────────────────
  function filterTable(inputId, tableId) {
    const q = document.getElementById(inputId).value.toLowerCase();
    document.querySelectorAll(`#${tableId} tbody tr`).forEach(r => {
      r.style.display = r.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
  }
  function filterCards(inputId, gridId) {
    const q = document.getElementById(inputId).value.toLowerCase();
    document.querySelectorAll(`#${gridId} .card-item`).forEach(c => {
      c.style.display = c.innerText.toLowerCase().includes(q) ? '' : 'none';
    });
  }

  // ── Export CSV ─────────────────────────────────────────────
  function exportSubscribersCSV() {
    const rows = document.querySelectorAll('#tbl-subscribers tbody tr');
    let csv = 'Email,Date Subscribed\n';
    rows.forEach(r => {
      const cols = r.querySelectorAll('td');
      if (cols.length >= 2) csv += `"${cols[0].innerText.trim()}","${cols[1].innerText.trim()}"\n`;
    });
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a'); a.href = url; a.download = 'subscribers_list.csv'; a.click();
    toast('CSV downloaded successfully', 'success');
  }

  // ── Edit Handlers ──────────────────────────────────────────
  function editResource(r) {
    document.getElementById('res-modal-title').innerText = 'Edit Study Resource';
    document.getElementById('res-id').value            = r.id;
    document.getElementById('res-title').value         = r.title;
    document.getElementById('res-branch').value        = r.branch || 'CS';
    document.getElementById('res-sem').value           = r.sem || 'S1';
    document.getElementById('res-type').value          = r.type || 'Notes';
    document.getElementById('res-by').value            = r.by || 'Yaswant Admin';
    if (document.getElementById('res-size')) document.getElementById('res-size').value = r.size || '2.0 MB';
    if (document.getElementById('res-color')) document.getElementById('res-color').value = r.color || 'primary';
    document.getElementById('res-download-url').value  = r.download_url || '';
    document.getElementById('res-btn-submit').innerText = 'Update Resource';
    openModal('modal-add-resource');
  }

  function editCourse(c) {
    document.getElementById('course-modal-title').innerText  = 'Edit Course Module';
    document.getElementById('course-id').value               = c.id;
    document.getElementById('course-title').value            = c.title;
    document.getElementById('course-tag').value              = c.tag || 'General';
    document.getElementById('course-lessons').value          = c.lessons || 20;
    document.getElementById('course-level').value            = c.level || 'Beginner';
    document.getElementById('course-icon').value             = c.icon || 'school';
    document.getElementById('course-color').value            = c.color || 'primary';
    document.getElementById('course-playlist').value         = c.playlist_url || '';
    document.getElementById('course-description').value      = c.description || '';
    document.getElementById('course-btn-submit').innerText   = 'Update Course';
    openModal('modal-add-course');
  }

  function editJob(j) {
    document.getElementById('job-modal-title').innerText  = 'Edit Internship Role';
    document.getElementById('job-id').value               = j.id;
    document.getElementById('job-title').value            = j.title;
    document.getElementById('job-company').value          = j.company;
    document.getElementById('job-location').value         = j.location || 'Remote';
    document.getElementById('job-pay').value              = j.pay || '₹20,000/month';
    document.getElementById('job-tags').value             = Array.isArray(j.tags) ? j.tags.join(', ') : (j.tags || '');
    document.getElementById('job-apply-url').value        = j.apply_url || j.apply_link || '';
    document.getElementById('job-deadline').value         = j.deadline || '';
    document.getElementById('job-btn-submit').innerText   = 'Update Internship';
    openModal('modal-add-job');
  }

  // ── Form Submit Handlers ───────────────────────────────────
  function handleResourceSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('res-id').value;
    submitAdminForm(e.target, id ? 'edit_resource' : 'add_resource', 'modal-add-resource', 'res-btn-submit');
  }
  function handleCourseSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('course-id').value;
    submitAdminForm(e.target, id ? 'edit_course' : 'add_course', 'modal-add-course', 'course-btn-submit');
  }
  function handleJobSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('job-id').value;
    submitAdminForm(e.target, id ? 'edit_job' : 'add_job', 'modal-add-job', 'job-btn-submit');
  }
  function handleArticleSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('article-id').value;
    submitAdminForm(e.target, id ? 'edit_article' : 'add_article', 'modal-add-article', 'article-btn-submit');
  }

  // ── Safe API JSON Parser ──────────────────────────────────
  async function callAdminApi(formData) {
    const r = await fetch('api/admin_action.php', { method: 'POST', body: formData });
    const text = await r.text();
    let res;
    try {
      res = JSON.parse(text);
    } catch (e) {
      if (r.status === 401 || text.includes('admin_login') || text.includes('Unauthorized')) {
        alert('Your admin session has expired. Please log in again.');
        window.location.href = 'admin_login.php?timeout=1';
        return { success: false, error: 'Session expired' };
      }
      const clean = text.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
      throw new Error(clean.substring(0, 160) || ('Server returned HTTP status ' + r.status));
    }
    if (res && res.logged_out) {
      alert(res.error || 'Your admin session has expired. Please log in again.');
      window.location.href = 'admin_login.php?timeout=1';
      return res;
    }
    return res;
  }

  // ── Core Submit Engine ─────────────────────────────────────
  function submitAdminForm(formEl, action, modalId, btnId) {
    const btn = document.getElementById(btnId);
    const originalText = btn.innerText;
    btn.innerText = 'Saving...';
    btn.classList.add('btn-loading');

    const formData = new FormData(formEl);
    formData.set('action', action);

    callAdminApi(formData)
      .then(res => {
        if (!res) return;
        btn.innerText = originalText;
        btn.classList.remove('btn-loading');
        if (res.success) {
          toast('✓ ' + (res.message || 'Saved successfully'), 'success');
          closeModal(modalId);
          setTimeout(() => window.location.reload(), 900);
        } else if (!res.logged_out) {
          toast('✗ ' + (res.error || 'Operation failed'), 'error');
        }
      })
      .catch(err => {
        btn.innerText = originalText;
        btn.classList.remove('btn-loading');
        toast('Server error: ' + err.message, 'error');
      });
  }

  // ── Delete Item ────────────────────────────────────────────
  function deleteItem(action, id) {
    const label = { delete_resource: 'resource', delete_course: 'course', delete_job: 'internship posting', delete_article: 'article' }[action] || 'item';
    if (!confirm(`Delete this ${label}? This action cannot be undone.`)) return;
    const formData = new FormData();
    formData.append('action', action);
    formData.append('id', id);
    callAdminApi(formData)
      .then(res => {
        if (!res) return;
        if (res.success) {
          toast('Deleted successfully', 'success');
          setTimeout(() => window.location.reload(), 700);
        } else if (!res.logged_out) {
          toast(res.error || 'Delete failed', 'error');
        }
      })
      .catch(err => toast('Delete error: ' + err.message, 'error'));
  }

  // ── Delete Subscriber ──────────────────────────────────────
  function deleteSubscriber(email) {
    if (!confirm('Remove subscriber ' + email + '?')) return;
    const formData = new FormData();
    formData.append('action', 'delete_subscriber');
    formData.append('email', email);
    callAdminApi(formData)
      .then(res => {
        if (!res) return;
        if (res.success) {
          toast('Subscriber removed', 'success');
          setTimeout(() => window.location.reload(), 700);
        } else if (!res.logged_out) {
          toast(res.error || 'Delete failed', 'error');
        }
      })
      .catch(err => toast('Remove error: ' + err.message, 'error'));
  }

  // ── Close modal on backdrop click ──────────────────────────
  ['modal-add-resource','modal-add-course','modal-add-job','modal-add-article','modal-add-announcement'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('click', e => { if (e.target === el) closeModal(id); });
  });

  // ── Toggle Article Status (Published / Draft) ─────────────
  function toggleArticleStatus(id, btn) {
    const fd = new FormData();
    fd.append('action', 'toggle_article_status');
    fd.append('id', id);
    callAdminApi(fd)
      .then(res => {
        if (!res) return;
        if (res.success) {
          toast('✓ Article set to ' + res.status, 'success');
          setTimeout(() => window.location.reload(), 800);
        } else {
          toast('✗ ' + (res.error || 'Failed'), 'error');
        }
      })
      .catch(err => toast('Error: ' + err.message, 'error'));
  }

  // ── Subscriber Bulk Actions ───────────────────────────────
  function toggleAllSubscribers(cb) {
    document.querySelectorAll('.sub-cb').forEach(el => el.checked = cb.checked);
    updateBulkBtn();
  }
  function updateBulkBtn() {
    const checked = document.querySelectorAll('.sub-cb:checked').length;
    const btn = document.getElementById('btn-bulk-delete');
    if (btn) { btn.classList.toggle('hidden', checked === 0); btn.classList.toggle('flex', checked > 0); }
  }
  function bulkDeleteSubscribers() {
    const emails = [...document.querySelectorAll('.sub-cb:checked')].map(el => el.value);
    if (!emails.length) return;
    if (!confirm(`Delete ${emails.length} subscriber(s)? This cannot be undone.`)) return;
    const fd = new FormData();
    fd.append('action', 'bulk_delete_subscribers');
    fd.append('emails', emails.join(','));
    callAdminApi(fd)
      .then(res => {
        if (!res) return;
        if (res.success) { toast('✓ ' + res.message, 'success'); setTimeout(() => location.reload(), 700); }
        else toast('✗ ' + (res.error || 'Failed'), 'error');
      })
      .catch(err => toast('Error: ' + err.message, 'error'));
  }

  // ── Analytics: Refresh Live Stats ────────────────────────
  function refreshStats() {
    const btn = document.getElementById('btn-refresh-stats');
    if (btn) { btn.disabled = true; btn.innerHTML = '<span class="material-symbols-outlined text-[16px] animate-spin">sync</span> Refreshing...'}
    const fd = new FormData();
    fd.append('action', 'get_stats');
    callAdminApi(fd)
      .then(res => {
        if (btn) { btn.disabled = false; btn.innerHTML = '<span class="material-symbols-outlined text-[16px]">refresh</span> Refresh Live Stats'; }
        if (res && res.success) {
          Object.entries(res.stats).forEach(([key, val]) => {
            const el = document.querySelector(`[data-stat="${key}"]`);
            if (el) el.textContent = val;
          });
          toast('✓ Stats updated', 'success');
        }
      })
      .catch(() => { if (btn) { btn.disabled = false; btn.innerHTML = '<span class="material-symbols-outlined text-[16px]">refresh</span> Refresh Live Stats'; } });
  }

  // ── Live Clock ────────────────────────────────────────────
  function startLiveClock() {
    const el = document.getElementById('live-clock');
    if (!el) return;
    setInterval(() => { el.textContent = new Date().toLocaleTimeString('en-IN'); }, 1000);
  }
  startLiveClock();

  // ── Activity Log ─────────────────────────────────────────
  function loadActivityLog() {
    const container = document.getElementById('activity-log-container');
    if (!container) return;
    const fd = new FormData();
    fd.append('action', 'get_activity_log');
    callAdminApi(fd)
      .then(res => {
        if (!res || !res.success) { container.innerHTML = '<div class="text-xs text-error p-md">Failed to load log</div>'; return; }
        if (!res.log || !res.log.length) { container.innerHTML = '<div class="text-xs text-on-surface-variant font-mono p-md">No activity recorded yet.</div>'; return; }
        const actionLabels = { add_resource:'Added Resource', edit_resource:'Edited Resource', delete_resource:'Deleted Resource', add_course:'Added Course', edit_course:'Edited Course', delete_course:'Deleted Course', add_job:'Posted Internship', edit_job:'Edited Internship', delete_job:'Deleted Internship', add_article:'Published Article', edit_article:'Edited Article', delete_article:'Deleted Article', delete_subscriber:'Removed Subscriber', bulk_delete_subscribers:'Bulk Deleted Subscribers', announcement_add:'Added Announcement', article_status:'Toggled Article Status', password_change:'Changed Password' };
        container.innerHTML = res.log.map(row => {
          const label = actionLabels[row.action] || row.action;
          return `<div class="flex items-start gap-md p-sm bg-surface-container rounded-lg border border-outline-variant/10">
            <span class="material-symbols-outlined text-[18px] text-primary mt-0.5">task_alt</span>
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between gap-sm">
                <span class="text-sm text-on-surface font-medium">${label}</span>
                <span class="text-[11px] text-outline font-mono whitespace-nowrap">${row.created_at}</span>
              </div>
              ${row.detail ? `<p class="text-xs text-on-surface-variant font-mono mt-0.5">${row.detail}</p>` : ''}
              <span class="text-[10px] text-outline font-mono">IP: ${row.ip}</span>
            </div>
          </div>`;
        }).join('');
      })
      .catch(() => { container.innerHTML = '<div class="text-xs text-error p-md">Network error loading log</div>'; });
  }
  if (document.getElementById('activity-log-container')) loadActivityLog();

  function clearActivityLog() {
    if (!confirm('Clear all activity log entries? This cannot be undone.')) return;
    const fd = new FormData();
    fd.append('action', 'clear_activity_log');
    callAdminApi(fd)
      .then(res => {
        if (res && res.success) { toast('✓ Activity log cleared', 'success'); loadActivityLog(); }
        else toast('✗ ' + (res?.error || 'Failed'), 'error');
      })
      .catch(err => toast('Error: ' + err.message, 'error'));
  }

  // ── Announcements Manager ─────────────────────────────────
  function loadAnnouncements() {
    const container = document.getElementById('announcements-list');
    if (!container) return;
    const fd = new FormData();
    fd.append('action', 'get_announcements');
    callAdminApi(fd)
      .then(res => {
        if (!res || !res.success) { container.innerHTML = '<div class="text-xs text-error">Failed to load</div>'; return; }
        if (!res.announcements || !res.announcements.length) { container.innerHTML = '<div class="text-sm text-on-surface-variant bg-surface-container rounded-xl p-lg text-center">No announcements yet. Click "New Announcement" to add one.</div>'; return; }
        const typeColors = { info: 'bg-primary/10 text-primary border-primary/20', warning: 'bg-amber-500/10 text-amber-400 border-amber-500/20', success: 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', error: 'bg-error/10 text-error border-error/20' };
        container.innerHTML = res.announcements.map(a => {
          const colors = typeColors[a.type] || typeColors.info;
          return `<div class="flex items-center gap-md p-md rounded-xl border ${colors} ${a.active==1 ? '' : 'opacity-50'}">
            <span class="material-symbols-outlined text-[22px]">campaign</span>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium">${a.message}</p>
              <div class="text-[11px] mt-0.5 flex gap-md">
                <span class="font-mono opacity-70">${a.created_at}</span>
                <span class="font-mono uppercase font-bold">${a.type}</span>
                <span>${a.active==1 ? '✓ Active' : '✗ Hidden'}</span>
              </div>
            </div>
            <div class="flex items-center gap-xs">
              <button onclick="toggleAnnouncement(${a.id}, this)" class="p-1.5 rounded-lg hover:bg-white/10 transition-colors" title="Toggle Visibility">
                <span class="material-symbols-outlined text-[18px]">${a.active==1 ? 'visibility_off' : 'visibility'}</span>
              </button>
              <button onclick="deleteAnnouncement(${a.id})" class="p-1.5 rounded-lg hover:bg-error/20 transition-colors text-error" title="Delete">
                <span class="material-symbols-outlined text-[18px]">delete</span>
              </button>
            </div>
          </div>`;
        }).join('');
      })
      .catch(() => { container.innerHTML = '<div class="text-xs text-error">Network error</div>'; });
  }
  if (document.getElementById('announcements-list')) loadAnnouncements();

  function deleteAnnouncement(id) {
    if (!confirm('Delete this announcement?')) return;
    const fd = new FormData();
    fd.append('action', 'delete_announcement');
    fd.append('id', id);
    callAdminApi(fd).then(res => { if (res?.success) { toast('✓ Announcement deleted', 'success'); loadAnnouncements(); } else toast('✗ ' + (res?.error || 'Failed'), 'error'); })
      .catch(err => toast('Error: ' + err.message, 'error'));
  }

  function toggleAnnouncement(id) {
    const fd = new FormData();
    fd.append('action', 'toggle_announcement');
    fd.append('id', id);
    callAdminApi(fd).then(res => { if (res?.success) { toast('✓ Visibility toggled', 'success'); loadAnnouncements(); } else toast('✗ ' + (res?.error || 'Failed'), 'error'); })
      .catch(err => toast('Error: ' + err.message, 'error'));
  }

  function handleAnnouncementSubmit(e) {
    e.preventDefault();
    const btn = document.getElementById('ann-btn-submit');
    btn.innerText = 'Publishing...';
    const fd = new FormData(e.target);
    fd.append('action', 'add_announcement');
    callAdminApi(fd)
      .then(res => {
        btn.innerText = 'Publish Announcement';
        if (res?.success) { toast('✓ Announcement published', 'success'); closeModal('modal-add-announcement'); e.target.reset(); loadAnnouncements(); }
        else toast('✗ ' + (res?.error || 'Failed'), 'error');
      })
      .catch(err => { btn.innerText = 'Publish Announcement'; toast('Error: ' + err.message, 'error'); });
  }

  // ── Admin Password Change ─────────────────────────────────
  function handlePasswordChange(e) {
    e.preventDefault();
    const btn = document.getElementById('cp-btn');
    btn.innerText = 'Updating...';
    const fd = new FormData(e.target);
    fd.append('action', 'change_password');
    callAdminApi(fd)
      .then(res => {
        btn.innerText = 'Update Password';
        if (res?.success) {
          toast('✓ ' + res.message, 'success');
          e.target.reset();
          alert('Password updated!\n\nIMPORTANT: Copy the new bcrypt hash from the response and update your .env file.\n\n' + res.message);
        } else {
          toast('✗ ' + (res?.error || 'Failed'), 'error');
        }
      })
      .catch(err => { btn.innerText = 'Update Password'; toast('Error: ' + err.message, 'error'); });
  }

  // ── Admin Quick Notes ─────────────────────────────────────
  function loadAdminNote() {
    const area = document.getElementById('admin-note-area');
    const savedAt = document.getElementById('note-saved-at');
    if (!area) return;
    const fd = new FormData();
    fd.append('action', 'get_note');
    callAdminApi(fd)
      .then(res => {
        if (res?.success) {
          area.value = res.note || '';
          if (savedAt) savedAt.textContent = res.updated_at ? 'Last saved: ' + res.updated_at : 'No note saved yet';
        }
      })
      .catch(() => {});
  }
  function saveAdminNote() {
    const area = document.getElementById('admin-note-area');
    const savedAt = document.getElementById('note-saved-at');
    if (!area) return;
    const fd = new FormData();
    fd.append('action', 'save_note');
    fd.append('note', area.value);
    callAdminApi(fd)
      .then(res => {
        if (res?.success) { toast('✓ Note saved', 'success'); if (savedAt) savedAt.textContent = 'Last saved: just now'; }
        else toast('✗ ' + (res?.error || 'Save failed'), 'error');
      })
      .catch(err => toast('Error: ' + err.message, 'error'));
  }
  if (document.getElementById('admin-note-area')) loadAdminNote();

</script>

<!-- MODAL: NEW ANNOUNCEMENT -->
<div id="modal-add-announcement" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center p-md">
  <div class="bg-surface-container rounded-2xl p-lg max-w-md w-full shadow-2xl border border-outline-variant/20">
    <div class="flex justify-between items-center mb-md">
      <h3 class="font-headline-md text-lg text-on-surface flex items-center gap-xs"><span class="material-symbols-outlined text-primary">campaign</span> New Announcement</h3>
      <button onclick="closeModal('modal-add-announcement')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-announcement" onsubmit="handleAnnouncementSubmit(event)">
      <div class="space-y-sm mb-md">
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Announcement Message *</label>
          <textarea name="message" required rows="3" placeholder="e.g. New study notes for CSE Semester 4 are now available!" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface text-sm resize-none"></textarea>
        </div>
        <div>
          <label class="block text-xs font-label-sm text-on-surface-variant mb-1">Type</label>
          <select name="type" class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-sm text-on-surface">
            <option value="info">ℹ️ Info (Blue)</option>
            <option value="success">✅ Success (Green)</option>
            <option value="warning">⚠️ Warning (Amber)</option>
            <option value="error">🔴 Alert (Red)</option>
          </select>
        </div>
      </div>
      <button type="submit" id="ann-btn-submit" class="w-full bg-primary text-on-primary py-sm rounded-lg font-label-sm font-bold">Publish Announcement</button>
    </form>
  </div>
</div>

</body>
</html>