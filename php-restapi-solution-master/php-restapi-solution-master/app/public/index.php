<?php
require __DIR__ . '/../patternrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');


session_start();
$router = new PatternRouter();
$router->route($uri);