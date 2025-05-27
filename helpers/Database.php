<?php
    try{
        $cred = require_once('config.php');
        $dsn = 'mysql:'.http_build_query($cred, '', ';');
        $db = new PDO($dsn, $cred['username'], $cred['password'], [
            PDO::ATTR_EMULATE_PREPARES => false,
            // PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        defined('DB') ? null : define('DB',$db);
    }catch(\PDOException $e){
        echo json_encode($e->getMessage());
        exit;
    }
