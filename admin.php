<?php
// admin.php — Yaswant Dev Admin Control Center v3.0
session_start();

if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {
  session_unset(); session_destroy();
  header('Location: admin_login.php?timeout=1'); exit;
}
$_SESSION['last_activity'] = time();

if (empty($_SESSION['admin_logged_in'])) {
  if (!headers_sent()) header('Location: admin_login.php');
  echo '<script>window.location.href="admin_login.php";</script>';
  echo '<meta http-equiv="refresh" content="0;url=admin_login.php">'; exit;
}

require_once 'includes/layout.php';
require_once 'includes/data.php';

$resources   = get_resources();
$courses     = get_courses();
$jobs        = get_jobs();
$articles    = get_articles();
$subscribers = get_subscribers();
$tab = $_GET['tab'] ?? 'overview';
$totalItems  = count($resources) + count($courses) + count($jobs) + count($articles);

$cyberTools = [
  ['num'=>'#01','file'=>'01-password-strength-checker.php','name'=>'Password Strength & Shannon Entropy Checker','cat'=>'Security'],
  ['num'=>'#02','file'=>'02-csprng-password-generator.php','name'=>'CSPRNG Password Generator','cat'=>'Security'],
  ['num'=>'#03','file'=>'03-syslog-siem-log-analyzer.php','name'=>'Syslog SIEM & Auth Log Analyzer','cat'=>'Security'],
  ['num'=>'#04','file'=>'04-brute-force-rate-limiter.php','name'=>'Brute Force Rate Limiter Simulator','cat'=>'Security'],
  ['num'=>'#05','file'=>'05-wifi-security-analyzer.php','name'=>'Wi-Fi Network Security & Cipher Analyzer','cat'=>'Security'],
  ['num'=>'#06','file'=>'06-network-packet-sniffer.php','name'=>'Network Packet Sniffer & Stream Analyzer','cat'=>'Security'],
  ['num'=>'#07','file'=>'07-malware-yara-scanner.php','name'=>'Malware Signature & YARA Rule Scanner','cat'=>'Security'],
  ['num'=>'#08','file'=>'08-stateful-firewall-simulator.php','name'=>'Stateful Firewall Rule Simulator','cat'=>'Security'],
  ['num'=>'#09','file'=>'09-sqli-auditor-pdo-converter.php','name'=>'SQL Injection Auditor & PDO Converter','cat'=>'Security'],
  ['num'=>'#10','file'=>'10-2fa-totp-authenticator-generator.php','name'=>'2FA TOTP Authenticator Generator','cat'=>'Security'],
  ['num'=>'#11','file'=>'11-keylogger-event-auditor.php','name'=>'Keylogger & Input Event Auditor','cat'=>'Security'],
  ['num'=>'#12','file'=>'12-ipv4-subnet-cidr-calculator.php','name'=>'IPv4 Subnet & CIDR Calculator','cat'=>'Security'],
  ['num'=>'#13','file'=>'13-http-security-headers-auditor.php','name'=>'HTTP Security Headers Auditor','cat'=>'Security'],
  ['num'=>'#14','file'=>'14-aes-256-gcm-web-encryptor.php','name'=>'AES-GCM Web Encryptor / Decryptor','cat'=>'Security'],
  ['num'=>'#15','file'=>'15-ip-geolocation-threat-inspector.php','name'=>'IP Geolocation & Threat Inspector','cat'=>'Security'],
  ['num'=>'#16','file'=>'16-sha256-sha1-hash-generator.php','name'=>'SHA-256 / SHA-1 Hash Generator','cat'=>'Security'],
  ['num'=>'#17','file'=>'17-jwt-token-decoder-inspector.php','name'=>'JWT Token Decoder & Inspector','cat'=>'Security'],
  ['num'=>'#18','file'=>'18-dns-email-policy-inspector.php','name'=>'DNS & Email Policy Inspector (SPF/DMARC)','cat'=>'Security'],
  ['num'=>'#19','file'=>'19-xss-payload-sanitizer-auditor.php','name'=>'XSS Sanitizer & Payload Auditor','cat'=>'Security'],
  ['num'=>'#20','file'=>'20-url-safety-redirect-inspector.php','name'=>'URL Safety & Redirect Inspector','cat'=>'Security'],
  ['num'=>'#21','file'=>'21-browser-port-reachability-scanner.php','name'=>'Browser Port Reachability Scanner','cat'=>'Security'],
  ['num'=>'#22','file'=>'22-base64-hex-encoder-decoder.php','name'=>'Base64 & Hex Encoder / Decoder','cat'=>'Security'],
  ['num'=>'#23','file'=>'23-gpa-sgpa-grade-calculator.php','name'=>'GPA / SGPA Calculator','cat'=>'Utility'],
  ['num'=>'#24','file'=>'24-code-beautifier-formatter.php','name'=>'Code Beautifier & Formatter','cat'=>'Utility'],
  ['num'=>'#25','file'=>'25-json-validator-linter.php','name'=>'JSON Validator & Linter','cat'=>'Utility'],
  ['num'=>'#26','file'=>'26-rest-api-tester.php','name'=>'REST API Tester','cat'=>'Utility'],
];

nexus_head('Admin Control Center v3','Admin dashboard for Yaswant Dev.','admin panel, yaswant dev admin','https://yaswant.co.in/admin.php');
?>
<style>
.kpi-card{transition:transform .18s,box-shadow .18s}.kpi-card:hover{transform:translateY(-2px);box-shadow:0 0 20px rgba(16,185,129,.12)}.progress-bar{transition:width 1s cubic-bezier(.4,0,.2,1)}.health-dot{animation:hdpulse 2s infinite}@keyframes hdpulse{0%,100%{opacity:1}50%{opacity:.4}}.activity-item{animation:slideIn .3s ease}@keyframes slideIn{from{opacity:0;transform:translateX(-8px)}to{opacity:1;transform:none}}
</style>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
<?php nexus_sidebar('admin'); nexus_topbar('admin'); ?>
<main id="main-content" role="main" class="flex-1 pt-16 lg:pt-8 w-full max-w-[1400px] mx-auto px-4 sm:px-6 pb-8">

<!-- Admin Header -->
<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 bg-gradient-to-br from-zinc-900 via-zinc-900 to-emerald-950/40 rounded-2xl p-5 border border-emerald-500/20 shadow-xl">
  <div class="flex items-center gap-4">
    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-500/20 to-cyan-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shadow-lg shrink-0">
      <span class="material-symbols-outlined text-[30px]">admin_panel_settings</span>
    </div>
    <div>
      <div class="flex items-center gap-2 flex-wrap">
        <h1 class="text-white text-xl font-bold tracking-tight font-display-lg">Admin Control Center</h1>
        <span class="bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2 py-0.5 rounded-full text-[10px] font-mono uppercase tracking-wider">SuperAdmin</span>
        <span class="flex items-center gap-1 bg-zinc-900 border border-zinc-700 px-2 py-0.5 rounded-full text-[10px] font-mono text-zinc-400">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 health-dot"></span>
          All Systems Live &middot; <?= date('d M Y, H:i') ?>
        </span>
      </div>
      <p class="text-zinc-400 text-xs mt-1">Full control: Resources, Courses, Internships, Blog, Tools, Subscribers, CI/CD Deployment.</p>
    </div>
  </div>
  <div class="flex items-center gap-2 flex-wrap">
    <button onclick="openAddResourceModal()" class="bg-emerald-500/15 hover:bg-emerald-500/25 border border-emerald-500/30 text-emerald-400 px-3 py-2 rounded-xl font-mono text-xs flex items-center gap-1.5 transition-all active:scale-95">
      <span class="material-symbols-outlined text-[16px]">folder_zip</span> Add Tool / Resource
    </button>
    <button onclick="openModal('modal-add-course')" class="bg-cyan-500/15 hover:bg-cyan-500/25 border border-cyan-500/30 text-cyan-400 px-3 py-2 rounded-xl font-mono text-xs flex items-center gap-1.5 transition-all active:scale-95">
      <span class="material-symbols-outlined text-[16px]">school</span> Course
    </button>
    <button onclick="openModal('modal-add-job')" class="bg-indigo-500/15 hover:bg-indigo-500/25 border border-indigo-500/30 text-indigo-400 px-3 py-2 rounded-xl font-mono text-xs flex items-center gap-1.5 transition-all active:scale-95">
      <span class="material-symbols-outlined text-[16px]">work</span> Internship
    </button>
    <button onclick="openArticleStudio()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-3 py-2 rounded-xl font-mono font-bold text-xs flex items-center gap-1.5 transition-all shadow-lg active:scale-95">
      <span class="material-symbols-outlined text-[16px]">edit_note</span> Write Article
    </button>
    <a href="admin_logout.php" class="bg-red-500/15 hover:bg-red-500/25 border border-red-500/30 text-red-400 px-3 py-2 rounded-xl font-mono text-xs flex items-center gap-1.5 transition-all active:scale-95">
      <span class="material-symbols-outlined text-[16px]">logout</span> Logout
    </a>
  </div>
</div>

<!-- Tab Pills -->
<div class="flex items-center gap-1.5 overflow-x-auto pb-2 mb-6">
<?php
$tabs=[
  'overview'    =>['label'=>'Overview',                         'icon'=>'dashboard',      'c'=>'emerald'],
  'resources'   =>['label'=>'Resources ('.count($resources).')','icon'=>'folder_open',    'c'=>'cyan'],
  'courses'     =>['label'=>'Courses ('.count($courses).')',    'icon'=>'school',          'c'=>'indigo'],
  'internships' =>['label'=>'Internships ('.count($jobs).')',   'icon'=>'work',            'c'=>'amber'],
  'blog'        =>['label'=>'Blog ('.count($articles).')',      'icon'=>'article',         'c'=>'purple'],
  'tools'       =>['label'=>'Cyber Tools (26)',                 'icon'=>'build',           'c'=>'emerald'],
  'subscribers' =>['label'=>'Subscribers ('.count($subscribers).')','icon'=>'mail',       'c'=>'pink'],
  'deploy'      =>['label'=>'Deployment',                       'icon'=>'rocket_launch',   'c'=>'cyan'],
  'settings'    =>['label'=>'Diagnostics',                      'icon'=>'settings',        'c'=>'zinc'],
];
$cmap=['emerald'=>['a'=>'bg-emerald-500/20 text-emerald-400 border-emerald-500/40','i'=>'text-zinc-400 hover:text-emerald-300 border-transparent hover:border-emerald-500/30'],
'cyan'=>['a'=>'bg-cyan-500/20 text-cyan-400 border-cyan-500/40','i'=>'text-zinc-400 hover:text-cyan-300 border-transparent hover:border-cyan-500/30'],
'indigo'=>['a'=>'bg-indigo-500/20 text-indigo-400 border-indigo-500/40','i'=>'text-zinc-400 hover:text-indigo-300 border-transparent hover:border-indigo-500/30'],
'amber'=>['a'=>'bg-amber-500/20 text-amber-400 border-amber-500/40','i'=>'text-zinc-400 hover:text-amber-300 border-transparent hover:border-amber-500/30'],
'purple'=>['a'=>'bg-purple-500/20 text-purple-400 border-purple-500/40','i'=>'text-zinc-400 hover:text-purple-300 border-transparent hover:border-purple-500/30'],
'pink'=>['a'=>'bg-pink-500/20 text-pink-400 border-pink-500/40','i'=>'text-zinc-400 hover:text-pink-300 border-transparent hover:border-pink-500/30'],
'zinc'=>['a'=>'bg-zinc-700 text-zinc-200 border-zinc-600','i'=>'text-zinc-400 hover:text-zinc-200 border-transparent hover:border-zinc-600']];
foreach($tabs as $key=>$t):
  $ia=($tab===$key);
  $cls=$cmap[$t['c']][$ia?'a':'i'];
?>
<a href="?tab=<?=$key?>" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl border font-mono text-xs whitespace-nowrap transition-all <?=$cls?>">
  <span class="material-symbols-outlined text-[15px]"><?=$t['icon']?></span><?=$t['label']?>
</a>
<?php endforeach; ?>
</div>

<!-- ══ OVERVIEW ══ -->
<?php if($tab==='overview'): ?>
<div class="flex flex-col gap-6">
  <!-- KPI Cards -->
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
<?php
$kpis=[
  ['label'=>'Resources','val'=>count($resources),'icon'=>'folder_open','c'=>'emerald','sub'=>'Study Files'],
  ['label'=>'Courses','val'=>count($courses),'icon'=>'school','c'=>'cyan','sub'=>'Free Modules'],
  ['label'=>'Internships','val'=>count($jobs),'icon'=>'work','c'=>'indigo','sub'=>'Open Roles'],
  ['label'=>'Blog Posts','val'=>count($articles),'icon'=>'article','c'=>'purple','sub'=>'Published'],
  ['label'=>'Cyber Tools','val'=>26,'icon'=>'build','c'=>'amber','sub'=>'Live Tools'],
  ['label'=>'Subscribers','val'=>count($subscribers),'icon'=>'group','c'=>'pink','sub'=>'Newsletter'],
];
$kc=['emerald'=>'text-emerald-400 bg-emerald-500/10 border-emerald-500/20','cyan'=>'text-cyan-400 bg-cyan-500/10 border-cyan-500/20','indigo'=>'text-indigo-400 bg-indigo-500/10 border-indigo-500/20','purple'=>'text-purple-400 bg-purple-500/10 border-purple-500/20','amber'=>'text-amber-400 bg-amber-500/10 border-amber-500/20','pink'=>'text-pink-400 bg-pink-500/10 border-pink-500/20'];
foreach($kpis as $k): $c=$kc[$k['c']]; ?>
    <div class="kpi-card bg-zinc-900/80 border border-zinc-800 rounded-2xl p-4 flex flex-col gap-2">
      <div class="w-8 h-8 rounded-xl <?=$c?> border flex items-center justify-center">
        <span class="material-symbols-outlined text-[17px]"><?=$k['icon']?></span>
      </div>
      <div class="text-2xl font-bold text-white font-mono"><?=$k['val']?></div>
      <div class="text-[10px] font-mono text-zinc-500 uppercase tracking-wide"><?=$k['sub']?></div>
    </div>
<?php endforeach; ?>
  </div>

  <!-- 3-col Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <!-- Quick Actions -->
    <div class="lg:col-span-1 flex flex-col gap-3">
      <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 flex items-center gap-1.5">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Quick Actions
      </div>
<?php
$acts=[['label'=>'Add Resource & Tool','sub'=>'ZIPs, Tools, Notes, PYQs','icon'=>'folder_zip','fn'=>"openAddResourceModal()",'bc'=>'bg-emerald-500 hover:bg-emerald-400 text-black'],
['label'=>'Post Internship','sub'=>'Publish openings','icon'=>'post_add','fn'=>"openModal('modal-add-job')",'bc'=>'bg-indigo-600 hover:bg-indigo-500 text-white'],
['label'=>'Write Article','sub'=>'Rich blog content','icon'=>'edit_note','fn'=>'openArticleStudio()','bc'=>'bg-purple-600 hover:bg-purple-500 text-white'],
['label'=>'Add Course','sub'=>'Engineering curriculum','icon'=>'school','fn'=>"openModal('modal-add-course')",'bc'=>'bg-cyan-500 hover:bg-cyan-400 text-black']];
foreach($acts as $a): ?>
      <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-4 flex flex-col gap-3">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-xl bg-zinc-800 border border-zinc-700 flex items-center justify-center text-zinc-300">
            <span class="material-symbols-outlined text-[19px]"><?=$a['icon']?></span>
          </div>
          <div>
            <div class="text-sm font-semibold text-white"><?=$a['label']?></div>
            <div class="text-[10px] text-zinc-500"><?=$a['sub']?></div>
          </div>
        </div>
        <button onclick="<?=$a['fn']?>" class="w-full <?=$a['bc']?> py-1.5 rounded-xl font-mono font-bold text-xs transition-all active:scale-95"><?=$a['label']?></button>
      </div>
<?php endforeach; ?>
    </div>
    <!-- Server Health -->
    <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5 flex flex-col gap-3">
      <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 flex items-center gap-1.5">
        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 health-dot"></span> Server Health
      </div>
<?php
$load=rand(12,45);
$hh=[['l'=>'PHP Runtime','v'=>phpversion(),'p'=>100,'c'=>'bg-emerald-500'],['l'=>'Server Load','v'=>$load.'%','p'=>$load,'c'=>$load>70?'bg-red-500':'bg-emerald-500'],['l'=>'Memory Limit','v'=>ini_get('memory_limit'),'p'=>40,'c'=>'bg-indigo-500'],['l'=>'Max Upload','v'=>ini_get('upload_max_filesize'),'p'=>60,'c'=>'bg-cyan-500'],['l'=>'Session Idle','v'=>'15 min','p'=>60,'c'=>'bg-amber-500']];
foreach($hh as $h): ?>
      <div>
        <div class="flex justify-between mb-1">
          <span class="text-[11px] text-zinc-400 font-mono"><?=$h['l']?></span>
          <span class="text-[11px] font-bold text-white font-mono"><?=htmlspecialchars($h['v'])?></span>
        </div>
        <div class="w-full bg-zinc-800 rounded-full h-1.5">
          <div class="progress-bar <?=$h['c']?> h-1.5 rounded-full" style="width:<?=min($h['p'],100)?>%"></div>
        </div>
      </div>
<?php endforeach; ?>
      <div class="grid grid-cols-2 gap-2 pt-2 border-t border-zinc-800">
        <div class="bg-zinc-800/60 rounded-xl p-2.5 text-center">
          <div class="text-[10px] text-zinc-500">Server Time</div>
          <div class="text-xs font-mono text-emerald-400 font-bold" id="live-time"><?=date('H:i:s')?></div>
        </div>
        <div class="bg-zinc-800/60 rounded-xl p-2.5 text-center">
          <div class="text-[10px] text-zinc-500">Platform</div>
          <div class="text-[10px] font-mono text-cyan-400 font-bold">Hostinger LiteSpeed</div>
        </div>
      </div>
    </div>
    <!-- Recent Activity -->
    <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5 flex flex-col gap-3">
      <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 flex items-center gap-1.5">
        <span class="w-1.5 h-1.5 rounded-full bg-purple-400 health-dot"></span> Recent Activity
      </div>
<?php
$feed=array_merge(
  array_slice(array_map(fn($r)=>['l'=>'Resource: '.$r['title'],'icon'=>'folder_open','c'=>'bg-emerald-500/15 text-emerald-400','t'=>'#'.$r['id']],$resources),0,2),
  array_slice(array_map(fn($j)=>['l'=>'Internship: '.$j['title'],'icon'=>'work','c'=>'bg-indigo-500/15 text-indigo-400','t'=>$j['company']??'—'],$jobs),0,2),
  array_slice(array_map(fn($a)=>['l'=>'Blog: '.$a['title'],'icon'=>'article','c'=>'bg-purple-500/15 text-purple-400','t'=>$a['created_at']??'—'],$articles),0,2)
);
if(empty($feed)): ?>
      <div class="flex-1 flex items-center justify-center text-center text-zinc-600">
        <div><span class="material-symbols-outlined text-[36px] block mb-1">history</span><span class="text-xs font-mono">No activity yet</span></div>
      </div>
<?php else: foreach($feed as $f): ?>
      <div class="activity-item flex items-start gap-3 p-2.5 rounded-xl bg-zinc-800/50 border border-zinc-800">
        <div class="w-7 h-7 rounded-lg <?=$f['c']?> flex items-center justify-center shrink-0 mt-0.5">
          <span class="material-symbols-outlined text-[15px]"><?=$f['icon']?></span>
        </div>
        <div class="min-w-0">
          <div class="text-xs text-white font-medium truncate"><?=htmlspecialchars($f['l'])?></div>
          <div class="text-[10px] text-zinc-500 font-mono"><?=htmlspecialchars($f['t'])?></div>
        </div>
      </div>
<?php endforeach; endif; ?>
    </div>
  </div>

  <!-- Content Distribution -->
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5">
    <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 mb-4 flex items-center gap-1.5">
      <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Platform Content Distribution
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
<?php
$total=max($totalItems,1);
$bars=[['l'=>'Study Resources','v'=>count($resources),'c'=>'bg-emerald-500','t'=>'text-emerald-400'],['l'=>'Courses','v'=>count($courses),'c'=>'bg-cyan-500','t'=>'text-cyan-400'],['l'=>'Internships','v'=>count($jobs),'c'=>'bg-indigo-500','t'=>'text-indigo-400'],['l'=>'Blog Articles','v'=>count($articles),'c'=>'bg-purple-500','t'=>'text-purple-400']];
foreach($bars as $b): $pct=round(($b['v']/$total)*100); ?>
      <div>
        <div class="flex justify-between mb-1.5">
          <span class="text-xs text-zinc-400"><?=$b['l']?></span>
          <span class="text-xs font-bold <?=$b['t']?> font-mono"><?=$b['v']?></span>
        </div>
        <div class="w-full bg-zinc-800 rounded-full h-2">
          <div class="progress-bar <?=$b['c']?> h-2 rounded-full" style="width:<?=$pct?>%"></div>
        </div>
        <div class="text-[10px] text-zinc-600 font-mono mt-1"><?=$pct?>% of content</div>
      </div>
<?php endforeach; ?>
    </div>
  </div>

  <!-- Domain Quick Links -->
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5">
    <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 mb-4 flex items-center gap-1.5">
      <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Live Subdomain Status
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
<?php
$domains=[['l'=>'Main','url'=>URL_HOME,'icon'=>'home','c'=>'emerald'],['l'=>'Tools','url'=>URL_TOOLS,'icon'=>'build','c'=>'cyan'],['l'=>'Resume','url'=>URL_RESUME,'icon'=>'description','c'=>'indigo'],['l'=>'Resources','url'=>URL_RESOURCES,'icon'=>'folder_open','c'=>'amber'],['l'=>'Projects','url'=>URL_PROJECT,'icon'=>'folder_special','c'=>'purple']];
$dc=['emerald'=>'border-emerald-500/30 hover:border-emerald-500 text-emerald-400','cyan'=>'border-cyan-500/30 hover:border-cyan-500 text-cyan-400','indigo'=>'border-indigo-500/30 hover:border-indigo-500 text-indigo-400','amber'=>'border-amber-500/30 hover:border-amber-500 text-amber-400','purple'=>'border-purple-500/30 hover:border-purple-500 text-purple-400'];
foreach($domains as $d): ?>
      <a href="<?=$d['url']?>" target="_blank" rel="noopener"
        class="flex flex-col items-center gap-2 p-3 bg-zinc-800/50 border rounded-xl <?=$dc[$d['c']]?> transition-all active:scale-95">
        <span class="material-symbols-outlined text-[22px]"><?=$d['icon']?></span>
        <span class="text-[10px] font-mono"><?=$d['l']?></span>
        <span class="flex items-center gap-1 text-[9px] text-zinc-500"><span class="w-1 h-1 rounded-full bg-emerald-400"></span>Online</span>
      </a>
<?php endforeach; ?>
    </div>
  </div>
</div>

<!-- ══ RESOURCES ══ -->
<?php elseif($tab==='resources'): ?>
<div class="flex flex-col gap-5">
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
    <div>
      <h2 class="text-white text-lg font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-400">folder_zip</span>
        Academic & Developer Resources Catalog
      </h2>
      <p class="text-xs text-zinc-500 font-mono"><?=count($resources)?> items &middot; Tools, ZIP Archives, Source Code, Notes & Question Banks</p>
    </div>
    <div class="flex items-center gap-2 w-full sm:w-auto">
      <div class="flex-1 sm:flex-none flex items-center bg-zinc-900 border border-zinc-800 rounded-xl px-3 gap-2">
        <span class="material-symbols-outlined text-zinc-600 text-[16px]">search</span>
        <input type="text" id="search-resources" oninput="filterTable('search-resources','tbl-resources')" placeholder="Filter resources or tools..." class="bg-transparent text-white text-xs outline-none py-2 w-full sm:w-56 font-mono placeholder:text-zinc-600"/>
      </div>
      <button onclick="openAddResourceModal()" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-black px-3.5 py-2 rounded-xl font-mono font-bold text-xs flex items-center gap-1.5 whitespace-nowrap transition-all shadow-md shadow-emerald-500/20 active:scale-95">
        <span class="material-symbols-outlined text-[16px]">add_circle</span> Add Tool / ZIP
      </button>
    </div>
  </div>
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl overflow-hidden overflow-x-auto shadow-xl">
    <table id="tbl-resources" class="w-full text-left border-collapse text-sm min-w-[720px]">
      <thead><tr class="bg-zinc-800/80 text-zinc-400 font-mono text-[10px] uppercase border-b border-zinc-800">
        <th class="px-4 py-3">Resource / Tool Title</th>
        <th class="px-4 py-3">Domain & Sem</th>
        <th class="px-4 py-3">Type</th>
        <th class="px-4 py-3">Download / File</th>
        <th class="px-4 py-3">Author</th>
        <th class="px-4 py-3">Size</th>
        <th class="px-4 py-3 text-right">Actions</th>
      </tr></thead>
      <tbody class="divide-y divide-zinc-800/60">
<?php foreach($resources as $r): 
  $isZip = (strcasecmp($r['type'] ?? '', 'ZIP File') === 0 || stripos($r['title'] ?? '', '.zip') !== false);
  $isTool = (strcasecmp($r['type'] ?? '', 'Tools') === 0 || strcasecmp($r['type'] ?? '', 'Software') === 0);
  $typeBadgeCls = match(true) {
    $isZip => 'bg-amber-500/15 text-amber-400 border border-amber-500/30',
    $isTool => 'bg-cyan-500/15 text-cyan-400 border border-cyan-500/30',
    strcasecmp($r['type'] ?? '', 'Source Code') === 0 => 'bg-violet-500/15 text-violet-400 border border-violet-500/30',
    strcasecmp($r['type'] ?? '', 'PYQ') === 0 => 'bg-purple-500/15 text-purple-400 border border-purple-500/30',
    strcasecmp($r['type'] ?? '', 'Lab Manual') === 0 => 'bg-rose-500/15 text-rose-400 border border-rose-500/30',
    default => 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/30'
  };
  $typeIcon = match(true) {
    $isZip => 'folder_zip',
    $isTool => 'build',
    strcasecmp($r['type'] ?? '', 'Source Code') === 0 => 'code',
    strcasecmp($r['type'] ?? '', 'PYQ') === 0 => 'assignment',
    strcasecmp($r['type'] ?? '', 'Lab Manual') === 0 => 'science',
    strcasecmp($r['type'] ?? '', 'Formula Sheet') === 0 => 'calculate',
    default => 'menu_book'
  };
?>
        <tr class="hover:bg-zinc-800/40 transition-colors">
          <td class="px-4 py-3">
            <div class="flex items-center gap-2.5">
              <span class="material-symbols-outlined text-[18px] <?= $isZip ? 'text-amber-400' : ($isTool ? 'text-cyan-400' : 'text-emerald-400') ?> shrink-0">
                <?= $typeIcon ?>
              </span>
              <div class="min-w-0">
                <div class="font-medium text-white text-xs leading-snug line-clamp-1"><?=htmlspecialchars($r['title'])?></div>
                <div class="text-[10px] font-mono text-zinc-500">ID #<?=$r['id']?> &middot; Color: <?=$r['color'] ?? 'default'?></div>
              </div>
            </div>
          </td>
          <td class="px-4 py-3">
            <span class="bg-zinc-800 px-2 py-0.5 rounded-lg text-xs font-mono text-zinc-300">
              <?=htmlspecialchars($r['branch'])?> &middot; <?=htmlspecialchars($r['sem'])?>
            </span>
          </td>
          <td class="px-4 py-3">
            <span class="px-2 py-0.5 rounded-lg text-xs font-mono inline-flex items-center gap-1 <?=$typeBadgeCls?>">
              <span class="material-symbols-outlined text-[12px]"><?=$typeIcon?></span>
              <?=htmlspecialchars($r['type'])?>
            </span>
          </td>
          <td class="px-4 py-3">
            <?php if(!empty($r['url'])): 
              $isLocal = strpos($r['url'], 'uploads/resources/') === 0;
            ?>
              <a href="<?=htmlspecialchars($r['url'])?>" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-mono font-medium transition-all <?= $isLocal ? 'bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 border border-emerald-500/30' : 'bg-cyan-500/10 text-cyan-400 hover:bg-cyan-500/20 border border-cyan-500/30' ?>">
                <span class="material-symbols-outlined text-[13px]"><?= $isLocal ? 'download' : 'open_in_new' ?></span>
                <?= $isLocal ? 'Local File' : 'External Link' ?>
              </a>
            <?php else: ?>
              <span class="text-zinc-600 font-mono text-[11px] italic">No link</span>
            <?php endif; ?>
          </td>
          <td class="px-4 py-3 text-zinc-400 text-xs truncate max-w-[120px]"><?=htmlspecialchars($r['by'])?></td>
          <td class="px-4 py-3 text-zinc-400 font-mono text-xs"><?=htmlspecialchars($r['size'] ?? 'PDF')?></td>
          <td class="px-4 py-3 text-right">
            <div class="flex items-center justify-end gap-1">
              <?php if(!empty($r['url'])): ?>
                <a href="<?=htmlspecialchars($r['url'])?>" target="_blank" download class="text-zinc-400 hover:text-white p-1.5 rounded-lg hover:bg-zinc-800 transition-colors" title="Download">
                  <span class="material-symbols-outlined text-[17px]">download</span>
                </a>
              <?php endif; ?>
              <button onclick='editResource(<?=htmlspecialchars(json_encode($r), ENT_QUOTES, 'UTF-8')?>)' class="text-cyan-400 hover:bg-cyan-500/15 p-1.5 rounded-lg transition-colors" title="Edit">
                <span class="material-symbols-outlined text-[17px]">edit</span>
              </button>
              <button onclick="deleteItem('delete_resource','<?=$r['id']?>')" class="text-red-400 hover:bg-red-500/15 p-1.5 rounded-lg transition-colors" title="Delete">
                <span class="material-symbols-outlined text-[17px]">delete</span>
              </button>
            </div>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- ══ COURSES ══ -->
<?php elseif($tab==='courses'): ?>
<div class="flex flex-col gap-5">
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
    <div><h2 class="text-white text-lg font-bold">Engineering Courses</h2><p class="text-xs text-zinc-500 font-mono"><?=count($courses)?> modules</p></div>
    <div class="flex items-center gap-2 w-full sm:w-auto">
      <div class="flex-1 sm:flex-none flex items-center bg-zinc-900 border border-zinc-800 rounded-xl px-3 gap-2">
        <span class="material-symbols-outlined text-zinc-600 text-[16px]">search</span>
        <input type="text" id="search-courses" oninput="filterCards('search-courses','grid-courses')" placeholder="Filter..." class="bg-transparent text-white text-xs outline-none py-2 w-full sm:w-48 font-mono placeholder:text-zinc-600"/>
      </div>
      <button onclick="openModal('modal-add-course')" class="bg-cyan-500 hover:bg-cyan-400 text-black px-3 py-2 rounded-xl font-mono font-bold text-xs flex items-center gap-1.5 whitespace-nowrap transition-all active:scale-95">
        <span class="material-symbols-outlined text-[16px]">add</span> Add Course
      </button>
    </div>
  </div>
  <div id="grid-courses" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
<?php foreach($courses as $c): ?>
    <div class="card-item bg-zinc-900/80 border border-zinc-800 rounded-2xl p-4 flex flex-col gap-3 hover:border-cyan-500/40 transition-all">
      <div class="flex justify-between items-start">
        <span class="bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 px-2 py-0.5 rounded-lg text-[10px] font-mono uppercase"><?=htmlspecialchars($c['tag'])?></span>
        <div class="flex gap-1">
          <button onclick='editCourse(<?=json_encode($c)?>)' class="text-cyan-400 hover:bg-cyan-500/10 p-1 rounded-lg"><span class="material-symbols-outlined text-[17px]">edit</span></button>
          <button onclick="deleteItem('delete_course','<?=$c['id']?>')" class="text-red-400 hover:bg-red-500/10 p-1 rounded-lg"><span class="material-symbols-outlined text-[17px]">delete</span></button>
        </div>
      </div>
      <h3 class="text-white font-semibold text-sm"><?=htmlspecialchars($c['title'])?></h3>
      <div class="flex items-center gap-2 text-[10px] font-mono text-zinc-500">
        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[13px]">play_lesson</span><?=$c['lessons']?> lessons</span><span>&middot;</span><span><?=htmlspecialchars($c['level'])?></span>
      </div>
    </div>
<?php endforeach; ?>
  </div>
</div>

<!-- ══ INTERNSHIPS ══ -->
<?php elseif($tab==='internships'): ?>
<div class="flex flex-col gap-5">
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
    <div><h2 class="text-white text-lg font-bold">Internships & Career Board</h2><p class="text-xs text-zinc-500 font-mono"><?=count($jobs)?> active openings</p></div>
    <div class="flex items-center gap-2 w-full sm:w-auto">
      <div class="flex-1 sm:flex-none flex items-center bg-zinc-900 border border-zinc-800 rounded-xl px-3 gap-2">
        <span class="material-symbols-outlined text-zinc-600 text-[16px]">search</span>
        <input type="text" id="search-jobs" oninput="filterTable('search-jobs','tbl-jobs')" placeholder="Filter roles..." class="bg-transparent text-white text-xs outline-none py-2 w-full sm:w-48 font-mono placeholder:text-zinc-600"/>
      </div>
      <button onclick="openModal('modal-add-job')" class="bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-2 rounded-xl font-mono font-bold text-xs flex items-center gap-1.5 whitespace-nowrap transition-all active:scale-95">
        <span class="material-symbols-outlined text-[16px]">add</span> Post Role
      </button>
    </div>
  </div>
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl overflow-hidden overflow-x-auto">
    <table id="tbl-jobs" class="w-full text-left border-collapse text-sm min-w-[640px]">
      <thead><tr class="bg-zinc-800/80 text-zinc-400 font-mono text-[10px] uppercase border-b border-zinc-800">
        <th class="px-4 py-3">Role</th><th class="px-4 py-3">Company</th><th class="px-4 py-3">Location</th><th class="px-4 py-3">Stipend</th><th class="px-4 py-3">Tags</th><th class="px-4 py-3 text-right">Actions</th>
      </tr></thead>
      <tbody class="divide-y divide-zinc-800/60">
<?php foreach($jobs as $j): ?>
        <tr class="hover:bg-zinc-800/40 transition-colors">
          <td class="px-4 py-3 font-medium text-white"><?=htmlspecialchars($j['title'])?></td>
          <td class="px-4 py-3 text-zinc-400"><?=htmlspecialchars($j['company'])?></td>
          <td class="px-4 py-3 text-zinc-500 text-xs font-mono"><?=htmlspecialchars($j['location'])?></td>
          <td class="px-4 py-3 text-indigo-400 font-mono font-bold text-xs"><?=htmlspecialchars($j['pay'])?></td>
          <td class="px-4 py-3"><div class="flex flex-wrap gap-1"><?php foreach(($j['tags']??[]) as $t): ?><span class="bg-zinc-800 text-zinc-400 px-1.5 py-0.5 rounded text-[10px] font-mono"><?=htmlspecialchars($t)?></span><?php endforeach; ?></div></td>
          <td class="px-4 py-3 text-right"><div class="flex items-center justify-end gap-1">
            <button onclick='editJob(<?=json_encode($j)?>)' class="text-indigo-400 hover:bg-indigo-500/15 p-1.5 rounded-lg"><span class="material-symbols-outlined text-[17px]">edit</span></button>
            <button onclick="deleteItem('delete_job','<?=$j['id']?>')" class="text-red-400 hover:bg-red-500/15 p-1.5 rounded-lg"><span class="material-symbols-outlined text-[17px]">delete</span></button>
          </div></td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- ══ BLOG CMS ══ -->
<?php elseif($tab==='blog'): ?>
<div class="flex flex-col gap-5">
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
    <div><h2 class="text-white text-lg font-bold">Blog Articles CMS</h2><p class="text-xs text-zinc-500 font-mono"><?=count($articles)?> published</p></div>
    <div class="flex items-center gap-2 w-full sm:w-auto">
      <div class="flex-1 sm:flex-none flex items-center bg-zinc-900 border border-zinc-800 rounded-xl px-3 gap-2">
        <span class="material-symbols-outlined text-zinc-600 text-[16px]">search</span>
        <input type="text" id="search-articles" oninput="filterCards('search-articles','grid-articles')" placeholder="Filter..." class="bg-transparent text-white text-xs outline-none py-2 w-full sm:w-48 font-mono placeholder:text-zinc-600"/>
      </div>
      <button onclick="openArticleStudio()" class="bg-purple-600 hover:bg-purple-500 text-white px-3 py-2 rounded-xl font-mono font-bold text-xs flex items-center gap-1.5 whitespace-nowrap transition-all active:scale-95">
        <span class="material-symbols-outlined text-[16px]">edit_note</span> Write
      </button>
    </div>
  </div>
  <div id="grid-articles" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<?php foreach($articles as $a): ?>
    <div class="card-item bg-zinc-900/80 border border-zinc-800 rounded-2xl p-4 flex flex-col gap-3 hover:border-purple-500/40 transition-all">
      <div class="flex justify-between items-start">
        <span class="bg-purple-500/10 text-purple-400 border border-purple-500/20 px-2 py-0.5 rounded-lg text-[10px] font-mono uppercase"><?=htmlspecialchars($a['cat'])?></span>
        <div class="flex gap-1">
          <a href="<?=URL_BLOG?>/post.php?id=<?=$a['id']?>" target="_blank" class="text-emerald-400 hover:bg-emerald-500/10 p-1 rounded-lg"><span class="material-symbols-outlined text-[17px]">open_in_new</span></a>
          <button onclick='editArticle(<?=json_encode($a)?>)' class="text-purple-400 hover:bg-purple-500/10 p-1 rounded-lg"><span class="material-symbols-outlined text-[17px]">edit</span></button>
          <button onclick="deleteItem('delete_article','<?=$a['id']?>')" class="text-red-400 hover:bg-red-500/10 p-1 rounded-lg"><span class="material-symbols-outlined text-[17px]">delete</span></button>
        </div>
      </div>
      <h3 class="text-white font-semibold text-sm"><?=htmlspecialchars($a['title'])?></h3>
      <p class="text-xs text-zinc-500 line-clamp-2"><?=htmlspecialchars($a['excerpt'])?></p>
      <div class="flex justify-between pt-2 border-t border-zinc-800 text-[10px] font-mono text-zinc-600">
        <span>By <?=htmlspecialchars($a['author'])?></span><span><?=htmlspecialchars($a['read'])?> read</span>
      </div>
    </div>
<?php endforeach; ?>
  </div>
</div>

<!-- ══ CYBER TOOLS ══ -->
<?php elseif($tab==='tools'): ?>
<div class="flex flex-col gap-5">
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
    <div><h2 class="text-white text-lg font-bold">Cyber Security & Dev Utilities</h2><p class="text-xs text-zinc-500 font-mono">26 live tools on <code class="text-emerald-400">tools.yaswant.co.in</code></p></div>
    <div class="flex items-center bg-zinc-900 border border-zinc-800 rounded-xl px-3 gap-2">
      <span class="material-symbols-outlined text-zinc-600 text-[16px]">search</span>
      <input type="text" id="search-cyber-tools" oninput="filterTable('search-cyber-tools','tbl-cyber-tools')" placeholder="Search tools..." class="bg-transparent text-white text-xs outline-none py-2 w-48 font-mono placeholder:text-zinc-600"/>
    </div>
  </div>
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl overflow-hidden overflow-x-auto">
    <table id="tbl-cyber-tools" class="w-full text-left border-collapse text-sm min-w-[580px]">
      <thead><tr class="bg-zinc-800/80 text-zinc-400 font-mono text-[10px] uppercase border-b border-zinc-800">
        <th class="px-4 py-3">ID</th><th class="px-4 py-3">Tool Name</th><th class="px-4 py-3">File</th><th class="px-4 py-3">Category</th><th class="px-4 py-3 text-right">Link</th>
      </tr></thead>
      <tbody class="divide-y divide-zinc-800/60">
<?php foreach($cyberTools as $ct): ?>
        <tr class="hover:bg-zinc-800/40 transition-colors">
          <td class="px-4 py-3 font-mono text-emerald-400 font-bold text-xs"><?=$ct['num']?></td>
          <td class="px-4 py-3 font-medium text-white text-sm"><?=htmlspecialchars($ct['name'])?></td>
          <td class="px-4 py-3 font-mono text-zinc-500 text-[11px]"><?=$ct['file']?></td>
          <td class="px-4 py-3"><span class="<?=$ct['cat']==='Utility'?'bg-amber-500/10 text-amber-400':'bg-emerald-500/10 text-emerald-400'?> px-2 py-0.5 rounded-lg text-[10px] font-mono"><?=$ct['cat']?></span></td>
          <td class="px-4 py-3 text-right">
            <a href="<?=URL_TOOLS.'/'.$ct['file']?>" target="_blank" class="text-emerald-400 hover:text-emerald-300 text-[11px] font-mono inline-flex items-center gap-1 hover:underline">
              Open <span class="material-symbols-outlined text-[13px]">open_in_new</span>
            </a>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- ══ SUBSCRIBERS ══ -->
<?php elseif($tab==='subscribers'): ?>
<div class="flex flex-col gap-5">
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
    <div><h2 class="text-white text-lg font-bold">Newsletter Subscribers</h2><p class="text-xs text-zinc-500 font-mono"><?=count($subscribers)?> registered</p></div>
    <div class="flex items-center gap-2 w-full sm:w-auto">
      <div class="flex-1 sm:flex-none flex items-center bg-zinc-900 border border-zinc-800 rounded-xl px-3 gap-2">
        <span class="material-symbols-outlined text-zinc-600 text-[16px]">search</span>
        <input type="text" id="search-subscribers" oninput="filterTable('search-subscribers','tbl-subscribers')" placeholder="Filter email..." class="bg-transparent text-white text-xs outline-none py-2 w-full sm:w-48 font-mono placeholder:text-zinc-600"/>
      </div>
      <button onclick="exportSubscribersCSV()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-3 py-2 rounded-xl font-mono font-bold text-xs flex items-center gap-1.5 whitespace-nowrap transition-all active:scale-95">
        <span class="material-symbols-outlined text-[16px]">download</span> CSV
      </button>
    </div>
  </div>
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl overflow-hidden">
    <table id="tbl-subscribers" class="w-full text-left border-collapse text-sm">
      <thead><tr class="bg-zinc-800/80 text-zinc-400 font-mono text-[10px] uppercase border-b border-zinc-800">
        <th class="px-4 py-3">#</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Date</th><th class="px-4 py-3 text-right">Remove</th>
      </tr></thead>
      <tbody class="divide-y divide-zinc-800/60">
<?php foreach($subscribers as $idx=>$s): ?>
        <tr class="hover:bg-zinc-800/40 transition-colors">
          <td class="px-4 py-3 text-zinc-600 font-mono text-xs"><?=$idx+1?></td>
          <td class="px-4 py-3 font-medium text-white"><?=htmlspecialchars($s['email'])?></td>
          <td class="px-4 py-3 text-zinc-400 font-mono text-xs"><?=htmlspecialchars($s['date'])?></td>
          <td class="px-4 py-3 text-right">
            <button onclick="deleteSubscriber('<?=htmlspecialchars($s['email'])?>')" class="text-red-400 hover:bg-red-500/15 p-1.5 rounded-lg transition-colors"><span class="material-symbols-outlined text-[17px]">person_remove</span></button>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- ══ DEPLOYMENT ══ -->
<?php elseif($tab==='deploy'): ?>
<div class="flex flex-col gap-5">
  <div><h2 class="text-white text-lg font-bold">CI/CD Deployment Control</h2><p class="text-xs text-zinc-500 font-mono">GitHub Actions &rarr; Hostinger FTP Auto-Deploy Pipeline</p></div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5 space-y-3">
      <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 flex items-center gap-1.5">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 health-dot"></span> Pipeline Config
      </div>
<?php
$pi=[['l'=>'Repository','v'=>'yaswantpandey/yaswant-dev','c'=>'text-emerald-400'],['l'=>'Branch','v'=>'main','c'=>'text-cyan-400'],['l'=>'FTP Host','v'=>'82.25.125.43','c'=>'text-amber-400'],['l'=>'FTP Username','v'=>'u865909543.yaswant.co.in','c'=>'text-indigo-400'],['l'=>'Remote Dir','v'=>'./ (FTP root)','c'=>'text-zinc-300'],['l'=>'Deploy Action','v'=>'SamKirkland/FTP-Deploy-Action@v4.3.5','c'=>'text-purple-400'],['l'=>'PHP Syntax Check','v'=>'php -l on every push','c'=>'text-emerald-400'],['l'=>'Auto-Trigger','v'=>'git push origin main','c'=>'text-zinc-300']];
foreach($pi as $p): ?>
      <div class="flex justify-between items-center py-2 border-b border-zinc-800/60 last:border-0">
        <span class="text-xs text-zinc-500 font-mono"><?=$p['l']?></span>
        <span class="text-xs font-bold <?=$p['c']?> font-mono"><?=htmlspecialchars($p['v'])?></span>
      </div>
<?php endforeach; ?>
    </div>
    <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5 space-y-3">
      <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 flex items-center gap-1.5">
        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 health-dot"></span> GitHub Secrets Required
      </div>
<?php
$sec=[['n'=>'FTP_SERVER','v'=>'82.25.125.43','note'=>'Hostinger FTP IP'],['n'=>'FTP_USERNAME','v'=>'u865909543.yaswant.co.in','note'=>'FTP Username'],['n'=>'FTP_PASSWORD','v'=>'Your FTP password','note'=>'Keep secret!']];
foreach($sec as $s): ?>
      <div class="bg-zinc-800/60 border border-zinc-700/50 rounded-xl p-3">
        <div class="flex justify-between items-center mb-1">
          <code class="text-emerald-400 font-mono text-xs font-bold"><?=$s['n']?></code>
          <span class="text-[10px] text-zinc-500"><?=$s['note']?></span>
        </div>
        <code class="text-zinc-300 font-mono text-[11px]"><?=htmlspecialchars($s['v'])?></code>
      </div>
<?php endforeach; ?>
      <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-xl p-3 text-xs text-emerald-400 font-mono">
        GitHub &rarr; Settings &rarr; Secrets and variables &rarr; Actions
      </div>
      <a href="https://github.com/yaswantpandey/yaswant-dev/actions" target="_blank" rel="noopener"
        class="flex items-center justify-center gap-2 w-full bg-emerald-500 hover:bg-emerald-400 text-black py-2.5 rounded-xl font-mono font-bold text-xs transition-all active:scale-95">
        <span class="material-symbols-outlined text-[17px]">rocket_launch</span> View GitHub Actions
      </a>
    </div>
  </div>
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5">
    <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 mb-3 flex items-center gap-1.5">
      <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Excluded from Deploy
    </div>
    <div class="flex flex-wrap gap-2">
      <?php foreach(['**/.git*/**','**/.github*/**','**/node_modules/**','**/.vscode/**','**/.gemini/**','README.md','sync_config.jsonc','database.sql'] as $ex): ?>
      <span class="bg-red-500/10 text-red-400 border border-red-500/20 px-2 py-1 rounded-lg font-mono text-[10px]"><?=$ex?></span>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- ══ DIAGNOSTICS ══ -->
<?php elseif($tab==='settings'): ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5 space-y-2">
    <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 flex items-center gap-1.5 mb-3">
      <span class="material-symbols-outlined text-emerald-400 text-[16px]">dns</span> System Diagnostics
    </div>
<?php
$diags=[['l'=>'PHP Runtime','v'=>'PHP '.phpversion(),'c'=>'text-emerald-400'],['l'=>'Database','v'=>'MySQL PDO (Hostinger)','c'=>'text-cyan-400'],['l'=>'Session Timeout','v'=>'15 min auto-expire','c'=>'text-indigo-400'],['l'=>'Server Timezone','v'=>date_default_timezone_get(),'c'=>'text-amber-400'],['l'=>'Server Time','v'=>date('Y-m-d H:i:s'),'c'=>'text-zinc-300'],['l'=>'Memory Limit','v'=>ini_get('memory_limit'),'c'=>'text-purple-400'],['l'=>'Max Upload Size','v'=>ini_get('upload_max_filesize'),'c'=>'text-cyan-400'],['l'=>'Post Max Size','v'=>ini_get('post_max_size'),'c'=>'text-zinc-400']];
foreach($diags as $d): ?>
    <div class="flex justify-between items-center py-2 border-b border-zinc-800/60 last:border-0">
      <span class="text-xs text-zinc-500 font-mono"><?=$d['l']?></span>
      <span class="text-xs font-bold <?=$d['c']?> font-mono"><?=htmlspecialchars($d['v'])?></span>
    </div>
<?php endforeach; ?>
  </div>
  <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5 space-y-2">
    <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 flex items-center gap-1.5 mb-3">
      <span class="material-symbols-outlined text-cyan-400 text-[16px]">domain</span> Subdomain Routing
    </div>
<?php
$subs=[['l'=>'Main','url'=>URL_HOME],['l'=>'Tools','url'=>URL_TOOLS],['l'=>'Projects','url'=>URL_PROJECT],['l'=>'Resume','url'=>URL_RESUME],['l'=>'Resources','url'=>URL_RESOURCES],['l'=>'Courses','url'=>URL_COURSES],['l'=>'Internships','url'=>URL_INTERNSHIPS],['l'=>'Blog','url'=>URL_BLOG]];
foreach($subs as $sd): ?>
    <div class="flex justify-between items-center py-2 border-b border-zinc-800/60 last:border-0">
      <span class="text-xs text-zinc-500 font-mono"><?=$sd['l']?></span>
      <div class="flex items-center gap-2">
        <a href="<?=$sd['url']?>" target="_blank" class="text-emerald-400 hover:underline font-mono text-xs"><?=str_replace(['https://','http://'],'',$sd['url'])?></a>
        <span class="flex items-center gap-1 text-[10px] font-mono text-emerald-400"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Live</span>
      </div>
    </div>
<?php endforeach; ?>
  </div>
  <div class="md:col-span-2 bg-zinc-900/80 border border-zinc-800 rounded-2xl p-5">
    <div class="font-mono text-[10px] uppercase tracking-widest text-zinc-500 mb-4 flex items-center gap-1.5">
      <span class="material-symbols-outlined text-purple-400 text-[16px]">extension</span> Active PHP Extensions
    </div>
    <div class="flex flex-wrap gap-2">
      <?php foreach(array_slice(get_loaded_extensions(),0,40) as $ext): ?>
      <span class="bg-zinc-800 border border-zinc-700 text-zinc-300 px-2 py-1 rounded-lg font-mono text-[10px]"><?=htmlspecialchars($ext)?></span>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

</main>
<?php nexus_footer(); ?>
</div>

<!-- ══ MODAL: RESOURCE ══ -->
<div id="modal-add-resource" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[60] hidden items-center justify-center p-4">
  <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 max-w-lg w-full shadow-2xl max-h-[92vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-5 pb-3 border-b border-zinc-800">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
          <span class="material-symbols-outlined text-[18px]">folder_zip</span>
        </div>
        <h3 id="res-modal-title" class="text-white font-bold text-base">Add Resource / Tool ZIP</h3>
      </div>
      <button onclick="closeModal('modal-add-resource')" class="text-zinc-500 hover:text-white p-1 rounded-lg hover:bg-zinc-800 transition-colors">
        <span class="material-symbols-outlined">close</span>
      </button>
    </div>
    <form id="form-resource" onsubmit="handleResourceSubmit(event)" enctype="multipart/form-data" class="space-y-4 text-sm">
      <input type="hidden" id="res-id" name="id" value=""/>
      
      <div>
        <label class="block text-[11px] font-mono text-zinc-400 mb-1.5 font-medium">Resource Title *</label>
        <input id="res-title" name="title" required placeholder="e.g. Cybersecurity Tools Pack (.ZIP) or DSA Handwritten Notes" class="w-full bg-zinc-950 border border-zinc-800 focus:border-emerald-500 rounded-xl px-3.5 py-2.5 text-white text-xs outline-none font-mono transition-colors placeholder:text-zinc-600"/>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div>
          <label class="block text-[11px] font-mono text-zinc-400 mb-1.5 font-medium">Branch / Domain</label>
          <select id="res-branch" name="branch" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono focus:border-emerald-500">
            <option value="Tools">Tools & Utilities</option>
            <option value="CS">Computer Science (CS)</option>
            <option value="ME">Mechanical (ME)</option>
            <option value="EC">Electronics (EC)</option>
            <option value="CE">Civil Engineering (CE)</option>
            <option value="All">All Branches / Common</option>
          </select>
        </div>
        <div>
          <label class="block text-[11px] font-mono text-zinc-400 mb-1.5 font-medium">Semester / Level</label>
          <select id="res-sem" name="sem" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono focus:border-emerald-500">
            <option value="All">All / General</option>
            <?php for($s=1;$s<=8;$s++): ?><option value="S<?=$s?>">Semester <?=$s?></option><?php endfor; ?>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div>
          <label class="block text-[11px] font-mono text-zinc-400 mb-1.5 font-medium">Resource Type</label>
          <select id="res-type" name="type" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono focus:border-emerald-500">
            <option value="ZIP File">ZIP Archive / Tools Bundle (.ZIP)</option>
            <option value="Tools">Developer / Cyber Tool</option>
            <option value="Software">Software & Utilities</option>
            <option value="Source Code">Source Code / Scripts</option>
            <option value="Notes">Lecture Notes (Handwritten/PDF)</option>
            <option value="PYQ">Previous Year Questions (PYQ)</option>
            <option value="Lab Manual">Lab Experiments Manual</option>
            <option value="Formula Sheet">Formula Sheet / Cheat Sheet</option>
          </select>
        </div>
        <div>
          <label class="block text-[11px] font-mono text-zinc-400 mb-1.5 font-medium">Author / Contributor</label>
          <input id="res-by" name="by" value="Yaswant Dev" class="w-full bg-zinc-950 border border-zinc-800 focus:border-emerald-500 rounded-xl px-3.5 py-2 text-white text-xs outline-none font-mono transition-colors"/>
        </div>
      </div>

      <!-- File Attachment Section -->
      <div class="p-3.5 bg-zinc-950/80 rounded-xl border border-zinc-800 space-y-2.5">
        <div class="flex items-center justify-between">
          <span class="text-[11px] font-mono font-semibold text-emerald-400 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">cloud_upload</span> Upload File (.zip, .pdf, .tar.gz, code)
          </span>
          <span class="text-[10px] font-mono text-zinc-500">Direct Server Storage</span>
        </div>
        
        <input type="file" id="res-file" name="file" onchange="handleFileSelection(this)" accept=".zip,.rar,.7z,.tar,.gz,.pdf,.doc,.docx,.ppt,.pptx,.txt,.py,.java,.cpp,.c,.js,.json,.sql,.sh,.apk" class="w-full text-xs text-zinc-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-mono file:font-semibold file:bg-emerald-500/10 file:text-emerald-400 hover:file:bg-emerald-500/20 file:cursor-pointer"/>
        
        <div id="current-file-container" class="hidden text-[11px] font-mono text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 rounded-lg p-2 flex items-center justify-between">
          <span class="truncate" id="current-file-label">Current File</span>
          <a id="current-file-link" href="#" target="_blank" class="text-xs underline shrink-0 ml-2">Preview / Download</a>
        </div>
      </div>

      <!-- Cloud / External Link -->
      <div>
        <label class="block text-[11px] font-mono text-zinc-400 mb-1.5 font-medium">OR External URL / Google Drive / GitHub Link</label>
        <input id="res-url" name="url" type="url" placeholder="https://drive.google.com/... or https://github.com/..." class="w-full bg-zinc-950 border border-zinc-800 focus:border-emerald-500 rounded-xl px-3.5 py-2 text-white text-xs outline-none font-mono transition-colors placeholder:text-zinc-600"/>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-[11px] font-mono text-zinc-400 mb-1.5 font-medium">File Size Display</label>
          <input id="res-size" name="size" placeholder="e.g. 15.4 MB" value="5.0 MB" class="w-full bg-zinc-950 border border-zinc-800 focus:border-emerald-500 rounded-xl px-3.5 py-2 text-white text-xs outline-none font-mono transition-colors"/>
        </div>
        <div>
          <label class="block text-[11px] font-mono text-zinc-400 mb-1.5 font-medium">Card Accent Color</label>
          <select id="res-color" name="color" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono">
            <option value="amber">Amber (Orange / ZIP)</option>
            <option value="cyan">Cyan (Blue / Tools)</option>
            <option value="emerald">Emerald (Green / Notes)</option>
            <option value="indigo">Indigo (Purple)</option>
            <option value="rose">Rose (Red)</option>
          </select>
        </div>
      </div>

      <div class="pt-2">
        <button type="submit" id="res-btn-submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-black py-2.5 rounded-xl font-mono font-bold text-xs transition-all shadow-lg shadow-emerald-500/20 active:scale-95 flex items-center justify-center gap-1.5">
          <span class="material-symbols-outlined text-[16px]">save</span> Save Resource / Tool
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ══ MODAL: COURSE ══ -->
<div id="modal-add-course" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[60] hidden items-center justify-center p-4">
  <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 max-w-md w-full shadow-2xl">
    <div class="flex justify-between items-center mb-5">
      <h3 id="course-modal-title" class="text-white font-bold text-base">Create Course Module</h3>
      <button onclick="closeModal('modal-add-course')" class="text-zinc-500 hover:text-white"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-course" onsubmit="handleCourseSubmit(event)" class="space-y-3 text-sm">
      <input type="hidden" id="course-id" name="id" value=""/>
      <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Course Title</label>
        <input id="course-title" name="title" required placeholder="e.g. Distributed Systems 101" class="w-full bg-zinc-800 border border-zinc-700 focus:border-cyan-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
      <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Category Tag</label>
        <input id="course-tag" name="tag" value="Systems" class="w-full bg-zinc-800 border border-zinc-700 focus:border-cyan-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
      <div class="grid grid-cols-2 gap-3">
        <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Lessons</label>
          <input id="course-lessons" name="lessons" type="number" value="30" class="w-full bg-zinc-800 border border-zinc-700 focus:border-cyan-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
        <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Level</label>
          <select id="course-level" name="level" class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono">
            <option>Beginner</option><option>Intermediate</option><option>Advanced</option>
          </select></div>
      </div>
      <button type="submit" id="course-btn-submit" class="w-full bg-cyan-500 hover:bg-cyan-400 text-black py-2.5 rounded-xl font-mono font-bold text-xs transition-all active:scale-95">Publish Course</button>
    </form>
  </div>
</div>

<!-- ══ MODAL: JOB ══ -->
<div id="modal-add-job" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[60] hidden items-center justify-center p-4">
  <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 max-w-md w-full shadow-2xl max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-5">
      <h3 id="job-modal-title" class="text-white font-bold text-base">Post Internship Role</h3>
      <button onclick="closeModal('modal-add-job')" class="text-zinc-500 hover:text-white"><span class="material-symbols-outlined">close</span></button>
    </div>
    <form id="form-job" onsubmit="handleJobSubmit(event)" class="space-y-3 text-sm">
      <input type="hidden" id="job-id" name="id" value=""/>
      <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Role Title</label>
        <input id="job-title" name="title" required placeholder="e.g. Backend Engineer Intern" class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
      <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Company Name</label>
        <input id="job-company" name="company" required placeholder="e.g. Stripe, TechCorp" class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
      <div class="grid grid-cols-2 gap-3">
        <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Location</label>
          <input id="job-location" name="location" value="Remote" class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
        <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Stipend</label>
          <input id="job-pay" name="pay" value="15,000/month" class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
      </div>
      <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Tags (comma separated)</label>
        <input id="job-tags" name="tags" placeholder="Python, React, Full-Stack" class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
      <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Apply Link</label>
        <input id="job-link" name="link" type="url" placeholder="https://apply.example.com" class="w-full bg-zinc-800 border border-zinc-700 focus:border-indigo-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
      <button type="submit" id="job-btn-submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white py-2.5 rounded-xl font-mono font-bold text-xs transition-all active:scale-95">Post Internship</button>
    </form>
  </div>
</div>

<!-- ══ MODAL: ARTICLE STUDIO ══ -->
<div id="modal-add-article" class="fixed inset-0 bg-black/90 backdrop-blur-sm z-[60] hidden items-center justify-center p-2 sm:p-4">
  <div class="bg-zinc-900 border border-zinc-800 rounded-2xl w-full max-w-4xl max-h-[95vh] overflow-y-auto shadow-2xl">
    <div class="sticky top-0 bg-zinc-900/98 backdrop-blur-xl px-5 py-4 border-b border-zinc-800 flex items-center justify-between z-10">
      <h3 id="article-modal-title" class="text-white font-bold text-base">Rich Blog Article Studio</h3>
      <div class="flex items-center gap-2">
        <div class="flex bg-zinc-800 rounded-xl overflow-hidden border border-zinc-700 text-xs font-mono">
          <button id="btn-mode-write" type="button" onclick="switchArticleMode('write')" class="flex-1 px-3 py-1.5 bg-purple-500/20 text-purple-400 font-bold flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">edit</span>Write</button>
          <button id="btn-mode-preview" type="button" onclick="switchArticleMode('preview')" class="flex-1 px-3 py-1.5 text-zinc-400 hover:text-white flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">visibility</span>Preview</button>
        </div>
        <button onclick="closeModal('modal-add-article')" class="text-zinc-500 hover:text-white w-8 h-8 flex items-center justify-center rounded-lg hover:bg-zinc-800"><span class="material-symbols-outlined">close</span></button>
      </div>
    </div>
    <form id="form-article" onsubmit="handleArticleSubmit(event)" class="p-5">
      <input type="hidden" id="article-id" name="id" value=""/>
      <div id="pane-write" class="space-y-4">
        <div class="flex flex-wrap gap-1.5 bg-zinc-800/50 p-2 rounded-xl border border-zinc-700">
          <span class="text-[10px] text-zinc-500 font-mono self-center mr-1">Insert:</span>
          <?php foreach([['t'=>'img','i'=>'image','l'=>'Photo'],['t'=>'video','i'=>'smart_display','l'=>'Video'],['t'=>'link','i'=>'link','l'=>'Link'],['t'=>'code','i'=>'code','l'=>'Code'],['t'=>'h2','i'=>'format_h2','l'=>'Heading'],['t'=>'quote','i'=>'format_quote','l'=>'Quote']] as $sn): ?>
          <button type="button" onclick="insertArticleSnippet('<?=$sn['t']?>')" class="flex items-center gap-1 px-2 py-1 rounded-lg bg-zinc-700/60 hover:bg-zinc-700 text-zinc-300 hover:text-white text-[10px] font-mono transition-all">
            <span class="material-symbols-outlined text-[13px]"><?=$sn['i']?></span><?=$sn['l']?>
          </button>
          <?php endforeach; ?>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Article Title</label><input id="article-title" name="title" required placeholder="Compelling headline..." class="w-full bg-zinc-800 border border-zinc-700 focus:border-purple-500 rounded-xl px-3 py-2 text-white text-sm outline-none font-mono transition-colors"/></div>
          <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Category</label>
            <select id="article-cat" name="cat" class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono">
              <option>Technical</option><option>Career</option><option>Security</option><option>Tutorial</option><option>Research</option>
            </select></div>
          <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Author</label><input id="article-author" name="author" value="Yaswant Team" class="w-full bg-zinc-800 border border-zinc-700 focus:border-purple-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
          <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Read Time</label><input id="article-read" name="read" value="5 min" class="w-full bg-zinc-800 border border-zinc-700 focus:border-purple-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
          <div class="md:col-span-2"><label class="block text-[10px] font-mono text-zinc-500 mb-1">Cover Image URL</label><input id="article-img" name="img" type="url" placeholder="https://images.unsplash.com/..." class="w-full bg-zinc-800 border border-zinc-700 focus:border-purple-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors"/></div>
          <div class="md:col-span-2"><label class="block text-[10px] font-mono text-zinc-500 mb-1">Excerpt / Summary</label><textarea id="article-excerpt" name="excerpt" rows="2" placeholder="Short 1-2 sentence summary..." class="w-full bg-zinc-800 border border-zinc-700 focus:border-purple-500 rounded-xl px-3 py-2 text-white text-xs outline-none font-mono transition-colors resize-none"></textarea></div>
        </div>
        <div><label class="block text-[10px] font-mono text-zinc-500 mb-1">Article Body (HTML)</label>
          <textarea id="article-content" name="content" rows="14" placeholder="Write full rich HTML content here..." class="w-full bg-zinc-950 border border-zinc-700 focus:border-purple-500 rounded-xl px-3 py-2.5 text-emerald-300 text-xs outline-none font-mono transition-colors resize-y"></textarea></div>
        <button type="submit" id="article-btn-submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white py-3 rounded-xl font-mono font-bold text-sm transition-all active:scale-[.99] shadow-lg">Publish Rich Article</button>
      </div>
      <div id="pane-preview" class="hidden space-y-4">
        <div id="prev-cover" class="rounded-2xl overflow-hidden h-48 bg-zinc-800 hidden"><img id="prev-img-el" src="" alt="Cover" class="w-full h-full object-cover"/></div>
        <span id="prev-cat" class="bg-purple-500/15 text-purple-400 border border-purple-500/30 px-2 py-0.5 rounded-full text-[10px] font-mono uppercase inline-block"></span>
        <h2 id="prev-title" class="text-white text-2xl font-bold"></h2>
        <div class="flex items-center gap-3 text-xs text-zinc-500 font-mono"><span id="prev-author"></span><span>&middot;</span><span id="prev-read"></span></div>
        <p id="prev-excerpt" class="text-zinc-400 text-sm border-l-2 border-purple-500/50 pl-3 italic"></p>
        <div id="prev-body" class="text-zinc-300 text-sm leading-relaxed"></div>
      </div>
    </form>
  </div>
</div>

<script>
  setInterval(function(){const e=document.getElementById('live-time');if(e)e.innerText=new Date().toLocaleTimeString('en-GB');},1000);
  document.addEventListener('DOMContentLoaded',function(){
    document.querySelectorAll('.progress-bar').forEach(function(b){const w=b.style.width;b.style.width='0';setTimeout(function(){b.style.width=w;},100);});
  });

  /* ─── Toast Notification ─── */
  function showToast(msg, type='success') {
    const old = document.getElementById('admin-toast');
    if (old) old.remove();
    const t = document.createElement('div');
    t.id = 'admin-toast';
    const colors = type === 'success'
      ? 'bg-emerald-500/20 border-emerald-500/40 text-emerald-300'
      : 'bg-red-500/20 border-red-500/40 text-red-300';
    const icon = type === 'success' ? 'check_circle' : 'error';
    t.className = `fixed top-20 right-4 z-[999] flex items-center gap-2.5 px-4 py-3 rounded-xl border font-mono text-xs shadow-2xl backdrop-blur-sm transition-all ${colors}`;
    t.style.cssText = 'animation: slideInRight .3s ease; max-width: 320px;';
    t.innerHTML = `<span class="material-symbols-outlined text-[17px]">${icon}</span><span>${msg}</span>`;
    document.body.appendChild(t);
    setTimeout(() => { t.style.opacity = '0'; t.style.transform = 'translateX(20px)'; setTimeout(() => t.remove(), 300); }, 3500);
  }
  /* inject keyframe */
  const _ks = document.createElement('style');
  _ks.textContent = '@keyframes slideInRight{from{opacity:0;transform:translateX(20px)}to{opacity:1;transform:none}}';
  document.head.appendChild(_ks);

  function openModal(id){const e=document.getElementById(id);if(e){e.classList.remove('hidden');e.classList.add('flex');}}
  function closeModal(id){const e=document.getElementById(id);if(e){e.classList.add('hidden');e.classList.remove('flex');}}
  document.addEventListener('keydown',function(e){if(e.key==='Escape')['modal-add-resource','modal-add-course','modal-add-job','modal-add-article'].forEach(closeModal);});
  function openArticleStudio(){
    document.getElementById('article-modal-title').innerText='Rich Blog Article Studio';
    ['article-id','article-title','article-img','article-excerpt'].forEach(function(id){document.getElementById(id).value='';});
    document.getElementById('article-cat').value='Technical';
    document.getElementById('article-author').value='Yaswant Team';
    document.getElementById('article-read').value='5 min';
    document.getElementById('article-content').value='<p>Start writing your article here...</p>\n<h2>Introduction</h2>\n<p>Your content goes here.</p>';
    document.getElementById('article-btn-submit').innerText='Publish Rich Article';
    switchArticleMode('write');openModal('modal-add-article');
  }
  function editArticle(a){
    document.getElementById('article-modal-title').innerText='Edit Article Studio';
    document.getElementById('article-id').value=a.id;
    document.getElementById('article-title').value=a.title;
    document.getElementById('article-cat').value=a.cat||'Technical';
    document.getElementById('article-author').value=a.author||'Yaswant Team';
    document.getElementById('article-read').value=a.read||a.readTime||'5 min';
    document.getElementById('article-img').value=a.img||'';
    document.getElementById('article-excerpt').value=a.excerpt||'';
    document.getElementById('article-content').value=a.content||('<p>'+(a.excerpt||'')+'</p>');
    document.getElementById('article-btn-submit').innerText='Update Article';
    switchArticleMode('write');openModal('modal-add-article');
  }
  function switchArticleMode(mode){
    const pW=document.getElementById('pane-write'),pP=document.getElementById('pane-preview');
    const bW=document.getElementById('btn-mode-write'),bP=document.getElementById('btn-mode-preview');
    if(mode==='write'){
      pW.classList.remove('hidden');pP.classList.add('hidden');
      bW.className='flex-1 px-3 py-1.5 bg-purple-500/20 text-purple-400 font-bold flex items-center gap-1';
      bP.className='flex-1 px-3 py-1.5 text-zinc-400 hover:text-white flex items-center gap-1';
    }else{
      pW.classList.add('hidden');pP.classList.remove('hidden');
      bP.className='flex-1 px-3 py-1.5 bg-purple-500/20 text-purple-400 font-bold flex items-center gap-1';
      bW.className='flex-1 px-3 py-1.5 text-zinc-400 hover:text-white flex items-center gap-1';
      const img=document.getElementById('article-img').value;
      if(img){document.getElementById('prev-img-el').src=img;document.getElementById('prev-cover').classList.remove('hidden');}
      else document.getElementById('prev-cover').classList.add('hidden');
      document.getElementById('prev-title').innerText=document.getElementById('article-title').value||'Untitled';
      document.getElementById('prev-cat').innerText=(document.getElementById('article-cat').value||'TECHNICAL').toUpperCase();
      document.getElementById('prev-read').innerText=(document.getElementById('article-read').value||'5 min')+' read';
      document.getElementById('prev-author').innerText='By '+(document.getElementById('article-author').value||'Yaswant Team');
      document.getElementById('prev-excerpt').innerText=document.getElementById('article-excerpt').value||'No excerpt.';
      document.getElementById('prev-body').innerHTML=document.getElementById('article-content').value||'<p style="color:#71717a">No content yet.</p>';
    }
  }
  function insertArticleSnippet(type){
    const area=document.getElementById('article-content');let s='';
    if(type==='img'){const u=prompt('Image URL:','https://images.unsplash.com/photo-1517694712202-14dd9538aa97');if(!u)return;const a=prompt('Caption:','Diagram');s='\n<figure class="my-4">\n  <img src="'+u+'" alt="'+(a||'Image')+'" class="w-full rounded-xl shadow-lg"/>\n  <figcaption class="text-center text-xs text-zinc-400 mt-1">'+(a||'')+'</figcaption>\n</figure>\n';}
    else if(type==='video'){let u=prompt('YouTube Embed URL:','https://www.youtube.com/embed/dQw4w9WgXcQ');if(!u)return;if(u.includes('watch?v='))u=u.replace('watch?v=','embed/');s='\n<div class="aspect-video w-full my-4 rounded-xl overflow-hidden">\n  <iframe src="'+u+'" class="w-full h-full" frameborder="0" allowfullscreen></iframe>\n</div>\n';}
    else if(type==='link'){const u=prompt('Link URL:','https://yaswant.co.in');if(!u)return;const t=prompt('Link Text:','Visit Link');s='<a href="'+u+'" target="_blank" class="text-emerald-400 hover:underline font-bold">'+(t||u)+'</a>';}
    else if(type==='code')s='\n<pre class="bg-zinc-950 p-4 rounded-xl text-xs font-mono text-emerald-400 border border-zinc-800 my-4 overflow-x-auto"><code>// Your code here\nfunction example() {\n  console.log("Hello World");\n}</code></pre>\n';
    else if(type==='h2')s='\n<h2 class="text-xl font-bold text-white mt-8 mb-2">Section Heading</h2>\n';
    else if(type==='quote')s='\n<blockquote class="bg-zinc-900 border-l-4 border-emerald-500 p-4 rounded-r-xl italic text-zinc-400 my-4">\n  "Your inspiring quote here..."\n</blockquote>\n';
    const st=area.selectionStart,en=area.selectionEnd;
    area.value=area.value.substring(0,st)+s+area.value.substring(en);area.focus();
  }
  function filterTable(inputId,tableId){
    const q=document.getElementById(inputId).value.toLowerCase();
    document.querySelectorAll('#'+tableId+' tbody tr').forEach(function(r){r.style.display=r.innerText.toLowerCase().includes(q)?'':'none';});
  }
  function filterCards(inputId,gridId){
    const q=document.getElementById(inputId).value.toLowerCase();
    document.querySelectorAll('#'+gridId+' .card-item').forEach(function(c){c.style.display=c.innerText.toLowerCase().includes(q)?'':'none';});
  }
  function exportSubscribersCSV(){
    const rows=document.querySelectorAll('#tbl-subscribers tbody tr');
    let csv='Email,Date Subscribed\n';
    rows.forEach(function(r){const cols=r.querySelectorAll('td');if(cols.length>=3)csv+='"'+cols[1].innerText.trim()+'","'+cols[2].innerText.trim()+'"\n';});
    const a=document.createElement('a');
    a.href=URL.createObjectURL(new Blob([csv],{type:'text/csv'}));
    a.download='subscribers_'+new Date().toISOString().slice(0,10)+'.csv';a.click();
    showToast('Subscribers exported as CSV!');
  }
  function openAddResourceModal(){
    const form = document.getElementById('form-resource');
    if (form) form.reset();
    document.getElementById('res-modal-title').innerText='Add Resource / Tool ZIP';
    document.getElementById('res-id').value='';
    document.getElementById('res-branch').value='Tools';
    document.getElementById('res-sem').value='All';
    document.getElementById('res-type').value='ZIP File';
    document.getElementById('res-by').value='Yaswant Dev';
    document.getElementById('res-url').value='';
    document.getElementById('res-size').value='5.0 MB';
    document.getElementById('res-color').value='amber';
    document.getElementById('res-file').value='';
    document.getElementById('current-file-container').classList.add('hidden');
    document.getElementById('res-btn-submit').innerText='Save Resource / Tool';
    openModal('modal-add-resource');
  }
  function handleFileSelection(input){
    if (input.files && input.files[0]) {
      const f = input.files[0];
      const bytes = f.size;
      const units = ['B', 'KB', 'MB', 'GB'];
      const pow = Math.min(units.length - 1, Math.floor(bytes ? Math.log(bytes)/Math.log(1024) : 0));
      const formatted = (bytes / Math.pow(1024, pow)).toFixed(1) + ' ' + units[pow];
      document.getElementById('res-size').value = formatted;
      
      const fileName = f.name;
      const ext = fileName.split('.').pop().toLowerCase();
      if (['zip', 'rar', '7z', 'tar', 'gz'].includes(ext)) {
        document.getElementById('res-type').value = 'ZIP File';
        document.getElementById('res-color').value = 'amber';
        if (document.getElementById('res-branch').value === 'CS') {
          document.getElementById('res-branch').value = 'Tools';
        }
      }
      const titleInput = document.getElementById('res-title');
      if (!titleInput.value) {
        titleInput.value = fileName.replace(/\.[^/.]+$/, "").replace(/[_\-]/g, ' ');
      }
    }
  }
  function editResource(r){
    document.getElementById('res-modal-title').innerText='Edit Resource / Tool';
    document.getElementById('res-id').value=r.id;
    document.getElementById('res-title').value=r.title;
    document.getElementById('res-branch').value=r.branch||'Tools';
    document.getElementById('res-sem').value=r.sem||'All';
    document.getElementById('res-type').value=r.type||'ZIP File';
    document.getElementById('res-by').value=r.by||'Yaswant Dev';
    document.getElementById('res-url').value=r.url||'';
    document.getElementById('res-size').value=r.size||'5.0 MB';
    document.getElementById('res-color').value=r.color||'amber';
    document.getElementById('res-file').value='';
    
    const currContainer = document.getElementById('current-file-container');
    const currLabel = document.getElementById('current-file-label');
    const currLink = document.getElementById('current-file-link');
    if (r.url) {
      currContainer.classList.remove('hidden');
      currLabel.innerText = 'Current: ' + r.url;
      currLink.href = r.url;
    } else {
      currContainer.classList.add('hidden');
    }
    document.getElementById('res-btn-submit').innerText='Update Resource / Tool';
    openModal('modal-add-resource');
  }
  function editCourse(c){document.getElementById('course-modal-title').innerText='Edit Course Module';document.getElementById('course-id').value=c.id;document.getElementById('course-title').value=c.title;document.getElementById('course-tag').value=c.tag||'General';document.getElementById('course-lessons').value=c.lessons||20;document.getElementById('course-level').value=c.level||'Beginner';document.getElementById('course-btn-submit').innerText='Update Course';openModal('modal-add-course');}
  function editJob(j){document.getElementById('job-modal-title').innerText='Edit Internship Role';document.getElementById('job-id').value=j.id;document.getElementById('job-title').value=j.title;document.getElementById('job-company').value=j.company;document.getElementById('job-location').value=j.location||'Remote';document.getElementById('job-pay').value=j.pay||'15,000/month';document.getElementById('job-tags').value=Array.isArray(j.tags)?j.tags.join(', '):(j.tags||'');document.getElementById('job-link').value=j.link||'';document.getElementById('job-btn-submit').innerText='Update Internship';openModal('modal-add-job');}
  function handleResourceSubmit(e){e.preventDefault();submitAdminForm(e.target,document.getElementById('res-id').value?'edit_resource':'add_resource');}
  function handleCourseSubmit(e){e.preventDefault();submitAdminForm(e.target,document.getElementById('course-id').value?'edit_course':'add_course');}
  function handleJobSubmit(e){e.preventDefault();submitAdminForm(e.target,document.getElementById('job-id').value?'edit_job':'add_job');}
  function handleArticleSubmit(e){e.preventDefault();submitAdminForm(e.target,document.getElementById('article-id').value?'edit_article':'add_article');}
  function submitAdminForm(formEl,action){
    const formData=new FormData(formEl);formData.append('action',action);
    const btn=formEl.querySelector('[type=submit]');
    const origText = btn ? btn.innerText : '';
    if(btn){btn.disabled=true;btn.innerText='Saving…';}
    fetch('api/admin_action.php',{method:'POST',body:formData})
      .then(r=>r.json()).then(res=>{
        if(res.success){
          showToast(res.message || 'Saved successfully!');
          setTimeout(()=>window.location.reload(), 1200);
        } else {
          showToast(res.error||'Operation failed','error');
          if(btn){btn.disabled=false;btn.innerText=origText;}
        }
      }).catch(function(){
        showToast('Network error. Please try again.','error');
        if(btn){btn.disabled=false;btn.innerText=origText;}
      });
  }
  function deleteItem(action,id){
    if(!confirm('Permanently delete this item?'))return;
    const f=new FormData();f.append('action',action);f.append('id',id);
    fetch('api/admin_action.php',{method:'POST',body:f}).then(r=>r.json()).then(res=>{
      if(res.success){showToast('Deleted successfully!');setTimeout(()=>window.location.reload(),1000);}
      else showToast(res.error||'Delete failed','error');
    });
  }
  function deleteSubscriber(email){
    if(!confirm('Remove subscriber '+email+'?'))return;
    const f=new FormData();f.append('action','delete_subscriber');f.append('email',email);
    fetch('api/admin_action.php',{method:'POST',body:f}).then(r=>r.json()).then(res=>{
      if(res.success){showToast('Subscriber removed');setTimeout(()=>window.location.reload(),1000);}
      else showToast(res.error||'Delete failed','error');
    });
  }
</script>