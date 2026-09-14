<?php
// config.php — Central Environment, .env Loader & Hostinger Deployment Configuration

/**
 * Robust Zero-Dependency .env Loader
 * Searches parent folder first (Hostinger root: /home/username/.env), then public_html/.env
 */
function load_env_file(?string $customPath = null): bool
{
    static $loaded = false;
    static $foundPath = null;
    if ($loaded && $customPath === null) {
        return true;
    }

    $candidates = $customPath ? [$customPath] : [
        dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env',                     // 1. One level above public_html (Hostinger root directory)
        __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '.env', // 2. Explicit ../.env
        __DIR__ . DIRECTORY_SEPARATOR . '.env',                              // 3. Inside public_html/.env (fallback / local)
        (isset($_SERVER['DOCUMENT_ROOT']) ? dirname($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR . '.env' : null),
        (isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '.env' : null),
    ];

    @clearstatcache(true);
    $targetFile = null;
    foreach ($candidates as $candidate) {
        if (!empty($candidate) && @is_file($candidate) && @is_readable($candidate)) {
            $targetFile = $candidate;
            break;
        }
    }

    if (!$targetFile) {
        return false;
    }

    $lines = @file($targetFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return false;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || (isset($line[1]) && $line[0] === '/' && $line[1] === '/')) {
            continue;
        }

        if (strpos($line, 'export ') === 0) {
            $line = trim(substr($line, 7));
        }

        if (strpos($line, '=') === false) {
            continue;
        }

        [$name, $value] = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $name)) {
            continue;
        }

        // Strip outer single or double quotes
        $len = strlen($value);
        if ($len >= 2 && (($value[0] === '"' && $value[$len - 1] === '"') || ($value[0] === "'" && $value[$len - 1] === "'"))) {
            $quoteChar = $value[0];
            $value = substr($value, 1, -1);
            if ($quoteChar === '"') {
                $value = str_replace(['\\n', '\\r', '\\t', '\\"', '\\\\'], ["\n", "\r", "\t", '"', '\\'], $value);
            }
        } else {
            // Strip trailing comments if unquoted
            if (($hashPos = strpos($value, ' #')) !== false) {
                $value = trim(substr($value, 0, $hashPos));
            }
            $lower = strtolower($value);
            if ($lower === 'true') {
                $value = '1';
            } elseif ($lower === 'false') {
                $value = '0';
            } elseif ($lower === 'null') {
                $value = '';
            }
        }

        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
        @putenv("{$name}={$value}");
    }

    $loaded = true;
    $foundPath = $targetFile;
    return true;
}

/**
 * Universal Environment Variable Getter
 * Checks $_ENV, $_SERVER, and getenv()
 */
function get_env_var(string $key, $default = null)
{
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
        return $_ENV[$key];
    }
    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
        return $_SERVER[$key];
    }
    $val = getenv($key);
    if ($val !== false && $val !== '') {
        return $val;
    }
    return $default;
}

// Automatically load .env at startup
load_env_file();

// ─── Environment & Host Resolution ───────────────────────────────────────────
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$isLocalHost = ($host === 'localhost' || $host === '127.0.0.1' || strpos($host, 'localhost:') === 0 || strpos($host, '127.0.0.1:') === 0);
$envAppEnv = get_env_var('APP_ENV');
$isLocal = ($envAppEnv !== null) ? in_array(strtolower($envAppEnv), ['development', 'local', 'dev']) : $isLocalHost;

if ($isLocal) {
    define('APP_ENV', 'development');
    define('DB_HOST', get_env_var('DB_HOST') ?: get_env_var('DB_HOSTNAME') ?: '127.0.0.1');
    define('DB_PORT', (int)(get_env_var('DB_PORT') ?: 3306));
    define('DB_USER', get_env_var('DB_USER') ?: get_env_var('DB_USERNAME') ?: 'root');
    define('DB_PASS', get_env_var('DB_PASS') !== null ? get_env_var('DB_PASS') : (get_env_var('DB_PASSWORD') !== null ? get_env_var('DB_PASSWORD') : ''));
    define('DB_NAME', get_env_var('DB_NAME') ?: get_env_var('DB_DATABASE') ?: 'stitch_engihub');

    // Dynamic local site URL detection
    $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? '');
    $curDir = str_replace('\\', '/', __DIR__);
    $relPath = '';
    if (!empty($docRoot) && strpos($curDir, $docRoot) === 0) {
        $relPath = trim(substr($curDir, strlen($docRoot)), '/');
    }
    $defaultLocalUrl = 'http://' . $host . ($relPath ? '/' . $relPath : '');
    define('SITE_URL', rtrim(get_env_var('SITE_URL') ?: get_env_var('APP_URL') ?: ($defaultLocalUrl ?: 'http://localhost/public_html'), '/'));
} else {
    define('APP_ENV', 'production');
    define('DB_HOST', get_env_var('DB_HOST') ?: get_env_var('DB_HOSTNAME') ?: 'localhost');
    define('DB_PORT', (int)(get_env_var('DB_PORT') ?: 3306));
    define('DB_USER', get_env_var('DB_USER') ?: get_env_var('DB_USERNAME') ?: 'u865909543_yaswant');
    define('DB_PASS', get_env_var('DB_PASS') !== null ? get_env_var('DB_PASS') : (get_env_var('DB_PASSWORD') !== null ? get_env_var('DB_PASSWORD') : 'Yaswant739830#'));
    define('DB_NAME', get_env_var('DB_NAME') ?: get_env_var('DB_DATABASE') ?: 'u865909543_stitch_engihub');
    define('SITE_URL', rtrim(get_env_var('SITE_URL') ?: get_env_var('APP_URL') ?: 'https://yaswant.co.in', '/'));
}

// ─── App Version (used for asset cache-busting) ───────────────────────────────
define('APP_VERSION', get_env_var('APP_VERSION') ?: '2.5.0');

// ─── Subdomain URL Map ────────────────────────────────────────────────────────
// All subdomains share the same /public_html/ — no code duplication needed.
// Use these constants for navigation links and canonical tags across all pages.
if ($isLocal) {
    // In local dev, subdomains aren't set up, so fall back to path-based URLs
    define('URL_HOME',        SITE_URL . '/index.php');
    define('URL_RESUME',      SITE_URL . '/resume.php');
    define('URL_RESOURCES',   SITE_URL . '/resources.php');
    define('URL_COURSES',     SITE_URL . '/courses.php');
    define('URL_TOOLS',       SITE_URL . '/tools.php');
    define('URL_BLOG',        SITE_URL . '/blog.php');
    define('URL_INTERNSHIPS', SITE_URL . '/internships.php');
    define('URL_PROJECT',     SITE_URL . '/project/index.php');
    define('URL_DASHBOARD',   SITE_URL . '/dashboard.php');
    define('URL_SEARCH',      SITE_URL . '/search.php');
    define('URL_IMAGE',       SITE_URL . '/image/index.php');
} else {
    define('URL_HOME',        SITE_URL);
    define('URL_RESUME',      'https://resume.yaswant.co.in');
    define('URL_RESOURCES',   'https://resource.yaswant.co.in');
    define('URL_COURSES',     'https://course.yaswant.co.in');
    define('URL_TOOLS',       'https://tools.yaswant.co.in');
    define('URL_BLOG',        'https://blog.yaswant.co.in');
    define('URL_INTERNSHIPS', 'https://internship.yaswant.co.in');
    define('URL_PROJECT',     SITE_URL . '/project/');
    define('URL_DASHBOARD',   SITE_URL . '/dashboard.php');
    define('URL_SEARCH',      SITE_URL . '/search.php');
    define('URL_IMAGE',       'https://image.yaswant.co.in');
}

// ─── Subdomain Detection ──────────────────────────────────────────────────────
// Returns: 'resume' | 'resource' | 'course' | 'tools' | 'blog' | 'internship' | 'project' | 'main'
function detect_subdomain(): string {
    $host = $_SERVER['HTTP_HOST'] ?? '';
    $subdomainMap = [
        'resume.'     => 'resume',
        'resource.'   => 'resource',
        'course.'     => 'course',
        'tools.'      => 'tools',
        'blog.'       => 'blog',
        'internship.' => 'internship',
        'project.'    => 'project',
        'image.'      => 'image',
    ];
    foreach ($subdomainMap as $prefix => $name) {
        if (strpos($host, $prefix) === 0) {
            return $name;
        }
    }
    return 'main';
}

// ─── Canonical URL Builder ────────────────────────────────────────────────────
// Returns the canonical URL for the current page, subdomain-aware.
function get_canonical_url(string $page = ''): string {
    $pageMap = [
        'resume'      => URL_RESUME,
        'resources'   => URL_RESOURCES,
        'courses'     => URL_COURSES,
        'tools'       => URL_TOOLS,
        'blog'        => URL_BLOG,
        'internships' => URL_INTERNSHIPS,
        'project'     => URL_PROJECT,
        'dashboard'   => URL_DASHBOARD,
        'search'      => URL_SEARCH,
        ''            => URL_HOME,
        'index'       => URL_HOME,
    ];
    // Strip .php extension if present
    $page = preg_replace('/\.php$/', '', $page);
    return $pageMap[$page] ?? (URL_HOME . ($page ? '/' . $page . '.php' : '/'));
}

// ─── FTP Deployment Configuration for Hostinger ───────────────────────────────
define('FTP_HOST',       get_env_var('FTP_HOST') ?: '82.25.125.43');
define('FTP_USER',       get_env_var('FTP_USER') ?: 'u865909543.yaswant.co.in');
define('FTP_PASS',       get_env_var('FTP_PASS') !== null ? get_env_var('FTP_PASS') : 'Yaswant739830#');
define('FTP_PORT',       (int)(get_env_var('FTP_PORT') ?: 21));
define('FTP_REMOTE_DIR', get_env_var('FTP_REMOTE_DIR') ?: '/public_html/');

// ─── Admin Credentials ────────────────────────────────────────────────────────
define('ADMIN_USER', get_env_var('ADMIN_USER') ?: get_env_var('ADMIN_USERNAME') ?: 'admin');
define('ADMIN_PASS', get_env_var('ADMIN_PASS') !== null ? get_env_var('ADMIN_PASS') : (get_env_var('ADMIN_PASSWORD') !== null ? get_env_var('ADMIN_PASSWORD') : 'admin123'));

