<?php

$query = new Query();

$user = $query->table('users')
        ->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => password_hash('123456',PASSWORD_DEFAULT),
            'role' => 'admin',
        ]);
$user = $query->table('users')
        ->create([
            'name' => 'Agent',
            'email' => 'agent@gmail.com',
            'password' => password_hash('123456',PASSWORD_DEFAULT),
            'role' => 'agent',
        ]);

response($user);