<?php
// includes/db.php — MySQL PDO Database Connection & Auto-Schema Initializer
require_once __DIR__ . '/../config.php';

function get_db(): PDO
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    try {
        // Direct database connection with optimal PDO options
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

        // Auto-initialize tables if missing
        init_db_schema($pdo);

        return $pdo;
    } catch (PDOException $e) {
        // In local development, try creating database if it does not exist
        if (defined('APP_ENV') && APP_ENV === 'development') {
            try {
                $rootPdo = new PDO(
                    "mysql:host=" . DB_HOST . ";charset=utf8mb4",
                    DB_USER,
                    DB_PASS,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
                $rootPdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                
                $pdo = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
                init_db_schema($pdo);
                return $pdo;
            } catch (Exception $ex) {
                error_log("Local DB Create Fallback Failed: " . $ex->getMessage());
            }
        }
        error_log("Database Connection Error: " . $e->getMessage());
        throw new Exception("Database Connection Error: " . $e->getMessage());
    }
}

function init_db_schema(PDO $pdo): void
{
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

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `admin_users` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(50) UNIQUE NOT NULL,
            `email` VARCHAR(191) UNIQUE NOT NULL,
            `password_hash` VARCHAR(255) NOT NULL,
            `role` VARCHAR(20) NOT NULL DEFAULT 'superadmin',
            `last_login` DATETIME NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `analytics` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `ip_address` VARCHAR(45) NULL,
            `page_url` VARCHAR(255) NOT NULL,
            `user_agent` VARCHAR(500) NULL,
            `referrer` VARCHAR(500) NULL,
            `visited_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
}
