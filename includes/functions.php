<?php

/**
 * @param db Database connection
 * @param id Id of the url
 * 
 * @return bool true if the id exists, false if it doesn't
 */
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

/**
 * @param db Database connection
 * @param url Url to check
 * 
 * @return bool true if the id has been found, false if it hasn't
 */
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

/**
 * @param db Database connection
 * @param url Url to insert
 * 
 * @return bool true if the url has been inserted, false if it hasn't
 */
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

/**
 * @param db Database connection
 * @param url Url to check
 * 
 * @return bool true if the url has been shortened, false if it hasn't
 */
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

/**
 * @param db Database connection
 * @param url Url to update
 * 
 * @return bool true if the url has been updated, false if it hasn't
 */
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

/**
 * @param db Database connection
 * @param id Id of the url
 * 
 * @return string url if the url has been found, bool false if it hasn't
 */
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

/**
 * @param db Database connection
 * @param url Url to check
 * 
 * @return int times visited if the url has been found, bool false if it hasn't
 */
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

/**
 * @param db Database connection
 * @param url Url to check
 * 
 * @return int times shortened if the url has been found, bool false if it hasn't
 */
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

/**
 * @param db Database connection
 * @param id Id of the url
 * 
 * @return bool true if the times visited has been updated, false if it hasn't
 */
function updateTimesVisited($db, $id)
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

/**
 * @param number the id of the url to encode
 * 
 * @return string encoded id
 */
function encode($number)
{
    return strtr(rtrim(base64_encode(pack('i', $number)), '='), '+/', '-_');
}

/**
 * @param encoded the encoded id to decode
 * 
 * @return int decoded id
 */
function decode($encoded)
{
    $number = unpack('i', base64_decode(str_pad(strtr($encoded, '-_', '+/'), strlen($encoded) % 4, '=')));
    return $number[1];
}

/**
 * @param url Url to check
 * 
 * @return bool true if the url starts with http:// or https://, false if it doesn't
 */
function startsWithHttp($url)
{
    if (substr($url, 0, 7) == "http://" || substr($url, 0, 8) == "https://") {
        return true;
    } else {
        return false;
    }
}
