<?php

error_reporting(E_ALL);

$env = parse_ini_file(__DIR__ . '/.env');

define("DB_DSN", $env["DB_DSN"]);
define("DB_USERNAME", $env["DB_USERNAME"]);
define("DB_PASSWORD", $env["DB_PASSWORD"]);

try {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec lors de la connexion : " . $e->getMessage());
}
