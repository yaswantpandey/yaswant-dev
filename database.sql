-- ==============================================================================
-- Complete Database SQL Dump & Schema for Yaswant Dev Ecosystem
-- Target Database: u865909543_freefund / MySQL 8.0+ / MariaDB
-- Engine: InnoDB | Character Set: utf8mb4 | Collation: utf8mb4_unicode_ci
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ------------------------------------------------------------------------------
-- 1. Table Structure: `admin_users`
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin_users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) UNIQUE NOT NULL,
    `email` VARCHAR(191) UNIQUE NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `role` VARCHAR(20) NOT NULL DEFAULT 'superadmin',
    `last_login` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 2. Table Structure: `tools` (Cyber Security, Dev Utilities & Image Tools)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tools` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `slug` VARCHAR(100) UNIQUE NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL DEFAULT 'Cyber Security',
    `description` TEXT NOT NULL,
    `icon` VARCHAR(50) NOT NULL DEFAULT 'build',
    `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
    `file_path` VARCHAR(255) NOT NULL,
    `subdomain` VARCHAR(50) NOT NULL DEFAULT 'tools',
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `usage_count` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_category` (`category`),
    INDEX `idx_subdomain` (`subdomain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 3. Table Structure: `resumes` (ATS Resume Profiles & Templates)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `resumes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL DEFAULT 'My ATS Resume',
    `full_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(191) NOT NULL,
    `phone` VARCHAR(50) NULL,
    `location` VARCHAR(100) NULL,
    `headline` VARCHAR(255) NULL,
    `summary` TEXT NULL,
    `experience_json` LONGTEXT NULL,
    `education_json` LONGTEXT NULL,
    `skills_json` LONGTEXT NULL,
    `projects_json` LONGTEXT NULL,
    `template_theme` VARCHAR(50) NOT NULL DEFAULT 'modern',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 4. Table Structure: `articles` (Blog & Technical Knowledge Base)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `cat` VARCHAR(100) NOT NULL DEFAULT 'Technical',
    `title` VARCHAR(255) NOT NULL,
    `excerpt` TEXT NULL,
    `content` LONGTEXT NULL,
    `author` VARCHAR(100) NOT NULL DEFAULT 'Yaswant Team',
    `read_time` VARCHAR(50) NOT NULL DEFAULT '5 min',
    `img` VARCHAR(500) NULL,
    `is_published` TINYINT(1) NOT NULL DEFAULT 1,
    `views_count` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_cat` (`cat`),
    FULLTEXT INDEX `ft_title_content` (`title`, `excerpt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 5. Table Structure: `resources` (Academic Notes, PYQs, Lab Manuals)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `resources` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `branch` VARCHAR(20) NOT NULL DEFAULT 'CS',
    `sem` VARCHAR(10) NOT NULL DEFAULT 'S1',
    `type` VARCHAR(50) NOT NULL DEFAULT 'Notes',
    `title` VARCHAR(255) NOT NULL,
    `by_author` VARCHAR(100) NOT NULL DEFAULT 'Yaswant Admin',
    `file_size` VARCHAR(50) NOT NULL DEFAULT '1.0 MB',
    `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
    `download_url` VARCHAR(500) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_branch_sem` (`branch`, `sem`),
    INDEX `idx_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 6. Table Structure: `courses` (Video & Curated Engineering Courses)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `courses` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `tag` VARCHAR(100) NOT NULL DEFAULT 'General',
    `lessons` INT NOT NULL DEFAULT 10,
    `level` VARCHAR(50) NOT NULL DEFAULT 'Beginner',
    `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
    `icon` VARCHAR(50) NOT NULL DEFAULT 'school',
    `playlist_url` VARCHAR(500) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_level` (`level`),
    INDEX `idx_tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 7. Table Structure: `jobs` (Tech & Software Engineering Internships)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jobs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `company` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL DEFAULT 'Remote',
    `pay` VARCHAR(100) NOT NULL DEFAULT '$40/hr',
    `tags` TEXT NULL,
    `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
    `apply_link` VARCHAR(500) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_company` (`company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 8. Table Structure: `projects` (Cyber Security Labs & Code Repositories)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `projects` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL DEFAULT 'Cyber Security',
    `tech_stack` VARCHAR(255) NOT NULL DEFAULT 'Python, Linux',
    `difficulty` VARCHAR(50) NOT NULL DEFAULT 'Intermediate',
    `github_url` VARCHAR(500) NULL,
    `demo_url` VARCHAR(500) NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 9. Table Structure: `subscribers` (Newsletter Audience)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `subscribers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(191) UNIQUE NOT NULL,
    `status` VARCHAR(20) NOT NULL DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 10. Table Structure: `analytics` (Visitor Tracker Logs)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `analytics` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ip_address` VARCHAR(45) NULL,
    `page_url` VARCHAR(255) NOT NULL,
    `user_agent` VARCHAR(500) NULL,
    `referrer` VARCHAR(500) NULL,
    `visited_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_visited_at` (`visited_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ==============================================================================
-- COMPREHENSIVE SEED DATA INSERTIONS
-- ==============================================================================

-- 1. Admin Users (Password: Yaswant739830#)
INSERT IGNORE INTO `admin_users` (`id`, `username`, `email`, `password_hash`, `role`) VALUES
(1, 'yaswant', 'yaswant@yaswant.co.in', '$2y$10$wT5tT99Uu3yY81R2g7P5u.q2zV4kP7pD6L3N7V2Q8X5Z9A1B2C3D4', 'superadmin');

-- 2. Tools (All 26 Cyber & Dev Tools + 10 Image Tools)
INSERT IGNORE INTO `tools` (`id`, `slug`, `name`, `category`, `description`, `icon`, `color`, `file_path`, `subdomain`) VALUES
-- Cyber Security Tools
(1, 'password-strength-checker', 'Password Strength & Shannon Entropy Checker', 'Cyber Security', 'Calculates Shannon entropy score and dictionary breach risk in real-time.', 'lock_reset', 'primary', '01-password-strength-checker.php', 'tools'),
(2, 'csprng-password-generator', 'CSPRNG Cryptographic Password Generator', 'Cyber Security', 'Hardware-level entropy password and passphrase generator.', 'key', 'secondary', '02-csprng-password-generator.php', 'tools'),
(3, 'syslog-siem-log-analyzer', 'Syslog SIEM & Auth Log Analyzer', 'Cyber Security', 'Parses Linux auth.log, Apache access logs, and extracts threat IPs.', 'receipt_long', 'emerald', '03-syslog-siem-log-analyzer.php', 'tools'),
(4, 'brute-force-rate-limiter', 'Brute Force Rate Limiter Simulator', 'Cyber Security', 'Simulates login rate limiting, exponential backoff, and IP ban rules.', 'timer', 'primary', '04-brute-force-rate-limiter.php', 'tools'),
(5, 'wifi-security-analyzer', 'Wi-Fi Network Security & Handshake Analyzer', 'Cyber Security', 'Inspects WPA2/WPA3 handshake security and WPS vulnerability risk.', 'wifi', 'tertiary', '05-wifi-security-analyzer.php', 'tools'),
(6, 'network-packet-sniffer', 'Network Packet Sniffer & Stream Analyzer', 'Cyber Security', 'Simulates live PCAP packet capture, protocol headers, and hex payloads.', 'hub', 'secondary', '06-network-packet-sniffer.php', 'tools'),
(7, 'malware-yara-scanner', 'Malware Signature & YARA Rule Scanner', 'Cyber Security', 'Scans files against webshell, Trojan, and ransomware signatures.', 'coronavirus', 'emerald', '07-malware-yara-scanner.php', 'tools'),
(8, 'stateful-firewall-simulator', 'Stateful Firewall Rule Simulator', 'Cyber Security', 'Simulates packet filtering rules (ALLOW/DENY) by IP, Port, and Protocol.', 'local_firewall', 'emerald', '08-stateful-firewall-simulator.php', 'tools'),
(9, 'sqli-auditor-pdo-converter', 'SQL Injection Auditor & PDO Converter', 'Cyber Security', 'Detects SQLi vulnerabilities and generates safe PDO prepared statements.', 'terminal', 'tertiary', '09-sqli-auditor-pdo-converter.php', 'tools'),
(10, '2fa-totp-authenticator-generator', '2FA TOTP Authenticator Generator', 'Cyber Security', 'Generates RFC 6238 Base32 secrets and live 6-digit 2FA passcodes.', 'phonelink_lock', 'emerald', '10-2fa-totp-authenticator-generator.php', 'tools'),
(11, 'keylogger-event-auditor', 'Keylogger & Input Event Auditor', 'Cyber Security', 'Captures keypress event details, keycodes, and keystroke dynamics.', 'keyboard', 'primary', '11-keylogger-event-auditor.php', 'tools'),
(12, 'ipv4-subnet-cidr-calculator', 'IPv4 Subnet & CIDR Calculator', 'Cyber Security', 'Calculates Network Address, Broadcast IP, Subnet Mask, and Host Ranges.', 'lan', 'tertiary', '12-ipv4-subnet-cidr-calculator.php', 'tools'),
(13, 'http-security-headers-auditor', 'HTTP Security Headers Auditor', 'Cyber Security', 'Audits CSP, HSTS, X-Frame-Options, and CORS headers for any site.', 'verified_user', 'secondary', '13-http-security-headers-auditor.php', 'tools'),
(14, 'aes-256-gcm-web-encryptor', 'AES-256-GCM Web Encryptor / Decryptor', 'Cyber Security', 'Encrypts files and text in browser with zero-knowledge AES-256-GCM.', 'shield', 'emerald', '14-aes-256-gcm-web-encryptor.php', 'tools'),
(15, 'ip-geolocation-threat-inspector', 'IP Geolocation & Threat Inspector', 'Cyber Security', 'Looks up ASN, ISP, country, city, and VPN/Proxy indicators for any IP.', 'travel_explore', 'primary', '15-ip-geolocation-threat-inspector.php', 'tools'),
(16, 'sha256-sha1-hash-generator', 'SHA-256 / SHA-1 Hash Generator', 'Cyber Security', 'Calculates instant cryptographic file checksums and hash signatures.', 'fingerprint', 'tertiary', '16-sha256-sha1-hash-generator.php', 'tools'),
(17, 'jwt-token-decoder-inspector', 'JWT Token Decoder & Inspector', 'Cyber Security', 'Decodes JWT header, payload claims, signature validation, and expiration.', 'badge', 'primary', '17-jwt-token-decoder-inspector.php', 'tools'),
(18, 'dns-email-policy-inspector', 'DNS & Email Policy Inspector (SPF/DMARC)', 'Cyber Security', 'Queries live A, MX, TXT, SPF, and DMARC records via DoH.', 'dns', 'secondary', '18-dns-email-policy-inspector.php', 'tools'),
(19, 'xss-payload-sanitizer-auditor', 'XSS Sanitizer & Payload Auditor', 'Cyber Security', 'Inspects HTML payloads for XSS threats and renders sanitized code.', 'bug_report', 'tertiary', '19-xss-payload-sanitizer-auditor.php', 'tools'),
(20, 'url-safety-redirect-inspector', 'URL Safety & Redirect Inspector', 'Cyber Security', 'Inspects URLs for phishing indicators, open redirects, and SSL status.', 'security', 'primary', '20-url-safety-redirect-inspector.php', 'tools'),
(21, 'browser-port-reachability-scanner', 'Browser Port Reachability Scanner', 'Cyber Security', 'Tests TCP port responsiveness and WebSocket reachability.', 'radar', 'secondary', '21-browser-port-reachability-scanner.php', 'tools'),
(22, 'base64-hex-encoder-decoder', 'Base64 & Hex Encoder / Decoder', 'Cyber Security', 'Converts raw strings and binary URLs to Base64 and Hex representations.', 'enhanced_encryption', 'tertiary', '22-base64-hex-encoder-decoder.php', 'tools'),
-- Developer Utilities
(23, 'gpa-sgpa-grade-calculator', 'GPA / SGPA Engineering Grade Calculator', 'Developer Utilities', 'Interactive semester grade, SGPA, and cumulative CGPA calculator.', 'calculate', 'primary', '23-gpa-sgpa-grade-calculator.php', 'tools'),
(24, 'code-beautifier-formatter', 'Code Beautifier & Formatter', 'Developer Utilities', 'Formats JavaScript, HTML, CSS, SQL, and JSON with syntax highlighting.', 'code', 'secondary', '24-code-beautifier-formatter.php', 'tools'),
(25, 'json-validator-linter', 'JSON Validator & Tree Linter', 'Developer Utilities', 'Validates JSON syntax, detects missing commas, and formats raw strings.', 'data_object', 'tertiary', '25-json-validator-linter.php', 'tools'),
(26, 'rest-api-tester', 'Browser REST API Tester', 'Developer Utilities', 'Tests GET, POST, PUT, DELETE endpoints with custom JSON headers.', 'api', 'primary', '26-rest-api-tester.php', 'tools'),
-- Image Suite Tools
(27, 'image-resizer', 'Precision Photo Resizer & DPI Optimizer', 'Image Tools', 'Resize by pixels, percentage, cm, mm, inches, and auto-fit target KB.', 'photo_size_select_large', 'primary', 'resize.php', 'image'),
(28, 'image-compressor', 'Smart Image Compressor', 'Image Tools', 'Compress JPG, PNG, WebP by up to 85% without visual quality loss.', 'compress', 'secondary', 'compress.php', 'image'),
(29, 'remove-background', 'Background Remover & Transparent PNG Cutout', 'Image Tools', 'Remove photo backgrounds with edge feathering and custom studio backdrops.', 'auto_fix_high', 'emerald', 'remove-bg.php', 'image'),
(30, 'crop-image', 'Photo Cropper & Aspect Ratio Studio', 'Image Tools', 'Crop photos with 1:1, 16:9, 4:3, and custom freeform selection boxes.', 'crop', 'tertiary', 'crop.php', 'image'),
(31, 'convert-image', 'Image Format Converter', 'Image Tools', 'Convert between JPG, PNG, WebP, and BMP formats instantly.', 'transform', 'primary', 'convert.php', 'image'),
(32, 'meme-generator', 'Viral Meme Studio', 'Image Tools', 'Create trending memes with classic Impact captions and viral templates.', 'sentiment_very_satisfied', 'secondary', 'meme.php', 'image'),
(33, 'photo-collage-maker', 'Photo Collage Maker', 'Image Tools', 'Combine 2 to 6 photos into modern creative grids with rounded corners.', 'grid_view', 'tertiary', 'collage.php', 'image'),
(34, 'rotate-flip-image', 'Rotate & Flip Image', 'Image Tools', 'Rotate 90, 180, 270 degrees and mirror flip horizontally or vertically.', 'rotate_right', 'primary', 'rotate.php', 'image'),
(35, 'watermark-image', 'Photo Watermark Tool', 'Image Tools', 'Add custom copyright text and transparent watermark stamps to photos.', 'copyright', 'secondary', 'watermark.php', 'image'),
(36, 'photo-filters', 'Filters & Photo Adjustments', 'Image Tools', 'Adjust brightness, contrast, saturation, and apply grayscale/sepia filters.', 'tune', 'emerald', 'filters.php', 'image');

-- 3. Resumes (Ready-to-use Professional ATS Templates)
INSERT IGNORE INTO `resumes` (`id`, `title`, `full_name`, `email`, `phone`, `location`, `headline`, `summary`, `experience_json`, `education_json`, `skills_json`, `projects_json`, `template_theme`) VALUES
(1, 'Full Stack Software Engineer ATS Resume', 'Yaswant Kumar', 'yaswant@yaswant.co.in', '+91 9876543210', 'Bengaluru, India', 'Senior Full Stack & Cloud Infrastructure Engineer', 'Results-driven software engineer with 3+ years of experience in architecting scalable distributed microservices, real-time web applications, and cloud CI/CD infrastructure. Passionate about low-latency performance and clean system design.', '[{"company":"CloudNova Inc.","role":"Software Engineer Intern","period":"2023 - Present","bullets":["Engineered real-time microservices in Go & React serving 50k+ daily active users.","Reduced API latency by 42% by implementing Redis caching and database indexing.","Built automated CI/CD deployment pipelines using Docker and Kubernetes."]}]', '[{"institution":"National Institute of Technology","degree":"B.Tech in Computer Science and Engineering","period":"2020 - 2024","gpa":"8.9 CGPA"}]', '["Go","TypeScript","React.js","Next.js","Python","Node.js","PostgreSQL","Docker","Kubernetes","AWS","Git","Linux"]', '[{"title":"Zero-Knowledge Cloud File Vault","tech":"WebCrypto, React, Go","description":"End-to-end client-side encrypted cloud storage system with PBKDF2 authentication."}]', 'modern'),
(2, 'Cyber Security & AppSec Analyst Resume', 'Aman Sharma', 'aman.security@example.com', '+91 9123456789', 'New Delhi, India', 'Cyber Security Analyst & Penetration Tester', 'Detail-oriented security analyst skilled in OWASP Top 10 auditing, network packet analysis, SIEM log monitoring, and automated vulnerability scanning across enterprise web infrastructure.', '[{"company":"DefSec Labs","role":"Security Auditor Intern","period":"2023 - 2024","bullets":["Conducted black-box penetration testing and discovered 12 critical SQLi and XSS vulnerabilities.","Implemented SIEM alert rules analyzing 1M+ daily auth.log events using Python & RegEx."]}]', '[{"institution":"Delhi Technological University","degree":"B.Tech in Information Technology","period":"2020 - 2024","gpa":"8.6 CGPA"}]', '["Network Security","SIEM Analysis","OWASP Top 10","Wireshark","Python","Burp Suite","Metasploit","Linux Hardening","Cryptography","Snort"]', '[{"title":"Stateful Packet Filtering Firewall","tech":"Python, Scapy, Raw Sockets","description":"Custom packet inspection firewall blocking IP spoofing and SYN flood attacks."}]', 'classic');

-- 4. Articles (Rich Technical Blogs)
INSERT IGNORE INTO `articles` (`id`, `cat`, `title`, `excerpt`, `content`, `author`, `read_time`, `img`) VALUES
(1, 'Technical', 'Optimizing React Rendering for Complex Real-Time Dashboards', 'A deep dive into memoization techniques, Web Workers, and state management patterns to ensure fluid 60fps performance.', '<h2>Introduction</h2><p>Rendering thousands of real-time data points in modern web applications requires architectural vigilance. In this article, we explore virtualized DOM lists, <code>useMemo</code> caching strategies, and offloading compute tasks to background Web Workers.</p><h3>Key Optimization Strategies</h3><ul><li><strong>Virtual List Windowing:</strong> Only render elements currently within the viewport.</li><li><strong>Custom Hook Memoization:</strong> Isolate high-frequency state updates.</li><li><strong>Web Worker Offloading:</strong> Keep the main thread responsive by running heavy data sorting in background threads.</li></ul>', 'Alex Chen', '5 min', 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800'),
(2, 'Career', 'Navigating Your First Tech Engineering Internship', 'Practical guidance on how to make a high impact, ask the right architectural questions, and secure a full-time return offer.', '<h2>Getting Started</h2><p>Your first 30 days at a tech company establish your reputation. Focus on understanding the codebase deployment pipeline, writing clean unit tests, and proactive communication with your engineering mentor.</p><h3>The Return Offer Playbook</h3><p>Document your weekly deliverables, contribute to team documentation, and request bi-weekly feedback to align with team expectations.</p>', 'Maya Patel', '4 min', 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800'),
(3, 'Technical', 'Demystifying Kubernetes Architecture & Container Orchestration', 'Breaking down control plane nodes, kubelet agents, etcd consensus, and pod networking for software engineers.', '<h2>Why Kubernetes?</h2><p>As applications transition from monolithic services to distributed microservices, automated scheduling, rollbacks, and self-healing container infrastructure become indispensable.</p><h3>Core Components</h3><ul><li><strong>etcd:</strong> Distributed key-value store holding the cluster state.</li><li><strong>kube-scheduler:</strong> Assigns pods to nodes based on resource constraints.</li><li><strong>kube-proxy:</strong> Handles network routing and load balancing across service endpoints.</li></ul>', 'David Kim', '10 min', 'https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?w=800'),
(4, 'Student Life', 'Managing Cognitive Fatigue During Finals & Placements', 'Evidence-backed strategies for maintaining high mental performance, optimizing spaced repetition blocks, and active recovery.', '<h2>Brain Optimization</h2><p>Engineering examinations require sustained analytical focus. Learn how the Pomodoro 50/10 protocol, hydration, and sleep hygiene directly improve retention and problem-solving speed.</p>', 'Sarah Jenkins', '6 min', 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800');

-- 5. Academic Resources & Tools Vault (Notes, PYQs, Tools & ZIP Archives)
INSERT IGNORE INTO `resources` (`id`, `branch`, `sem`, `type`, `title`, `by_author`, `file_size`, `color`, `download_url`) VALUES
(1, 'Tools', 'All', 'ZIP File', 'Cybersecurity 26-in-1 Offline Penetration Testing Tools Suite (.ZIP)', 'Yaswant Dev', '18.4 MB', 'amber', 'api/download_tools_zip.php'),
(2, 'Tools', 'All', 'ZIP File', 'Full-Stack Web Development Starter Pack & REST API Boilerplate (.ZIP)', 'Yaswant Dev', '6.2 MB', 'cyan', 'https://github.com/yaswantpandey'),
(3, 'CS', 'All', 'Source Code', 'Data Structures & Algorithms Complete Java & C++ Code Archive (.ZIP)', 'Yaswant Dev', '4.5 MB', 'emerald', 'https://github.com/yaswantpandey'),
(4, 'Tools', 'All', 'ZIP File', 'Linux DevOps & System Administration Automation Shell Scripts (.ZIP)', 'Yaswant Dev', '2.1 MB', 'indigo', 'https://github.com/yaswantpandey'),
(5, 'CS', 'S3', 'Notes', 'Data Structures & Algorithms Handwritten Complete Notes', 'Yaswant Admin', '4.2 MB', 'emerald', 'https://drive.google.com/'),
(6, 'CS', 'S4', 'PYQ', 'Operating Systems 2024 End-Sem Solved PYQs with Answers', 'Prof. Vance', '2.8 MB', 'cyan', 'https://drive.google.com/'),
(7, 'CS', 'S5', 'Notes', 'Database Management Systems SQL & Normalization Cheat Sheet', 'Yaswant Admin', '1.5 MB', 'indigo', 'https://drive.google.com/'),
(8, 'ME', 'S2', 'Lab Manual', 'Engineering Mechanics Lab Manual & Formula Derivations', 'Dr. Smith', '3.1 MB', 'rose', 'https://drive.google.com/'),
(9, 'CS', 'S6', 'Notes', 'Computer Networks OSI Model & TCP/IP Socket Programming', 'Yaswant Admin', '3.6 MB', 'amber', 'https://drive.google.com/'),
(10, 'EC', 'S3', 'PYQ', 'Digital Electronics & Logic Design Solved Question Bank', 'Prof. Sharma', '2.4 MB', 'violet', 'https://drive.google.com/');

-- 6. Curated Courses
INSERT IGNORE INTO `courses` (`id`, `title`, `tag`, `lessons`, `level`, `color`, `icon`, `playlist_url`) VALUES
(1, 'Data Structures & Algorithms in C++ & Java', 'CS Fundamentals', 42, 'Intermediate', 'primary', 'account_tree', NULL),
(2, 'Operating Systems & Linux Kernel Deep Dive', 'Systems', 35, 'Advanced', 'secondary', 'memory', NULL),
(3, 'Applied Machine Learning & Neural Networks', 'AI/ML', 28, 'Beginner', 'tertiary', 'psychology', NULL),
(4, 'Full-Stack Web Development with React & Node', 'Frontend', 50, 'Intermediate', 'primary', 'web', NULL),
(5, 'Database Systems, PostgreSQL & SQL Optimization', 'Backend', 30, 'Beginner', 'secondary', 'storage', NULL),
(6, 'Computer Networks & Cybersecurity Fundamentals', 'Networking', 25, 'Intermediate', 'tertiary', 'lan', NULL),
(7, 'Data Analyst Roadmap: Excel, SQL, Python, Power BI & ML', 'Data Analytics', 56, 'Beginner', 'emerald', 'data_exploration', '/data-analyst');

-- 7. Tech Internships
INSERT IGNORE INTO `jobs` (`id`, `title`, `company`, `location`, `pay`, `tags`, `color`) VALUES
(1, 'Software Engineering Intern', 'CloudNova Inc.', 'San Francisco (Hybrid)', '$45–$55/hr', '["React","Go","Kubernetes"]', 'primary'),
(2, 'ML Research & AI Intern', 'DeepMind Labs', 'Remote', '$50–$60/hr', '["Python","PyTorch","CUDA"]', 'secondary'),
(3, 'Cloud & DevOps Intern', 'Infra Systems', 'New York (On-site)', '$40–$48/hr', '["Docker","Terraform","AWS"]', 'tertiary'),
(4, 'Frontend Engineer Intern', 'PixelCraft Studio', 'Remote', '$38–$45/hr', '["TypeScript","Next.js","Tailwind"]', 'primary'),
(5, 'Data Engineering & Pipeline Intern', 'DataStream Co.', 'Austin (Hybrid)', '$42–$50/hr', '["Spark","SQL","Airflow"]', 'secondary'),
(6, 'Embedded Systems & Firmware Intern', 'RoboCore Systems', 'Boston (On-site)', '$44–$52/hr', '["C++","RTOS","ARM"]', 'tertiary');

-- 8. Cyber Security Projects
INSERT IGNORE INTO `projects` (`id`, `title`, `category`, `tech_stack`, `difficulty`, `description`) VALUES
(1, 'Stateful Network Firewall & Packet Filter', 'Network Security', 'Python, Scapy, Raw Sockets', 'Intermediate', 'Build a stateful firewall rule engine that filters TCP/UDP traffic and prevents IP spoofing attacks in real time.'),
(2, 'Automated SQL Injection & XSS Vulnerability Scanner', 'AppSec', 'Python, BeautifulSoup, Requests', 'Advanced', 'A security auditing tool that fuzzes web form inputs and tests endpoints against SQLi and cross-site scripting attack payloads.'),
(3, 'Zero-Knowledge AES-256-GCM File Vault', 'Cryptography', 'JavaScript, Web Crypto API', 'Intermediate', 'Client-side encrypted vault where files are encrypted in the browser with PBKDF2 derived keys before storage.'),
(4, 'SIEM Log Threat & Brute Force Rate Limiter', 'Blue Team', 'Python, Redis, RegEx', 'Beginner', 'Analyzes Linux auth.log and Apache access logs to detect brute-force attempts and automatically ban malicious IPs.');

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;
