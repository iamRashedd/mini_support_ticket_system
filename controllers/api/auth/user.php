<?php
header('Access-Control-Allow-Methods: GET');
$auth = auth();
// !$auth ? abort() : null;

response($auth);
