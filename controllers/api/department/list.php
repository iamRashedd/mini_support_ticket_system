<?php

$query = new Query();

$departs = $query->table('departments')->get();

response([
    'status' => true,
    'message' => 'Showing all departments',
    'departments' => $departs,
],200);