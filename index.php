<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

require_once('helpers/initialize.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$segments = explode('/', $uri);
require_once ('routes/router.php');