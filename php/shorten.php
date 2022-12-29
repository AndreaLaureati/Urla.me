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
    echo json_encode([
        'status' => 'success',
        'shortened_url' => "http://localhost/urla.me/index.php?id=" . getUrlEncodedId($db, $url)
    ]);
    exit;
}

insertUrl($db, $url);

echo json_encode([
    'status' => 'success',
    'shortened_url' => "http://localhost/urla.me/index.php?id=" . getUrlEncodedId($db, $url)
]);
