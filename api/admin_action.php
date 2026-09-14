<?php
// api/admin_action.php — Unified Admin Action Handler (Full CRUD Engine)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json; charset=utf-8');

// Disable HTML error display to guarantee 100% clean JSON responses
ini_set('display_errors', '0');
error_reporting(E_ALL);

// Guarantee clean JSON even in the event of an unrecoverable PHP fatal error
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
        }
        echo json_encode([
            'success' => false,
            'error'   => 'Fatal Error: ' . $error['message'] . ' in ' . basename($error['file']) . ':' . $error['line']
        ]);
    }
});

// Session authentication check
if (empty($_SESSION['admin_logged_in'])) {
    echo json_encode([
        'success'    => false,
        'logged_out' => true,
        'error'      => 'Your admin session has expired. Please log in again.'
    ]);
    exit;
}

// Refresh activity timestamp
$_SESSION['last_activity'] = time();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'error'   => 'Method not allowed. POST required.'
    ]);
    exit;
}

// Safe input extraction helpers
if (!function_exists('s')) {
    function s(string $key, string $default = ''): string {
        return trim($_POST[$key] ?? $default);
    }
}
if (!function_exists('n')) {
    function n(string $key, int $default = 0): int {
        return (int)($_POST[$key] ?? $default);
    }
}

try {
    require_once __DIR__ . '/../includes/db.php';
    $action = $_POST['action'] ?? '';
    $pdo = get_db();

    switch ($action) {

        // ════════════════════════════════════════════════════
        //  RESOURCES CRUD
        // ════════════════════════════════════════════════════
        case 'add_resource':
            $title        = s('title');
            $branch       = s('branch', 'CS');
            $sem          = s('sem', 'S1');
            $type         = s('type', 'Notes');
            $by           = s('by', 'Yaswant Admin');
            $size         = s('size', '2.0 MB');
            $color        = s('color', 'primary');
            $download_url = s('download_url');

            if (!$title) {
                echo json_encode(['success' => false, 'error' => 'Resource title is required']);
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO resources (branch, sem, type, title, by_author, file_size, color, download_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$branch, $sem, $type, $title, $by, $size, $color, $download_url]);
            echo json_encode(['success' => true, 'message' => 'Resource added successfully', 'id' => $pdo->lastInsertId()]);
            break;

        case 'edit_resource':
            $id           = n('id');
            $title        = s('title');
            $branch       = s('branch', 'CS');
            $sem          = s('sem', 'S1');
            $type         = s('type', 'Notes');
            $by           = s('by', 'Yaswant Admin');
            $size         = s('size', '2.0 MB');
            $color        = s('color', 'primary');
            $download_url = s('download_url');

            if (!$id || !$title) {
                echo json_encode(['success' => false, 'error' => 'Invalid resource parameters']);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE resources SET title=?, branch=?, sem=?, type=?, by_author=?, file_size=?, color=?, download_url=? WHERE id=?");
            $stmt->execute([$title, $branch, $sem, $type, $by, $size, $color, $download_url, $id]);
            echo json_encode(['success' => true, 'message' => 'Resource updated successfully']);
            break;

        case 'delete_resource':
            $id = n('id');
            if (!$id) {
                echo json_encode(['success' => false, 'error' => 'Invalid resource ID']);
                exit;
            }
            $pdo->prepare("DELETE FROM resources WHERE id=?")->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Resource deleted']);
            break;

        // ════════════════════════════════════════════════════
        //  COURSES CRUD
        // ════════════════════════════════════════════════════
        case 'add_course':
            $title        = s('title');
            $tag          = s('tag', 'General');
            $lessons      = n('lessons', 20);
            $level        = s('level', 'Beginner');
            $color        = s('color', 'primary');
            $icon         = s('icon', 'school');
            $playlist_url = s('playlist_url');
            $description  = s('description');

            if (!$title) {
                echo json_encode(['success' => false, 'error' => 'Course title is required']);
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO courses (title, tag, lessons, level, color, icon, playlist_url, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $tag, $lessons, $level, $color, $icon, $playlist_url, $description]);
            echo json_encode(['success' => true, 'message' => 'Course published to platform', 'id' => $pdo->lastInsertId()]);
            break;

        case 'edit_course':
            $id           = n('id');
            $title        = s('title');
            $tag          = s('tag', 'General');
            $lessons      = n('lessons', 20);
            $level        = s('level', 'Beginner');
            $color        = s('color', 'primary');
            $icon         = s('icon', 'school');
            $playlist_url = s('playlist_url');
            $description  = s('description');

            if (!$id || !$title) {
                echo json_encode(['success' => false, 'error' => 'Invalid course parameters']);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE courses SET title=?, tag=?, lessons=?, level=?, color=?, icon=?, playlist_url=?, description=? WHERE id=?");
            $stmt->execute([$title, $tag, $lessons, $level, $color, $icon, $playlist_url, $description, $id]);
            echo json_encode(['success' => true, 'message' => 'Course updated successfully']);
            break;

        case 'delete_course':
            $id = n('id');
            if (!$id) {
                echo json_encode(['success' => false, 'error' => 'Invalid course ID']);
                exit;
            }
            $pdo->prepare("DELETE FROM courses WHERE id=?")->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Course removed from platform']);
            break;

        // ════════════════════════════════════════════════════
        //  JOBS / INTERNSHIPS CRUD
        // ════════════════════════════════════════════════════
        case 'add_job':
            $title     = s('title');
            $company   = s('company');
            $location  = s('location', 'Remote');
            $pay       = s('pay', '₹20,000/month');
            $tagsStr   = s('tags', 'Software, Engineering');
            $color     = s('color', 'primary');
            $apply_url = s('apply_url');
            $deadline  = s('deadline');

            if (!$title || !$company) {
                echo json_encode(['success' => false, 'error' => 'Role title and company are required']);
                exit;
            }

            $tagsJson = json_encode(array_values(array_filter(array_map('trim', explode(',', $tagsStr)))));
            $stmt = $pdo->prepare("INSERT INTO jobs (title, company, location, pay, tags, color, apply_url, apply_link, deadline) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $company, $location, $pay, $tagsJson, $color, $apply_url, $apply_url, $deadline ?: null]);
            echo json_encode(['success' => true, 'message' => 'Internship posted live', 'id' => $pdo->lastInsertId()]);
            break;

        case 'edit_job':
            $id        = n('id');
            $title     = s('title');
            $company   = s('company');
            $location  = s('location', 'Remote');
            $pay       = s('pay', '₹20,000/month');
            $tagsStr   = s('tags', 'Software, Engineering');
            $apply_url = s('apply_url');
            $deadline  = s('deadline');

            if (!$id || !$title || !$company) {
                echo json_encode(['success' => false, 'error' => 'Invalid internship parameters']);
                exit;
            }

            $tagsJson = json_encode(array_values(array_filter(array_map('trim', explode(',', $tagsStr)))));
            $stmt = $pdo->prepare("UPDATE jobs SET title=?, company=?, location=?, pay=?, tags=?, apply_url=?, apply_link=?, deadline=? WHERE id=?");
            $stmt->execute([$title, $company, $location, $pay, $tagsJson, $apply_url, $apply_url, $deadline ?: null, $id]);
            echo json_encode(['success' => true, 'message' => 'Internship updated successfully']);
            break;

        case 'delete_job':
            $id = n('id');
            if (!$id) {
                echo json_encode(['success' => false, 'error' => 'Invalid job ID']);
                exit;
            }
            $pdo->prepare("DELETE FROM jobs WHERE id=?")->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Job posting deleted']);
            break;

        // ════════════════════════════════════════════════════
        //  BLOG ARTICLES CRUD
        // ════════════════════════════════════════════════════
        case 'add_article':
            $title   = s('title');
            $cat     = s('cat', 'Technical');
            $excerpt = s('excerpt');
            $content = $_POST['content'] ?? '';
            $author  = s('author', 'Yaswant Team');
            $read    = s('read', '5 min');
            $img     = s('img', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97');

            if (!$title) {
                echo json_encode(['success' => false, 'error' => 'Article title is required']);
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO articles (cat, title, excerpt, content, author, read_time, img) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$cat, $title, $excerpt, $content, $author, $read, $img]);
            echo json_encode(['success' => true, 'message' => 'Article published successfully', 'id' => $pdo->lastInsertId()]);
            break;

        case 'edit_article':
            $id      = n('id');
            $title   = s('title');
            $cat     = s('cat', 'Technical');
            $excerpt = s('excerpt');
            $content = $_POST['content'] ?? '';
            $author  = s('author', 'Yaswant Team');
            $read    = s('read', '5 min');
            $img     = s('img', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97');

            if (!$id || !$title) {
                echo json_encode(['success' => false, 'error' => 'Invalid article parameters']);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE articles SET title=?, cat=?, excerpt=?, content=?, author=?, read_time=?, img=? WHERE id=?");
            $stmt->execute([$title, $cat, $excerpt, $content, $author, $read, $img, $id]);
            echo json_encode(['success' => true, 'message' => 'Article updated successfully']);
            break;

        case 'delete_article':
            $id = n('id');
            if (!$id) {
                echo json_encode(['success' => false, 'error' => 'Invalid article ID']);
                exit;
            }
            $pdo->prepare("DELETE FROM articles WHERE id=?")->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Article deleted']);
            break;

        // ════════════════════════════════════════════════════
        //  SUBSCRIBERS CRUD
        // ════════════════════════════════════════════════════
        case 'delete_subscriber':
            $email = s('email');
            if (!$email) {
                echo json_encode(['success' => false, 'error' => 'Email is required']);
                exit;
            }
            $pdo->prepare("DELETE FROM subscribers WHERE email=?")->execute([$email]);
            echo json_encode(['success' => true, 'message' => 'Subscriber removed']);
            break;

        // ════════════════════════════════════════════════════
        //  STATS REFRESH
        // ════════════════════════════════════════════════════
        case 'get_stats':
            $stats = [];
            foreach (['resources', 'courses', 'jobs', 'articles', 'subscribers'] as $table) {
                try {
                    $stats[$table] = (int) $pdo->query("SELECT COUNT(*) FROM `{$table}`")->fetchColumn();
                } catch (Exception $e) {
                    $stats[$table] = 0;
                }
            }
            echo json_encode(['success' => true, 'stats' => $stats]);
            break;

        // ════════════════════════════════════════════════════
        //  ARTICLE STATUS TOGGLE (published / draft)
        // ════════════════════════════════════════════════════
        case 'toggle_article_status':
            $id = n('id');
            if (!$id) {
                echo json_encode(['success' => false, 'error' => 'Invalid article ID']);
                exit;
            }
            try {
                // Add status column if not present
                $pdo->exec("ALTER TABLE articles ADD COLUMN status VARCHAR(20) NOT NULL DEFAULT 'published'");
            } catch (Exception $e) { /* column already exists */ }
            $current = $pdo->prepare("SELECT status FROM articles WHERE id=?");
            $current->execute([$id]);
            $row = $current->fetch(PDO::FETCH_ASSOC);
            $newStatus = ($row && $row['status'] === 'published') ? 'draft' : 'published';
            $pdo->prepare("UPDATE articles SET status=? WHERE id=?")->execute([$newStatus, $id]);
            admin_log($pdo, 'article_status', "Article #$id set to $newStatus");
            echo json_encode(['success' => true, 'status' => $newStatus, 'message' => "Article set to $newStatus"]);
            break;

        // ════════════════════════════════════════════════════
        //  ANNOUNCEMENTS CRUD
        // ════════════════════════════════════════════════════
        case 'get_announcements':
            try {
                $pdo->exec("CREATE TABLE IF NOT EXISTS announcements (
                    id INTEGER PRIMARY KEY AUTO_INCREMENT,
                    message TEXT NOT NULL,
                    type VARCHAR(20) DEFAULT 'info',
                    active TINYINT(1) DEFAULT 1,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                ) CHARACTER SET utf8mb4");
            } catch (Exception $e) { /* table exists */ }
            $rows = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'announcements' => $rows]);
            break;

        case 'add_announcement':
            $message = s('message');
            $type    = s('type', 'info');
            if (!$message) {
                echo json_encode(['success' => false, 'error' => 'Announcement message is required']);
                exit;
            }
            try {
                $pdo->exec("CREATE TABLE IF NOT EXISTS announcements (
                    id INTEGER PRIMARY KEY AUTO_INCREMENT,
                    message TEXT NOT NULL,
                    type VARCHAR(20) DEFAULT 'info',
                    active TINYINT(1) DEFAULT 1,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                ) CHARACTER SET utf8mb4");
            } catch (Exception $e) { /* table exists */ }
            $pdo->prepare("INSERT INTO announcements (message, type) VALUES (?, ?)")->execute([$message, $type]);
            admin_log($pdo, 'announcement_add', "Added: " . substr($message, 0, 80));
            echo json_encode(['success' => true, 'message' => 'Announcement published', 'id' => $pdo->lastInsertId()]);
            break;

        case 'delete_announcement':
            $id = n('id');
            if (!$id) {
                echo json_encode(['success' => false, 'error' => 'Invalid announcement ID']);
                exit;
            }
            $pdo->prepare("DELETE FROM announcements WHERE id=?")->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Announcement removed']);
            break;

        case 'toggle_announcement':
            $id = n('id');
            if (!$id) {
                echo json_encode(['success' => false, 'error' => 'Invalid announcement ID']);
                exit;
            }
            $row = $pdo->prepare("SELECT active FROM announcements WHERE id=?");
            $row->execute([$id]);
            $a = $row->fetch(PDO::FETCH_ASSOC);
            $newActive = $a ? ($a['active'] ? 0 : 1) : 1;
            $pdo->prepare("UPDATE announcements SET active=? WHERE id=?")->execute([$newActive, $id]);
            echo json_encode(['success' => true, 'active' => $newActive]);
            break;

        // ════════════════════════════════════════════════════
        //  BULK DELETE SUBSCRIBERS
        // ════════════════════════════════════════════════════
        case 'bulk_delete_subscribers':
            $emailsRaw = $_POST['emails'] ?? '';
            $emails = array_filter(array_map('trim', explode(',', $emailsRaw)));
            if (empty($emails)) {
                echo json_encode(['success' => false, 'error' => 'No emails provided']);
                exit;
            }
            $placeholders = implode(',', array_fill(0, count($emails), '?'));
            $pdo->prepare("DELETE FROM subscribers WHERE email IN ($placeholders)")->execute($emails);
            admin_log($pdo, 'bulk_delete_subscribers', count($emails) . " subscriber(s) removed");
            echo json_encode(['success' => true, 'message' => count($emails) . ' subscriber(s) removed']);
            break;

        // ════════════════════════════════════════════════════
        //  ADMIN PASSWORD CHANGE
        // ════════════════════════════════════════════════════
        case 'change_password':
            $current  = s('current_password');
            $newPass  = s('new_password');
            $confirm  = s('confirm_password');
            if (!$current || !$newPass || !$confirm) {
                echo json_encode(['success' => false, 'error' => 'All password fields are required']);
                exit;
            }
            if ($newPass !== $confirm) {
                echo json_encode(['success' => false, 'error' => 'New passwords do not match']);
                exit;
            }
            if (strlen($newPass) < 8) {
                echo json_encode(['success' => false, 'error' => 'New password must be at least 8 characters']);
                exit;
            }
            // Verify current password against stored (env or default)
            $storedPass = getenv('ADMIN_PASSWORD') ?: (defined('ADMIN_PASSWORD') ? ADMIN_PASSWORD : '');
            if (!$storedPass || !password_verify($current, $storedPass)) {
                // Also try plain comparison for legacy
                if ($current !== $storedPass) {
                    echo json_encode(['success' => false, 'error' => 'Current password is incorrect']);
                    exit;
                }
            }
            $hashed = password_hash($newPass, PASSWORD_BCRYPT);
            admin_log($pdo, 'password_change', 'Admin password changed');
            echo json_encode(['success' => true, 'message' => 'Password updated. Please update your .env file with: ADMIN_PASSWORD=' . $hashed]);
            break;

        // ════════════════════════════════════════════════════
        //  ACTIVITY LOG
        // ════════════════════════════════════════════════════
        case 'get_activity_log':
            try {
                ensure_activity_log_table($pdo);
                $rows = $pdo->query("SELECT * FROM admin_activity_log ORDER BY created_at DESC LIMIT 100")->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'log' => $rows]);
            } catch (Exception $e) {
                echo json_encode(['success' => true, 'log' => []]);
            }
            break;

        case 'clear_activity_log':
            try {
                ensure_activity_log_table($pdo);
                $pdo->exec("DELETE FROM admin_activity_log");
                echo json_encode(['success' => true, 'message' => 'Activity log cleared']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            break;

        // ════════════════════════════════════════════════════
        //  QUICK NOTES (Admin sticky notes)
        // ════════════════════════════════════════════════════
        case 'save_note':
            $note = s('note');
            try {
                $pdo->exec("CREATE TABLE IF NOT EXISTS admin_notes (
                    id INTEGER PRIMARY KEY AUTO_INCREMENT,
                    note TEXT,
                    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) CHARACTER SET utf8mb4");
                $exists = $pdo->query("SELECT COUNT(*) FROM admin_notes")->fetchColumn();
                if ($exists) {
                    $pdo->prepare("UPDATE admin_notes SET note=?, updated_at=NOW() WHERE 1 LIMIT 1")->execute([$note]);
                } else {
                    $pdo->prepare("INSERT INTO admin_notes (note) VALUES (?)")->execute([$note]);
                }
                echo json_encode(['success' => true, 'message' => 'Note saved']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
            break;

        case 'get_note':
            try {
                $pdo->exec("CREATE TABLE IF NOT EXISTS admin_notes (
                    id INTEGER PRIMARY KEY AUTO_INCREMENT,
                    note TEXT,
                    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                ) CHARACTER SET utf8mb4");
                $row = $pdo->query("SELECT note, updated_at FROM admin_notes LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'note' => $row['note'] ?? '', 'updated_at' => $row['updated_at'] ?? '']);
            } catch (Exception $e) {
                echo json_encode(['success' => true, 'note' => '', 'updated_at' => '']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'error' => 'Unknown action: ' . htmlspecialchars($action)]);
            break;
    }

    // Log the write action (non-GET) to activity log
    if (!in_array($action, ['get_stats', 'get_announcements', 'get_activity_log', 'get_note', ''])) {
        try { admin_log($pdo, $action, ''); } catch (Exception $e) { /* silent */ }
    }

} catch (Throwable $e) {
    error_log("admin_action.php Exception: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error'   => 'Database operation failed: ' . $e->getMessage()
    ]);
    exit;
}

// ════════════════════════════════════════════════════
//  HELPER: Activity Log
// ════════════════════════════════════════════════════
function ensure_activity_log_table(PDO $pdo): void {
    $pdo->exec("CREATE TABLE IF NOT EXISTS admin_activity_log (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        action VARCHAR(80) NOT NULL,
        detail TEXT,
        ip VARCHAR(45),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) CHARACTER SET utf8mb4");
}

function admin_log(PDO $pdo, string $action, string $detail = ''): void {
    try {
        ensure_activity_log_table($pdo);
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $pdo->prepare("INSERT INTO admin_activity_log (action, detail, ip) VALUES (?, ?, ?)")
            ->execute([$action, $detail, $ip]);
    } catch (Exception $e) { /* silent */ }
}
