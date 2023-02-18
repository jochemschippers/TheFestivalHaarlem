<?php
require __DIR__ . '/../patternrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$file = "<h1>test</h1>";
echo filter_var($file,FILTER_UNSAFE_RAW);

$router = new PatternRouter();
$router->route($uri);

require_once("dbconfig.php");

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
        echo "Connection failed: " . $error->getMessage();
}