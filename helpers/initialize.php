<?php

    define('APP_NAME', 'Mini Ticket');
    
    defined('TIME_ZONE') ? null : define('TIME_ZONE', 'Asia/Dhaka');
    defined('TOKEN_EXP') ? null : define('TOKEN_EXP', 3600 );
        
    date_default_timezone_set(TIME_ZONE);
    
    
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    header('Content-Type: application/json,application/x-www-form-urlencoded');

    require_once('helpers/database.php');
    require_once('helpers/query.php');
    require_once('helpers/helper.php');
    require_once('helpers/validator.php');
    require_once('helpers/AuthMiddleware.php');
    
    require_once('models/user.php');
    require_once('models/token.php');
    require_once('models/department.php');
    

    

