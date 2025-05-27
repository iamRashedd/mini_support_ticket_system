<?php

header('Access-Control-Allow-Methods: GET');

$auth = auth();
!$auth ? abort() : null;

$query = new Query();
$status = $query->table('personal_access_token')->where('id','=',$auth['token']['id'])->delete();

if($status){
    response([
        'status' => true,
        'message' => 'Logged out successfully',
    ],200);
}else{
    response([
        'status' => false,
        'message' => 'Logout Failed',
    ],400);
}
