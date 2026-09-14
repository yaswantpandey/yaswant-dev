<?php
// includes/db.php — Multi-Port MySQL PDO Connection & Zero-Crash SQLite Engine
require_once __DIR__ . '/../config.php';

function get_db(): PDO
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $pdoOptions = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_TIMEOUT            => 5,
    ];

    // ─── 1. Multi-Port MySQL Discovery ──────────────────────────────────
    $attempts = [];
    $port = defined('DB_PORT') ? (int)DB_PORT : 3306;

    if (defined('APP_ENV') && APP_ENV === 'development') {
        $attempts[] = ['host' => DB_HOST,     'port' => $port, 'user' => DB_USER, 'pass' => DB_PASS];
        $attempts[] = ['host' => '127.0.0.1', 'port' => 3308, 'user' => 'root',  'pass' => ''];
        $attempts[] = ['host' => 'localhost', 'port' => 3306, 'user' => 'root',  'pass' => ''];
        $attempts[] = ['host' => 'localhost', 'port' => 3308, 'user' => 'root',  'pass' => ''];
    } else {
        // Production (Hostinger)
        $attempts[] = ['host' => DB_HOST, 'port' => $port, 'user' => DB_USER, 'pass' => DB_PASS];
        if (DB_HOST === 'localhost') {
            $attempts[] = ['host' => '127.0.0.1', 'port' => $port, 'user' => DB_USER, 'pass' => DB_PASS];
        } elseif (DB_HOST === '127.0.0.1') {
            $attempts[] = ['host' => 'localhost', 'port' => $port, 'user' => DB_USER, 'pass' => DB_PASS];
        }
    }

    $lastMysqlError = '';
    foreach ($attempts as $cfg) {
        $portStr = !empty($cfg['port']) ? ";port={$cfg['port']}" : "";
        try {
            $dsn = "mysql:host={$cfg['host']}{$portStr};dbname=" . DB_NAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], $pdoOptions);
            init_db_schema($pdo);
            seed_data_if_empty($pdo);
            return $pdo;
        } catch (PDOException $e) {
            $lastMysqlError = $e->getMessage();
            // In local development only, attempt to auto-create database if it doesn't exist
            if (defined('APP_ENV') && APP_ENV === 'development') {
                try {
                    $rootDsn = "mysql:host={$cfg['host']}{$portStr};charset=utf8mb4";
                    $rootPdo = new PDO($rootDsn, $cfg['user'], $cfg['pass'], $pdoOptions);
                    $rootPdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                    
                    $pdo = new PDO("mysql:host={$cfg['host']}{$portStr};dbname=" . DB_NAME . ";charset=utf8mb4", $cfg['user'], $cfg['pass'], $pdoOptions);
                    init_db_schema($pdo);
                    seed_data_if_empty($pdo);
                    return $pdo;
                } catch (Exception $createEx) {
                    // Continue to next port/host attempt
                }
            }
        }
    }

    // ─── 2. Zero-Crash Fallback: SQLite Local Storage ────────────────────
    // If MySQL service is unreachable, fallback to local SQLite database
    try {
        $dataDir = __DIR__ . '/../data';
        if (!is_dir($dataDir)) {
            @mkdir($dataDir, 0777, true);
        }
        $sqliteFile = $dataDir . '/engihub_local.sqlite';
        $pdo = new PDO("sqlite:" . $sqliteFile, null, null, $pdoOptions);
        $pdo->exec("PRAGMA journal_mode = WAL;");
        init_db_schema($pdo);
        seed_data_if_empty($pdo);
        return $pdo;
    } catch (Exception $sqliteErr) {
        $msg = "Database Error: MySQL failed (" . $lastMysqlError . ") and SQLite fallback failed: " . $sqliteErr->getMessage();
        error_log($msg);
        throw new Exception($msg);
    }
}

function init_db_schema(PDO $pdo): void
{
    $isSqlite = ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) === 'sqlite');
    $autoInc  = $isSqlite ? "INTEGER PRIMARY KEY AUTOINCREMENT" : "INT AUTO_INCREMENT PRIMARY KEY";
    $tblOpt   = $isSqlite ? "" : "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `tools` (
            `id` {$autoInc},
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
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `resumes` (
            `id` {$autoInc},
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
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `resources` (
            `id` {$autoInc},
            `branch` VARCHAR(20) NOT NULL DEFAULT 'CS',
            `sem` VARCHAR(10) NOT NULL DEFAULT 'S1',
            `type` VARCHAR(50) NOT NULL DEFAULT 'Notes',
            `title` VARCHAR(255) NOT NULL,
            `by_author` VARCHAR(100) NOT NULL DEFAULT 'Yaswant Admin',
            `file_size` VARCHAR(50) NOT NULL DEFAULT '1.0 MB',
            `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
            `download_url` VARCHAR(500) NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `courses` (
            `id` {$autoInc},
            `title` VARCHAR(255) NOT NULL,
            `tag` VARCHAR(100) NOT NULL DEFAULT 'General',
            `lessons` INT NOT NULL DEFAULT 10,
            `level` VARCHAR(50) NOT NULL DEFAULT 'Beginner',
            `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
            `icon` VARCHAR(50) NOT NULL DEFAULT 'school',
            `playlist_url` VARCHAR(500) NULL,
            `description` TEXT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `jobs` (
            `id` {$autoInc},
            `title` VARCHAR(255) NOT NULL,
            `company` VARCHAR(255) NOT NULL,
            `location` VARCHAR(255) NOT NULL DEFAULT 'Remote',
            `pay` VARCHAR(100) NOT NULL DEFAULT '$40/hr',
            `tags` TEXT NULL,
            `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
            `apply_link` VARCHAR(500) NULL,
            `apply_url` VARCHAR(500) NULL,
            `deadline` VARCHAR(100) NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `articles` (
            `id` {$autoInc},
            `cat` VARCHAR(100) NOT NULL DEFAULT 'Technical',
            `title` VARCHAR(255) NOT NULL,
            `excerpt` TEXT NULL,
            `content` LONGTEXT NULL,
            `author` VARCHAR(100) NOT NULL DEFAULT 'Yaswant Team',
            `read_time` VARCHAR(50) NOT NULL DEFAULT '5 min',
            `img` VARCHAR(500) NULL,
            `is_published` TINYINT(1) NOT NULL DEFAULT 1,
            `views_count` INT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `projects` (
            `id` {$autoInc},
            `title` VARCHAR(255) NOT NULL,
            `category` VARCHAR(100) NOT NULL DEFAULT 'Cyber Security',
            `tech_stack` VARCHAR(255) NOT NULL DEFAULT 'Python, Linux',
            `difficulty` VARCHAR(50) NOT NULL DEFAULT 'Intermediate',
            `github_url` VARCHAR(500) NULL,
            `demo_url` VARCHAR(500) NULL,
            `description` TEXT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `subscribers` (
            `id` {$autoInc},
            `email` VARCHAR(191) UNIQUE NOT NULL,
            `status` VARCHAR(20) NOT NULL DEFAULT 'active',
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `admin_users` (
            `id` {$autoInc},
            `username` VARCHAR(50) UNIQUE NOT NULL,
            `email` VARCHAR(191) UNIQUE NOT NULL,
            `password_hash` VARCHAR(255) NOT NULL,
            `role` VARCHAR(20) NOT NULL DEFAULT 'superadmin',
            `last_login` DATETIME NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) {$tblOpt};
    ");

    // Dynamic Safe Column Migrations
    $ensureCol = function(PDO $p, string $table, string $col, string $def) use ($isSqlite) {
        try {
            if ($isSqlite) {
                $check = $p->query("PRAGMA table_info(`{$table}`)");
                $exists = false;
                if ($check) {
                    while ($row = $check->fetch()) {
                        if (strcasecmp($row['name'] ?? '', $col) === 0) {
                            $exists = true;
                            break;
                        }
                    }
                }
                if (!$exists) {
                    $p->exec("ALTER TABLE `{$table}` ADD COLUMN `{$col}` {$def}");
                }
            } else {
                $check = $p->query("SHOW COLUMNS FROM `{$table}` LIKE '{$col}'");
                if ($check && !$check->fetch()) {
                    $p->exec("ALTER TABLE `{$table}` ADD COLUMN `{$col}` {$def}");
                }
            }
        } catch (Exception $e) {
            // Ignore non-critical migration exception
        }
    };

    $ensureCol($pdo, 'courses',   'description',  'TEXT NULL');
    $ensureCol($pdo, 'jobs',      'apply_url',    'VARCHAR(500) NULL');
    $ensureCol($pdo, 'jobs',      'apply_link',   'VARCHAR(500) NULL');
    $ensureCol($pdo, 'jobs',      'deadline',     'VARCHAR(100) NULL');
    $ensureCol($pdo, 'resources', 'download_url', 'VARCHAR(500) NULL');
}

function seed_data_if_empty(PDO $pdo): void
{
    try {
        // 1. Seed courses if table is empty
        $courseCount = (int) $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
        if ($courseCount === 0) {
            $coursesJson = __DIR__ . '/../data/courses.json';
            if (file_exists($coursesJson)) {
                $data = json_decode(file_get_contents($coursesJson), true);
                if (is_array($data)) {
                    $stmt = $pdo->prepare("INSERT INTO courses (title, tag, lessons, level, color, icon, playlist_url, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    foreach ($data as $c) {
                        $stmt->execute([
                            $c['title'] ?? 'Course Title',
                            $c['tag'] ?? 'General',
                            (int)($c['lessons'] ?? 20),
                            $c['level'] ?? 'Beginner',
                            $c['color'] ?? 'primary',
                            $c['icon'] ?? 'school',
                            $c['playlist_url'] ?? '',
                            $c['description'] ?? ''
                        ]);
                    }
                }
            }
        }

        // 2. Seed jobs if table is empty
        $jobCount = (int) $pdo->query("SELECT COUNT(*) FROM jobs")->fetchColumn();
        if ($jobCount === 0) {
            $jobsJson = __DIR__ . '/../data/jobs.json';
            if (file_exists($jobsJson)) {
                $data = json_decode(file_get_contents($jobsJson), true);
                if (is_array($data)) {
                    $stmt = $pdo->prepare("INSERT INTO jobs (title, company, location, pay, tags, color, apply_url, apply_link, deadline) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    foreach ($data as $j) {
                        $tags = isset($j['tags']) ? (is_array($j['tags']) ? json_encode($j['tags']) : $j['tags']) : '[]';
                        $url = $j['apply_url'] ?? $j['apply_link'] ?? '';
                        $stmt->execute([
                            $j['title'] ?? 'Software Engineer Intern',
                            $j['company'] ?? 'TechCorp',
                            $j['location'] ?? 'Remote',
                            $j['pay'] ?? '₹25,000/month',
                            $tags,
                            $j['color'] ?? 'primary',
                            $url,
                            $url,
                            $j['deadline'] ?? null
                        ]);
                    }
                }
            }
        }

        // 3. Seed articles if table is empty
        $articleCount = (int) $pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn();
        if ($articleCount === 0) {
            $articlesJson = __DIR__ . '/../data/articles.json';
            if (file_exists($articlesJson)) {
                $data = json_decode(file_get_contents($articlesJson), true);
                if (is_array($data)) {
                    $stmt = $pdo->prepare("INSERT INTO articles (cat, title, excerpt, content, author, read_time, img) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    foreach ($data as $a) {
                        $stmt->execute([
                            $a['cat'] ?? 'Technical',
                            $a['title'] ?? 'Sample Article',
                            $a['excerpt'] ?? '',
                            $a['content'] ?? '<p>Article content...</p>',
                            $a['author'] ?? 'Yaswant Team',
                            $a['read'] ?? $a['readTime'] ?? '5 min',
                            $a['img'] ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97'
                        ]);
                    }
                }
            }
        }

        // 4. Seed resources if table is empty
        $resCount = (int) $pdo->query("SELECT COUNT(*) FROM resources")->fetchColumn();
        if ($resCount === 0) {
            $sampleResources = [
                ['CS', 'S3', 'Notes', 'Data Structures & Algorithms Complete Notes', 'Yaswant Pandey', '2.8 MB', 'primary', 'https://drive.google.com'],
                ['CS', 'S4', 'Notes', 'Operating System Kernel & Concurrency Architecture', 'Yaswant Pandey', '3.4 MB', 'secondary', 'https://drive.google.com'],
                ['CS', 'S5', 'Notes', 'Database Management Systems & SQL Optimization', 'Yaswant Pandey', '1.9 MB', 'tertiary', 'https://drive.google.com'],
                ['CS', 'S6', 'PYQ',   'Computer Networks 5-Year Solved Question Bank', 'Yaswant Pandey', '4.2 MB', 'green', 'https://drive.google.com'],
            ];
            $stmt = $pdo->prepare("INSERT INTO resources (branch, sem, type, title, by_author, file_size, color, download_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            foreach ($sampleResources as $r) {
                $stmt->execute($r);
            }
        }

        // 5. Seed default admin if admin_users is empty
        $adminCount = (int) $pdo->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
        if ($adminCount === 0 && defined('ADMIN_USER') && defined('ADMIN_PASS')) {
            $hash = password_hash(ADMIN_PASS, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO admin_users (username, email, password_hash, role) VALUES (?, ?, ?, 'superadmin')");
            $stmt->execute([ADMIN_USER, 'admin@yaswant.co.in', $hash]);
        }
    } catch (Exception $e) {
        error_log("Seed DB Data Notice: " . $e->getMessage());
    }
}
