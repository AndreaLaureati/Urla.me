<?php
function idExists($db, $id)
{
    try {
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

function getUrlId($db, $url)
{
    try {
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

function insertId($db, $id, $url)
{
    try {
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

function urlHasBeenShortened($db, $url)
{
    try {
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

function getUrlLocation($db, $id)
{
    try {
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
