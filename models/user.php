<?php
class User{
    
    public $id;
    public $name;
    public $email;
    private $password;
    public $role;
    public $created_at;

    // public $cols = ['id','name','email','password','role'];
    public function __construct()
    {
        
    }
    public function verifyPass($password){
        return password_verify($password,$this->password);
    }
    public function createToken(){
        $query = new Query();
        $token = $query->table('personal_access_token')
            ->create([
                'tokenable_id' => $this->id,
                'token' => Token::generateToken(),
                'expires_at' => date("Y-m-d H:i",(time()+TOKEN_EXP)),
            ]);
        return $token ? $token->token : $token;
    }
    public function isAdmin(){
        return $this->role == 'admin';
    }
}
