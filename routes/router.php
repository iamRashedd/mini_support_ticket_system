<?php

// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

$routes = require_once('api.php');

$id = isset($segments[2]) ? $segments[2] : null;
if(is_numeric($id)){
    $_REQUEST['id'] = $id;
    $segments[2] = '{id}';
    $uri = implode('/',$segments);
}

if(array_key_exists($uri, $routes[$method])){
    if(isset($routes[$method][$uri]['middleware'])){
        $middleware = $routes[$method][$uri]['middleware'].'Middleware';
        new $middleware()->handle();
    }
    require $routes[$method][$uri]['action'];
}
else{
    response([
        'status' => 404,
        'message' => 'Route not found',
    ],404);
}