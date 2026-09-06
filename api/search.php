<?php
// api/search.php — Live MySQL Search API Endpoint
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../includes/data.php';

$q = trim($_GET['q'] ?? '');

if ($q === '') {
    echo json_encode(['results' => [], 'query' => '', 'count' => 0]);
    exit;
}

$catalog = [];

// Fetch live resources from MySQL
foreach (get_resources() as $r) {
    $catalog[] = [
        'type'  => 'Resource',
        'title' => $r['title'] ?? '',
        'href'  => URL_RESOURCES,
        'color' => $r['color'] ?? 'primary',
        'icon'  => 'description'
    ];
}

// Fetch live courses from MySQL
foreach (get_courses() as $c) {
    $catalog[] = [
        'type'  => 'Course',
        'title' => $c['title'] ?? '',
        'href'  => URL_COURSES,
        'color' => $c['color'] ?? 'tertiary',
        'icon'  => $c['icon'] ?? 'school'
    ];
}

// Fetch live jobs/internships from MySQL
foreach (get_jobs() as $j) {
    $catalog[] = [
        'type'  => 'Internship',
        'title' => ($j['title'] ?? '') . ' – ' . ($j['company'] ?? ''),
        'href'  => URL_INTERNSHIPS,
        'color' => $j['color'] ?? 'secondary',
        'icon'  => 'work'
    ];
}

// Fetch live blog articles from MySQL
foreach (get_articles() as $a) {
    $catalog[] = [
        'type'  => 'Blog',
        'title' => $a['title'] ?? '',
        'href'  => URL_BLOG,
        'color' => 'primary',
        'icon'  => 'article'
    ];
}

// Static developer utilities
$tools = [
    ['type' => 'Tool', 'title' => 'GPA Calculator', 'href' => URL_TOOLS, 'color' => 'primary', 'icon' => 'calculate'],
    ['type' => 'Tool', 'title' => 'Code Formatter', 'href' => URL_TOOLS, 'color' => 'secondary', 'icon' => 'code'],
    ['type' => 'Tool', 'title' => 'JSON Validator', 'href' => URL_TOOLS, 'color' => 'tertiary', 'icon' => 'data_object'],
    ['type' => 'Tool', 'title' => 'API Tester', 'href' => URL_TOOLS, 'color' => 'primary', 'icon' => 'api'],
    ['type' => 'Tool', 'title' => 'ATS Resume Builder', 'href' => URL_RESUME, 'color' => 'secondary', 'icon' => 'description'],
];
$catalog = array_merge($catalog, $tools);

$results = array_values(array_filter(
    $catalog,
    fn($item) => stripos($item['title'], $q) !== false || stripos($item['type'], $q) !== false
));

echo json_encode([
    'query'   => $q,
    'count'   => count($results),
    'results' => array_slice($results, 0, 30),
]);
