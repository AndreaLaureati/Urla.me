<?php
require_once(__DIR__ . "/functions.php");

$id = rand(100000, 999999);
$url = $_POST['url'];

while (idExists($id)) {
    $id = rand(100000, 999999);
}

if (urlHasBeenShortened($url)) {
    echo json_encode([
        'status' => 'success',
        'shortened_url' => "http://localhost/urla.me/index.php?id=" . getUrlId($url)
    ]);
    exit;
}

insertId($id, $url);

echo json_encode([
    'status' => 'success',
    'shortened_url' => "http://localhost/urla.me/index.php?id=" . getUrlId($url)
]);
