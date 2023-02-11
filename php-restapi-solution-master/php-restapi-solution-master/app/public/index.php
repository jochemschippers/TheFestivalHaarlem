<?php
require __DIR__ . '/../patternrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$file = "<h1>test</h1>";
echo filter_var($file,FILTER_UNSAFE_RAW);

$router = new PatternRouter();
$router->route($uri);