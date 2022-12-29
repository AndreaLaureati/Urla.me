<?php
require_once(__DIR__ . "/includes/functions.php");
require_once(__DIR__ . "/lib/Database.php");
$db = new Database();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $url = getUrlLocation($db, $id);
    updateVisits($db, $id);
    header("Location:" . $url);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Urla.me URL Shortener</title>
</head>

<body>
    <div class="topbar">
        <h1 class="title">Urla.me</h1>
        <h3 class="subtitle">Your free URL shortener</h3>
    </div>
    <div class="content-wrapper">
        <div class="url-input-container">
            <input type="text" class="url-input" name="url">
        </div>
        <div class="submit-button-container">
            <button type="submit" class="submit-button">Shorten !</button>
        </div>
        <p class="errors"></p>
        <p class="result"></p>
        <p class="stats"></p>
    </div>
    <script type="text/javascript" src="script/index.js"></script>
</body>

</html>