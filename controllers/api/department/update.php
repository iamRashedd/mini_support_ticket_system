<?php


header('Content-Type: application/json');

$rawBody = file_get_contents('php://input');
$data = json_decode($rawBody, true);

// dd($data);

$query = new Query();
$depart = $query->table('departments')->find($id);
if(!$depart){
    response([
        'status' => false,
        'message' => 'Department not found',
    ],404);
}
$exist = $query->table('departments')->where('name','=',$data['name'])->where('id','!=',$id)->first();
if($exist){
    response([
        'status' => false,
        'message' => 'Department name already used',
    ],400);
}
$depart = $query->table('departments')->update($_REQUEST['id'],$data);

if($depart){
    response([
        'status' => true,
        'message' => 'Department updated',
        'department' => $depart,
    ],200);
}
else{
    response([
        'status' => false,
        'message' => 'Department update failed',
    ],400);
}