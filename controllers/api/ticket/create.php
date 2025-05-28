<?php

header('Access-Control-Allow-Methods: POST');


$auth = auth();
!$auth['user']->isAdmin() ? unauthorized() : null;

Validator::clear();
Validator::new_ticket($_POST);
if(Validator::fails()){
    response([
        'status' => false,
        'message' => Validator::errors(),
    ],400);
}
    
$query = new Query();
$ticket = $query->table('tickets')
            ->create([
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'status' => $_POST['status'] ?? Ticket::STATUS_OPEN,
                'department_id' => $_POST['department_id'],
                'user_id' => $auth['user']->id,
            ]);

if($ticket){
    response([
        'status' => true,
        'message' => 'Ticket created successfully',
        'ticket' => $ticket,
    ],200);
}else{
    response([
        'status' => false,
        'message' => 'Ticket Create failed',
    ],400);
}
