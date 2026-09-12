<?php
// includes/db.php — Universal Self-Healing PDO Database Connection & Schema Engine
require_once __DIR__ . '/../config.php';

function get_db(): PDO
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $errors = [];

    // ─── 1. Try MySQL Connection ─────────────────────────────────────────────
    if (defined('DB_HOST') && defined('DB_NAME')) {
        // Ports to try in development: configured port, default 3306, and WampServer alternative 3308
        $hostsToTry = [DB_HOST];
        if (defined('APP_ENV') && APP_ENV === 'development' && strpos(DB_HOST, ':') === false) {
            $hostsToTry = [DB_HOST, DB_HOST . ':3306', DB_HOST . ':3308', 'localhost:3306', 'localhost:3308'];
            $hostsToTry = array_unique($hostsToTry);
        }

        foreach ($hostsToTry as $h) {
            try {
                $dsn = "mysql:host=" . $h . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);

                // Auto-initialize tables & migrations
                init_db_schema($pdo);
                return $pdo;
            } catch (PDOException $e) {
                $errors[] = "MySQL ({$h}/" . DB_NAME . "): " . $e->getMessage();

                // In local development, attempt to create database if it doesn't exist
                if (defined('APP_ENV') && APP_ENV === 'development' && ($e->getCode() == 1049 || stripos($e->getMessage(), 'Unknown database') !== false)) {
                    try {
                        $rootPdo = new PDO("mysql:host=" . $h . ";charset=utf8mb4", DB_USER, DB_PASS, [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ]);
                        $rootPdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                        
                        $pdo = new PDO("mysql:host=" . $h . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        ]);
                        init_db_schema($pdo);
                        return $pdo;
                    } catch (Exception $ex) {
                        $errors[] = "MySQL create DB ({$h}): " . $ex->getMessage();
                    }
                }
            }
        }
    }

    // ─── 2. SQLite High-Speed Local Storage Fallback ─────────────────────────
    // If MySQL server is offline or unreachable on local machine, fall back to SQLite
    // to ensure admin adds, updates, and deletes ALWAYS work 100% reliably.
    try {
        $dataDir = __DIR__ . '/../data';
        if (!is_dir($dataDir)) {
            @mkdir($dataDir, 0755, true);
        }
        $sqliteFile = $dataDir . '/engihub_local.sqlite';
        
        $pdo = new PDO("sqlite:" . $sqliteFile, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        // Enable foreign keys
        $pdo->exec("PRAGMA foreign_keys = ON;");
        
        init_db_schema($pdo);
        return $pdo;
    } catch (Exception $e) {
        $errors[] = "SQLite fallback failed: " . $e->getMessage();
    }

    $errMsg = "All database connection attempts failed:\n" . implode("\n", $errors);
    error_log($errMsg);
    throw new Exception("Database Connection Error: Unable to connect to MySQL or SQLite storage.");
}

function init_db_schema(PDO $pdo): void
{
    $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

    if ($driver === 'sqlite') {
        // SQLite Table Definitions
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tools` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT,
                `slug` TEXT UNIQUE NOT NULL,
                `name` TEXT NOT NULL,
                `category` TEXT NOT NULL DEFAULT 'Cyber Security',
                `description` TEXT NOT NULL,
                `icon` TEXT NOT NULL DEFAULT 'build',
                `color` TEXT NOT NULL DEFAULT 'primary',
                `file_path` TEXT NOT NULL,
                `subdomain` TEXT NOT NULL DEFAULT 'tools',
                `is_active` INTEGER NOT NULL DEFAULT 1,
                `usage_count` INTEGER NOT NULL DEFAULT 0,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `resumes` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT,
                `title` TEXT NOT NULL DEFAULT 'My ATS Resume',
                `full_name` TEXT NOT NULL,
                `email` TEXT NOT NULL,
                `phone` TEXT,
                `location` TEXT,
                `headline` TEXT,
                `summary` TEXT,
                `experience_json` TEXT,
                `education_json` TEXT,
                `skills_json` TEXT,
                `projects_json` TEXT,
                `template_theme` TEXT NOT NULL DEFAULT 'modern',
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `resources` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT,
                `branch` TEXT NOT NULL DEFAULT 'CS',
                `sem` TEXT NOT NULL DEFAULT 'S1',
                `type` TEXT NOT NULL DEFAULT 'Notes',
                `title` TEXT NOT NULL,
                `by_author` TEXT NOT NULL DEFAULT 'Yaswant Admin',
                `file_size` TEXT NOT NULL DEFAULT '1.0 MB',
                `color` TEXT NOT NULL DEFAULT 'primary',
                `download_url` TEXT,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `courses` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT,
                `title` TEXT NOT NULL,
                `tag` TEXT NOT NULL DEFAULT 'General',
                `lessons` INTEGER NOT NULL DEFAULT 10,
                `level` TEXT NOT NULL DEFAULT 'Beginner',
                `color` TEXT NOT NULL DEFAULT 'primary',
                `icon` TEXT NOT NULL DEFAULT 'school',
                `playlist_url` TEXT,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `jobs` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT,
                `title` TEXT NOT NULL,
                `company` TEXT NOT NULL,
                `location` TEXT NOT NULL DEFAULT 'Remote',
                `pay` TEXT NOT NULL DEFAULT '$40/hr',
                `tags` TEXT,
                `color` TEXT NOT NULL DEFAULT 'primary',
                `apply_link` TEXT,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `articles` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT,
                `cat` TEXT NOT NULL DEFAULT 'Technical',
                `title` TEXT NOT NULL,
                `excerpt` TEXT,
                `content` TEXT,
                `author` TEXT NOT NULL DEFAULT 'Yaswant Team',
                `read_time` TEXT NOT NULL DEFAULT '5 min',
                `img` TEXT,
                `is_published` INTEGER NOT NULL DEFAULT 1,
                `views_count` INTEGER NOT NULL DEFAULT 0,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `subscribers` (
                `id` INTEGER PRIMARY KEY AUTOINCREMENT,
                `email` TEXT UNIQUE NOT NULL,
                `status` TEXT NOT NULL DEFAULT 'active',
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            );
        ");

        // Seed initial items if resources table is empty
        $count = $pdo->query("SELECT COUNT(*) FROM resources")->fetchColumn();
        if ($count == 0) {
            $seedStmt = $pdo->prepare("INSERT INTO resources (branch, sem, type, title, by_author, file_size, color, download_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $seeds = [
                ['Tools', 'All', 'ZIP File', 'Cybersecurity 26-in-1 Offline Penetration Testing Tools Suite (.ZIP)', 'Yaswant Dev', '18.4 MB', 'amber', 'api/download_tools_zip.php'],
                ['Tools', 'All', 'ZIP File', 'Full-Stack Web Development Starter Pack & REST API Boilerplate (.ZIP)', 'Yaswant Dev', '6.2 MB', 'cyan', 'https://github.com/yaswantpandey'],
                ['CS', 'All', 'Source Code', 'Data Structures & Algorithms Complete Java & C++ Code Archive (.ZIP)', 'Yaswant Dev', '4.5 MB', 'emerald', 'https://github.com/yaswantpandey'],
                ['CS', 'S3', 'Notes', 'Data Structures & Algorithms Handwritten Complete Notes', 'Yaswant Admin', '4.2 MB', 'emerald', 'https://drive.google.com/'],
                ['CS', 'S4', 'PYQ', 'Operating Systems 2024 End-Sem Solved PYQs with Answers', 'Prof. Vance', '2.8 MB', 'cyan', 'https://drive.google.com/'],
            ];
            foreach ($seeds as $s) {
                $seedStmt->execute($s);
            }
        }

        // Seed initial courses if empty
        $cCount = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
        if ($cCount == 0) {
            $cStmt = $pdo->prepare("INSERT INTO courses (title, tag, lessons, level, color, icon, playlist_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $cSeeds = [
                ['Data Structures & Algorithms in C++ & Java', 'CS Fundamentals', 42, 'Intermediate', 'primary', 'account_tree', null],
                ['Operating Systems & Linux Kernel Deep Dive', 'Systems', 35, 'Advanced', 'secondary', 'memory', null],
                ['Full-Stack Web Development with React & Node', 'Frontend', 50, 'Intermediate', 'primary', 'web', null],
                ['Computer Networks & Cybersecurity Fundamentals', 'Networking', 25, 'Intermediate', 'tertiary', 'lan', null],
            ];
            foreach ($cSeeds as $cs) {
                $cStmt->execute($cs);
            }
        }

        // Seed initial jobs if empty
        $jCount = $pdo->query("SELECT COUNT(*) FROM jobs")->fetchColumn();
        if ($jCount == 0) {
            $jStmt = $pdo->prepare("INSERT INTO jobs (title, company, location, pay, tags, color, apply_link) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $jSeeds = [
                ['Backend Engineering Intern', 'CloudNova Labs', 'Remote', '25,000/month', json_encode(['Python', 'Docker', 'FastAPI']), 'primary', 'https://yaswant.co.in/internship'],
                ['AppSec & Penetration Testing Intern', 'CyberArmor Systems', 'Hybrid (Bengaluru)', '30,000/month', json_encode(['OWASP', 'Linux', 'Security']), 'emerald', 'https://yaswant.co.in/internship'],
            ];
            foreach ($jSeeds as $js) {
                $jStmt->execute($js);
            }
        }

        return;
    }

    // ─── MySQL Schema Initialization & Migrations ────────────────────────────
    $pdo->exec("
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
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

    $pdo->exec("
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
    ");

    $pdo->exec("
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
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `courses` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `tag` VARCHAR(100) NOT NULL DEFAULT 'General',
            `lessons` INT NOT NULL DEFAULT 10,
            `level` VARCHAR(50) NOT NULL DEFAULT 'Beginner',
            `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
            `icon` VARCHAR(50) NOT NULL DEFAULT 'school',
            `playlist_url` VARCHAR(500) NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `jobs` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `company` VARCHAR(255) NOT NULL,
            `location` VARCHAR(255) NOT NULL DEFAULT 'Remote',
            `pay` VARCHAR(100) NOT NULL DEFAULT '$40/hr',
            `tags` TEXT NULL,
            `color` VARCHAR(20) NOT NULL DEFAULT 'primary',
            `apply_link` VARCHAR(500) NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

    $pdo->exec("
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
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

    $pdo->exec("
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
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `subscribers` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(191) UNIQUE NOT NULL,
            `status` VARCHAR(20) NOT NULL DEFAULT 'active',
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

    // ─── Automated Column Migrations for Existing Tables ─────────────────────
    // Ensures existing databases gracefully receive any missing columns
    try {
        $cols = $pdo->query("SHOW COLUMNS FROM `resources` LIKE 'download_url'")->fetchAll();
        if (empty($cols)) {
            $pdo->exec("ALTER TABLE `resources` ADD COLUMN `download_url` VARCHAR(500) NULL AFTER `color`");
        }
    } catch (Exception $e) {}

    try {
        $cols = $pdo->query("SHOW COLUMNS FROM `jobs` LIKE 'apply_link'")->fetchAll();
        if (empty($cols)) {
            $pdo->exec("ALTER TABLE `jobs` ADD COLUMN `apply_link` VARCHAR(500) NULL AFTER `color`");
        }
    } catch (Exception $e) {}

    try {
        $cols = $pdo->query("SHOW COLUMNS FROM `courses` LIKE 'playlist_url'")->fetchAll();
        if (empty($cols)) {
            $pdo->exec("ALTER TABLE `courses` ADD COLUMN `playlist_url` VARCHAR(500) NULL AFTER `icon`");
        }
    } catch (Exception $e) {}
}
