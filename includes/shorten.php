<?php
require_once(__DIR__ . "/functions.php");

$id = rand(100000, 999999);
$url = $_POST['url'];

if (idExists($id)) {
    $id = rand(100000, 999999);
}

if (urlHasBeenShortened($url)) {
    echo "http://localhost/urla.me/index.php?id=" . getUrlId($url);
    return;
}

insertId($id, $url);

echo "http://localhost/urla.me/index.php?id=" . $id;
