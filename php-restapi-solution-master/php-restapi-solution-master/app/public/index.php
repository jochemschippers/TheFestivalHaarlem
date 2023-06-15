<?php
require __DIR__ . '/../patternrouter.php';
require __DIR__ . '/../vendor/autoload.php';
$urlParts = parse_url($_SERVER['REQUEST_URI']);
$uri = trim($urlParts['path'], '/');

session_start();

$router = new PatternRouter();

$router->route($uri, $urlParts['query'] ?? '');
