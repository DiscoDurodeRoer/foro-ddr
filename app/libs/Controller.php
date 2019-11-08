<?php


class Controller{

    function __construct(){ }

    public function model($modelo){
        require_once("../app/models/".$modelo.".php");
        return new $modelo();
    }
    
    public function view($view, $datos=[]){
        if(file_exists("../app/views/".$view.".php")){
            $session = new Session();
            $datos['login']= $session->getLogin();
            $datos['nickname']=$session->getNickname();
            require_once("../app/views/".$view.".php");
        }else{
            die("No existe la vista");
        }
    }


}

?>