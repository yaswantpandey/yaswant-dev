<?php
// config.php — Central Environment & Hostinger Deployment Configuration

$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$isLocal = ($host === 'localhost' || $host === '127.0.0.1' || strpos($host, 'localhost:') === 0);

if ($isLocal) {
    define('APP_ENV', 'development');
    define('DB_HOST', '127.0.0.1');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'stitch_engihub');
    define('SITE_URL', 'http://localhost/stitch_engihub_os');
} else {
    define('APP_ENV', 'production');
    define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('DB_USER', getenv('DB_USER') ?: 'u865909543_yaswant');
    define('DB_PASS', getenv('DB_PASS') ?: 'Yaswant739830#');
    define('DB_NAME', getenv('DB_NAME') ?: 'u865909543_stitch_engihub');
    define('SITE_URL', 'https://yaswant.co.in');
}

// ─── App Version (used for asset cache-busting) ───────────────────────────────
define('APP_VERSION', '2.5.0');

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
    define('URL_HOME',        'https://yaswant.co.in');
    define('URL_RESUME',      'https://resume.yaswant.co.in');
    define('URL_RESOURCES',   'https://resource.yaswant.co.in');
    define('URL_COURSES',     'https://course.yaswant.co.in');
    define('URL_TOOLS',       'https://tools.yaswant.co.in');
    define('URL_BLOG',        'https://blog.yaswant.co.in');
    define('URL_INTERNSHIPS', 'https://internship.yaswant.co.in');
    define('URL_PROJECT',     'https://yaswant.co.in/project/');
    define('URL_DASHBOARD',   'https://yaswant.co.in/dashboard.php');
    define('URL_SEARCH',      'https://yaswant.co.in/search.php');
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
define('FTP_HOST',       getenv('FTP_HOST')  ?: '82.25.125.43');
define('FTP_USER',       getenv('FTP_USER')  ?: 'u865909543.yaswant.co.in');
define('FTP_PASS',       getenv('FTP_PASS')  ?: 'Yaswant739830#');
define('FTP_PORT',       21);
define('FTP_REMOTE_DIR', '/public_html/');

// ─── Admin Credentials ────────────────────────────────────────────────────────
define('ADMIN_USER', getenv('ADMIN_USER') ?: 'admin');
define('ADMIN_PASS', getenv('ADMIN_PASS') ?: 'admin123');
