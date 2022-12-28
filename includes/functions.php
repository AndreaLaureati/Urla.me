<?php
function idExists($id)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
        $query = $db->prepare("SELECT id FROM url WHERE id = :id");
        $query->execute([':id' => $id]);
        return $query->rowCount() > 0 ? true : false;
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

function getUrlId($url)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
        $query = $db->prepare("SELECT id FROM url WHERE url = :url");
        $query->execute([':url' => $url]);
        return $query->rowCount() > 0 ? $query->fetch(PDO::FETCH_ASSOC)['id'] : false;
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

function insertId($id, $url)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
        $query = $db->prepare("INSERT INTO url (id, url) VALUES (:id, :url)");
        $query->execute([':id' => $id, ':url' => $url]);
        return $query->rowCount() > 0 ? true : false;
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

function urlHasBeenShortened($url)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
        $query = $db->prepare("SELECT id FROM url WHERE url = :url");
        $query->execute([':url' => $url]);
        return $query->rowCount() > 0 ? true : false;
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

function getUrlLocation($id)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=urlame', 'root', 'masterkey');
        $query = $db->prepare("SELECT url FROM url WHERE id = :id");
        $query->execute([':id' => $id]);
        return $query->rowCount() > 0 ? $query->fetch(PDO::FETCH_ASSOC)['url'] : false;
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}
