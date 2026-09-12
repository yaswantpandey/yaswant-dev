<?php
// api/download_tools_zip.php — High-Performance Tools & Offline Suite ZIP Bundler & Streamer
// Serves / generates cached ZIP package of all 26 client-side cyber security and developer tools

error_reporting(0);
ini_set('display_errors', 0);

$rootDir   = dirname(__DIR__);
$toolsDir  = $rootDir . DIRECTORY_SEPARATOR . 'tools';
$uploadDir = $rootDir . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'resources';
$zipFile   = $uploadDir . DIRECTORY_SEPARATOR . 'cyber_tools_suite_offline_v1.zip';
$filename  = 'cyber_tools_suite_offline_v1.zip';

// Ensure uploads/resources directory exists
if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0755, true);
}

$rebuild = !file_exists($zipFile);

// Check if any tool file is newer than existing zip
if (!$rebuild && file_exists($zipFile)) {
    $zipTime = filemtime($zipFile);
    if (is_dir($toolsDir)) {
        $files = scandir($toolsDir);
        foreach ($files as $f) {
            if ($f === '.' || $f === '..') continue;
            $toolPath = $toolsDir . DIRECTORY_SEPARATOR . $f;
            if (is_file($toolPath) && filemtime($toolPath) > $zipTime) {
                $rebuild = true;
                break;
            }
        }
    }
}

// Build ZIP archive using PHP ZipArchive extension
if ($rebuild && class_exists('ZipArchive')) {
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        
        // 1. Add Offline Documentation & Local Server Instructions
        $readme = "# 🛡️ Cybersecurity & Developer Offline Tool Suite (2026)\n"
            . "Author: Yaswant Pandey\n"
            . "Website: https://yaswant.co.in\n"
            . "Tools Portal: https://tools.yaswant.co.in\n"
            . "License: MIT\n\n"
            . "---\n\n"
            . "## 🚀 How to Run Offline\n\n"
            . "### Option 1: Built-in PHP Server (Recommended)\n"
            . "1. Ensure PHP 7.4 or 8.x is installed on your machine.\n"
            . "2. Open terminal in this folder:\n"
            . "   ```bash\n"
            . "   cd cyber-tools-suite\n"
            . "   php -S localhost:8000\n"
            . "   ```\n"
            . "3. Visit http://localhost:8000/index.php in your web browser.\n\n"
            . "### Option 2: Apache / WAMP / XAMPP / Nginx\n"
            . "Place the extracted `tools/` folder in your `htdocs` or `www` directory and navigate to `http://localhost/tools/`.\n\n"
            . "---\n\n"
            . "## 📦 Included Tools Catalog (26 Standalone Utilities)\n\n"
            . "### 🔐 Cyber Security Suite\n"
            . "- `01-password-strength-checker.php` — Shannon entropy & zxcvbn password resilience audit\n"
            . "- `02-csprng-password-generator.php` — Cryptographically secure pseudo-random password generator\n"
            . "- `03-syslog-siem-log-analyzer.php` — Real-time syslog/auth.log SIEM threat rule engine\n"
            . "- `04-brute-force-rate-limiter.php` — Authentication rate limiter & exponential backoff simulator\n"
            . "- `05-wifi-security-analyzer.php` — WPA2/WPA3 handshake & beacon frame auditor\n"
            . "- `06-network-packet-sniffer.php` — Stream packet capture & hex/ASCII inspector\n"
            . "- `07-malware-yara-scanner.php` — In-browser YARA signature & malware pattern scanner\n"
            . "- `08-stateful-firewall-simulator.php` — Stateful packet filter & ACL inspector\n"
            . "- `09-sqli-auditor-pdo-converter.php` — SQL Injection auditor & PDO parameterized query converter\n"
            . "- `10-2fa-totp-authenticator-generator.php` — RFC 6238 TOTP two-factor code generator\n"
            . "- `11-keylogger-event-auditor.php` — Keystroke dynamics & browser event listener auditor\n"
            . "- `12-ipv4-subnet-cidr-calculator.php` — Subnet division, wildcard mask & host range calculator\n"
            . "- `13-http-security-headers-auditor.php` — CSP, HSTS, X-Frame & Permissions Policy generator\n"
            . "- `14-aes-256-gcm-web-encryptor.php` — Zero-knowledge client-side AES-256-GCM encryption\n"
            . "- `15-ip-geolocation-threat-inspector.php` — ASN, ISP & IP reputation intelligence lookup\n"
            . "- `16-sha256-sha1-hash-generator.php` — Multi-algorithm checksum generator & hash verifier\n"
            . "- `17-jwt-token-decoder-inspector.php` — JSON Web Token payload, header & claims inspector\n"
            . "- `18-dns-email-policy-inspector.php` — SPF, DKIM & DMARC email authentication auditor\n"
            . "- `19-xss-payload-sanitizer-auditor.php` — Cross-Site Scripting contextual sanitizer\n"
            . "- `20-url-safety-redirect-inspector.php` — Open redirect, shortlink & phishing chain auditor\n"
            . "- `21-browser-port-reachability-scanner.php` — Non-destructive browser port reachability scanner\n"
            . "- `22-base64-hex-encoder-decoder.php` — Multi-radix encoding/decoding suite\n\n"
            . "### 🛠️ Developer & Engineering Utilities\n"
            . "- `23-gpa-sgpa-grade-calculator.php` — Semester GPA & SGPA weighted credit calculator\n"
            . "- `24-code-beautifier-formatter.php` — Multi-language code beautifier & indentation fixer\n"
            . "- `25-json-validator-linter.php` — JSON formatter, schema validator & minifier\n"
            . "- `26-rest-api-tester.php` — In-browser HTTP/REST API & webhook testing client\n"
            . "- `index.php` — Master portal dashboard with live search & categorization\n\n"
            . "---\n"
            . "© " . date('Y') . " Yaswant Pandey. All rights reserved.\n";
            
        $zip->addFromString('README.md', $readme);

        // 2. Add all tools files into tools/ subfolder
        if (is_dir($toolsDir)) {
            $files = scandir($toolsDir);
            foreach ($files as $f) {
                if ($f === '.' || $f === '..') continue;
                $fullPath = $toolsDir . DIRECTORY_SEPARATOR . $f;
                if (is_file($fullPath)) {
                    $zip->addFile($fullPath, 'tools/' . $f);
                }
            }
        }

        // 3. Add root index.php launcher
        $launcher = "<?php\n"
            . "// Master offline launcher\n"
            . "header('Location: tools/index.php');\n"
            . "exit;\n";
        $zip->addFromString('index.php', $launcher);

        $zip->close();
    }
}

// Serve the zip file for direct download
if (file_exists($zipFile) && filesize($zipFile) > 0) {
    // Clear any previous output buffers
    while (ob_get_level()) {
        ob_end_clean();
    }

    $fileSize = filesize($zipFile);

    header('Content-Description: File Transfer');
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: public, must-revalidate, max-age=86400');
    header('Pragma: public');
    header('Content-Length: ' . $fileSize);

    // Stream the file in chunks to prevent memory exhaustion
    $handle = fopen($zipFile, 'rb');
    if ($handle !== false) {
        while (!feof($handle)) {
            echo fread($handle, 65536);
            flush();
        }
        fclose($handle);
    } else {
        readfile($zipFile);
    }
    exit;
} else {
    // Fallback: Redirect to tools suite if server cannot produce zip
    header('Location: ../tools/index.php');
    exit;
}
