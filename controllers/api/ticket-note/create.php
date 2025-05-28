<?php

header('Access-Control-Allow-Methods: POST');

$auth = auth();
// !$auth['user']->isAdmin() ? unauthorized() : null;

$id = $_POST['ticket_id'] ?? null;

if(!$id){
    response([
        'status' => false,
        'message' => [
            'ticket_id' => 'Ticket ID required',
        ],
    ],400);
}

Validator::clear();
Validator::note($_POST['note']);
if(Validator::fails()){
    response([
        'status' => false,
        'message' => Validator::errors(),
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
if($ticket->status == 'closed'){
    response([
        'status' => false,
        'message' => 'Ticket already closed',
    ],404);
}

$note = $query->table('ticket_notes')
            ->create([
                'ticket_id' => $_POST['ticket_id'],
                'note' => $_POST['note'],
                'user_id' => $auth['user']->id,
            ]);

if($note){
    response([
        'status' => true,
        'message' => 'Ticket Note added successfully',
        'note' => $note,
    ],200);
}else{
    response([
        'status' => false,
        'message' => 'Ticket Note Add failed',
    ],400);
}
