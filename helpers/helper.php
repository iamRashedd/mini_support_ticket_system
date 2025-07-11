<?php
    function dd($value){
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die();
    }
    function getDB(){
        // $config = require('config.php');
        // return new Database($config);
        // return DB;
    }
    function response($data,$code=200){
        http_response_code($code);
        echo json_encode($data);
        exit();
    }
    function getClass($table){
        $data = [
            'users' => 'User',
            'personal_access_token' => 'Token',
            'departments' => 'Department',
            'tickets' => 'Ticket',
            'ticket_notes' => 'TicketNote',
            'ticket_attachments' => 'TicketAttachment',
        ];
        return $data[$table];
    }
    function auth(){
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        if (!empty($headers) && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            $token = $matches[1];
        }
        $query = new Query();
        $token = $query->raw('SELECT * FROM personal_access_token WHERE token=\''.$token.'\' AND expires_at > NOW()')->fetch() ?? null;
        $user = $token ? $query->table('users')->find($token['tokenable_id']) : null;
        return  $token? ['token' => $token, 'user' => $user]: null;
    }
    function abort($code = 400){
        response([
            'status' => false,
            'message' => 'User Unauthenticated',
        ],$code);
    }
    function unauthorized($msg = null){
        $message = $msg ? 'User Unauthorized! ('.$msg.')' : 'User Unauthorized!';
        response([
            'status' => false,
            'message' => $message,
        ],403);
    }
    