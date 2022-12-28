<?php
function idExists($id)
{
    $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
    $query = $db->prepare("SELECT id FROM url WHERE id = :id");
    $query->execute([
        ':id' => $id
    ]);
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function getUrlId($url)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
        $query = $db->prepare("SELECT id FROM url WHERE url = :url");
        $query->execute([
            ':url' => $url
        ]);
        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_ASSOC)['id'];
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function insertId($id, $url)
{
    $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
    $query = $db->prepare("INSERT INTO url (id, url) VALUES (:id, :url)");
    $query->execute([
        ':id' => $id,
        ':url' => $url
    ]);
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function urlHasBeenShortened($url)
{
    $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
    $query = $db->prepare("SELECT id FROM url WHERE url = :url");
    $query->execute([
        ':url' => $url
    ]);
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function getUrlLocation($id)
{
    $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
    $query = $db->prepare("SELECT url FROM url WHERE id = :id");
    $query->execute([
        ':id' => $id
    ]);
    if ($query->rowCount() > 0) {
        return $query->fetch(PDO::FETCH_ASSOC)['url'];
    } else {
        return false;
    }
}
