<?php
// includes/data.php — Central MySQL Data Fetch Engine for Yaswant Dev

require_once __DIR__ . '/db.php';

if (!function_exists('get_resources')) {
    function get_resources(): array
    {
        try {
            $pdo = get_db();
            $stmt = $pdo->query("SELECT id, branch, sem, type, title, by_author AS `by`, file_size AS size, color FROM resources ORDER BY id DESC");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching resources: " . $e->getMessage());
            return [];
        }
    }
}

if (!function_exists('get_courses')) {
    function get_courses(): array
    {
        try {
            $pdo = get_db();
            $stmt = $pdo->query("SELECT id, title, tag, lessons, level, color, icon, playlist_url FROM courses ORDER BY id DESC");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching courses: " . $e->getMessage());
            return [];
        }
    }
}

if (!function_exists('get_jobs')) {
    function get_jobs(): array
    {
        try {
            $pdo = get_db();
            $stmt = $pdo->query("SELECT id, title, company, location, pay, tags, color FROM jobs ORDER BY id DESC");
            $jobs = $stmt->fetchAll();
            foreach ($jobs as &$j) {
                if (isset($j['tags']) && is_string($j['tags'])) {
                    $decoded = json_decode($j['tags'], true);
                    $j['tags'] = is_array($decoded) ? $decoded : array_map('trim', explode(',', $j['tags']));
                }
            }
            return $jobs;
        } catch (Exception $e) {
            error_log("Error fetching jobs: " . $e->getMessage());
            return [];
        }
    }
}

if (!function_exists('get_articles')) {
    function get_articles(): array
    {
        try {
            $pdo = get_db();
            $stmt = $pdo->query("SELECT id, cat, title, excerpt, content, author, read_time AS readTime, img, created_at FROM articles ORDER BY id DESC");
            $articles = $stmt->fetchAll();
            foreach ($articles as &$a) {
                if (isset($a['readTime'])) {
                    $a['read'] = $a['readTime'];
                }
            }
            return $articles;
        } catch (Exception $e) {
            error_log("Error fetching articles: " . $e->getMessage());
            return [];
        }
    }
}

if (!function_exists('get_article_by_id')) {
    function get_article_by_id(int $id): ?array
    {
        try {
            $pdo = get_db();
            $stmt = $pdo->prepare("SELECT id, cat, title, excerpt, content, author, read_time AS readTime, img, created_at FROM articles WHERE id = ?");
            $stmt->execute([$id]);
            $a = $stmt->fetch();
            if ($a) {
                $a['read'] = $a['readTime'] ?? '5 min';
            }
            return $a ?: null;
        } catch (Exception $e) {
            error_log("Error fetching article by id: " . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_subscribers')) {
    function get_subscribers(): array
    {
        try {
            $pdo = get_db();
            $stmt = $pdo->query("SELECT id, email, created_at AS date FROM subscribers ORDER BY id DESC");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching subscribers: " . $e->getMessage());
            return [];
        }
    }
}

if (!function_exists('get_tools')) {
    function get_tools(string $category = ''): array
    {
        try {
            $pdo = get_db();
            if ($category) {
                $stmt = $pdo->prepare("SELECT id, slug, name, category, description AS `desc`, icon, color, file_path AS file, subdomain FROM tools WHERE is_active = 1 AND category = ? ORDER BY id ASC");
                $stmt->execute([$category]);
            } else {
                $stmt = $pdo->query("SELECT id, slug, name, category, description AS `desc`, icon, color, file_path AS file, subdomain FROM tools WHERE is_active = 1 ORDER BY id ASC");
            }
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching tools: " . $e->getMessage());
            return [];
        }
    }
}

if (!function_exists('get_resumes')) {
    function get_resumes(): array
    {
        try {
            $pdo = get_db();
            $stmt = $pdo->query("SELECT id, title, full_name, email, headline, summary, experience_json, education_json, skills_json, projects_json, template_theme, created_at FROM resumes ORDER BY id DESC");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching resumes: " . $e->getMessage());
            return [];
        }
    }
}

if (!function_exists('get_projects')) {
    function get_projects(): array
    {
        try {
            $pdo = get_db();
            $stmt = $pdo->query("SELECT id, title, category, tech_stack, difficulty, github_url, demo_url, description FROM projects ORDER BY id DESC");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching projects: " . $e->getMessage());
            return [];
        }
    }
}

