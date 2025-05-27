<?php

header('Access-Control-Allow-Methods: POST');


Validator::login($_POST);
if(Validator::fails()){
    response([
        'status' => false,
        'message' => Validator::errors(),
    ],400);
}
    
$query = new Query();
$user = $query->table('users')
            ->where('email', '=', $_POST['email'])
            ->first();

if($user && $user->verifyPass($_POST['password'])){
    $token = $user->createToken();
    response([
        'status' => true,
        'message' => 'Logged in successfully',
        'token' => $token,
        'user' => $user,
    ]);
}else{
    response([
        'status' => false,
        'message' => 'Incorrect Email/Passowrd',
    ]);
}