<?php

return [
    'GET' => [
        '/auth/user' => [
            'action' => 'controllers/api/auth/user.php',
            'middleware' => 'auth'
        ],
        '/auth/logout' => [
            'action' => 'controllers/api/auth/logout.php',
            'middleware' => 'auth'
        ],
        '/seed' => [
            'action' => 'controllers/seeder.php',
        ],
    ],
    'POST' => [
        '/auth/login' => [
            'action' => 'controllers/api/auth/login.php'
        ],
        '/auth/register' => [
            'action' => 'controllers/api/auth/register.php'
        ],
    ],
];