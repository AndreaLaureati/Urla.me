<?php
require_once(__DIR__ . "/../includes/functions.php");
require_once(__DIR__ . "/../lib/Database.php");

$id = rand(100000, 999999);
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

while (idExists($db, $id)) {
    $id = rand(100000, 999999);
}

if (urlHasBeenShortened($db, $url)) {
    echo json_encode([
        'status' => 'success',
        'shortened_url' => "http://localhost/urla.me/index.php?id=" . getUrlId($db, $url)
    ]);
    exit;
}

insertId($db, $id, $url);

echo json_encode([
    'status' => 'success',
    'shortened_url' => "http://localhost/urla.me/index.php?id=" . getUrlId($db, $url)
]);
