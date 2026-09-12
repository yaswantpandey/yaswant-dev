<?php
// api/search.php — Live MySQL Search API Endpoint
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../includes/data.php';

$q = trim($_GET['q'] ?? '');

if ($q === '') {
    echo json_encode(['results' => [], 'query' => '', 'count' => 0]);
    exit;
}

$catalog = [];

// Fetch live resources from MySQL
foreach (get_resources() as $r) {
    $type = $r['type'] ?? 'Resource';
    $isZip = (strcasecmp($type, 'ZIP File') === 0 || stripos($r['title'] ?? '', '.zip') !== false);
    $isTool = (strcasecmp($type, 'Tools') === 0 || strcasecmp($type, 'Software') === 0);
    $isCode = (strcasecmp($type, 'Source Code') === 0);

    $icon = match(true) {
        $isZip => 'folder_zip',
        $isTool => 'terminal',
        $isCode => 'code',
        strcasecmp($type, 'PYQ') === 0 => 'assignment',
        strcasecmp($type, 'Lab Manual') === 0 => 'science',
        strcasecmp($type, 'Formula Sheet') === 0 => 'calculate',
        default => 'description'
    };

    $color = match(true) {
        $isZip => 'amber',
        $isTool => 'cyan',
        $isCode => 'purple',
        default => ($r['color'] ?? 'primary')
    };

    $catalog[] = [
        'type'  => $isZip ? 'ZIP Archive' : ($isTool ? 'Tool & Utility' : $type),
        'title' => $r['title'] ?? '',
        'href'  => !empty($r['url']) ? $r['url'] : URL_RESOURCES . '?q=' . urlencode($r['title'] ?? ''),
        'color' => $color,
        'icon'  => $icon
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

// Cyber Security & Developer Suite Tools (with direct standalone URLs & ZIP archives)
$tools = [
    ['type' => 'ZIP Archive', 'title' => 'Cybersecurity 26-in-1 Offline Penetration Testing Tools Suite (.ZIP)', 'href' => URL_MAIN . 'api/download_tools_zip.php', 'color' => 'amber', 'icon' => 'folder_zip'],
    ['type' => 'ZIP Archive', 'title' => 'Full-Stack Web Development Starter Pack & REST API Boilerplate (.ZIP)', 'href' => URL_RESOURCES . '?branch=Tools', 'color' => 'amber', 'icon' => 'folder_zip'],
    ['type' => 'Cyber Tool', 'title' => 'Password Strength & Shannon Entropy Checker', 'href' => URL_TOOLS . '/01-password-strength-checker.php', 'color' => 'primary', 'icon' => 'lock_reset'],
    ['type' => 'Cyber Tool', 'title' => 'CSPRNG Password Generator', 'href' => URL_TOOLS . '/02-csprng-password-generator.php', 'color' => 'secondary', 'icon' => 'key'],
    ['type' => 'Cyber Tool', 'title' => 'Syslog SIEM & Auth Log Threat Analyzer', 'href' => URL_TOOLS . '/03-syslog-siem-log-analyzer.php', 'color' => 'emerald', 'icon' => 'receipt_long'],
    ['type' => 'Cyber Tool', 'title' => 'Brute Force Rate Limiter Simulator', 'href' => URL_TOOLS . '/04-brute-force-rate-limiter.php', 'color' => 'primary', 'icon' => 'timer'],
    ['type' => 'Cyber Tool', 'title' => 'Wi-Fi Network Security & Cipher Analyzer', 'href' => URL_TOOLS . '/05-wifi-security-analyzer.php', 'color' => 'tertiary', 'icon' => 'wifi'],
    ['type' => 'Cyber Tool', 'title' => 'Network Packet Sniffer & Stream PCAP Analyzer', 'href' => URL_TOOLS . '/06-network-packet-sniffer.php', 'color' => 'secondary', 'icon' => 'hub'],
    ['type' => 'Cyber Tool', 'title' => 'Malware Signature & YARA Rule Scanner', 'href' => URL_TOOLS . '/07-malware-yara-scanner.php', 'color' => 'emerald', 'icon' => 'coronavirus'],
    ['type' => 'Cyber Tool', 'title' => 'Stateful Firewall Rule Simulator', 'href' => URL_TOOLS . '/08-stateful-firewall-simulator.php', 'color' => 'emerald', 'icon' => 'local_firewall'],
    ['type' => 'Cyber Tool', 'title' => 'SQL Injection (SQLi) Auditor & PDO Converter', 'href' => URL_TOOLS . '/09-sqli-auditor-pdo-converter.php', 'color' => 'tertiary', 'icon' => 'terminal'],
    ['type' => 'Cyber Tool', 'title' => '2FA TOTP Authenticator Generator', 'href' => URL_TOOLS . '/10-2fa-totp-authenticator-generator.php', 'color' => 'emerald', 'icon' => 'phonelink_lock'],
    ['type' => 'Cyber Tool', 'title' => 'Keylogger & Input Event Dynamics Auditor', 'href' => URL_TOOLS . '/11-keylogger-event-auditor.php', 'color' => 'primary', 'icon' => 'keyboard'],
    ['type' => 'Cyber Tool', 'title' => 'IPv4 Subnet & CIDR Mask Calculator', 'href' => URL_TOOLS . '/12-ipv4-subnet-cidr-calculator.php', 'color' => 'tertiary', 'icon' => 'lan'],
    ['type' => 'Cyber Tool', 'title' => 'HTTP Security Headers Auditor (CSP/HSTS)', 'href' => URL_TOOLS . '/13-http-security-headers-auditor.php', 'color' => 'secondary', 'icon' => 'verified_user'],
    ['type' => 'Cyber Tool', 'title' => 'AES-256-GCM Zero-Knowledge Web Encryptor', 'href' => URL_TOOLS . '/14-aes-256-gcm-web-encryptor.php', 'color' => 'emerald', 'icon' => 'shield'],
    ['type' => 'Cyber Tool', 'title' => 'IP Geolocation & Threat ASN Inspector', 'href' => URL_TOOLS . '/15-ip-geolocation-threat-inspector.php', 'color' => 'primary', 'icon' => 'travel_explore'],
    ['type' => 'Cyber Tool', 'title' => 'Cryptographic Hash Generator (SHA-256 / SHA-512)', 'href' => URL_TOOLS . '/16-sha256-sha1-hash-generator.php', 'color' => 'tertiary', 'icon' => 'fingerprint'],
    ['type' => 'Cyber Tool', 'title' => 'JWT Token Decoder & Claims Inspector', 'href' => URL_TOOLS . '/17-jwt-token-decoder-inspector.php', 'color' => 'primary', 'icon' => 'badge'],
    ['type' => 'Cyber Tool', 'title' => 'DNS & Email Policy Inspector (SPF/DMARC)', 'href' => URL_TOOLS . '/18-dns-email-policy-inspector.php', 'color' => 'secondary', 'icon' => 'dns'],
    ['type' => 'Cyber Tool', 'title' => 'XSS Payload Sanitizer & Threat Auditor', 'href' => URL_TOOLS . '/19-xss-payload-sanitizer-auditor.php', 'color' => 'tertiary', 'icon' => 'bug_report'],
    ['type' => 'Cyber Tool', 'title' => 'URL Safety & Phishing Redirect Inspector', 'href' => URL_TOOLS . '/20-url-safety-redirect-inspector.php', 'color' => 'primary', 'icon' => 'security'],
    ['type' => 'Cyber Tool', 'title' => 'Browser Port Reachability Scanner', 'href' => URL_TOOLS . '/21-browser-port-reachability-scanner.php', 'color' => 'secondary', 'icon' => 'radar'],
    ['type' => 'Cyber Tool', 'title' => 'Base64 & Hex Encoder / Decoder', 'href' => URL_TOOLS . '/22-base64-hex-encoder-decoder.php', 'color' => 'tertiary', 'icon' => 'enhanced_encryption'],
    ['type' => 'Developer Tool', 'title' => 'Engineering GPA & SGPA Cumulative Calculator', 'href' => URL_TOOLS . '/23-gpa-sgpa-grade-calculator.php', 'color' => 'primary', 'icon' => 'calculate'],
    ['type' => 'Developer Tool', 'title' => 'Code Beautifier & Multi-Language Formatter', 'href' => URL_TOOLS . '/24-code-beautifier-formatter.php', 'color' => 'secondary', 'icon' => 'code'],
    ['type' => 'Developer Tool', 'title' => 'JSON Formatter, Validator & Tree Linter', 'href' => URL_TOOLS . '/25-json-validator-linter.php', 'color' => 'tertiary', 'icon' => 'data_object'],
    ['type' => 'Developer Tool', 'title' => 'REST API & Webhook Endpoint Tester', 'href' => URL_TOOLS . '/26-rest-api-tester.php', 'color' => 'primary', 'icon' => 'api'],
    ['type' => 'Developer Tool', 'title' => 'PDF Editor, Merger & Watermark Suite', 'href' => URL_TOOLS . '/pdf-editor', 'color' => 'emerald', 'icon' => 'picture_as_pdf'],
    ['type' => 'Developer Tool', 'title' => 'UUID / GUID v4 Random Generator', 'href' => URL_TOOLS . '/uuid-generator', 'color' => 'emerald', 'icon' => 'tag'],
    ['type' => 'Resume Studio', 'title' => 'ATS Resume Builder & Scoring Studio', 'href' => URL_RESUME, 'color' => 'secondary', 'icon' => 'description'],
];
$catalog = array_merge($catalog, $tools);

$results = array_values(array_filter(
    $catalog,
    fn($item) => stripos($item['title'], $q) !== false || stripos($item['type'], $q) !== false
));

echo json_encode([
    'query'   => $q,
    'count'   => count($results),
    'results' => array_slice($results, 0, 30),
]);
