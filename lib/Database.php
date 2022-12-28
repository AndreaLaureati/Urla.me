<?php

class Database extends PDO
{
    public function __construct()
    {
        require_once(__DIR__ . "/../config/database.php");
        parent::__construct("mysql:host=$host;dbname=$dbname", $user, $password);
    }
}
