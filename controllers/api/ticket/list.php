<?php

$query = new Query();

$tickets = $query->table('tickets')->get();

response([
    'status' => true,
    'message' => 'Showing all tickets',
    'tickets' => $tickets,
],200);