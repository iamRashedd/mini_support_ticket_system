<?php

class AuthMiddleware{
    public function handle(){
        !auth() ? abort() : null;
    }
}