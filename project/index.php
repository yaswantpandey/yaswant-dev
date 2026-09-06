<?php require_once __DIR__ . '/../includes/layout.php';
require_once __DIR__ . '/../includes/data.php';

$projects = [
  // 1. Password Strength Checker
  [
    'id' => 'cs-1',
    'cat' => 'Web Sec',
    'difficulty' => 'Beginner',
    'title' => 'Password Strength Checker & Entropy Calculator',
    'desc' => 'Calculates password entropy, checks against 100k breached passwords dictionary, and provides real-time complexity feedback.',
    'tags' => ['JavaScript', 'Entropy', 'zxcvbn', 'Client-side'],
    'stars' => 128,
    'forks' => 24,
    'icon' => 'lock_reset',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Modern Browser with JS enabled',
    'details' => 'Evaluates password strength using Shannon entropy mathematics, checks character distribution diversity, and flags common dictionary patterns.'
  ],

  // 2. Password Generator
  [
    'id' => 'cs-2',
    'cat' => 'Cryptography',
    'difficulty' => 'Beginner',
    'title' => 'Cryptographically Secure Password Generator',
    'desc' => 'Generates high-entropy passwords and passphrases using crypto.getRandomValues API with customizable character sets.',
    'tags' => ['JavaScript', 'CSPRNG', 'Security', 'Web Crypto API'],
    'stars' => 95,
    'forks' => 18,
    'icon' => 'key',
    'color' => 'secondary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Browser with Web Crypto API',
    'details' => 'Uses hardware-level pseudo-random number generators to avoid predictable pseudo-random seeds in generated secrets.'
  ],

  // 3. File Encryption App
  [
    'id' => 'cs-3',
    'cat' => 'Cryptography',
    'difficulty' => 'Intermediate',
    'title' => 'AES-256-GCM Zero-Knowledge File Encryptor',
    'desc' => 'Client-side AES-256 Galois/Counter Mode file encryption tool with PBKDF2 key derivation.',
    'tags' => ['Python', 'Web Crypto', 'AES-256', 'PBKDF2'],
    'stars' => 210,
    'forks' => 45,
    'icon' => 'lock',
    'color' => 'tertiary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Python 3.9+ or Modern Browser',
    'details' => 'Encrypts files before upload using authenticated AES-GCM encryption with 128-bit authentication tags and unique initialization vectors.'
  ],

  // 4. Text Encryption
  [
    'id' => 'cs-4',
    'cat' => 'Cryptography',
    'difficulty' => 'Beginner',
    'title' => 'Multi-Cipher Text Encryptor & Decryptor Utility',
    'desc' => 'Supports AES, RSA, Caesar, Vigenère, and Base64 cipher conversions with instant cryptographic output.',
    'tags' => ['JavaScript', 'AES', 'RSA', 'Ciphers'],
    'stars' => 112,
    'forks' => 22,
    'icon' => 'enhanced_encryption',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Browser Environment',
    'details' => 'Provides visual step-by-step cryptographic transformations between plain text, cipher text, hex strings, and Base64 representations.'
  ],

  // 5. Login Auth System
  [
    'id' => 'cs-5',
    'cat' => 'Web Sec',
    'difficulty' => 'Intermediate',
    'title' => 'Secure Authentication & Session Management System',
    'desc' => 'PHP PDO login architecture with Argon2id password hashing, CSRF protection, and HttpOnly cookie session hardening.',
    'tags' => ['PHP', 'Argon2id', 'PDO', 'CSRF Tokens'],
    'stars' => 315,
    'forks' => 82,
    'icon' => 'badge',
    'color' => 'secondary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'PHP 8.1+, MySQL Database',
    'details' => 'Implements state-of-the-art authentication defenses: password hashing with Argon2id, IP rate limiting, session regeneration, and anti-CSRF token verification.'
  ],

  // 6. 2FA
  [
    'id' => 'cs-6',
    'cat' => 'Web Sec',
    'difficulty' => 'Intermediate',
    'title' => 'TOTP Two-Factor Authentication (2FA) Engine',
    'desc' => 'RFC 6238 compliant TOTP generator and validator compatible with Google Authenticator and Authy.',
    'tags' => ['PHP', 'TOTP', 'RFC 6238', 'QR Code'],
    'stars' => 240,
    'forks' => 54,
    'icon' => 'phonelink_lock',
    'color' => 'tertiary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'PHP 8.0+ / Authenticator App',
    'details' => 'Generates 32-character Base32 secret keys, renders scanable QR codes, and calculates 30-second time-based 6-digit verification passcodes.'
  ],

  // 7. Secure Password Manager
  [
    'id' => 'cs-7',
    'cat' => 'Cryptography',
    'difficulty' => 'Advanced',
    'title' => 'Zero-Knowledge Encrypted Password Manager',
    'desc' => 'Local-first password vault storing credentials encrypted with Master Key derived via Argon2id + AES-GCM.',
    'tags' => ['JS', 'IndexedDB', 'AES-GCM', 'Zero-Knowledge'],
    'stars' => 410,
    'forks' => 95,
    'icon' => 'password',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Browser with IndexedDB',
    'details' => 'Master password is never transmitted or stored. All vault data is encrypted in-memory and persisted inside encrypted IndexedDB storage.'
  ],

  // 8. Network Port Scanner
  [
    'id' => 'cs-8',
    'cat' => 'Network Sec',
    'difficulty' => 'Intermediate',
    'title' => 'Asynchronous Network Port Scanner & Service Grabber',
    'desc' => 'Multi-threaded Python socket scanner for detecting open TCP ports, service banners, and host uptime.',
    'tags' => ['Python', 'Sockets', 'Asyncio', 'Network'],
    'stars' => 285,
    'forks' => 64,
    'icon' => 'radar',
    'color' => 'secondary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Python 3.8+',
    'details' => 'Scans custom port ranges using asynchronous socket connect calls, grabs service banners (HTTP, SSH, FTP), and outputs structured JSON logs.'
  ],

  // 9. IP Address Lookup
  [
    'id' => 'cs-9',
    'cat' => 'Network Sec',
    'difficulty' => 'Beginner',
    'title' => 'IP Intelligence & Threat Geolocation Analyzer',
    'desc' => 'Looks up IP WHOIS records, ISP ASN details, proxy/VPN flags, and geographical threat scores.',
    'tags' => ['JavaScript', 'WHOIS API', 'GeoIP', 'ASN Lookup'],
    'stars' => 175,
    'forks' => 32,
    'icon' => 'public',
    'color' => 'tertiary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'API Access',
    'details' => 'Fetches real-time IP metadata, detects malicious Tor exit nodes/VPN proxies, and maps client location on interactive maps.'
  ],

  // 10. URL Safety Checker
  [
    'id' => 'cs-10',
    'cat' => 'Web Sec',
    'difficulty' => 'Intermediate',
    'title' => 'URL Safety & Malware Reputation Checker',
    'desc' => 'Scans URLs against Google Safe Browsing API, VirusTotal APIs, and domain SSL certificate status.',
    'tags' => ['Python', 'VirusTotal API', 'SSL Inspector', 'REST'],
    'stars' => 230,
    'forks' => 48,
    'icon' => 'security',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'VirusTotal API Key',
    'details' => 'Performs HTTP redirect chain analysis, checks domain WHOIS registration age, and verifies SSL certificate validity to prevent dangerous link clicks.'
  ],

  // 11. Phishing Website Detector
  [
    'id' => 'cs-11',
    'cat' => 'AI / Cyber',
    'difficulty' => 'Advanced',
    'title' => 'AI-Powered Phishing Website Classifier',
    'desc' => 'Machine learning classifier evaluating 18 lexical and DOM features to detect spoofed domain names.',
    'tags' => ['Python', 'Scikit-Learn', 'FastAPI', 'ML Sec'],
    'stars' => 380,
    'forks' => 88,
    'icon' => 'phishing',
    'color' => 'secondary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://blog.yaswant.co.in',
    'prereq' => 'Python 3.9+, Scikit-learn',
    'details' => 'Extracts URL structural metrics (typosquatting distance, homograph characters, iframe presence) and achieves 98.4% precision using Random Forest.'
  ],

  // 12. Basic Firewall Simulator
  [
    'id' => 'cs-12',
    'cat' => 'Network Sec',
    'difficulty' => 'Intermediate',
    'title' => 'Interactive Network Firewall Rule Simulator',
    'desc' => 'Simulates packet filtering rules (ALLOW/DENY) based on IP ranges, ports, protocols, and stateful connections.',
    'tags' => ['JavaScript', 'Packet Filtering', 'IPTables', 'Stateful'],
    'stars' => 190,
    'forks' => 39,
    'icon' => 'local_fire_department',
    'color' => 'tertiary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Browser Environment',
    'details' => 'Models Linux IPTables / UFW firewall chains, allowing users to define custom rule priorities and test sample packet matches in real time.'
  ],

  // 13. File Integrity SHA256
  [
    'id' => 'cs-13',
    'cat' => 'Blue Team',
    'difficulty' => 'Beginner',
    'title' => 'File Integrity Monitor (SHA-256 Hash Engine)',
    'desc' => 'Monitors critical system files for unauthorized modifications by maintaining real-time SHA-256 cryptographic baselines.',
    'tags' => ['Python', 'SHA-256', 'File Watcher', 'Integrity'],
    'stars' => 165,
    'forks' => 29,
    'icon' => 'fingerprint',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Python 3.8+',
    'details' => 'Recursively computes SHA-256 checksums of target directory trees, alerting administrators if any file is tampered with or modified.'
  ],

  // 14. Keylogger Detection
  [
    'id' => 'cs-14',
    'cat' => 'Blue Team',
    'difficulty' => 'Advanced',
    'title' => 'API Hooking & Keylogger Detection Shield',
    'desc' => 'Monitors OS keyboard event hooks (SetWindowsHookEx) and unaligned DLL injections to detect malicious keylogging software.',
    'tags' => ['C++', 'WinAPI', 'Hook Detection', 'Forensics'],
    'stars' => 320,
    'forks' => 71,
    'icon' => 'visibility',
    'color' => 'secondary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Windows OS / C++ Compiler',
    'details' => 'Enumerates active global message hooks, checks API entry points in user32.dll for Inline JMP patches, and alerts on unauthorized key capture.'
  ],

  // 15. Malware Scanner
  [
    'id' => 'cs-15',
    'cat' => 'Blue Team',
    'difficulty' => 'Intermediate',
    'title' => 'YARA-Based Malware Signature Scanner',
    'desc' => 'Scans system files and process memory against YARA malware rules to detect known ransomware and trojan signatures.',
    'tags' => ['Python', 'YARA Rules', 'Malware Sec', 'ClamAV'],
    'stars' => 295,
    'forks' => 62,
    'icon' => 'bug_report',
    'color' => 'tertiary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Python yara-python binding',
    'details' => 'Executes compiled YARA rule sets against suspicious binaries, parsing PE header anomalies, byte patterns, and embedded obfuscated strings.'
  ],

  // 16. Brute-Force
  [
    'id' => 'cs-16',
    'cat' => 'Web Sec',
    'difficulty' => 'Intermediate',
    'title' => 'Brute-Force Attack Simulator & Rate Limiting Engine',
    'desc' => 'Educational lab demonstrating login brute-force attacks and defensive mitigation using Token Bucket rate limiters.',
    'tags' => ['PHP', 'Redis', 'Rate Limiting', 'Defense'],
    'stars' => 205,
    'forks' => 41,
    'icon' => 'speed',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'PHP 8.0+, Redis server',
    'details' => 'Demonstrates how rate limiting via Redis sliding window algorithm prevents password spraying and automated credential stuffing.'
  ],

  // 17. SQL Injection
  [
    'id' => 'cs-17',
    'cat' => 'Red Team',
    'difficulty' => 'Intermediate',
    'title' => 'SQL Injection (SQLi) Vulnerability Scanner',
    'desc' => 'Automated security auditor testing web forms and GET parameters for Error-Based, Boolean-Based, and Time-Based SQLi.',
    'tags' => ['Python', 'SQLi', 'Security Audit', 'OWASP'],
    'stars' => 350,
    'forks' => 84,
    'icon' => 'terminal',
    'color' => 'secondary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Python 3.9+',
    'details' => 'Injects dynamic SQL payloads into web forms, evaluates database error signatures, and provides remediation recommendations for PDO prepared statements.'
  ],

  // 18. XSS Detection
  [
    'id' => 'cs-18',
    'cat' => 'Web Sec',
    'difficulty' => 'Intermediate',
    'title' => 'Cross-Site Scripting (XSS) Scanner & Sanitizer',
    'desc' => 'Detects Reflected, Stored, and DOM-based XSS vulnerabilities and auto-generates Context-Aware HTML sanitizers.',
    'tags' => ['JavaScript', 'DOMPurify', 'XSS Filter', 'Security'],
    'stars' => 225,
    'forks' => 46,
    'icon' => 'code',
    'color' => 'tertiary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Node.js or Browser',
    'details' => 'Tests HTML inputs with polyglot XSS payloads, verifies CSP header enforcement, and applies DOMPurify sanitization rules.'
  ],

  // 19. Network Packet Sniffer
  [
    'id' => 'cs-19',
    'cat' => 'Network Sec',
    'difficulty' => 'Advanced',
    'title' => 'Live Network Packet Sniffer & Stream Analyzer',
    'desc' => 'Real-time packet inspection tool capturing raw Ethernet frames, decoding IP/TCP headers, and analyzing stream bandwidth.',
    'tags' => ['Python', 'Scapy', 'Raw Sockets', 'Packet Capture'],
    'stars' => 430,
    'forks' => 102,
    'icon' => 'settings_ethernet',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Root / Administrator Access',
    'details' => 'Binds to network interface in promiscuous mode, decodes hex packet dumps, and displays real-time protocol breakdown statistics.'
  ],

  // 20. Wi-Fi Net Scanner
  [
    'id' => 'cs-20',
    'cat' => 'Network Sec',
    'difficulty' => 'Intermediate',
    'title' => 'Wi-Fi Access Point & Signal Strength Scanner',
    'desc' => 'Discovers nearby 802.11 Wi-Fi networks, inspects WPA2/WPA3 encryption protocols, and measures RSSI signal levels.',
    'tags' => ['Python', '802.11', 'Wireless Sec', 'Network'],
    'stars' => 275,
    'forks' => 58,
    'icon' => 'wifi',
    'color' => 'secondary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Wi-Fi Adapter in Monitor Mode',
    'details' => 'Scans wireless frequency channels, extracts BSSID, SSID, Beacon intervals, and flags unencrypted Open/WEP access points.'
  ],

  // 21. DNS Lookup
  [
    'id' => 'cs-21',
    'cat' => 'Network Sec',
    'difficulty' => 'Beginner',
    'title' => 'DNS Record & Security Configuration Inspector',
    'desc' => 'Queries A, AAAA, MX, NS, TXT, SPF, DKIM, and DMARC security records for any target domain name.',
    'tags' => ['PHP', 'DNS', 'DMARC', 'SPF Record'],
    'stars' => 155,
    'forks' => 31,
    'icon' => 'dns',
    'color' => 'tertiary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Standard PHP Environment',
    'details' => 'Performs recursive DNS lookups, audits email security policies (SPF/DMARC), and detects DNS spoofing or misconfigurations.'
  ],

  // 22. Web Sec Scanner
  [
    'id' => 'cs-22',
    'cat' => 'Web Sec',
    'difficulty' => 'Advanced',
    'title' => 'Comprehensive Web Security & Header Auditor',
    'desc' => 'Automated vulnerability scanner evaluating HSTS, CSP, X-Frame-Options, CORS policy, and SSL TLS cipher suites.',
    'tags' => ['Python', 'HTTP Headers', 'Security Audit', 'SSL'],
    'stars' => 310,
    'forks' => 69,
    'icon' => 'shield',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Python 3.9+',
    'details' => 'Inspects HTTP response headers, tests for permissive CORS wildcard access (`Access-Control-Allow-Origin: *`), and grades domain security posture.'
  ],

  // 23. Secure File Sharing App
  [
    'id' => 'cs-23',
    'cat' => 'Cryptography',
    'difficulty' => 'Advanced',
    'title' => 'Self-Destructing Encrypted File Sharing App',
    'desc' => 'End-to-end encrypted temporary file transfer platform with expiration timers and max-download enforcement.',
    'tags' => ['PHP', 'Web Crypto API', 'AES-256', 'Ephemeral'],
    'stars' => 365,
    'forks' => 78,
    'icon' => 'share',
    'color' => 'secondary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'PHP 8.0+, Storage Directory',
    'details' => 'Encryption keys remain client-side in URL hashes. Files are stored encrypted on server disk and permanently purged after single download or expiry.'
  ],

  // 24. Sys Log Analyzer
  [
    'id' => 'cs-24',
    'cat' => 'Blue Team',
    'difficulty' => 'Intermediate',
    'title' => 'System & Auth Log Threat Parser (SIEM Light)',
    'desc' => 'Parses Linux auth.log and Web server access logs, detecting SSH brute-force attempts and anomalous IP activity.',
    'tags' => ['Python', 'SIEM', 'Syslog', 'Threat Intel'],
    'stars' => 245,
    'forks' => 52,
    'icon' => 'monitoring',
    'color' => 'tertiary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Python 3.8+',
    'details' => 'Extracts IP addresses from failed login events, aggregates failed attempts within dynamic time windows, and generates automated IP blocklists.'
  ],

  // 25. Cyber Sec Lab
  [
    'id' => 'cs-25',
    'cat' => 'Red Team',
    'difficulty' => 'Advanced',
    'title' => 'Virtual Cyber Security Pentesting Lab Suite',
    'desc' => 'Containerized Docker environment containing pre-configured vulnerability targets and pentesting challenge scenarios.',
    'tags' => ['Docker', 'Linux', 'Pentest Lab', 'CTF'],
    'stars' => 520,
    'forks' => 140,
    'icon' => 'computer',
    'color' => 'primary',
    'github' => 'https://github.com/Yaswantpandey',
    'demo' => 'https://tools.yaswant.co.in',
    'prereq' => 'Docker & Docker Compose',
    'details' => 'Includes 10+ vulnerable web applications, network targets, and privilege escalation labs designed for practical security training.'
  ]
];

$schema = schema_project($projects);

nexus_head(
  'Cyber Security & Software Projects by Yaswant Pandey — 25+ Hands-On Labs',
  'Explore 25+ hands-on Cyber Security tools, password entropy checkers, pentesting scanners, cryptography engines, firewall simulators, and SOC analysis labs by Yaswant Pandey.',
  'Yaswant Pandey projects, cyber security projects by Yaswant Pandey, password strength checker, url safety checker, phishing detector, firewall simulator, sha256 integrity, keylogger detection, malware scanner, sqli scanner',
  URL_PROJECT,
  ['type' => 'website', 'title' => 'Cyber Security & Engineering Projects by Yaswant Pandey'],
  $schema
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('project');
  nexus_topbar('project'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg">
    <div class="flex flex-col w-full gap-xl">

      <!-- ── Breadcrumbs ─────────────────────────────────────────── -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
        <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
        <span class="text-zinc-600">/</span>
        <span class="text-zinc-300">Cyber Security Projects</span>
      </nav>

      <!-- Header & Cyber Banner -->
      <div
        class="bg-gradient-to-r from-surface-container-high via-surface-container to-surface-container-high rounded-2xl p-lg md:p-xl border border-outline-variant/20 shadow-xl relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none">
        </div>
        <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-md">
          <div class="space-y-xs max-w-3xl">
            <div
              class="inline-flex items-center gap-xs bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full text-xs font-mono border border-emerald-500/20 uppercase tracking-widest">
              <span class="material-symbols-outlined text-[16px]">shield_lock</span> 25 Cyber Security Tools & Labs
            </div>
            <h1 class="font-display-lg text-headline-md md:text-display-lg-mobile text-on-surface">Cyber Security &
              Engineering Projects</h1>
            <p class="font-body-md text-xs md:text-sm text-on-surface-variant leading-relaxed">
              Explore hands-on Cyber Security projects: Password Tools, Firewalls, Vulnerability Scanners, Cryptography,
              Network Sniffers, and SOC Log Analyzers.
            </p>
          </div>
          <div class="flex items-center gap-sm shrink-0">
            <div
              class="bg-surface-container-lowest px-md py-sm rounded-xl border border-outline-variant/20 text-center">
              <span class="block text-2xl font-bold font-mono text-emerald-400"
                id="total-count"><?= count($projects) ?></span>
              <span class="text-[10px] font-mono text-on-surface-variant uppercase">Projects Live</span>
            </div>
            <a href="https://github.com/Yaswantpandey" target="_blank" rel="noopener"
              class="bg-emerald-500 hover:bg-emerald-400 text-black px-md py-sm rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-xs shadow-md">
              <span class="material-symbols-outlined text-[18px]">code</span> GitHub Org
            </a>
          </div>
        </div>
      </div>

      <!-- Controls: Real-time Search & Filter Tabs -->
      <div
        class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-md bg-surface-container rounded-xl p-md border border-outline-variant/20 shadow-md">
        <!-- Filter Category Tabs -->
        <div class="flex items-center gap-xs overflow-x-auto pb-xs md:pb-0" id="category-tabs">
          <?php foreach (['All', 'Web Sec', 'Cryptography', 'Network Sec', 'Blue Team', 'Red Team', 'AI / Cyber'] as $cat): ?>
            <button onclick="filterProjects('<?= $cat ?>')" data-cat="<?= $cat ?>"
              class="tab-btn px-md py-1.5 rounded-lg text-xs font-mono transition-all whitespace-nowrap <?= $cat === 'All' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 font-bold' : 'bg-surface-container-highest text-on-surface-variant hover:text-on-surface' ?>">
              <?= $cat ?>
            </button>
          <?php endforeach; ?>
        </div>

        <!-- Search Bar -->
        <div class="relative w-full md:w-72">
          <span
            class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
          <input id="proj-search" oninput="searchProjects()" placeholder="Search 25 cyber security tools…"
            class="w-full bg-surface-container-lowest text-on-surface font-mono text-xs py-2 pl-9 pr-md rounded-lg border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-emerald-400/50 placeholder:text-outline" />
        </div>
      </div>

      <!-- COMPACT HIGH-DENSITY CARD GRID -->
      <div id="project-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-md">
        <?php foreach ($projects as $p): ?>
          <article data-cat="<?= htmlspecialchars($p['cat']) ?>"
            data-search="<?= strtolower(htmlspecialchars($p['title'] . ' ' . $p['desc'] . ' ' . implode(' ', $p['tags']))) ?>"
            class="proj-card bg-surface-container hover:bg-surface-container-high rounded-xl p-md flex flex-col justify-between border border-outline-variant/20 hover:border-emerald-400/40 transition-all shadow-sm hover:shadow-lg group">

            <div class="space-y-xs">
              <!-- Top Badges -->
              <div class="flex items-center justify-between gap-xs">
                <span
                  class="inline-flex items-center gap-1 text-[10px] font-mono uppercase tracking-wider text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">
                  <span class="material-symbols-outlined text-[13px]"><?= $p['icon'] ?></span>
                  <?= htmlspecialchars($p['cat']) ?>
                </span>
                <span class="text-[10px] font-mono text-zinc-400 bg-surface-container-highest px-1.5 py-0.5 rounded">
                  <?= htmlspecialchars($p['difficulty']) ?>
                </span>
              </div>

              <!-- Title -->
              <h2
                class="font-headline-md text-sm font-bold text-on-surface group-hover:text-emerald-400 transition-colors line-clamp-2 leading-snug">
                <?= htmlspecialchars($p['title']) ?>
              </h2>

              <!-- Description -->
              <p class="font-body-md text-xs text-on-surface-variant line-clamp-2 leading-relaxed">
                <?= htmlspecialchars($p['desc']) ?>
              </p>

              <!-- Tags -->
              <div class="flex flex-wrap gap-xs pt-xs">
                <?php foreach (array_slice($p['tags'], 0, 3) as $t): ?>
                  <span
                    class="bg-surface-container-lowest text-on-surface-variant px-1.5 py-0.5 rounded text-[10px] font-mono border border-outline-variant/10"><?= htmlspecialchars($t) ?></span>
                <?php endforeach; ?>
                <?php if (count($p['tags']) > 3): ?>
                  <span class="text-[10px] font-mono text-outline">+<?= count($p['tags']) - 3 ?></span>
                <?php endif; ?>
              </div>
            </div>

            <!-- Card Footer -->
            <div
              class="flex items-center justify-between mt-md pt-xs border-t border-outline-variant/10 text-xs font-mono">
              <div class="flex items-center gap-xs text-zinc-400 text-[11px]">
                <span class="flex items-center gap-0.5"><span
                    class="material-symbols-outlined text-[13px] text-amber-400">star</span> <?= $p['stars'] ?></span>
                <span class="flex items-center gap-0.5 ml-1"><span
                    class="material-symbols-outlined text-[13px] text-zinc-500">call_split</span>
                  <?= $p['forks'] ?></span>
              </div>
              <button onclick='openProjModal(<?= json_encode($p, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'
                class="bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 px-2.5 py-1 rounded-lg text-[11px] font-mono font-bold transition-colors flex items-center gap-0.5">
                Details <span class="material-symbols-outlined text-[13px]">arrow_forward</span>
              </button>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <!-- Empty State -->
      <div id="no-results" class="hidden text-center py-2xl text-on-surface-variant font-mono">
        <span class="material-symbols-outlined text-[64px] text-outline mb-md block">search_off</span>
        No cyber security projects matched your filter.
      </div>

      <!-- ── On-Page SEO Guide & FAQ Section ──────────────────────── -->
      <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-10 shadow-2xl space-y-8 mt-4">
        
        <div>
          <span class="text-xs font-mono text-emerald-400 uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Open-Source Cyber Labs</span>
          <h2 class="text-xl md:text-3xl font-black text-white mt-3">
            Hands-On <span class="gradient-text">Cyber Security & Software Engineering Projects</span>
          </h2>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-2 leading-relaxed max-w-3xl">
            Curated repositories and live security lab demonstrations engineered by <strong>Yaswant Pandey</strong>. Designed to help software engineers, penetration testers, and SOC analysts build enterprise-grade security knowledge.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-emerald-400 text-2xl mb-2">lock</span>
            <h3 class="text-sm font-bold text-white mb-1">Applied Cryptography</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Real-world implementations of zero-knowledge AES-256-GCM file vaults, PBKDF2 key derivation, and multi-cipher conversions.
            </p>
          </div>
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-cyan-400 text-2xl mb-2">security</span>
            <h3 class="text-sm font-bold text-white mb-1">AppSec & Vulnerability Scanners</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Automated SQL injection payload testing, XSS sanitization, HTTP security headers auditors, and phishing URL analyzers.
            </p>
          </div>
          <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800">
            <span class="material-symbols-outlined text-indigo-400 text-2xl mb-2">hub</span>
            <h3 class="text-sm font-bold text-white mb-1">Network & Blue Team Defense</h3>
            <p class="text-xs text-zinc-400 font-light leading-relaxed">
              Stateful packet filtering firewalls, PCAP stream sniffers, SIEM auth.log threat parsers, and brute-force rate limiters.
            </p>
          </div>
        </div>

        <!-- FAQ Accordions -->
        <div class="space-y-4 pt-6 border-t border-zinc-800">
          <h3 class="text-base font-bold text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-400">help</span> Frequently Asked Questions
          </h3>
          
          <div class="space-y-3">
            <details class="bg-zinc-900/80 rounded-xl p-4 border border-zinc-800/80 cursor-pointer group">
              <summary class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                Can I use these projects in my engineering portfolio or resume?
                <span class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                Yes! All source code and lab architectures are open-source and free to study, fork, and showcase on your GitHub and ATS resume.
              </p>
            </details>

            <details class="bg-zinc-900/80 rounded-xl p-4 border border-zinc-800/80 cursor-pointer group">
              <summary class="text-xs md:text-sm font-bold text-white group-hover:text-emerald-400 transition-colors flex items-center justify-between">
                How do I run these labs locally?
                <span class="material-symbols-outlined text-zinc-500 text-sm group-open:rotate-180 transition-transform">expand_more</span>
              </summary>
              <p class="text-xs text-zinc-400 font-light mt-3 leading-relaxed">
                Click "Details" on any project card to view the prerequisites (e.g. Python 3.9+, Docker, Node.js) and click "View Source Repo" to clone from GitHub.
              </p>
            </details>
          </div>
        </div>

      </section>

    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<!-- Project Details Modal -->
<div id="projModal"
  class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-md">
  <div
    class="bg-surface-container-high border border-outline-variant/30 rounded-2xl max-w-xl w-full p-lg shadow-2xl space-y-md relative">
    <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
      <div class="flex items-center gap-xs">
        <span id="m-icon" class="material-symbols-outlined text-emerald-400 text-[24px]">shield</span>
        <h3 id="m-title" class="font-headline-md text-base font-bold text-on-surface">Project Title</h3>
      </div>
      <button onclick="closeProjModal()" class="text-outline hover:text-on-surface"><span
          class="material-symbols-outlined">close</span></button>
    </div>

    <div class="space-y-sm text-xs font-body-md text-on-surface-variant">
      <div>
        <span class="font-mono text-[10px] text-emerald-400 uppercase tracking-widest block mb-1">Architecture &
          Implementation</span>
        <p id="m-details"
          class="leading-relaxed bg-surface-container-lowest p-md rounded-xl border border-outline-variant/20 text-on-surface">
        </p>
      </div>

      <div>
        <span class="font-mono text-[10px] text-zinc-400 uppercase tracking-widest block mb-1">Prerequisites & System
          Stack</span>
        <p id="m-prereq" class="font-mono text-[11px] text-zinc-300"></p>
      </div>

      <div>
        <span class="font-mono text-[10px] text-zinc-400 uppercase tracking-widest block mb-1">Tech Stack Tags</span>
        <div id="m-tags" class="flex flex-wrap gap-xs"></div>
      </div>
    </div>

    <div class="flex items-center justify-between pt-sm border-t border-outline-variant/20">
      <a id="m-github" href="#" target="_blank" rel="noopener"
        class="text-xs font-mono text-zinc-400 hover:text-white flex items-center gap-xs">
        <span class="material-symbols-outlined text-[16px]">code</span> View Source Repo
      </a>
      <a id="m-demo" href="#" target="_blank" rel="noopener"
        class="bg-emerald-500 hover:bg-emerald-400 text-black px-md py-1.5 rounded-lg text-xs font-mono font-bold flex items-center gap-xs transition-colors">
        Launch Live Lab <span class="material-symbols-outlined text-[14px]">open_in_new</span>
      </a>
    </div>
  </div>
</div>

<script>
  let currentCat = 'All';

  function filterProjects(cat) {
    currentCat = cat;
    document.querySelectorAll('.tab-btn').forEach(btn => {
      if (btn.dataset.cat === cat) {
        btn.className = 'tab-btn px-md py-1.5 rounded-lg text-xs font-mono transition-all whitespace-nowrap bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 font-bold';
      } else {
        btn.className = 'tab-btn px-md py-1.5 rounded-lg text-xs font-mono transition-all whitespace-nowrap bg-surface-container-highest text-on-surface-variant hover:text-on-surface';
      }
    });
    searchProjects();
  }

  function searchProjects() {
    const query = document.getElementById('proj-search').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.proj-card');
    let visibleCount = 0;

    cards.forEach(card => {
      const cardCat = card.dataset.cat;
      const cardSearch = card.dataset.search;

      const matchesCat = (currentCat === 'All' || cardCat === currentCat);
      const matchesSearch = (!query || cardSearch.includes(query));

      if (matchesCat && matchesSearch) {
        card.classList.remove('hidden');
        visibleCount++;
      } else {
        card.classList.add('hidden');
      }
    });

    const noResults = document.getElementById('no-results');
    if (visibleCount === 0) {
      noResults.classList.remove('hidden');
    } else {
      noResults.classList.add('hidden');
    }
  }

  function openProjModal(data) {
    document.getElementById('m-icon').innerText = data.icon || 'security';
    document.getElementById('m-title').innerText = data.title;
    document.getElementById('m-details').innerText = data.details || data.desc;
    document.getElementById('m-prereq').innerText = data.prereq || 'Standard environment';
    document.getElementById('m-github').href = data.github || 'https://github.com/Yaswantpandey';
    document.getElementById('m-demo').href = data.demo || '#';

    const tagsContainer = document.getElementById('m-tags');
    tagsContainer.innerHTML = '';
    (data.tags || []).forEach(t => {
      const span = document.createElement('span');
      span.className = 'bg-surface-container-lowest text-emerald-400 px-2 py-0.5 rounded text-[11px] font-mono border border-emerald-500/20';
      span.innerText = t;
      tagsContainer.appendChild(span);
    });

    document.getElementById('projModal').classList.remove('hidden');
  }

  function closeProjModal() {
    document.getElementById('projModal').classList.add('hidden');
  }
</script>