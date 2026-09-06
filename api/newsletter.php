<?php
// api/newsletter.php — Newsletter subscription MySQL endpoint
header('X-Content-Type-Options: nosniff');
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

if (!$email) {
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $ref = preg_replace('/[^a-zA-Z0-9\/_\-\.\?\=\&\:]/', '', $_SERVER['HTTP_REFERER']);
        header('Location: ' . strtok($ref, '?') . '?newsletter=error');
        exit;
    }
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email address']);
    exit;
}

try {
    $pdo = get_db();
    $stmt = $pdo->prepare("INSERT IGNORE INTO subscribers (email) VALUES (?)");
    $stmt->execute([$email]);

    if (!empty($_SERVER['HTTP_REFERER'])) {
        $ref = preg_replace('/[^a-zA-Z0-9\/_\-\.\?\=\&\:]/', '', $_SERVER['HTTP_REFERER']);
        header('Location: ' . strtok($ref, '?') . '?subscribed=1');
        exit;
    }

    echo json_encode(['success' => true, 'message' => 'Subscribed successfully']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
