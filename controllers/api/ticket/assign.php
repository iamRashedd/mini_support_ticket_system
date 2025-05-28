<?php

header('Access-Control-Allow-Methods: POST');

$auth = auth();
!$auth['user']->isAgent() ? unauthorized('Only Agents can assign themselves') : null;

$id = $_POST['ticket_id'] ?? null;

if(!$id){
    response([
        'status' => false,
        'message' => [
            'ticket_id' => 'Ticket ID required',
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
if($ticket->status == 'closed'){
    response([
        'status' => false,
        'message' => 'Ticket already closed',
    ],404);
}
if($ticket->assigned_to){
    response([
        'status' => false,
        'message' => 'Ticket already assigned to another agent',
    ],404);
}
    
$query = new Query();
$ticket = $query->table('tickets')
            ->update($id,[
                'assigned_to' => $auth['user']->id,
            ]);

if($ticket){
    response([
        'status' => true,
        'message' => 'Ticket assigned',
        'ticket' => $ticket,
    ],200);
}else{
    response([
        'status' => false,
        'message' => 'Ticket assign failed',
    ],400);
}
