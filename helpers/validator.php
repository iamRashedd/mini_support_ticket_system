<?php

class Validator{
    
    public static $validation_error = array();

    public static function pass($v){
        if(in_array($v,array_keys(static::$validation_error))){
            unset(static::$validation_error[$v]);
        }
    } 
    public static function clear(){
        self::$validation_error = array();
    }
    public static function errors(){
        return self::$validation_error;
    }
    public static function fails(){
        return count(self::$validation_error) > 0 ? true : false;
    }
    public static function name($name){
        if(!$name){
            static::$validation_error['name'] = 'Name Required';
            return true;
        }
        if(!preg_match('/^[a-zA-Z]+$/', $name)){
            static::$validation_error['name'] = 'Invalid Name';
            return true;
        }
        self::pass('name');
        return false;
    }
    public static function dep_name($name){
        if(!$name){
            static::$validation_error['name'] = 'Name Required';
            return true;
        }
        if(!preg_match('/^[a-zA-Z]+$/', $name)){
            static::$validation_error['name'] = 'Invalid Name';
            return true;
        }
        $query = new Query();
        $old_user = $query->table('departments')->where('name','=',$name)->first();
        if($old_user){
            static::$validation_error['name'] = 'Name already taken';
            return true;
        }
        self::pass('name');
        return false;
    }

    public static function email($email){
        if(!$email){
            static::$validation_error['email'] = 'Email Required';
            return true;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            static::$validation_error['email'] = 'Invalid Email';
            return true;
        }
        self::pass('email');
        return false;
    }

    public static function new_email($email){
        if(!$email){
            static::$validation_error['email'] = 'Email Required';
            return true;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            static::$validation_error['email'] = 'Invalid Email';
            return true;
        }
        $query = new Query();
        $old_user = $query->table('users')->where('email','=',$email)->first();
        if($old_user){
            static::$validation_error['email'] = 'Email already taken';
            return true;
        }
        self::pass('email');
        return false;
    }
    public static function password($value){
        if(!$value){
            static::$validation_error['password'] = 'Password Required';
            return true;
        }
        self::pass('password');
        return false;
    }
    public static function new_password($v1, $v2){
        if(!$v1){
            static::$validation_error['password'] = 'Password Required';
            return true;
        }
        if($v1 != $v2){
            static::$validation_error['password'] = 'Password and Confirm Password not matched';
            return true;
        }
        if (strlen($v1) <= '8') {
            static::$validation_error['password'] = "Your Password Must Contain At Least 8 Digits !";
            return true;
        }
        // elseif(!preg_match("#[0-9]+#",$_POST["password"])) {
        //     static::$validation_error['password'] = "Your Password Must Contain At Least 1 Number !"."<br>";
        // }
        // elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
        //     static::$validation_error['password'] = "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
        // }
        // elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
        //     static::$validation_error['password'] = "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
        // }
        self::pass('password');
        return false;
    }
    public static function role($value){
        if(!$value){
            static::$validation_error['role'] = 'Role Required';
            return true;
        }
        if(!in_array($value,['admin','agent','user'])){
            static::$validation_error['role'] = 'Invalid Role';
            return true;
        }
        self::pass('role');
        return false;
    }
    public static function title($value){
        if(!$value){
            static::$validation_error['title'] = 'Title Required';
            return true;
        }
        if (strlen($value) < 5 ) {
            static::$validation_error['title'] = "Title Must Contain At Least 5 char !";
            return true;
        }
        self::pass('title');
        return false;
    }
    public static function description($value){
        if(!$value){
            static::$validation_error['description'] = 'Description Required';
            return true;
        }
        if (strlen($value) <= 10 ) {
            static::$validation_error['description'] = "Description Must Contain At Least 10 char !";
            return true;
        }
        self::pass('description');
        return false;
    }
    public static function note($value){
        if(!$value){
            static::$validation_error['note'] = 'Note Required';
            return true;
        }
        if (strlen($value) <= 20 ) {
            static::$validation_error['note'] = "Note Must Contain At Least 20 char !";
            return true;
        }
        self::pass('description');
        return false;
    }
    public static function department($v){
        if(!$v){
            static::$validation_error['department_id'] = 'Department Required';
            return true;
        }
        if(!is_numeric($v)){
            static::$validation_error['department_id'] = 'Invalid Department ID';
            return true;
        }
        $query = new Query();
        $dep = $query->table('departments')->where('id','=',$v)->first();
        if(!$dep){
            static::$validation_error['department_id'] = 'Department not found';
            return true;
        }
        self::pass('department_id');
        return false;
    }
    public static function ticket_status($value = null){
        if($value && !in_array($value,['open','in_progress','closed'])){
            static::$validation_error['status'] = 'Invalid Status';
            return true;
        }
        self::pass('status');
        return false;
    }
    public static function register($data){
        self::clear();
        self::name($data['name']);
        self::new_email($data['email']);
        self::role($data['role']);
        self::new_password($data['password'],$data['confirm_password']);
    }
    public static function login($data){
        self::clear();
        self::email($data['email']);
        self::password($data['password']);
    }
    public static function new_ticket($data){
        self::clear();
        self::title($data['title']);
        self::description($data['description']);
        self::department($data['department_id']);
        self::ticket_status($data['status']);
    }
}