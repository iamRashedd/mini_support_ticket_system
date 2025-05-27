<?php

header('Access-Control-Allow-Methods: DELETE');

$auth = auth();
!$auth['user']->isAdmin() ? unauthorized() : null;

$query = new Query();
$depart = $query->table('departments')->find($id);
if(!$depart){
    response([
        'status' => false,
        'message' => 'Department not found',
    ],404);
}
$status = $query->table('departments')->where('id','=',$_REQUEST['id'])->delete();

if($status){
    response([
        'status' => true,
        'message' => 'Department deleted successfully',
    ],200);
}else{
    response([
        'status' => false,
        'message' => 'Department delete Failed',
    ],400);
}
