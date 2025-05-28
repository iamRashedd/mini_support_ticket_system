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
        '/department' => [
            'action' => 'controllers/api/department/list.php',
            'middleware' => 'auth'
        ],
        '/ticket' => [
            'action' => 'controllers/api/ticket/list.php',
            'middleware' => 'auth'
        ],
    ],
    'POST' => [
        '/auth/login' => [
            'action' => 'controllers/api/auth/login.php'
        ],
        '/auth/register' => [
            'action' => 'controllers/api/auth/register.php'
        ],
        '/department' => [
            'action' => 'controllers/api/department/create.php',
            'middleware' => 'auth'
        ],
        '/ticket' => [
            'action' => 'controllers/api/ticket/create.php',
            'middleware' => 'auth'
        ],
        '/ticket-status' => [
            'action' => 'controllers/api/ticket/status.php',
            'middleware' => 'auth'
        ],
        '/ticket-assign' => [
            'action' => 'controllers/api/ticket/assign.php',
            'middleware' => 'auth'
        ],
        '/ticket-note' => [
            'action' => 'controllers/api/ticket-note/create.php',
            'middleware' => 'auth'
        ],
    ],
    'PUT' => [
        '/department/{id}' =>[
            'action' => 'controllers/api/department/update.php',
            'middleware' => 'auth'
        ],
    ],
    'DELETE' => [
        '/department/{id}' =>[
            'action' => 'controllers/api/department/delete.php',
            'middleware' => 'auth'
        ],
    ],
];