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

function getUrlEncodedId($db, $url)
{
    try {
        $query = $db->prepare("SELECT encoded FROM url WHERE url = :url");
        $query->execute([':url' => $url]);
        return $query->rowCount() > 0 ? $query->fetch(PDO::FETCH_ASSOC)['encoded'] : false;
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

function insertUrl($db, $url)
{
    try {
        $query = $db->prepare("INSERT INTO url (url) VALUES (:url)");
        $query->execute([':url' => $url]);
        $query = $db->prepare("UPDATE url SET encoded = :encoded WHERE id = :id");
        $query->execute([':encoded' => encode($db->lastInsertId()), ':id' => $db->lastInsertId()]);
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

function updateTimesShortened($db, $url)
{
    try {
        $query = $db->prepare("UPDATE url SET times_shortened = times_shortened + 1 WHERE url = :url");
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
    $id = decode($id);
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

function getTimesVisited($db, $url)
{
    try {
        $query = $db->prepare("SELECT times_visited FROM url WHERE url = :url");
        $query->execute([':url' => $url]);
        return $query->rowCount() > 0 ? $query->fetch(PDO::FETCH_ASSOC)['times_visited'] : false;
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}


function getTimesShortened($db, $url)
{
    try {
        $query = $db->prepare("SELECT times_shortened FROM url WHERE url = :url");
        $query->execute([':url' => $url]);
        return $query->rowCount() > 0 ? $query->fetch(PDO::FETCH_ASSOC)['times_shortened'] : false;
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

function updateVisits($db, $id)
{
    $id = decode($id);
    try {
        $query = $db->prepare("UPDATE url SET times_visited = times_visited + 1 WHERE id = :id");
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

function encode($number)
{
    return strtr(rtrim(base64_encode(pack('i', $number)), '='), '+/', '-_');
}

function decode($base64)
{
    $number = unpack('i', base64_decode(str_pad(strtr($base64, '-_', '+/'), strlen($base64) % 4, '=')));
    return $number[1];
}

function startsWithHttp($url)
{
    if (substr($url, 0, 7) == "http://" || substr($url, 0, 8) == "https://") {
        return true;
    } else {
        return false;
    }
}
