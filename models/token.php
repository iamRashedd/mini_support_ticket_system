<?php

class Token{
    public $id;
    public $tokenable_id;
    public $token;
    public $expires_at;
    public $created_at;
    
    private static $secretKey = '1b8da0be4df865bee7725c6570dd9497';
    private static $secretIv = 'mini-ticket';
    private static $encryptMethod = "AES-256-CBC";

    public static function generateToken() {
        $key = hash('sha256', self::$secretKey);
        $iv = substr(hash('sha256', self::$secretIv), 0, 16);
        $result = openssl_encrypt(uniqid(), self::$encryptMethod, $key, 0, $iv);
        return $result= base64_encode($result);
    }
}