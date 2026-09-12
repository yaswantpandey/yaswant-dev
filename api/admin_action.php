<?php
// api/admin_action.php — Universal Admin Action Handler (MySQL & SQLite Compatible)
error_reporting(0);
ini_set('display_errors', 0);

session_start();
header('Content-Type: application/json');

// Refresh session activity timestamp on every interaction
$_SESSION['last_activity'] = time();

if (empty($_SESSION['admin_logged_in'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Admin session expired or not authenticated. Please refresh and log in again.'
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method. POST is required.'
    ]);
    exit;
}

require_once __DIR__ . '/../includes/db.php';

function handleResourceFileUpload(?array $file, ?string $currentUrl = null): array {
    if (!$file || empty($file['name']) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return ['url' => null, 'size' => null];
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("File upload failed (error code: " . $file['error'] . ")");
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['zip', 'rar', '7z', 'tar', 'gz', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'txt', 'py', 'java', 'cpp', 'c', 'js', 'json', 'sql', 'md', 'sh', 'apk', 'png', 'jpg', 'webp'];
    if (!in_array($ext, $allowed, true)) {
        throw new Exception("Disallowed file type: .$ext. Allowed formats: .zip, .rar, .7z, .tar, .gz, .pdf, source code, docs.");
    }

    $uploadDir = __DIR__ . '/../uploads/resources/';
    if (!is_dir($uploadDir)) {
        @mkdir($uploadDir, 0755, true);
    }

    $origBase = pathinfo($file['name'], PATHINFO_FILENAME);
    $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $origBase);
    $cleanBase = substr($cleanBase, 0, 45) ?: 'file';
    $newFileName = 'res_' . time() . '_' . $cleanBase . '.' . $ext;
    $targetPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        throw new Exception("Could not save uploaded file to server storage.");
    }

    $bytes = (int) $file['size'];
    $units = ['B', 'KB', 'MB', 'GB'];
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $formattedSize = round($bytes / pow(1024, $pow), 1) . ' ' . $units[$pow];
    $webUrl = 'uploads/resources/' . $newFileName;

    // Clean up old file if stored in uploads/resources/
    if ($currentUrl && strpos($currentUrl, 'uploads/resources/') === 0) {
        $oldPath = __DIR__ . '/../' . $currentUrl;
        if (is_file($oldPath)) {
            @unlink($oldPath);
        }
    }

    return ['url' => $webUrl, 'size' => $formattedSize];
}

try {
    $pdo = get_db();
    $action = $_POST['action'] ?? '';

    switch ($action) {

        // ─── RESOURCES & TOOLS ───────────────────────────────────────────────
        case 'add_resource':
            $title  = trim($_POST['title'] ?? '');
            $branch = trim($_POST['branch'] ?? 'Tools');
            $sem    = trim($_POST['sem'] ?? 'All');
            $type   = trim($_POST['type'] ?? 'ZIP File');
            $by     = trim($_POST['by'] ?? 'Yaswant Dev');
            $size   = trim($_POST['size'] ?? '');
            $color  = trim($_POST['color'] ?? 'amber');
            $url    = trim($_POST['url'] ?? '');

            if (!$title) {
                echo json_encode(['success' => false, 'error' => 'Title is required.']);
                exit;
            }

            $uploadResult = handleResourceFileUpload($_FILES['file'] ?? null);
            if (!empty($uploadResult['url'])) {
                $url = $uploadResult['url'];
                if (empty($size) || $size === '5.0 MB' || $size === '2.0 MB') {
                    $size = $uploadResult['size'];
                }
            }

            if (empty($size)) {
                $size = ($type === 'ZIP File' || $type === 'Tools') ? '5.0 MB' : '2.0 MB';
            }

            $stmt = $pdo->prepare("INSERT INTO resources (branch, sem, type, title, by_author, file_size, color, download_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$branch, $sem, $type, $title, $by, $size, $color, $url ?: null]);

            echo json_encode(['success' => true, 'message' => 'Resource & tool package added successfully!']);
            break;

        case 'edit_resource':
            $id     = (int) ($_POST['id'] ?? 0);
            $title  = trim($_POST['title'] ?? '');
            $branch = trim($_POST['branch'] ?? 'Tools');
            $sem    = trim($_POST['sem'] ?? 'All');
            $type   = trim($_POST['type'] ?? 'ZIP File');
            $by     = trim($_POST['by'] ?? 'Yaswant Dev');
            $size   = trim($_POST['size'] ?? '');
            $color  = trim($_POST['color'] ?? 'amber');
            $url    = trim($_POST['url'] ?? '');

            if (!$id || !$title) {
                echo json_encode(['success' => false, 'error' => 'Resource ID and Title are required.']);
                exit;
            }

            $currStmt = $pdo->prepare("SELECT download_url, file_size FROM resources WHERE id = ?");
            $currStmt->execute([$id]);
            $currentRes = $currStmt->fetch();
            $currentUrl = $currentRes['download_url'] ?? null;

            $uploadResult = handleResourceFileUpload($_FILES['file'] ?? null, $currentUrl);
            if (!empty($uploadResult['url'])) {
                $url = $uploadResult['url'];
                if (empty($size) || $size === '5.0 MB' || $size === '2.0 MB') {
                    $size = $uploadResult['size'];
                }
            }

            if (empty($url) && $currentUrl) {
                $url = $currentUrl;
            }
            if (empty($size)) {
                $size = $currentRes['file_size'] ?? '2.0 MB';
            }

            $stmt = $pdo->prepare("UPDATE resources SET title = ?, branch = ?, sem = ?, type = ?, by_author = ?, file_size = ?, color = ?, download_url = ? WHERE id = ?");
            $stmt->execute([$title, $branch, $sem, $type, $by, $size, $color, $url ?: null, $id]);

            echo json_encode(['success' => true, 'message' => 'Resource updated successfully!']);
            break;

        case 'delete_resource':
            $id = (int) ($_POST['id'] ?? 0);
            $currStmt = $pdo->prepare("SELECT download_url FROM resources WHERE id = ?");
            $currStmt->execute([$id]);
            $res = $currStmt->fetch();
            if ($res && !empty($res['download_url']) && strpos($res['download_url'], 'uploads/resources/') === 0) {
                $f = __DIR__ . '/../' . $res['download_url'];
                if (is_file($f)) {
                    @unlink($f);
                }
            }
            $stmt = $pdo->prepare("DELETE FROM resources WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Resource deleted from database.']);
            break;

        // ─── COURSES ─────────────────────────────────────────────────────────
        case 'add_course':
            $title       = trim($_POST['title'] ?? '');
            $tag         = trim($_POST['tag'] ?? 'General');
            $lessons     = (int) ($_POST['lessons'] ?? 20);
            $level       = trim($_POST['level'] ?? 'Beginner');
            $color       = trim($_POST['color'] ?? 'primary');
            $icon        = trim($_POST['icon'] ?? 'school');
            $playlistUrl = trim($_POST['playlist_url'] ?? '');

            if (!$title) {
                echo json_encode(['success' => false, 'error' => 'Course title is required.']);
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO courses (title, tag, lessons, level, color, icon, playlist_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $tag, $lessons, $level, $color, $icon, $playlistUrl ?: null]);

            echo json_encode(['success' => true, 'message' => 'Course added to database!']);
            break;

        case 'edit_course':
            $id          = (int) ($_POST['id'] ?? 0);
            $title       = trim($_POST['title'] ?? '');
            $tag         = trim($_POST['tag'] ?? 'General');
            $lessons     = (int) ($_POST['lessons'] ?? 20);
            $level       = trim($_POST['level'] ?? 'Beginner');
            $playlistUrl = trim($_POST['playlist_url'] ?? '');

            if (!$id || !$title) {
                echo json_encode(['success' => false, 'error' => 'Invalid course parameters.']);
                exit;
            }

            if (!empty($playlistUrl)) {
                $stmt = $pdo->prepare("UPDATE courses SET title = ?, tag = ?, lessons = ?, level = ?, playlist_url = ? WHERE id = ?");
                $stmt->execute([$title, $tag, $lessons, $level, $playlistUrl, $id]);
            } else {
                $stmt = $pdo->prepare("UPDATE courses SET title = ?, tag = ?, lessons = ?, level = ? WHERE id = ?");
                $stmt->execute([$title, $tag, $lessons, $level, $id]);
            }

            echo json_encode(['success' => true, 'message' => 'Course updated successfully!']);
            break;

        case 'delete_course':
            $id = (int) ($_POST['id'] ?? 0);
            $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Course deleted from database.']);
            break;

        // ─── INTERNSHIPS / JOBS ──────────────────────────────────────────────
        case 'add_job':
            $title    = trim($_POST['title'] ?? '');
            $company  = trim($_POST['company'] ?? '');
            $location = trim($_POST['location'] ?? 'Remote');
            $pay      = trim($_POST['pay'] ?? '$40/hr');
            $tagsStr  = trim($_POST['tags'] ?? 'Software, Engineering');
            $color    = trim($_POST['color'] ?? 'primary');
            $link     = trim($_POST['link'] ?? '');

            if (!$title || !$company) {
                echo json_encode(['success' => false, 'error' => 'Title and company are required.']);
                exit;
            }

            $tagsJson = json_encode(array_filter(array_map('trim', explode(',', $tagsStr))));
            $stmt = $pdo->prepare("INSERT INTO jobs (title, company, location, pay, tags, color, apply_link) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $company, $location, $pay, $tagsJson, $color, $link ?: null]);

            echo json_encode(['success' => true, 'message' => 'Internship role posted to database!']);
            break;

        case 'edit_job':
            $id       = (int) ($_POST['id'] ?? 0);
            $title    = trim($_POST['title'] ?? '');
            $company  = trim($_POST['company'] ?? '');
            $location = trim($_POST['location'] ?? 'Remote');
            $pay      = trim($_POST['pay'] ?? '$40/hr');
            $tagsStr  = trim($_POST['tags'] ?? 'Software, Engineering');
            $link     = trim($_POST['link'] ?? '');

            if (!$id || !$title || !$company) {
                echo json_encode(['success' => false, 'error' => 'Invalid internship parameters.']);
                exit;
            }

            $tagsJson = json_encode(array_filter(array_map('trim', explode(',', $tagsStr))));
            $stmt = $pdo->prepare("UPDATE jobs SET title = ?, company = ?, location = ?, pay = ?, tags = ?, apply_link = ? WHERE id = ?");
            $stmt->execute([$title, $company, $location, $pay, $tagsJson, $link ?: null, $id]);

            echo json_encode(['success' => true, 'message' => 'Internship updated successfully!']);
            break;

        case 'delete_job':
            $id = (int) ($_POST['id'] ?? 0);
            $stmt = $pdo->prepare("DELETE FROM jobs WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Job posting deleted.']);
            break;

        // ─── BLOG ARTICLES ───────────────────────────────────────────────────
        case 'add_article':
            $title   = trim($_POST['title'] ?? '');
            $cat     = trim($_POST['cat'] ?? 'Technical');
            $excerpt = trim($_POST['excerpt'] ?? '');
            $content = $_POST['content'] ?? '';
            $author  = trim($_POST['author'] ?? 'Yaswant Team');
            $read    = trim($_POST['read'] ?? '5 min');
            $img     = trim($_POST['img'] ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97');

            if (!$title) {
                echo json_encode(['success' => false, 'error' => 'Article title is required.']);
                exit;
            }

            if (empty($img)) {
                $img = 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97';
            }

            $stmt = $pdo->prepare("INSERT INTO articles (cat, title, excerpt, content, author, read_time, img) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$cat, $title, $excerpt, $content, $author, $read, $img]);

            echo json_encode(['success' => true, 'message' => 'Article published to database!']);
            break;

        case 'edit_article':
            $id      = (int) ($_POST['id'] ?? 0);
            $title   = trim($_POST['title'] ?? '');
            $cat     = trim($_POST['cat'] ?? 'Technical');
            $excerpt = trim($_POST['excerpt'] ?? '');
            $content = $_POST['content'] ?? '';
            $author  = trim($_POST['author'] ?? 'Yaswant Team');
            $read    = trim($_POST['read'] ?? '5 min');
            $img     = trim($_POST['img'] ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97');

            if (!$id || !$title) {
                echo json_encode(['success' => false, 'error' => 'Invalid article parameters.']);
                exit;
            }

            if (empty($img)) {
                $img = 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97';
            }

            $stmt = $pdo->prepare("UPDATE articles SET title = ?, cat = ?, excerpt = ?, content = ?, author = ?, read_time = ?, img = ? WHERE id = ?");
            $stmt->execute([$title, $cat, $excerpt, $content, $author, $read, $img, $id]);

            echo json_encode(['success' => true, 'message' => 'Article updated successfully!']);
            break;

        case 'delete_article':
            $id = (int) ($_POST['id'] ?? 0);
            $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Article deleted from database.']);
            break;

        // ─── SUBSCRIBERS ─────────────────────────────────────────────────────
        case 'delete_subscriber':
            $email = trim($_POST['email'] ?? '');
            $stmt = $pdo->prepare("DELETE FROM subscribers WHERE email = ?");
            $stmt->execute([$email]);
            echo json_encode(['success' => true, 'message' => 'Subscriber removed.']);
            break;

        default:
            echo json_encode(['success' => false, 'error' => 'Unknown action: ' . htmlspecialchars($action)]);
            break;
    }

} catch (Throwable $e) {
    error_log("Admin Action Critical Error (" . ($action ?? 'unknown') . "): " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Database operation error: ' . $e->getMessage()
    ]);
    exit;
}
