<?php

header('Access-Control-Allow-Methods: POST');


$auth = auth();
!$auth['user']->isAdmin() ? unauthorized() : null;

$name = isset($_POST['name']) ? $_POST['name'] : null ;

Validator::clear();
Validator::dep_name($_POST['name']);
if(Validator::fails()){
    response([
        'status' => false,
        'message' => Validator::errors(),
    ],400);
}
    
$query = new Query();
$depart = $query->table('departments')
            ->create([
                'name' => $_POST['name'],
            ]);

if($depart){
    response([
        'status' => true,
        'message' => 'Department created successfully',
        'department' => $depart,
    ],200);
}else{
    response([
        'status' => false,
        'message' => 'Department Create failed',
    ],400);
}
