<?php

header('Access-Control-Allow-Methods: POST');

$name = isset($_POST['name']) ? $_POST['name'] : null ;
$email = isset($_POST['email']) ? $_POST['email'] : null ;
$role = isset($_POST['role']) ? $_POST['role'] : null ;
$password = isset($_POST['password']) ? $_POST['password'] : null ;
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null ;

Validator::register($_POST);
if(Validator::fails()){
    response([
        'status' => false,
        'message' => Validator::errors(),
    ],400);
}
    
$query = new Query();
$user = $query->table('users')
            ->create([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'role' => $_POST['role'],
                'password' => password_hash($_POST['password'],PASSWORD_DEFAULT),
            ]);

if($user){
    $token = $user->createToken();
    response([
        'status' => true,
        'message' => 'User registered successfully',
        'token' => $token,
        'user' => $user,
    ]);
}else{
    response([
        'status' => false,
        'message' => 'User registration failed',
    ]);
}
