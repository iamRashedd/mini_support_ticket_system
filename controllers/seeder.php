<?php

$query = new Query();
$data = [];

$data['user'][] = $query->table('users')
        ->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => password_hash('123456',PASSWORD_DEFAULT),
            'role' => 'admin',
        ]);
$data['user'][] = $query->table('users')
        ->create([
            'name' => 'Agent',
            'email' => 'agent@gmail.com',
            'password' => password_hash('123456',PASSWORD_DEFAULT),
            'role' => 'agent',
        ]);

$data['depart'][] = $query->table('departments')
            ->create([
                'name' => 'IT',
            ]);
            
$data['depart'][] = $query->table('departments')
            ->create([
                'name' => 'Server',
            ]);

response([
    'status' => true,
    'message' => 'Seeding DB',
    'data' => $data
]);