<?php
require_once(__DIR__ . "/../includes/functions.php");
require_once(__DIR__ . "/../lib/Database.php");

$url = $_POST['url'];

try {
    $db = new Database();
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error'
    ]);
    exit;
}

if (urlHasBeenShortened($db, $url)) {
    updateTimesShortened($db, $url);
    echo json_encode([
        'status' => 'success',
        'original_url' => $url,
        'shortened_url' => "http://localhost/urla.me/?id=" . getUrlEncodedId($db, $url),
        'times_shortened' => getTimesShortened($db, $url),
        'times_visited' => getTimesVisited($db, $url)
    ]);
    exit;
}

insertUrl($db, $url);

echo json_encode([
    'status' => 'success',
    'original_url' => $url,
    'shortened_url' => "http://localhost/urla.me/?id=" . getUrlEncodedId($db, $url),
    'times_shortened' => getTimesShortened($db, $url),
    'times_visited' => getTimesVisited($db, $url)
]);
