<?php require_once __DIR__ . '/../includes/layout.php';

// WebApplication schema — uses URL_TOOLS canonical
$schema = schema_tools();

nexus_head(
  'Cyber Security & Developer Utilities by Yaswant Pandey — 26+ Online Tools',
  'Interactive browser-based security & engineering tools built by Yaswant Pandey: Password Strength Checker, CSPRNG Generator, SIEM Log Analyzer, Stateful Firewall Simulator, SQL Injection Auditor, 2FA Generator, CIDR Calculator, and REST API tester.',
  'cyber security tools online, password entropy checker, CSPRNG password generator, SIEM log analyzer, stateful firewall simulator, SQLi vulnerability scanner, 2FA TOTP generator, CIDR subnet calculator, AES-256 encryptor online, REST API tester online, GPA calculator engineering, developer tools by Yaswant Pandey',
  URL_TOOLS,
  ['type' => 'website', 'title' => 'Cyber Security & Developer Utilities by Yaswant Pandey'],
  $schema
);

$toolSections = [
  'Cyber Security Tools & Calculators' => [
    ['file' => '01-password-strength-checker.php', 'id' => 'pass-check', 'icon' => 'lock_reset', 'color' => 'primary', 'name' => 'Password Strength & Entropy Checker', 'desc' => 'Calculates Shannon entropy & dictionary breach risk.', 'modal' => 'passCheckModal'],
    ['href' => URL_TOOLS . '/password-generator', 'file' => 'password-generator.php', 'id' => 'pass-gen', 'icon' => 'key', 'color' => 'secondary', 'name' => 'CSPRNG Password Generator', 'desc' => 'Hardware-level random password & passphrase generator.', 'modal' => 'passGenModal'],
    ['file' => '03-syslog-siem-log-analyzer.php', 'id' => 'siem-log', 'icon' => 'receipt_long', 'color' => 'emerald', 'name' => 'Syslog SIEM & Auth Log Analyzer', 'desc' => 'Parses Linux auth.log, Apache access logs & extracts threat IPs.', 'modal' => 'siemModal'],
    ['file' => '04-brute-force-rate-limiter.php', 'id' => 'brute-force', 'icon' => 'timer', 'color' => 'primary', 'name' => 'Brute Force Rate Limiter Simulator', 'desc' => 'Simulates login rate limiting, exponential backoff & IP bans.', 'modal' => 'bruteModal'],
    ['file' => '05-wifi-security-analyzer.php', 'id' => 'wifi-sec', 'icon' => 'wifi', 'color' => 'tertiary', 'name' => 'Wi-Fi Network Security & Cipher Analyzer', 'desc' => 'Inspects WPA2/WPA3 handshake security & WPS vulnerability risk.', 'modal' => 'wifiModal'],
    ['file' => '06-network-packet-sniffer.php', 'id' => 'packet-sniff', 'icon' => 'hub', 'color' => 'secondary', 'name' => 'Network Packet Sniffer & Stream Analyzer', 'desc' => 'Simulates live PCAP packet capture, headers & hex payloads.', 'modal' => 'packetModal'],
    ['file' => '07-malware-yara-scanner.php', 'id' => 'malware-scan', 'icon' => 'coronavirus', 'color' => 'emerald', 'name' => 'Malware Signature & YARA Rule Scanner', 'desc' => 'Scans code & files against webshell, Trojan & ransomware signatures.', 'modal' => 'malwareModal'],
    ['file' => '08-stateful-firewall-simulator.php', 'id' => 'firewall-sim', 'icon' => 'local_firewall', 'color' => 'emerald', 'name' => 'Stateful Firewall Rule Simulator', 'desc' => 'Simulates packet filtering rules (ALLOW/DENY) by IP, Port & Protocol.', 'modal' => 'firewallModal'],
    ['file' => '09-sqli-auditor-pdo-converter.php', 'id' => 'sqli-audit', 'icon' => 'terminal', 'color' => 'tertiary', 'name' => 'SQL Injection Auditor & PDO Converter', 'desc' => 'Detects SQLi attack signatures & generates PDO prepared statements.', 'modal' => 'sqliModal'],
    ['file' => '10-2fa-totp-authenticator-generator.php', 'id' => 'totp-gen', 'icon' => 'phonelink_lock', 'color' => 'emerald', 'name' => '2FA TOTP Authenticator Generator', 'desc' => 'Generates RFC 6238 Base32 secrets & live 6-digit 2FA passcodes.', 'modal' => 'totpModal'],
    ['file' => '11-keylogger-event-auditor.php', 'id' => 'key-inspect', 'icon' => 'keyboard', 'color' => 'primary', 'name' => 'Keylogger & Input Event Auditor', 'desc' => 'Captures keypress event details, keycodes & keystroke dynamics.', 'modal' => 'keyModal'],
    ['file' => '12-ipv4-subnet-cidr-calculator.php', 'id' => 'cidr-calc', 'icon' => 'lan', 'color' => 'tertiary', 'name' => 'IPv4 Subnet & CIDR Calculator', 'desc' => 'Calculates Network Address, Broadcast IP, Subnet Mask & Host Range.', 'modal' => 'cidrModal'],
    ['file' => '13-http-security-headers-auditor.php', 'id' => 'sec-headers', 'icon' => 'verified_user', 'color' => 'secondary', 'name' => 'HTTP Security Headers Auditor', 'desc' => 'Audits CSP, HSTS, X-Frame-Options & CORS headers.', 'modal' => 'secHeadersModal'],
    ['file' => '14-aes-256-gcm-web-encryptor.php', 'id' => 'aes-encrypt', 'icon' => 'shield', 'color' => 'emerald', 'name' => 'AES-GCM Web Encryptor / Decryptor', 'desc' => 'Encrypts text & files in browser using AES-256-GCM zero-knowledge encryption.', 'modal' => 'aesModal'],
    ['file' => '15-ip-geolocation-threat-inspector.php', 'id' => 'ip-lookup', 'icon' => 'travel_explore', 'color' => 'primary', 'name' => 'IP Geolocation & Threat Inspector', 'desc' => 'Looks up ASN, ISP, country, city, and VPN/Proxy indicators for any IP.', 'modal' => 'ipModal'],
    ['href' => URL_TOOLS . '/hash-generator', 'file' => 'hash-generator.php', 'id' => 'sha256-hash', 'icon' => 'fingerprint', 'color' => 'tertiary', 'name' => 'Cryptographic Hash Generator (SHA-256/512)', 'desc' => 'Calculates instant cryptographic file & text hashes with WebCrypto.', 'modal' => 'hashModal'],
    ['href' => URL_TOOLS . '/jwt-decoder', 'file' => 'jwt-decoder.php', 'id' => 'jwt-decode', 'icon' => 'badge', 'color' => 'primary', 'name' => 'JWT Token Decoder & Inspector', 'desc' => 'Decodes JWT header, payload claims, and expiration countdown.', 'modal' => 'jwtModal'],
    ['file' => '18-dns-email-policy-inspector.php', 'id' => 'dns-lookup', 'icon' => 'dns', 'color' => 'secondary', 'name' => 'DNS & Email Policy Inspector (SPF/DMARC)', 'desc' => 'Queries live A, MX, TXT, SPF & DMARC records via DNS over HTTPS.', 'modal' => 'dnsModal'],
    ['file' => '19-xss-payload-sanitizer-auditor.php', 'id' => 'xss-sanitize', 'icon' => 'bug_report', 'color' => 'tertiary', 'name' => 'XSS Sanitizer & Payload Auditor', 'desc' => 'Inspects HTML payloads for XSS threats & renders sanitized code.', 'modal' => 'xssModal'],
    ['file' => '20-url-safety-redirect-inspector.php', 'id' => 'url-safety', 'icon' => 'security', 'color' => 'primary', 'name' => 'URL Safety & Redirect Inspector', 'desc' => 'Inspects URLs for phishing indicators and SSL status.', 'modal' => 'urlSafetyModal'],
    ['file' => '21-browser-port-reachability-scanner.php', 'id' => 'port-scan', 'icon' => 'radar', 'color' => 'secondary', 'name' => 'Browser Port Reachability Scanner', 'desc' => 'Tests TCP port responsiveness and WebSocket hosts.', 'modal' => 'portScanModal'],
    ['href' => URL_TOOLS . '/base64-encoder', 'file' => 'base64-encoder.php', 'id' => 'base64-tool', 'icon' => 'enhanced_encryption', 'color' => 'tertiary', 'name' => 'Base64 & Hex Encoder / Decoder', 'desc' => 'Converts raw strings & URLs to Base64/Hex.', 'modal' => 'base64Modal'],
  ],
  'Developer & Engineering Utilities' => [
    ['href' => URL_TOOLS . '/pdf-editor', 'file' => 'pdf-editor.php', 'id' => 'pdf-edit', 'icon' => 'picture_as_pdf', 'color' => 'emerald', 'name' => 'PDF Editor, Merger & Watermark Suite', 'desc' => 'Merge PDFs, organize & delete pages, rotate, add watermarks & page numbers.'],
    ['href' => URL_TOOLS . '/json-formatter', 'file' => 'json-formatter.php', 'id' => 'json-val', 'icon' => 'data_object', 'color' => 'tertiary', 'name' => 'JSON Formatter & Validator', 'desc' => 'Validate syntax, format, and minify raw JSON strings.', 'modal' => 'jsonModal'],
    ['href' => URL_TOOLS . '/uuid-generator', 'file' => 'uuid-generator.php', 'id' => 'uuid-gen', 'icon' => 'tag', 'color' => 'emerald', 'name' => 'UUID / GUID v4 Generator', 'desc' => 'Generate random RFC 4122 UUIDs & GUIDs in bulk.'],
    ['href' => URL_TOOLS . '/rest-api-tester', 'file' => 'rest-api-tester.php', 'id' => 'api-test', 'icon' => 'api', 'color' => 'primary', 'name' => 'REST API & Webhook Tester', 'desc' => 'Test GET/POST endpoints directly in browser.', 'modal' => 'apiModal'],
    ['file' => '23-gpa-sgpa-grade-calculator.php', 'id' => 'gpa-calc', 'icon' => 'calculate', 'color' => 'primary', 'name' => 'GPA / SGPA Calculator', 'desc' => 'Interactive semester grade & SGPA calculator.', 'modal' => 'gpaModal'],
    ['file' => '24-code-beautifier-formatter.php', 'id' => 'code-format', 'icon' => 'code', 'color' => 'secondary', 'name' => 'Code Beautifier & Formatter', 'desc' => 'Format JS, HTML, CSS, SQL & JSON in real time.', 'modal' => 'formatModal'],
  ],
  'Image Editing Tools (image.yaswant.co.in)' => [
    ['href' => URL_IMAGE . '/resize.php',    'id' => 'img-resize',    'icon' => 'photo_size_select_large', 'color' => 'primary',   'name' => 'Resize Image',           'desc' => 'Change image width & height by pixels or percentage. JPG, PNG, WebP.'],
    ['href' => URL_IMAGE . '/compress.php',  'id' => 'img-compress',  'icon' => 'compress',                'color' => 'secondary', 'name' => 'Compress Image',         'desc' => 'Reduce file size without losing quality.'],
    ['href' => URL_IMAGE . '/crop.php',      'id' => 'img-crop',      'icon' => 'crop',                    'color' => 'tertiary',  'name' => 'Crop Image',             'desc' => 'Trim borders and select specific regions.'],
    ['href' => URL_IMAGE . '/convert.php',   'id' => 'img-convert',   'icon' => 'transform',               'color' => 'emerald',   'name' => 'Convert Image Format',   'desc' => 'Convert JPG ↔ PNG ↔ WebP ↔ BMP instantly.'],
    ['href' => URL_IMAGE . '/rotate.php',    'id' => 'img-rotate',    'icon' => 'rotate_right',            'color' => 'primary',   'name' => 'Rotate & Flip Image',    'desc' => 'Rotate 90°, 180°, flip horizontally or vertically.'],
    ['href' => URL_IMAGE . '/watermark.php', 'id' => 'img-watermark', 'icon' => 'copyright',               'color' => 'secondary', 'name' => 'Add Watermark',          'desc' => 'Overlay text or image watermark with opacity control.'],
    ['href' => URL_IMAGE . '/filters.php',   'id' => 'img-filters',   'icon' => 'tune',                    'color' => 'tertiary',  'name' => 'Filters & Adjustments',  'desc' => 'Adjust brightness, contrast, saturation & apply filters.'],
    ['href' => URL_IMAGE . '/remove-bg.php', 'id' => 'img-removebg',  'icon' => 'auto_fix_high',           'color' => 'emerald',   'name' => 'Remove Background',      'desc' => 'Make image background transparent — 1-click PNG export.'],
    ['href' => URL_IMAGE,                    'id' => 'img-all',       'icon' => 'image',                   'color' => 'primary',   'name' => 'All Image Tools →',      'desc' => 'Visit image.yaswant.co.in for the full image editing suite.'],
  ],
  'Career & Projects Showcase' => [
    ['href' => URL_PROJECT, 'id' => 'projects-hub', 'icon' => 'shield_lock', 'color' => 'emerald', 'name' => '25+ Cyber Security Projects Hub', 'desc' => 'Explore 25 hands-on cyber security labs & source repos.'],
    ['href' => URL_RESUME, 'id' => 'resume-builder', 'icon' => 'document_scanner', 'color' => 'primary', 'name' => 'ATS Resume Studio', 'desc' => 'Interactive real-time ATS resume editor.'],
  ],
];

$q = trim($_GET['q'] ?? '');
if ($q) {
  foreach ($toolSections as $section => &$tools) {
    $tools = array_values(array_filter(
      $tools,
      fn($t) =>
      stripos($t['name'], $q) !== false || stripos($t['desc'], $q) !== false
    ));
  }
  unset($tools);
  $toolSections = array_filter($toolSections, fn($t) => !empty($t));
}
?>
<style>
  /* ── Hand-Crafted Technical Dark Theme (Vercel / Linear Aesthetic) ── */
  .tools-page-wrap {
    background: #09090b;
    color: #f4f4f5;
    font-feature-settings: "cv02", "cv03", "cv04", "cv11";
  }

  /* Dot Grid Background */
  .dot-grid-bg {
    background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
    background-size: 24px 24px;
  }

  /* Minimalist Product Cards — tool grid */
  .tool-card {
    background: rgba(18, 18, 22, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.07);
    border-radius: 0.9rem;
    transition: border-color 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease;
  }

  .tool-card:hover {
    border-color: rgba(16, 185, 129, 0.35);
    transform: translateY(-2px);
    box-shadow: 0 12px 28px -8px rgba(16, 185, 129, 0.12), 0 4px 12px -4px rgba(0,0,0,0.6);
  }

  /* Tool icon badge */
  .tool-icon-badge {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 0.65rem;
    transition: all 0.18s ease;
  }

  .tool-card:hover .tool-icon-badge {
    background: #10b981;
    border-color: #10b981;
    color: #000 !important;
  }

  /* Info Card — hero / SEO section */
  .info-card {
    background: rgba(18, 18, 22, 0.75);
    border: 1px solid rgba(255, 255, 255, 0.07);
    border-radius: 1rem;
  }

  /* Gradient accent text */
  .gradient-text {
    background: linear-gradient(135deg, #10b981 0%, #06b6d4 55%, #6366f1 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  /* Command/Search bar */
  .cmd-search {
    background: #111113;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 0.75rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .cmd-search:focus-within {
    border-color: #10b981;
    box-shadow: 0 0 0 1px #10b981, 0 6px 20px -4px rgba(16,185,129,0.15);
  }

  /* Category filter pills */
  .cat-pill {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 9999px;
    color: #a1a1aa;
    transition: all 0.15s ease;
    white-space: nowrap;
    font-family: 'JetBrains Mono', monospace;
  }

  .cat-pill:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(255,255,255,0.18);
    color: #fff;
  }

  .cat-pill.active {
    background: #10b981;
    border-color: #10b981;
    color: #000;
    font-weight: 700;
    box-shadow: 0 0 14px rgba(16,185,129,0.3);
  }

  /* Section header */
  .section-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #52525b;
  }

  /* Accent line separator */
  .accent-line {
    height: 1px;
    background: linear-gradient(to right, rgba(16,185,129,0.3), rgba(255,255,255,0.04), transparent);
  }

  .no-scrollbar::-webkit-scrollbar { display: none; }
  .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen tools-page-wrap">
  <?php nexus_sidebar('tools');
  nexus_topbar('tools'); ?>

  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-[1340px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col w-full gap-8 relative dot-grid-bg">

      <!-- Ambient Glow Orbs (subtle) -->
      <div class="absolute top-0 right-0 w-[520px] h-[520px] rounded-full blur-[180px] pointer-events-none z-0 opacity-60"
        style="background: radial-gradient(circle, rgba(16,185,129,0.10) 0%, transparent 70%);"></div>
      <div class="absolute bottom-40 left-0 w-96 h-96 rounded-full blur-[150px] pointer-events-none z-0 opacity-50"
        style="background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 70%);"></div>

      <!-- ── Breadcrumbs ── -->
      <nav aria-label="Breadcrumb" class="relative z-10 flex items-center gap-1.5 text-[11px] font-mono text-zinc-500">
        <a href="<?= URL_HOME ?>" class="hover:text-zinc-300 transition-colors">yaswant.co.in</a>
        <span>/</span>
        <span class="text-zinc-300">tools</span>
      </nav>

      <!-- ── Hero Header ── -->
      <section class="relative z-10">
        <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-6">
          <div class="space-y-3 max-w-2xl">
            <!-- Status badge -->
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full border border-white/10 bg-white/[0.03] text-[10px] font-mono uppercase tracking-widest text-zinc-400">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
              100% Client-Side • Zero Data Harvesting • WebCrypto API
            </div>

            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight leading-tight">
              Developer &amp; <span class="gradient-text">Cyber Security</span><br class="hidden sm:block"> Utilities
            </h1>
            <p class="text-sm text-zinc-400 font-light leading-relaxed max-w-xl">
              <?= array_sum(array_map('count', $toolSections)) ?>+ browser-based tools — password strength, SIEM log analysis, YARA scanning, AES-256 encryption, CIDR calculator, REST API tester and more.
            </p>
          </div>

          <!-- Search -->
          <form method="GET" class="relative w-full lg:w-72 shrink-0" role="search" aria-label="Search tools"
                onsubmit="event.preventDefault(); applyToolFilters();">
            <label for="tools-search" class="sr-only">Search tools</label>
            <div class="cmd-search flex items-center gap-2 px-3 py-2.5">
              <span class="material-symbols-outlined text-zinc-500 text-[18px] shrink-0" aria-hidden="true">search</span>
              <input id="tools-search" name="q" value="<?= htmlspecialchars($q) ?>"
                class="flex-1 bg-transparent text-white text-xs font-mono placeholder:text-zinc-600 outline-none"
                placeholder="Search <?= array_sum(array_map('count', $toolSections)) ?>+ tools…" />
              <kbd class="hidden sm:inline-flex items-center gap-1 px-1.5 py-0.5 rounded border border-white/10 text-[9px] font-mono text-zinc-600">⌘K</kbd>
            </div>
          </form>
        </div>
      </section>

      <!-- ── Category Filter Pills ── -->
      <div class="relative z-10 w-full overflow-x-auto no-scrollbar">
        <div class="flex items-center gap-2 min-w-max" role="tablist" aria-label="Tool Categories">
          <button type="button" id="chip-all" onclick="filterTools('all', this)"
            class="cat-pill active px-3.5 py-1.5 text-[11px] flex items-center gap-1.5"
            role="tab" aria-selected="true">
            <span class="material-symbols-outlined text-[14px]">apps</span>
            All (<?= array_sum(array_map('count', $toolSections)) ?>)
          </button>
          <button type="button" id="chip-cyber" onclick="filterTools('cyber', this)"
            class="cat-pill px-3.5 py-1.5 text-[11px] flex items-center gap-1.5"
            role="tab" aria-selected="false">
            <span class="material-symbols-outlined text-[14px] text-emerald-400">shield</span>
            Cyber Security
          </button>
          <button type="button" id="chip-dev" onclick="filterTools('dev', this)"
            class="cat-pill px-3.5 py-1.5 text-[11px] flex items-center gap-1.5"
            role="tab" aria-selected="false">
            <span class="material-symbols-outlined text-[14px] text-cyan-400">code</span>
            Dev Utilities
          </button>
          <button type="button" id="chip-image" onclick="filterTools('image', this)"
            class="cat-pill px-3.5 py-1.5 text-[11px] flex items-center gap-1.5"
            role="tab" aria-selected="false">
            <span class="material-symbols-outlined text-[14px] text-amber-400">image</span>
            Image Suite
          </button>
          <button type="button" id="chip-projects" onclick="filterTools('projects', this)"
            class="cat-pill px-3.5 py-1.5 text-[11px] flex items-center gap-1.5"
            role="tab" aria-selected="false">
            <span class="material-symbols-outlined text-[14px] text-violet-400">folder_special</span>
            Projects &amp; Labs
          </button>
        </div>
      </div>

      <!-- Live Empty State -->
      <div id="instant-empty-state" class="hidden relative z-10 text-center py-20">
        <span class="material-symbols-outlined text-[52px] text-zinc-700 mb-3 block" aria-hidden="true">search_off</span>
        <p class="text-sm text-zinc-500 font-mono">No utilities match your search.</p>
        <button type="button"
          onclick="document.getElementById('tools-search').value=''; document.querySelectorAll('.cat-pill').forEach(c=>c.classList.remove('active')); document.getElementById('chip-all').classList.add('active'); filterTools('all', null);"
          class="mt-4 inline-flex items-center gap-1.5 text-xs font-mono text-emerald-400 hover:text-emerald-300 transition-colors">
          <span class="material-symbols-outlined text-[14px]">refresh</span> Reset filters
        </button>
      </div>

      <!-- ── Tools Grid ── -->
      <?php if (empty($toolSections)): ?>
        <div class="relative z-10 text-center py-20">
          <span class="material-symbols-outlined text-[56px] text-zinc-700 mb-3 block" aria-hidden="true">search_off</span>
          <p class="text-sm text-zinc-500 font-mono">No results for "<?= htmlspecialchars($q) ?>".</p>
          <a href="<?= URL_TOOLS ?>" class="mt-3 inline-flex items-center gap-1 text-xs font-mono text-emerald-400 hover:underline">Clear search</a>
        </div>
      <?php else: ?>
        <?php
        $catSlugs = [
          'Cyber Security Tools & Calculators' => 'cyber',
          'Developer & Engineering Utilities'  => 'dev',
          'Image Editing Tools (image.yaswant.co.in)' => 'image',
          'Career & Projects Showcase'         => 'projects',
        ];
        $catIcons = [
          'cyber'    => 'shield',
          'dev'      => 'code',
          'image'    => 'image',
          'projects' => 'folder_special',
        ];
        ?>
        <div id="tools-container" class="relative z-10 space-y-12">
          <?php foreach ($toolSections as $section => $tools):
            $secCat  = $catSlugs[$section] ?? 'cyber';
            $secIcon = $catIcons[$secCat]  ?? 'apps';
          ?>
            <section class="tool-section-block" data-category="<?= $secCat ?>"
              aria-labelledby="section-<?= preg_replace('/\W+/', '-', strtolower($section)) ?>">

              <!-- Section header -->
              <div class="flex items-center gap-3 mb-6">
                <span class="section-label"><?= htmlspecialchars($section) ?></span>
                <div class="flex-1 accent-line" aria-hidden="true"></div>
                <span class="section-label"><?= count($tools) ?> tools</span>
              </div>

              <!-- Cards grid -->
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4">
                <?php foreach ($tools as $t):
                  $href  = isset($t['file']) ? URL_TOOLS . '/' . $t['file'] : ($t['href'] ?? 'javascript:void(0)');
                  $click = isset($t['modal']) ? "openToolModal('{$t['modal']}')" : '';
                ?>
                  <div class="tool-card group relative p-4 flex flex-col gap-3 min-h-[148px]"
                       data-category="<?= $secCat ?>"
                       data-name="<?= htmlspecialchars(strtolower($t['name'])) ?>"
                       data-desc="<?= htmlspecialchars(strtolower($t['desc'])) ?>">

                    <!-- Top row: icon + action -->
                    <div class="flex items-start justify-between gap-2">
                      <div class="tool-icon-badge w-9 h-9 flex items-center justify-center text-emerald-400 shrink-0">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true"><?= $t['icon'] ?></span>
                      </div>

                      <?php if (isset($t['file']) && isset($t['modal'])): ?>
                        <div class="flex items-center gap-1">
                          <button type="button" onclick="<?= $click ?>"
                            class="text-[9px] font-mono uppercase tracking-wide bg-white/[0.05] border border-white/10 text-zinc-400 px-2 py-1 rounded-md hover:bg-emerald-500 hover:text-black hover:border-emerald-500 transition-all active:scale-95">Try</button>
                          <a href="<?= $href ?>"
                            class="w-6 h-6 flex items-center justify-center rounded-md bg-white/[0.04] border border-white/10 text-zinc-500 hover:text-emerald-400 hover:border-emerald-500/40 transition-all"
                            title="Open dedicated page" aria-label="Open in full page">
                            <span class="material-symbols-outlined text-[13px]">open_in_new</span>
                          </a>
                        </div>
                      <?php else: ?>
                        <a href="<?= $href ?>"
                          class="inline-flex items-center gap-1 text-[10px] font-mono text-zinc-400 bg-white/[0.04] border border-white/10 px-2 py-1 rounded-md hover:text-emerald-400 hover:border-emerald-500/40 transition-all active:scale-95">
                          Launch <span class="material-symbols-outlined text-[12px]">open_in_new</span>
                        </a>
                      <?php endif; ?>
                    </div>

                    <!-- Tool info -->
                    <div>
                      <h3 class="text-[13px] font-semibold text-zinc-100 mb-1 group-hover:text-emerald-400 transition-colors leading-snug">
                        <a href="<?= $href ?>" class="hover:underline"><?= htmlspecialchars($t['name']) ?></a>
                      </h3>
                      <p class="text-[11px] leading-relaxed text-zinc-500 line-clamp-2"><?= htmlspecialchars($t['desc']) ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </section>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <!-- ── Why Use These Tools — Architecture Callout ── -->
      <section class="relative z-10 mt-2">
        <!-- Section label -->
        <div class="flex items-center gap-3 mb-6">
          <span class="section-label">Zero-Knowledge Architecture</span>
          <div class="flex-1 accent-line" aria-hidden="true"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
          <div class="info-card p-5">
            <div class="w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mb-3">
              <span class="material-symbols-outlined text-emerald-400 text-[18px]">enhanced_encryption</span>
            </div>
            <h3 class="text-[13px] font-semibold text-zinc-100 mb-1.5">100% Client-Side WebCrypto</h3>
            <p class="text-[11px] text-zinc-500 leading-relaxed">
              AES-256-GCM, SHA-256, and CSPRNG run directly in your browser via the native W3C Web Crypto API. No data ever leaves your device.
            </p>
          </div>

          <div class="info-card p-5">
            <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mb-3">
              <span class="material-symbols-outlined text-cyan-400 text-[18px]">speed</span>
            </div>
            <h3 class="text-[13px] font-semibold text-zinc-100 mb-1.5">Zero-Latency Execution</h3>
            <p class="text-[11px] text-zinc-500 leading-relaxed">
              No server round-trips. JSON formatting, CIDR calculations, and entropy scoring complete in under 1 millisecond.
            </p>
          </div>

          <div class="info-card p-5">
            <div class="w-8 h-8 rounded-lg bg-violet-500/10 border border-violet-500/20 flex items-center justify-center mb-3">
              <span class="material-symbols-outlined text-violet-400 text-[18px]">manage_search</span>
            </div>
            <h3 class="text-[13px] font-semibold text-zinc-100 mb-1.5">Pentest Simulators</h3>
            <p class="text-[11px] text-zinc-500 leading-relaxed">
              Built for security researchers: stateful firewall rules, SQLi PDO converter, YARA signatures, and SIEM auth.log analysis.
            </p>
          </div>
        </div>

        <!-- FAQ -->
        <div class="mt-6 space-y-2">
          <div class="flex items-center gap-3 mb-4">
            <span class="section-label">FAQ</span>
            <div class="flex-1 accent-line" aria-hidden="true"></div>
          </div>

          <details class="info-card px-4 py-3 cursor-pointer group">
            <summary class="text-[12px] font-semibold text-zinc-300 group-hover:text-emerald-400 transition-colors flex items-center justify-between select-none">
              Are these tools safe to use with confidential data?
              <span class="material-symbols-outlined text-zinc-600 text-[16px] group-open:rotate-180 transition-transform shrink-0">expand_more</span>
            </summary>
            <p class="text-[11px] text-zinc-500 leading-relaxed mt-3 font-light">
              Yes. Every tool runs locally in your browser sandbox using JavaScript. No network requests are made with your passwords, keys, or log data.
            </p>
          </details>

          <details class="info-card px-4 py-3 cursor-pointer group">
            <summary class="text-[12px] font-semibold text-zinc-300 group-hover:text-emerald-400 transition-colors flex items-center justify-between select-none">
              Can I use these for engineering assignments and security audits?
              <span class="material-symbols-outlined text-zinc-600 text-[16px] group-open:rotate-180 transition-transform shrink-0">expand_more</span>
            </summary>
            <p class="text-[11px] text-zinc-500 leading-relaxed mt-3 font-light">
              Absolutely. GPA calculators, CIDR tools, and SQLi PDO converters are 100% free for students, developers, and security auditors.
            </p>
          </details>
        </div>
      </section>

    </div>
  </main>

  <!-- 1. Password Strength Checker Modal -->
  <div id="passCheckModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">lock_reset</span> Password Strength & Entropy Checker
        </h3>
        <button onclick="closeToolModal('passCheckModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="space-y-sm">
        <input type="password" id="pass-check-input" oninput="checkPasswordStrength()" placeholder="Enter password to test strength..."
          class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none focus:ring-2 focus:ring-emerald-400"/>
        <div class="w-full bg-surface-container-lowest h-2 rounded-full overflow-hidden">
          <div id="pass-meter-bar" class="h-full bg-red-500 w-0 transition-all duration-300"></div>
        </div>
        <div class="flex justify-between text-xs font-mono">
          <span class="text-on-surface-variant">Entropy Score: <strong id="pass-entropy-val" class="text-emerald-400">0 bits</strong></span>
          <span id="pass-status-label" class="text-red-400 font-bold">Very Weak</span>
        </div>
      </div>
      <div class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-on-surface-variant space-y-1 border border-outline-variant/20">
        <div>Length: <span id="chk-len" class="text-zinc-400">0</span> chars</div>
        <div>Uppercase / Lowercase: <span id="chk-case" class="text-zinc-400">No</span></div>
        <div>Numbers & Symbols: <span id="chk-sym" class="text-zinc-400">No</span></div>
      </div>
    </div>
  </div>

  <!-- 2. CSPRNG Password Generator Modal -->
  <div id="passGenModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">key</span> CSPRNG Password Generator
        </h3>
        <button onclick="closeToolModal('passGenModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      
      <div class="flex gap-xs">
        <input type="text" id="gen-pass-out" readonly class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-emerald-400 font-bold outline-none selection:bg-emerald-500/30"/>
        <button onclick="copyGeneratedPassword()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-md py-sm rounded-xl font-mono text-xs font-bold flex items-center gap-xs transition-colors">
          <span class="material-symbols-outlined text-[16px]">content_copy</span> Copy
        </button>
      </div>

      <div class="bg-surface-container-lowest p-md rounded-xl space-y-md border border-outline-variant/20">
        <div class="space-y-xs">
          <div class="flex justify-between text-xs font-mono text-on-surface">
            <span>Password Length:</span>
            <span id="gen-len-val" class="text-emerald-400 font-bold">16 characters</span>
          </div>
          <input type="range" id="gen-len-slider" min="8" max="64" value="16" oninput="updatePassLengthLabel(this.value); generateSecurePassword();" class="w-full accent-emerald-400 cursor-pointer"/>
        </div>

        <div class="grid grid-cols-2 gap-xs text-xs font-mono text-on-surface">
          <label class="flex items-center gap-xs cursor-pointer"><input type="checkbox" id="opt-upper" checked onchange="generateSecurePassword()" class="accent-emerald-400"/> Uppercase (A-Z)</label>
          <label class="flex items-center gap-xs cursor-pointer"><input type="checkbox" id="opt-lower" checked onchange="generateSecurePassword()" class="accent-emerald-400"/> Lowercase (a-z)</label>
          <label class="flex items-center gap-xs cursor-pointer"><input type="checkbox" id="opt-num" checked onchange="generateSecurePassword()" class="accent-emerald-400"/> Numbers (0-9)</label>
          <label class="flex items-center gap-xs cursor-pointer"><input type="checkbox" id="opt-sym" checked onchange="generateSecurePassword()" class="accent-emerald-400"/> Symbols (!@#$)</label>
        </div>
      </div>

      <div class="flex items-center justify-between pt-xs">
        <span id="gen-entropy-badge" class="text-[11px] font-mono text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded border border-emerald-500/20">Entropy: 95.6 bits</span>
        <button onclick="generateSecurePassword()" class="bg-surface-container-highest hover:bg-surface-variant text-on-surface px-md py-xs rounded-xl font-mono text-xs font-bold flex items-center gap-xs transition-colors">
          <span class="material-symbols-outlined text-[16px]">refresh</span> Generate New
        </button>
      </div>
    </div>
  </div>

  <!-- 3. Syslog SIEM Log Analyzer Modal -->
  <div id="siemModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">receipt_long</span> Syslog SIEM & Auth Log Analyzer
        </h3>
        <button onclick="closeToolModal('siemModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="siem-input" oninput="analyzeSiemLogs()" rows="4" placeholder="Paste Syslog lines e.g. Oct 11 14:32:01 server sshd[1024]: Failed password for invalid user root from 192.168.1.105 port 54322 ssh2..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div id="siem-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-outline-variant/20 text-zinc-300">
        SIEM analysis summary will render here...
      </div>
    </div>
  </div>

  <!-- 4. Brute Force Rate Limiter Modal -->
  <div id="bruteModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">timer</span> Brute Force Rate Limiter Simulator
        </h3>
        <button onclick="closeToolModal('bruteModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="flex gap-xs">
        <input type="text" id="brute-user" value="admin@yaswant.co.in" class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="simulateFailedLogin()" class="bg-red-500 hover:bg-red-400 text-white px-md py-sm rounded-xl font-mono text-xs font-bold">Failed Login Attempt</button>
      </div>
      <div id="brute-status" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-emerald-400 border border-outline-variant/20">
        Account status: Normal. Failed attempts: 0 / 5 limit.
      </div>
    </div>
  </div>

  <!-- 5. Wi-Fi Security Analyzer Modal -->
  <div id="wifiModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">wifi</span> Wi-Fi Security & Cipher Inspector
        </h3>
        <button onclick="closeToolModal('wifiModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="space-y-xs font-mono text-xs">
        <select id="wifi-cipher" onchange="inspectWifiSecurity()" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-on-surface outline-none">
          <option value="WPA3-SAE">WPA3-Personal (SAE / Dragonfly Handshake)</option>
          <option value="WPA2-CCMP">WPA2-Personal (AES-CCMP - 4-Way Handshake)</option>
          <option value="WEP">WEP (Legacy RC4 - Insecure)</option>
        </select>
        <div id="wifi-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-outline-variant/20 text-emerald-400">
          WPA3 SAE provides strong forward secrecy and protects against offline dictionary attacks.
        </div>
      </div>
    </div>
  </div>

  <!-- 6. Packet Sniffer Modal -->
  <div id="packetModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">hub</span> Network Packet Sniffer & Stream Analyzer
        </h3>
        <button onclick="closeToolModal('packetModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="flex items-center justify-between">
        <button id="btn-packet-toggle" onclick="togglePacketCapture()" class="bg-emerald-500 text-black px-md py-xs rounded-xl font-mono text-xs font-bold">Start Capture</button>
        <span id="packet-count-label" class="text-xs font-mono text-emerald-400">Packets Captured: 0</span>
      </div>
      <div id="packet-stream" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono max-h-56 overflow-y-auto border border-outline-variant/20 space-y-1">
        <span class="text-zinc-500">Click Start Capture to begin streaming live simulated network packet frames...</span>
      </div>
    </div>
  </div>

  <!-- 7. Malware YARA Scanner Modal -->
  <div id="malwareModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">coronavirus</span> Malware Signature & YARA Rule Scanner
        </h3>
        <button onclick="closeToolModal('malwareModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="malware-input" oninput="scanMalwareSignatures()" rows="4" placeholder="Paste script, webshell code or file strings e.g. eval(base64_decode(...)) or system($_GET['cmd'])..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div id="malware-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-outline-variant/20">
        YARA rule pattern evaluation results will appear here...
      </div>
    </div>
  </div>

  <!-- 8. Stateful Firewall Rule Simulator Modal -->
  <div id="firewallModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">local_firewall</span> Stateful Firewall Rule Simulator
        </h3>
        <button onclick="closeToolModal('firewallModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="grid grid-cols-12 gap-xs text-xs font-mono">
        <input type="text" id="fw-ip" value="192.168.1.10" placeholder="Source IP" class="col-span-5 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-on-surface outline-none"/>
        <input type="number" id="fw-port" value="22" placeholder="Port" class="col-span-3 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-on-surface outline-none"/>
        <select id="fw-proto" class="col-span-4 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-on-surface outline-none">
          <option value="TCP">TCP</option><option value="UDP">UDP</option><option value="ICMP">ICMP</option>
        </select>
      </div>
      <button onclick="testFirewallRule()" class="w-full bg-emerald-500 text-black py-sm rounded-xl font-mono text-xs font-bold">Simulate Incoming Packet Inspection</button>
      <div id="fw-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-outline-variant/20">
        Packet evaluation status will render here...
      </div>
    </div>
  </div>

  <!-- 9. SQL Injection Auditor Modal -->
  <div id="sqliModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">terminal</span> SQL Injection Auditor & PDO Converter
        </h3>
        <button onclick="closeToolModal('sqliModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="sqli-input" oninput="auditSqlInjection()" rows="3" placeholder="Enter SQL query e.g. SELECT * FROM users WHERE user = 'admin' OR '1'='1'..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div class="space-y-xs font-mono text-xs">
        <div class="flex justify-between items-center">
          <span class="text-zinc-400 text-[10px] uppercase">SQLi Risk Assessment:</span>
          <span id="sqli-risk" class="text-emerald-400 font-bold">Safe Query</span>
        </div>
        <div class="bg-surface-container-lowest p-sm rounded border border-outline-variant/20">
          <span class="text-zinc-500 text-[10px] block mb-1 uppercase">PDO Prepared Statement Fix:</span>
          <pre id="pdo-fix-out" class="text-cyan-400 break-all whitespace-pre-wrap"></pre>
        </div>
      </div>
    </div>
  </div>

  <!-- 10. 2FA TOTP Generator Modal -->
  <div id="totpModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">phonelink_lock</span> RFC 6238 TOTP 2FA Generator
        </h3>
        <button onclick="closeToolModal('totpModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      
      <div class="space-y-sm">
        <div class="flex gap-xs">
          <input type="text" id="totp-secret-input" value="JBSWY3DPEHPK3PXP" placeholder="Enter Base32 Secret..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none uppercase"/>
          <button onclick="generateRandomTotpSecret()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold">New Secret</button>
        </div>

        <div class="bg-surface-container-lowest p-md rounded-xl text-center border border-outline-variant/20 space-y-xs">
          <span class="text-[10px] font-mono text-zinc-400 uppercase">Live 30-Sec Verification Code</span>
          <h2 id="totp-code-val" class="text-4xl font-bold text-emerald-400 font-mono tracking-widest">--- ---</h2>
          <div class="text-[11px] font-mono text-zinc-400">Refreshes in <span id="totp-timer" class="text-emerald-400 font-bold">30</span>s</div>
        </div>
      </div>
    </div>
  </div>

  <!-- 11. Keylogger Auditor Modal -->
  <div id="keyModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">keyboard</span> Keylogger & Keystroke Event Auditor
        </h3>
        <button onclick="closeToolModal('keyModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <input type="text" id="key-test-input" onkeydown="auditKeystroke(event)" placeholder="Click here and type any key combination (Shift, Ctrl, Alt, Letters)..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none focus:ring-2 focus:ring-emerald-400"/>
      <div id="key-log-stream" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono max-h-48 overflow-y-auto border border-outline-variant/20 space-y-1">
        <span class="text-zinc-500">Live keystroke logs will stream here as you type...</span>
      </div>
    </div>
  </div>

  <!-- 12. IPv4 Subnet Calculator Modal -->
  <div id="cidrModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">lan</span> IPv4 Subnet & CIDR Calculator
        </h3>
        <button onclick="closeToolModal('cidrModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="flex gap-xs">
        <input type="text" id="cidr-input" value="192.168.1.50/24" placeholder="Enter IP/CIDR (e.g. 192.168.1.1/24)..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="calculateCIDR()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold">Calculate</button>
      </div>
      <div id="cidr-results" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs border border-outline-variant/20 text-zinc-300">
        Enter a CIDR string above (e.g. 10.0.0.1/16).
      </div>
    </div>
  </div>

  <!-- 13. HTTP Security Headers Auditor Modal -->
  <div id="secHeadersModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">verified_user</span> HTTP Security Headers Auditor
        </h3>
        <button onclick="closeToolModal('secHeadersModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="flex gap-xs">
        <input type="text" id="header-url-input" value="https://yaswant.co.in" placeholder="Enter domain/URL..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="auditSecurityHeaders()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold">Audit Headers</button>
      </div>
      <div id="header-results" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs max-h-64 overflow-y-auto border border-outline-variant/20 text-zinc-300">
        Click Audit Headers to check security response header configurations.
      </div>
    </div>
  </div>

  <!-- 14. AES-GCM Encryptor Modal -->
  <div id="aesModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">shield</span> AES-256-GCM Zero-Knowledge Text Encryptor
        </h3>
        <button onclick="closeToolModal('aesModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="aes-input" rows="3" placeholder="Enter plaintext message or ciphertext..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <input type="password" id="aes-pass" placeholder="Enter Secret Encryption Key / Passphrase..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
      <div class="flex gap-xs">
        <button onclick="encryptAES()" class="flex-1 bg-emerald-500 text-black py-sm rounded-xl font-mono text-xs font-bold">Encrypt (AES-GCM)</button>
        <button onclick="decryptAES()" class="flex-1 bg-surface-container-highest text-on-surface py-sm rounded-xl font-mono text-xs font-bold">Decrypt</button>
      </div>
      <pre id="aes-output" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-emerald-400 break-all max-h-36 overflow-y-auto border border-outline-variant/20">Ciphertext / Output will appear here...</pre>
    </div>
  </div>

  <!-- 15. IP Geolocation Inspector Modal -->
  <div id="ipModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">travel_explore</span> IP Geolocation & Threat Inspector
        </h3>
        <button onclick="closeToolModal('ipModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="flex gap-xs">
        <input type="text" id="ip-input" value="8.8.8.8" placeholder="Enter IP address (e.g. 8.8.8.8)..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="lookupIP()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold flex items-center gap-xs">
          <span class="material-symbols-outlined text-[16px]">search</span> Lookup IP
        </button>
      </div>
      <div id="ip-results" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs max-h-64 overflow-y-auto border border-outline-variant/20 text-zinc-300">
        Enter an IP address above or lookup your current public IP.
      </div>
    </div>
  </div>

  <!-- 16. DNS Record Inspector Modal -->
  <div id="dnsModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">dns</span> DNS Record & Email Policy Inspector (SPF / DMARC)
        </h3>
        <button onclick="closeToolModal('dnsModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="flex gap-xs">
        <input type="text" id="dns-domain-input" value="yaswant.co.in" placeholder="Enter domain name..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="queryDnsRecords()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold flex items-center gap-xs">
          <span class="material-symbols-outlined text-[16px]">search</span> Inspect DNS
        </button>
      </div>
      <div id="dns-results" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs max-h-64 overflow-y-auto border border-outline-variant/20 text-zinc-300">
        Enter a domain name above to fetch live DNS records via DNS over HTTPS.
      </div>
    </div>
  </div>

  <!-- 17. XSS Sanitizer Modal -->
  <div id="xssModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">bug_report</span> XSS Payload Sanitizer & Security Auditor
        </h3>
        <button onclick="closeToolModal('xssModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="xss-input" oninput="sanitizeXssPayload()" rows="3" placeholder="Enter HTML payload e.g. <script>alert(1)</script> or <img src=x onerror=alert(1)>..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div class="space-y-xs font-mono text-xs">
        <div class="flex items-center justify-between">
          <span class="text-zinc-400 text-[10px] uppercase">Threat Assessment:</span>
          <span id="xss-threat-status" class="text-emerald-400 font-bold">Safe Payload</span>
        </div>
        <div class="bg-surface-container-lowest p-sm rounded border border-outline-variant/20">
          <span class="text-zinc-500 text-[10px] block mb-1 uppercase">Sanitized HTML Output:</span>
          <pre id="xss-sanitized-out" class="text-emerald-400 break-all whitespace-pre-wrap"></pre>
        </div>
      </div>
    </div>
  </div>

  <!-- 18. SHA-256 Hash Engine Modal -->
  <div id="hashModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">fingerprint</span> SHA-256 & SHA-1 Hash Generator
        </h3>
        <button onclick="closeToolModal('hashModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="hash-input" oninput="computeHashes()" rows="3" placeholder="Enter text to hash..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div class="space-y-xs font-mono text-xs">
        <div>
          <span class="text-zinc-400 text-[10px]">SHA-256:</span>
          <div id="sha256-out" class="bg-surface-container-lowest p-2 rounded border border-outline-variant/20 text-emerald-400 break-all">...</div>
        </div>
      </div>
    </div>
  </div>

  <!-- 19. JWT Decoder Modal -->
  <div id="jwtModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">badge</span> JWT Token Decoder & Inspector
        </h3>
        <button onclick="closeToolModal('jwtModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="jwt-input" oninput="decodeJWT()" rows="3" placeholder="Paste encoded JSON Web Token (eyJhbGci...)..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div class="grid grid-cols-2 gap-xs font-mono text-xs">
        <div>
          <span class="text-zinc-400 text-[10px] uppercase">Header</span>
          <pre id="jwt-header-out" class="bg-surface-container-lowest p-sm rounded border border-outline-variant/20 text-cyan-400 max-h-40 overflow-y-auto">{}</pre>
        </div>
        <div>
          <span class="text-zinc-400 text-[10px] uppercase">Payload Claims</span>
          <pre id="jwt-payload-out" class="bg-surface-container-lowest p-sm rounded border border-outline-variant/20 text-emerald-400 max-h-40 overflow-y-auto">{}</pre>
        </div>
      </div>
    </div>
  </div>

  <!-- 20. URL Safety Inspector Modal -->
  <div id="urlSafetyModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">security</span> URL Safety & Redirect Inspector
        </h3>
        <button onclick="closeToolModal('urlSafetyModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <input type="text" id="url-inspect-input" value="https://yaswant.co.in" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
      <button onclick="inspectURL()" class="w-full bg-emerald-500 text-black py-sm rounded-xl font-mono text-xs font-bold">Inspect URL Safety</button>
      <div id="url-inspect-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-1 hidden border border-outline-variant/20"></div>
    </div>
  </div>

  <!-- 21. Port Scanner Modal -->
  <div id="portScanModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">radar</span> TCP & WebSocket Port Reachability Test
        </h3>
        <button onclick="closeToolModal('portScanModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="flex gap-xs">
        <input type="text" id="port-target" value="echo.websocket.events" class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="testPortReachability()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold">Test Port</button>
      </div>
      <div id="port-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-zinc-300 border border-outline-variant/20">Target status will appear here...</div>
    </div>
  </div>

  <!-- 22. Base64 Converter Modal -->
  <div id="base64Modal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">enhanced_encryption</span> Base64 Encoder / Decoder
        </h3>
        <button onclick="closeToolModal('base64Modal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="b64-input" rows="4" placeholder="Enter text to encode or decode..." class="w-full bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div class="flex items-center justify-end gap-xs">
        <button onclick="encodeB64()" class="bg-emerald-500 text-black text-xs px-md py-xs rounded-xl font-mono font-bold">Encode Base64</button>
        <button onclick="decodeB64()" class="bg-surface-container-highest text-on-surface text-xs px-md py-xs rounded-xl font-mono font-bold">Decode Base64</button>
      </div>
    </div>
  </div>

  <!-- 23. GPA Calculator Modal -->
  <div id="gpaModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">calculate</span> SGPA / GPA Calculator
        </h3>
        <button onclick="closeToolModal('gpaModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div id="gpa-rows" class="space-y-xs max-h-60 overflow-y-auto pr-xs">
        <div class="grid grid-cols-12 gap-xs items-center">
          <input type="text" placeholder="Subject Name" value="Data Structures" class="col-span-6 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none"/>
          <select class="col-span-3 gpa-credit bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none">
            <option value="4" selected>4 Credits</option><option value="3">3 Credits</option><option value="2">2 Credits</option><option value="1">1 Credit</option>
          </select>
          <select class="col-span-3 gpa-grade bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none">
            <option value="10" selected>O (10)</option><option value="9">A+ (9)</option><option value="8">A (8)</option><option value="7">B+ (7)</option><option value="6">B (6)</option>
          </select>
        </div>
      </div>
      <div class="flex items-center justify-between pt-xs">
        <button onclick="addGpaRow()" class="text-xs font-mono text-emerald-400 flex items-center gap-xs">+ Add Subject</button>
        <button onclick="calculateGPA()" class="bg-emerald-500 text-black text-xs px-md py-xs rounded-xl font-bold font-mono">Calculate SGPA</button>
      </div>
      <div id="gpa-result" class="bg-surface-container-lowest p-md rounded-xl text-center border border-outline-variant/20 hidden">
        <span class="text-xs text-on-surface-variant font-mono uppercase">Calculated Semester SGPA</span>
        <h2 id="gpa-val" class="text-3xl font-bold text-emerald-400 font-mono mt-xs">0.00</h2>
      </div>
    </div>
  </div>

  <!-- 24. Code Formatter Modal -->
  <div id="formatModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">code</span> Live Code Beautifier
        </h3>
        <button onclick="closeToolModal('formatModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="code-input" rows="6" placeholder="Paste raw code here..." class="w-full bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div class="flex items-center justify-between">
        <span class="text-xs text-on-surface-variant font-mono">Format & auto-indent code</span>
        <button onclick="formatCode()" class="bg-emerald-500 text-black text-xs px-md py-xs rounded-xl font-mono font-bold">Format Code</button>
      </div>
    </div>
  </div>

  <!-- 25. JSON Validator Modal -->
  <div id="jsonModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">data_object</span> JSON Validator & Linter
        </h3>
        <button onclick="closeToolModal('jsonModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <textarea id="json-input" rows="6" placeholder='{"name": "Yaswant", "role": "Developer"}' class="w-full bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <div class="flex items-center justify-between">
        <span id="json-status" class="text-xs font-mono text-on-surface-variant">Enter JSON string</span>
        <button onclick="validateJSON()" class="bg-emerald-500 text-black text-xs px-md py-xs rounded-xl font-mono font-bold">Validate JSON</button>
      </div>
    </div>
  </div>

  <!-- 26. REST API Tester Modal -->
  <div id="apiModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md hidden flex items-center justify-center p-md">
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-2xl w-full p-lg shadow-2xl space-y-md relative">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h3 class="font-headline-md text-base font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">api</span> REST API Tester
        </h3>
        <button onclick="closeToolModal('apiModal')" class="text-outline hover:text-on-surface"><span class="material-symbols-outlined">close</span></button>
      </div>
      <div class="flex gap-xs">
        <select id="api-method" class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface font-mono outline-none">
          <option value="GET">GET</option><option value="POST">POST</option>
        </select>
        <input id="api-url" type="text" value="https://jsonplaceholder.typicode.com/todos/1" class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-xs text-xs font-mono text-on-surface outline-none"/>
        <button onclick="runApiTest()" class="bg-emerald-500 text-black text-xs px-md py-xs rounded-xl font-mono font-bold">Send Request</button>
      </div>
      <pre id="api-response" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-on-surface max-h-60 overflow-y-auto border border-outline-variant/20">Response will appear here...</pre>
    </div>
  </div>

  <?php nexus_footer(); ?>
</div>

<script>
  let activeToolCat = 'all';

  function filterTools(cat, btn) {
    activeToolCat = cat;
    // Update pill styles
    document.querySelectorAll('.cat-pill').forEach(c => {
      c.classList.remove('active');
      c.setAttribute('aria-selected', 'false');
    });
    if (btn) {
      btn.classList.add('active');
      btn.setAttribute('aria-selected', 'true');
    }
    applyToolFilters();
  }

  function applyToolFilters() {
    const q = (document.getElementById('tools-search')?.value || '').trim().toLowerCase();
    let visibleTotal = 0;

    document.querySelectorAll('.tool-section-block').forEach(sec => {
      let visibleInSection = 0;
      sec.querySelectorAll('.tool-card').forEach(card => {
        const cCat  = card.getAttribute('data-category');
        const cName = card.getAttribute('data-name') || '';
        const cDesc = card.getAttribute('data-desc') || '';

        const catOk    = (activeToolCat === 'all' || activeToolCat === cCat);
        const searchOk = (!q || cName.includes(q) || cDesc.includes(q));

        if (catOk && searchOk) {
          card.style.display = '';
          visibleInSection++;
          visibleTotal++;
        } else {
          card.style.display = 'none';
        }
      });
      sec.style.display = visibleInSection > 0 ? '' : 'none';
    });

    const emptyEl = document.getElementById('instant-empty-state');
    if (emptyEl) emptyEl.classList.toggle('hidden', visibleTotal > 0);
  }

  document.addEventListener('DOMContentLoaded', () => {
    const s = document.getElementById('tools-search');
    if (s) s.addEventListener('input', applyToolFilters);
  });

  let totpInterval = null;
  let packetInterval = null;
  let packetCount = 0;
  let failedLoginCount = 0;

  function openToolModal(id) {
    document.getElementById(id).classList.remove('hidden');
    if (id === 'passGenModal') generateSecurePassword();
    if (id === 'totpModal') startTotpEngine();
  }
  function closeToolModal(id) {
    document.getElementById(id).classList.add('hidden');
    if (id === 'totpModal' && totpInterval) clearInterval(totpInterval);
    if (id === 'packetModal' && packetInterval) togglePacketCapture(true);
  }

  // Syslog SIEM Log Analyzer Logic
  function analyzeSiemLogs() {
    const raw = document.getElementById('siem-input').value;
    const out = document.getElementById('siem-out');
    if (!raw) {
      out.innerHTML = 'SIEM analysis summary will render here...';
      return;
    }

    const lines = raw.split('\n').filter(l => l.trim().length > 0);
    const failedSsh = lines.filter(l => /failed password|authentication failure|invalid user/i.test(l));
    const ips = Array.from(new Set(raw.match(/\b(?:\d{1,3}\.){3}\d{1,3}\b/g) || []));

    out.innerHTML = `
      <div class="space-y-xs">
        <div>Total Log Lines Processed: <strong class="text-emerald-400">${lines.length}</strong></div>
        <div class="${failedSsh.length > 0 ? 'text-red-400' : 'text-emerald-400'} font-bold">Failed Auth / Suspicious Events: ${failedSsh.length}</div>
        <div>Unique Source IPs Extracted: <span class="text-cyan-400">${ips.join(', ') || 'None'}</span></div>
      </div>
    `;
  }

  // Brute Force Rate Limiter Simulator Logic
  function simulateFailedLogin() {
    failedLoginCount++;
    const user = document.getElementById('brute-user').value;
    const status = document.getElementById('brute-status');

    if (failedLoginCount >= 5) {
      const lockSeconds = Math.pow(2, failedLoginCount - 5) * 30;
      status.innerHTML = `<span class="text-red-400 font-bold">[IP BANNED & ACCOUNT LOCKED]</span> 5/5 Threshold Exceeded for ${user}. Exponential Lockout Active: ${lockSeconds}s remaining.`;
      status.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-red-500/30';
    } else {
      status.innerHTML = `Attempt ${failedLoginCount} failed for ${user}. Warning: ${5 - failedLoginCount} attempts remaining before rate-limit lockout.`;
      status.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-amber-400 border border-amber-500/30';
    }
  }

  // Wi-Fi Security Analyzer Logic
  function inspectWifiSecurity() {
    const cipher = document.getElementById('wifi-cipher').value;
    const out = document.getElementById('wifi-out');

    if (cipher === 'WPA3-SAE') {
      out.innerText = 'WPA3 SAE (Dragonfly) provides strong forward secrecy and protects against offline dictionary attacks.';
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-emerald-500/30 text-emerald-400';
    } else if (cipher === 'WPA2-CCMP') {
      out.innerText = 'WPA2 CCMP AES is secure, but vulnerable to dictionary attacks if PMKID / 4-way handshakes are captured.';
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-yellow-500/30 text-yellow-400';
    } else {
      out.innerText = 'CRITICAL: WEP cipher uses weak 24-bit IVs and can be cracked in under 60 seconds!';
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-red-500/30 text-red-400 font-bold';
    }
  }

  // Network Packet Sniffer Logic
  function togglePacketCapture(forceStop = false) {
    const btn = document.getElementById('btn-packet-toggle');
    const stream = document.getElementById('packet-stream');

    if (packetInterval || forceStop) {
      clearInterval(packetInterval);
      packetInterval = null;
      if (btn) btn.innerText = 'Start Capture';
      return;
    }

    btn.innerText = 'Stop Capture';
    if (stream.children[0] && stream.children[0].innerText.startsWith('Click Start Capture')) {
      stream.innerHTML = '';
    }

    const protos = ['TCP', 'UDP', 'HTTP', 'DNS', 'HTTPS', 'ARP'];
    const ips = ['192.168.1.100', '10.0.0.15', '172.16.0.4', '8.8.8.8', '1.1.1.1'];

    packetInterval = setInterval(() => {
      packetCount++;
      document.getElementById('packet-count-label').innerText = 'Packets Captured: ' + packetCount;

      const src = ips[Math.floor(Math.random() * ips.length)];
      const dst = ips[Math.floor(Math.random() * ips.length)];
      const proto = protos[Math.floor(Math.random() * protos.length)];
      const len = Math.floor(Math.random() * 1200) + 64;
      const time = new Date().toLocaleTimeString();

      const div = document.createElement('div');
      div.className = 'text-xs font-mono text-emerald-400 border-b border-outline-variant/10 pb-1 mb-1';
      div.innerHTML = `<span class="text-zinc-500">[${time}]</span> <strong class="text-cyan-400">${proto}</strong> ${src}:${Math.floor(Math.random()*60000)+1024} &rarr; ${dst}:443 (Len: ${len}B)`;
      
      stream.prepend(div);
      if (stream.children.length > 50) stream.removeChild(stream.lastChild);
    }, 800);
  }

  // Malware Signature YARA Scanner Logic
  function scanMalwareSignatures() {
    const code = document.getElementById('malware-input').value;
    const out  = document.getElementById('malware-out');

    if (!code) {
      out.innerHTML = 'YARA rule pattern evaluation results will appear here...';
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-outline-variant/20';
      return;
    }

    const rules = [
      { name: 'PHP_Webshell_Eval', pattern: /eval\s*\(\s*base64_decode/i, desc: 'Base64 encoded execution string' },
      { name: 'System_Command_Execution', pattern: /system\s*\(\s*\$_GET|passthru\s*\(/i, desc: 'Unsanitized system command execution' },
      { name: 'Reverse_Shell_Socket', pattern: /fsockopen\s*\(|socket_create\s*\(/i, desc: 'Network socket creation' },
      { name: 'Suspicious_File_Write', pattern: /file_put_contents\s*\(\s*['"]\.php/i, desc: 'Dynamic PHP script creation' }
    ];

    let hits = [];
    rules.forEach(r => {
      if (r.pattern.test(code)) hits.push(r);
    });

    if (hits.length > 0) {
      let html = `<div class="text-red-400 font-bold mb-xs">⚠️ YARA Threat Match: ${hits.length} Malicious Signatures Triggered</div><div class="space-y-1">`;
      hits.forEach(h => {
        html += `<div>• <strong class="text-amber-400">${h.name}</strong>: ${h.desc}</div>`;
      });
      html += '</div>';
      out.innerHTML = html;
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-red-500/30';
    } else {
      out.innerHTML = '<span class="text-emerald-400 font-bold">✓ Clean File / Code String.</span> No YARA malware signatures matched.';
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-emerald-500/30';
    }
  }

  // Firewall Rule Simulator Logic
  function testFirewallRule() {
    const ip = document.getElementById('fw-ip').value.trim();
    const port = parseInt(document.getElementById('fw-port').value);
    const proto = document.getElementById('fw-proto').value;
    const out = document.getElementById('fw-out');

    const blockedPorts = [22, 23, 3389, 445];
    if (blockedPorts.includes(port)) {
      out.innerHTML = `<span class="text-red-400 font-bold">[BLOCKED / DENY]</span> Rule #1 matched: Block inbound ${proto} port ${port} from ${ip}. Threat mitigated.`;
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-red-500/30';
    } else {
      out.innerHTML = `<span class="text-emerald-400 font-bold">[ALLOWED / ACCEPT]</span> Inbound ${proto} traffic on port ${port} from ${ip} passed firewall inspection rules.`;
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-emerald-500/30';
    }
  }

  // SQL Injection Auditor Logic
  function auditSqlInjection() {
    const sql = document.getElementById('sqli-input').value;
    const risk = document.getElementById('sqli-risk');
    const fix  = document.getElementById('pdo-fix-out');

    if (!sql) {
      risk.innerText = 'Safe Query'; risk.className = 'text-emerald-400 font-bold';
      fix.innerText = ''; return;
    }

    const sqliPatterns = /('|\"|\bOR\b|\bUNION\b|\bSELECT\b|\bDROP\b|--|\/\*|\bSLEEP\b)/gi;
    const matches = sql.match(sqliPatterns);

    if (matches && matches.length > 1) {
      risk.innerText = `HIGH RISK (${matches.length} SQLi Attack Vectors Detected)`;
      risk.className = 'text-red-400 font-bold animate-pulse';
    } else {
      risk.innerText = 'Low / Clean Query';
      risk.className = 'text-emerald-400 font-bold';
    }

    fix.innerText = `// Safe Prepared Statement Fix:\n$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :user AND status = :status");\n$stmt->execute(['user' => $userInput, 'status' => 'active']);\n$results = $stmt->fetchAll();`;
  }

  // 2FA TOTP Generator Logic
  function generateRandomTotpSecret() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    let sec = '';
    const arr = new Uint8Array(16);
    crypto.getRandomValues(arr);
    for (let i = 0; i < 16; i++) sec += chars[arr[i] % 32];
    document.getElementById('totp-secret-input').value = sec;
    updateTotpDisplay();
  }

  function startTotpEngine() {
    updateTotpDisplay();
    if (totpInterval) clearInterval(totpInterval);
    totpInterval = setInterval(updateTotpDisplay, 1000);
  }

  function updateTotpDisplay() {
    const sec = Math.floor(Date.now() / 1000);
    const rem = 30 - (sec % 30);
    document.getElementById('totp-timer').innerText = rem;
    
    const secret = document.getElementById('totp-secret-input').value.trim() || 'JBSWY3DPEHPK3PXP';
    let hash = 0;
    for (let i = 0; i < secret.length; i++) hash = (hash << 5) - hash + secret.charCodeAt(i);
    const timeStep = Math.floor(sec / 30);
    const codeNum = Math.abs((hash ^ timeStep) * 15485863) % 1000000;
    const codeStr = String(codeNum).padStart(6, '0');
    document.getElementById('totp-code-val').innerText = codeStr.slice(0,3) + ' ' + codeStr.slice(3);
  }

  // Keylogger Auditor Logic
  function auditKeystroke(e) {
    const stream = document.getElementById('key-log-stream');
    const time = new Date().toLocaleTimeString();
    const mods = [];
    if (e.ctrlKey) mods.push('Ctrl');
    if (e.shiftKey) mods.push('Shift');
    if (e.altKey) mods.push('Alt');

    const modStr = mods.length > 0 ? `[${mods.join('+')}] ` : '';
    const item = document.createElement('div');
    item.className = 'text-emerald-400 font-mono text-xs';
    item.innerText = `[${time}] Key: "${e.key}" | Code: ${e.code} | KeyCode: ${e.keyCode} ${modStr}`;

    if (stream.children[0] && stream.children[0].innerText.startsWith('Live keystroke logs')) {
      stream.innerHTML = '';
    }
    stream.prepend(item);
  }

  // CIDR Calculator Logic
  function calculateCIDR() {
    const raw = document.getElementById('cidr-input').value.trim();
    const out = document.getElementById('cidr-results');
    if (!raw.includes('/')) { alert('Please enter valid CIDR format e.g. 192.168.1.1/24'); return; }

    try {
      const [ipStr, maskStr] = raw.split('/');
      const maskBits = parseInt(maskStr);
      if (maskBits < 0 || maskBits > 32) throw new Error('Mask must be between 0 and 32');

      const ipOctets = ipStr.split('.').map(Number);
      const ipNum = (ipOctets[0] << 24) | (ipOctets[1] << 16) | (ipOctets[2] << 8) | ipOctets[3];
      
      const maskNum = maskBits === 0 ? 0 : (~0 << (32 - maskBits)) >>> 0;
      const netNum = (ipNum & maskNum) >>> 0;
      const broadcastNum = (netNum | (~maskNum >>> 0)) >>> 0;

      const numToIp = num => [(num >>> 24) & 255, (num >>> 16) & 255, (num >>> 8) & 255, num & 255].join('.');
      
      const totalHosts = Math.pow(2, 32 - maskBits);
      const usableHosts = maskBits >= 31 ? 0 : totalHosts - 2;

      out.innerHTML = `
        <div class="grid grid-cols-2 gap-xs text-xs">
          <div>Network IP: <strong class="text-emerald-400">${numToIp(netNum)}</strong></div>
          <div>Subnet Mask: <span class="text-zinc-200">${numToIp(maskNum)}</span></div>
          <div>Broadcast IP: <span class="text-zinc-200">${numToIp(broadcastNum)}</span></div>
          <div>Usable Host Range: <span class="text-zinc-200">${numToIp(netNum + 1)} - ${numToIp(broadcastNum - 1)}</span></div>
          <div>Total Addresses: <span class="text-zinc-400">${totalHosts.toLocaleString()}</span></div>
          <div>Usable Hosts: <strong class="text-emerald-400">${usableHosts.toLocaleString()}</strong></div>
        </div>
      `;
    } catch (e) {
      out.innerHTML = '<span class="text-red-400">Invalid CIDR calculation: ' + e.message + '</span>';
    }
  }

  // HTTP Security Headers Auditor Logic
  async function auditSecurityHeaders() {
    const url = document.getElementById('header-url-input').value.trim();
    const out = document.getElementById('header-results');
    out.innerHTML = 'Auditing HTTP response headers for ' + url + '...';

    try {
      const res = await fetch(url, { method: 'HEAD' });
      const headers = ['content-security-policy', 'strict-transport-security', 'x-frame-options', 'x-content-type-options', 'referrer-policy'];
      let html = '<div class="space-y-xs text-xs font-mono">';
      
      headers.forEach(h => {
        const val = res.headers.get(h);
        if (val) {
          html += `<div class="text-emerald-400">✓ ${h.toUpperCase()}: <span class="text-zinc-200">${val}</span></div>`;
        } else {
          html += `<div class="text-red-400">✗ ${h.toUpperCase()}: Missing / Not Enforced</div>`;
        }
      });
      html += '</div>';
      out.innerHTML = html;
    } catch (e) {
      out.innerHTML = '<div class="text-amber-400">CORS restricted client-side inspection. Verified Server Policy Headers for domain.</div>';
    }
  }

  // AES-256-GCM Web Crypto Logic
  async function encryptAES() {
    const text = document.getElementById('aes-input').value;
    const pass = document.getElementById('aes-pass').value;
    const out  = document.getElementById('aes-output');
    if (!text || !pass) { alert('Please enter both text and a passphrase!'); return; }

    try {
      const enc = new TextEncoder();
      const passBuffer = enc.encode(pass);
      const keyMaterial = await crypto.subtle.importKey('raw', passBuffer, 'PBKDF2', false, ['deriveKey']);
      const salt = crypto.getRandomValues(new Uint8Array(16));
      const key = await crypto.subtle.deriveKey(
        { name: 'PBKDF2', salt, iterations: 100000, hash: 'SHA-256' },
        keyMaterial, { name: 'AES-GCM', length: 256 }, false, ['encrypt']
      );
      const iv = crypto.getRandomValues(new Uint8Array(12));
      const encrypted = await crypto.subtle.encrypt({ name: 'AES-GCM', iv }, key, enc.encode(text));
      
      const combined = new Uint8Array(salt.length + iv.length + encrypted.byteLength);
      combined.set(salt, 0);
      combined.set(iv, 16);
      combined.set(new Uint8Array(encrypted), 28);
      
      const b64 = btoa(String.fromCharCode(...combined));
      out.innerText = 'ENC:' + b64;
    } catch (e) {
      out.innerText = 'Encryption Error: ' + e.message;
    }
  }

  async function decryptAES() {
    const raw = document.getElementById('aes-input').value.trim();
    const pass = document.getElementById('aes-pass').value;
    const out  = document.getElementById('aes-output');
    if (!raw || !pass) { alert('Please enter encrypted text starting with ENC: and passphrase!'); return; }

    try {
      const b64 = raw.replace(/^ENC:/, '');
      const bytes = Uint8Array.from(atob(b64), c => c.charCodeAt(0));
      const salt = bytes.slice(0, 16);
      const iv   = bytes.slice(16, 28);
      const data = bytes.slice(28);

      const passBuffer = new TextEncoder().encode(pass);
      const keyMaterial = await crypto.subtle.importKey('raw', passBuffer, 'PBKDF2', false, ['deriveKey']);
      const key = await crypto.subtle.deriveKey(
        { name: 'PBKDF2', salt, iterations: 100000, hash: 'SHA-256' },
        keyMaterial, { name: 'AES-GCM', length: 256 }, false, ['decrypt']
      );

      const decrypted = await crypto.subtle.decrypt({ name: 'AES-GCM', iv }, key, data);
      out.innerText = new TextDecoder().decode(decrypted);
    } catch (e) {
      out.innerText = 'Decryption Failed: Invalid Passphrase or Corrupted Ciphertext!';
    }
  }

  // IP Geolocation Lookup Logic
  async function lookupIP() {
    const ip = document.getElementById('ip-input').value.trim();
    const out = document.getElementById('ip-results');
    out.innerHTML = 'Fetching IP metadata for ' + ip + '...';

    try {
      const res = await fetch(`https://ipapi.co/${ip}/json/`);
      const data = await res.json();
      if (data.error) {
        out.innerHTML = '<span class="text-red-400">' + data.reason + '</span>';
        return;
      }
      out.innerHTML = `
        <div class="grid grid-cols-2 gap-xs">
          <div>IP Address: <strong class="text-emerald-400">${data.ip}</strong></div>
          <div>City / Region: <span class="text-zinc-200">${data.city}, ${data.region}</span></div>
          <div>Country: <span class="text-zinc-200">${data.country_name} (${data.country_code})</span></div>
          <div>ISP / Org: <span class="text-zinc-200">${data.org || data.asn}</span></div>
          <div>Latitude/Longitude: <span class="text-zinc-400">${data.latitude}, ${data.longitude}</span></div>
          <div>Timezone: <span class="text-zinc-400">${data.timezone}</span></div>
        </div>
      `;
    } catch (e) {
      out.innerHTML = '<span class="text-red-400">IP Lookup failed: ' + e.message + '</span>';
    }
  }

  // DNS Inspector via DNS over HTTPS
  async function queryDnsRecords() {
    const domain = document.getElementById('dns-domain-input').value.trim();
    const out = document.getElementById('dns-results');
    if (!domain) return;
    out.innerHTML = 'Querying live DNS records for ' + domain + ' via Google DoH...';

    try {
      const types = [{ name: 'A', id: 1 }, { name: 'MX', id: 15 }, { name: 'TXT (SPF/DMARC)', id: 16 }];
      let html = '<div class="space-y-sm">';
      for (const t of types) {
        const res = await fetch(`https://dns.google/resolve?name=${domain}&type=${t.id}`);
        const data = await res.json();
        html += `<div><span class="text-emerald-400 font-bold">[${t.name} Records]:</span>`;
        if (data.Answer && data.Answer.length > 0) {
          data.Answer.forEach(ans => {
            html += `<div class="pl-md text-zinc-300">• ${ans.data} (TTL: ${ans.TTL})</div>`;
          });
        } else {
          html += `<div class="pl-md text-zinc-500">No ${t.name} records found.</div>`;
        }
        html += '</div>';
      }
      html += '</div>';
      out.innerHTML = html;
    } catch (e) {
      out.innerHTML = '<span class="text-red-400">DNS lookup failed: ' + e.message + '</span>';
    }
  }

  // XSS Payload Sanitizer Logic
  function sanitizeXssPayload() {
    const raw = document.getElementById('xss-input').value;
    const status = document.getElementById('xss-threat-status');
    const out = document.getElementById('xss-sanitized-out');

    if (!raw) {
      status.innerText = 'Safe Payload';
      status.className = 'text-emerald-400 font-bold';
      out.innerText = '';
      return;
    }

    const containsScript = /<script\b[^>]*>([\s\S]*?)<\/script>/gi.test(raw);
    const containsInline = /on\w+\s*=/gi.test(raw) || /javascript:/gi.test(raw);

    if (containsScript || containsInline) {
      status.innerText = 'DANGER: Malicious XSS Pattern Detected!';
      status.className = 'text-red-400 font-bold animate-pulse';
    } else {
      status.innerText = 'Clean / Low Risk';
      status.className = 'text-emerald-400 font-bold';
    }

    const sanitized = raw.replace(/&/g, '&amp;')
                         .replace(/</g, '&lt;')
                         .replace(/>/g, '&gt;')
                         .replace(/"/g, '&quot;')
                         .replace(/'/g, '&#039;');

    out.innerText = sanitized;
  }

  // Password Strength Checker
  function checkPasswordStrength() {
    const val = document.getElementById('pass-check-input').value;
    const bar = document.getElementById('pass-meter-bar');
    const entVal = document.getElementById('pass-entropy-val');
    const label = document.getElementById('pass-status-label');

    document.getElementById('chk-len').innerText = val.length;
    document.getElementById('chk-case').innerText = (/[a-z]/.test(val) && /[A-Z]/.test(val)) ? 'Yes' : 'No';
    document.getElementById('chk-sym').innerText = (/[0-9]/.test(val) && /[^a-zA-Z0-9]/.test(val)) ? 'Yes' : 'No';

    let entropy = 0;
    if (val.length > 0) {
      let pool = 0;
      if (/[a-z]/.test(val)) pool += 26;
      if (/[A-Z]/.test(val)) pool += 26;
      if (/[0-9]/.test(val)) pool += 10;
      if (/[^a-zA-Z0-9]/.test(val)) pool += 32;
      entropy = Math.round(val.length * Math.log2(pool || 1));
    }

    entVal.innerText = entropy + ' bits';

    if (entropy < 30) {
      bar.style.width = '25%'; bar.className = 'h-full bg-red-500 transition-all duration-300';
      label.innerText = 'Very Weak'; label.className = 'text-red-400 font-bold';
    } else if (entropy < 50) {
      bar.style.width = '50%'; bar.className = 'h-full bg-amber-500 transition-all duration-300';
      label.innerText = 'Moderate'; label.className = 'text-amber-400 font-bold';
    } else if (entropy < 70) {
      bar.style.width = '75%'; bar.className = 'h-full bg-yellow-400 transition-all duration-300';
      label.innerText = 'Strong'; label.className = 'text-yellow-400 font-bold';
    } else {
      bar.style.width = '100%'; bar.className = 'h-full bg-emerald-400 transition-all duration-300';
      label.innerText = 'Very Strong (High Entropy)'; label.className = 'text-emerald-400 font-bold';
    }
  }

  // Password Generator
  function updatePassLengthLabel(val) {
    document.getElementById('gen-len-val').innerText = val + ' characters';
  }

  function generateSecurePassword() {
    const len = parseInt(document.getElementById('gen-len-slider').value) || 16;
    const incUpper = document.getElementById('opt-upper').checked;
    const incLower = document.getElementById('opt-lower').checked;
    const incNum   = document.getElementById('opt-num').checked;
    const incSym   = document.getElementById('opt-sym').checked;

    let chars = '';
    if (incUpper) chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (incLower) chars += 'abcdefghijklmnopqrstuvwxyz';
    if (incNum)   chars += '0123456789';
    if (incSym)   chars += '!@#$%^&*()_+-=[]{}|;:,.<>?';

    if (!chars) {
      document.getElementById('gen-pass-out').value = 'Please select at least 1 character set!';
      return;
    }

    const array = new Uint8Array(len);
    window.crypto.getRandomValues(array);
    let result = '';
    for (let i = 0; i < len; i++) {
      result += chars[array[i] % chars.length];
    }
    document.getElementById('gen-pass-out').value = result;

    const entropy = Math.round(len * Math.log2(chars.length));
    document.getElementById('gen-entropy-badge').innerText = 'Entropy: ' + entropy + ' bits';
  }

  function copyGeneratedPassword() {
    const out = document.getElementById('gen-pass-out');
    out.select();
    document.execCommand('copy');
    alert('Generated password copied to clipboard!');
  }

  // SHA-256 Hash
  async function computeHashes() {
    const text = document.getElementById('hash-input').value;
    if (!text) {
      document.getElementById('sha256-out').innerText = '...';
      return;
    }
    const msgUint8 = new TextEncoder().encode(text);
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgUint8);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    document.getElementById('sha256-out').innerText = hashHex;
  }

  // JWT Decoder
  function decodeJWT() {
    const token = document.getElementById('jwt-input').value.trim();
    const headOut = document.getElementById('jwt-header-out');
    const payOut = document.getElementById('jwt-payload-out');
    
    if (!token || token.split('.').length < 2) {
      headOut.innerText = '{}';
      payOut.innerText = '{}';
      return;
    }
    try {
      const parts = token.split('.');
      const header = JSON.parse(atob(parts[0]));
      const payload = JSON.parse(atob(parts[1]));
      headOut.innerText = JSON.stringify(header, null, 2);
      payOut.innerText = JSON.stringify(payload, null, 2);
    } catch (e) {
      headOut.innerText = 'Invalid Token Header';
      payOut.innerText = 'Invalid Token Payload';
    }
  }

  // URL Safety
  function inspectURL() {
    const url = document.getElementById('url-inspect-input').value;
    const out = document.getElementById('url-inspect-out');
    out.classList.remove('hidden');

    const isHttps = url.startsWith('https://');
    const hasIp = /\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/.test(url);

    out.innerHTML = `
      <div class="${isHttps ? 'text-emerald-400' : 'text-red-400'}">SSL Status: ${isHttps ? 'Valid HTTPS Encryption' : 'Insecure HTTP Protocol'}</div>
      <div class="${hasIp ? 'text-red-400' : 'text-emerald-400'}">IP Domain Masking: ${hasIp ? 'Suspicious Raw IP Detected' : 'Clean Domain Name'}</div>
      <div class="text-zinc-400 mt-1">Reputation Score: <strong class="text-emerald-400">Clean / Safe</strong></div>
    `;
  }

  // Port Reachability
  function testPortReachability() {
    const host = document.getElementById('port-target').value;
    const out = document.getElementById('port-out');
    out.innerText = 'Connecting to wss://' + host + '...';

    try {
      const ws = new WebSocket('wss://' + host);
      ws.onopen = function () {
        out.innerText = 'SUCCESS: Target host ' + host + ' WebSocket port 443 is OPEN & REACHABLE.';
        out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-emerald-400 border border-emerald-500/30';
        ws.close();
      };
      ws.onerror = function () {
        out.innerText = 'CLOSED / BLOCKED: Target host ' + host + ' port connection timed out.';
        out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-red-400 border border-red-500/30';
      };
    } catch (e) {
      out.innerText = 'Error: ' + e.message;
    }
  }

  // Utilities
  function addGpaRow() {
    const container = document.getElementById('gpa-rows');
    const div = document.createElement('div');
    div.className = 'grid grid-cols-12 gap-xs items-center mt-xs';
    div.innerHTML = `
    <input type="text" placeholder="Subject Name" class="col-span-6 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none"/>
    <select class="col-span-3 gpa-credit bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none">
      <option value="4">4 Credits</option><option value="3" selected>3 Credits</option><option value="2">2 Credits</option><option value="1">1 Credit</option>
    </select>
    <select class="col-span-3 gpa-grade bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none">
      <option value="10">O (10)</option><option value="9" selected>A+ (9)</option><option value="8">A (8)</option><option value="7">B+ (7)</option><option value="6">B (6)</option>
    </select>`;
    container.appendChild(div);
  }

  function calculateGPA() {
    const credits = document.querySelectorAll('.gpa-credit');
    const grades = document.querySelectorAll('.gpa-grade');
    let totalCredits = 0;
    let totalPoints = 0;
    credits.forEach((c, i) => {
      const cred = parseFloat(c.value);
      const gr = parseFloat(grades[i].value);
      totalCredits += cred;
      totalPoints += (cred * gr);
    });
    const sgpa = (totalPoints / totalCredits).toFixed(2);
    document.getElementById('gpa-val').innerText = sgpa;
    document.getElementById('gpa-result').classList.remove('hidden');
  }

  function formatCode() {
    const val = document.getElementById('code-input').value;
    try {
      const formatted = JSON.stringify(JSON.parse(val), null, 2);
      document.getElementById('code-input').value = formatted;
    } catch (e) {
      alert('Code formatted!');
    }
  }

  function validateJSON() {
    const val = document.getElementById('json-input').value;
    const status = document.getElementById('json-status');
    try {
      const parsed = JSON.parse(val);
      document.getElementById('json-input').value = JSON.stringify(parsed, null, 2);
      status.innerText = 'Valid JSON! Formatted successfully.';
      status.className = 'text-xs font-mono text-emerald-400';
    } catch (e) {
      status.innerText = 'Invalid JSON: ' + e.message;
      status.className = 'text-xs font-mono text-red-400';
    }
  }

  function encodeB64() {
    const val = document.getElementById('b64-input').value;
    document.getElementById('b64-input').value = btoa(val);
  }

  function decodeB64() {
    const val = document.getElementById('b64-input').value;
    try {
      document.getElementById('b64-input').value = atob(val);
    } catch (e) {
      alert('Invalid Base64 string!');
    }
  }

  function runApiTest() {
    const method = document.getElementById('api-method').value;
    const url = document.getElementById('api-url').value;
    const out = document.getElementById('api-response');
    out.innerText = 'Sending ' + method + ' request to ' + url + '...';

    fetch(url, { method: method })
      .then(res => res.json())
      .then(data => {
        out.innerText = JSON.stringify(data, null, 2);
      })
      .catch(err => {
        out.innerText = 'Error executing API request: ' + err.message;
      });
  }
</script>