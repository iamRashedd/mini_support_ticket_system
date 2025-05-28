<?php

header('Access-Control-Allow-Methods: POST');

$auth = auth();
// !$auth['user']->isAdmin() ? unauthorized() : null;

$id = $_POST['ticket_id'] ?? null;
$status = $_POST['status'] ?? null;

if(!$id){
    response([
        'status' => false,
        'message' => [
            'ticket_id' => 'Ticket ID required',
        ],
    ],400);
}
if(!$status){
    response([
        'status' => false,
        'message' => [
            'status' => 'Status required',
        ],
    ],400);
}
$query = new Query();
$ticket = $query->table('tickets')->find($id);
if(!$ticket){
    response([
        'status' => false,
        'message' => 'Ticket not found',
    ],404);
}

Validator::clear();
Validator::ticket_status($status);
if(Validator::fails()){
    response([
        'status' => false,
        'message' => Validator::errors(),
    ],400);
}
    
$query = new Query();
$ticket = $query->table('tickets')
            ->update($id,[
                'status' => $_POST['status'],
            ]);

if($ticket){
    response([
        'status' => true,
        'message' => 'Ticket status updated successfully',
        'ticket' => $ticket,
    ],200);
}else{
    response([
        'status' => false,
        'message' => 'Ticket status update failed',
    ],400);
}
