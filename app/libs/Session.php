<?php

class Session {

    // private $login;
    private $user;

    function __construct()
    {
        // $this->login = false;
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['user'])){
            $this->user = $_SESSION['user'];
            // $this->login = true;
            $_SESSION['login']=true;
        }

    }

    public function getLogin(){
        return isset($_SESSION['login']) ? $_SESSION['login'] : false;
    }

    public function getUser(){
        return $this->user;
    }

    public function getIdUser(){
        return $this->user['id'];
    }

    public function getNickname(){
        return $this->user['nickname'];
    }

    public function login($user){
        if($user){
            $_SESSION['user'] = $user;
            $this->user= $user;
            $_SESSION['login'] = true;
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        unset($this->user);
        unset($_SESSION['login']);
        session_destroy();
    }

}
