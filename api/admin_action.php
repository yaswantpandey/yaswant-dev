<?php
// api/admin_action.php — Unified Admin Action Handler (Full CRUD Engine)
session_start();
header('Content-Type: application/json; charset=utf-8');

// Disable HTML error display to guarantee 100% clean JSON responses
ini_set('display_errors', '0');
error_reporting(E_ALL);

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

require_once __DIR__ . '/../includes/db.php';

// Safe input extraction helpers
function s(string $key, string $default = ''): string {
    return trim($_POST[$key] ?? $default);
}
function n(string $key, int $default = 0): int {
    return (int)($_POST[$key] ?? $default);
}

try {
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

        default:
            echo json_encode(['success' => false, 'error' => 'Unknown action: ' . htmlspecialchars($action)]);
            break;
    }
} catch (Throwable $e) {
    error_log("admin_action.php Exception: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error'   => 'Database operation failed: ' . $e->getMessage()
    ]);
    exit;
}
