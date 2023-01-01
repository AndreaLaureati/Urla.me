<?php
require_once(__DIR__ . "/includes/functions.php");
require_once(__DIR__ . "/lib/Database.php");
$db = new Database();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $url = getUrlLocation($db, $id);
    updateTimesVisited($db, $id);
    if (startsWithHttp($url)) {
        header("Location: " . $url);
    } else {
        header("Location: http://" . $url);
    }
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
    <script src="https://kit.fontawesome.com/e4e0469f3b.js" crossorigin="anonymous"></script>
    <title>Urla.me URL Shortener</title>
</head>

<body>
    <div class="topbar">
        <h1 class="title">Urla.me</h1>
        <h3 class="subtitle">Free URL shortener</h3>
    </div>
    <div class="content-wrapper">
        <div class="url-input-container">
            <div class="url-text-1">Type the URL to be shortened</div>
            <input type="text" class="url-input" name="url">
            <div class="submit-button-container">
                <button type="submit" class="submit-button">Shorten !</button>
            </div>
        </div>
    </div>
    <div class="messages" hidden>
        <p class="errors"></p>
        <p class="result"></p>
        <p class="stats"></p>
    </div>
    <div class="history-container" hidden>
        <h3 class="history-title"><button type="button" class="clear-history-button" onclick="clearHistory();">x</button> Recent history</h3>
        <table class="history-table">
            <tr>
                <th>Created at</th>
                <th>Original Url</th>
                <th>Short Url</th>
            </tr>
        </table>
    </div>
    <script type="text/javascript" src="script/index.js"></script>
</body>

</html>