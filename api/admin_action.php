<?php
// api/admin_action.php — MySQL Admin Action Handler (Prepared SQL Engine)
session_start();
header('Content-Type: application/json');

if (empty($_SESSION['admin_logged_in'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized access. Admin login required.']);
    exit;
}

require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$action = $_POST['action'] ?? '';
$pdo = get_db();

switch ($action) {
    case 'add_resource':
        $title = trim($_POST['title'] ?? '');
        $branch = trim($_POST['branch'] ?? 'CS');
        $sem = trim($_POST['sem'] ?? 'S1');
        $type = trim($_POST['type'] ?? 'Notes');
        $by = trim($_POST['by'] ?? 'Yaswant Admin');
        $size = trim($_POST['size'] ?? '2.0 MB');
        $color = trim($_POST['color'] ?? 'primary');
        $url = trim($_POST['url'] ?? '');

        if (!$title) {
            echo json_encode(['error' => 'Title is required']);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO resources (branch, sem, type, title, by_author, file_size, color, download_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$branch, $sem, $type, $title, $by, $size, $color, $url ?: null]);
        echo json_encode(['success' => true, 'message' => 'Resource added to database']);
        break;

    case 'edit_resource':
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $branch = trim($_POST['branch'] ?? 'CS');
        $sem = trim($_POST['sem'] ?? 'S1');
        $type = trim($_POST['type'] ?? 'Notes');
        $by = trim($_POST['by'] ?? 'Yaswant Admin');
        $size = trim($_POST['size'] ?? '2.0 MB');
        $url = trim($_POST['url'] ?? '');

        if (!$id || !$title) {
            echo json_encode(['error' => 'Invalid resource parameters']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE resources SET title = ?, branch = ?, sem = ?, type = ?, by_author = ?, file_size = ?, download_url = ? WHERE id = ?");
        $stmt->execute([$title, $branch, $sem, $type, $by, $size, $url ?: null, $id]);
        echo json_encode(['success' => true, 'message' => 'Resource updated successfully']);
        break;

    case 'delete_resource':
        $id = (int) ($_POST['id'] ?? 0);
        $stmt = $pdo->prepare("DELETE FROM resources WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true, 'message' => 'Resource deleted from database']);
        break;

    case 'add_course':
        $title = trim($_POST['title'] ?? '');
        $tag = trim($_POST['tag'] ?? 'General');
        $lessons = (int) ($_POST['lessons'] ?? 20);
        $level = trim($_POST['level'] ?? 'Beginner');
        $color = trim($_POST['color'] ?? 'primary');
        $icon = trim($_POST['icon'] ?? 'school');

        if (!$title) {
            echo json_encode(['error' => 'Course title is required']);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO courses (title, tag, lessons, level, color, icon) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $tag, $lessons, $level, $color, $icon]);
        echo json_encode(['success' => true, 'message' => 'Course added to database']);
        break;

    case 'edit_course':
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $tag = trim($_POST['tag'] ?? 'General');
        $lessons = (int) ($_POST['lessons'] ?? 20);
        $level = trim($_POST['level'] ?? 'Beginner');

        if (!$id || !$title) {
            echo json_encode(['error' => 'Invalid course parameters']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE courses SET title = ?, tag = ?, lessons = ?, level = ? WHERE id = ?");
        $stmt->execute([$title, $tag, $lessons, $level, $id]);
        echo json_encode(['success' => true, 'message' => 'Course updated successfully']);
        break;

    case 'delete_course':
        $id = (int) ($_POST['id'] ?? 0);
        $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true, 'message' => 'Course deleted from database']);
        break;

    case 'add_job':
        $title = trim($_POST['title'] ?? '');
        $company = trim($_POST['company'] ?? '');
        $location = trim($_POST['location'] ?? 'Remote');
        $pay = trim($_POST['pay'] ?? '$40/hr');
        $tagsStr = trim($_POST['tags'] ?? 'Software, Engineering');
        $color = trim($_POST['color'] ?? 'primary');

        if (!$title || !$company) {
            echo json_encode(['error' => 'Title and company are required']);
            exit;
        }

        $tagsJson = json_encode(array_map('trim', explode(',', $tagsStr)));
        $stmt = $pdo->prepare("INSERT INTO jobs (title, company, location, pay, tags, color) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $company, $location, $pay, $tagsJson, $color]);
        echo json_encode(['success' => true, 'message' => 'Internship posted to database']);
        break;

    case 'edit_job':
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $company = trim($_POST['company'] ?? '');
        $location = trim($_POST['location'] ?? 'Remote');
        $pay = trim($_POST['pay'] ?? '$40/hr');
        $tagsStr = trim($_POST['tags'] ?? 'Software, Engineering');

        if (!$id || !$title || !$company) {
            echo json_encode(['error' => 'Invalid internship parameters']);
            exit;
        }

        $tagsJson = json_encode(array_map('trim', explode(',', $tagsStr)));
        $stmt = $pdo->prepare("UPDATE jobs SET title = ?, company = ?, location = ?, pay = ?, tags = ? WHERE id = ?");
        $stmt->execute([$title, $company, $location, $pay, $tagsJson, $id]);
        echo json_encode(['success' => true, 'message' => 'Internship updated successfully']);
        break;

    case 'delete_job':
        $id = (int) ($_POST['id'] ?? 0);
        $stmt = $pdo->prepare("DELETE FROM jobs WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true, 'message' => 'Job posting deleted']);
        break;

    case 'add_article':
        $title = trim($_POST['title'] ?? '');
        $cat = trim($_POST['cat'] ?? 'Technical');
        $excerpt = trim($_POST['excerpt'] ?? '');
        $content = $_POST['content'] ?? '';
        $author = trim($_POST['author'] ?? 'Yaswant Team');
        $read = trim($_POST['read'] ?? '5 min');
        $img = trim($_POST['img'] ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97');

        if (!$title) {
            echo json_encode(['error' => 'Article title is required']);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO articles (cat, title, excerpt, content, author, read_time, img) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$cat, $title, $excerpt, $content, $author, $read, $img]);
        echo json_encode(['success' => true, 'message' => 'Article published to database']);
        break;

    case 'edit_article':
        $id = (int) ($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $cat = trim($_POST['cat'] ?? 'Technical');
        $excerpt = trim($_POST['excerpt'] ?? '');
        $content = $_POST['content'] ?? '';
        $author = trim($_POST['author'] ?? 'Yaswant Team');
        $read = trim($_POST['read'] ?? '5 min');
        $img = trim($_POST['img'] ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97');

        if (!$id || !$title) {
            echo json_encode(['error' => 'Invalid article parameters']);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE articles SET title = ?, cat = ?, excerpt = ?, content = ?, author = ?, read_time = ?, img = ? WHERE id = ?");
        $stmt->execute([$title, $cat, $excerpt, $content, $author, $read, $img, $id]);
        echo json_encode(['success' => true, 'message' => 'Article updated successfully']);
        break;

    case 'delete_article':
        $id = (int) ($_POST['id'] ?? 0);
        $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true, 'message' => 'Article deleted']);
        break;

    case 'delete_subscriber':
        $email = trim($_POST['email'] ?? '');
        $stmt = $pdo->prepare("DELETE FROM subscribers WHERE email = ?");
        $stmt->execute([$email]);
        echo json_encode(['success' => true, 'message' => 'Subscriber removed']);
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}
