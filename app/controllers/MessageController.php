<?php

class MessageController extends Controller {

    private $model;

    function __construct()
    {
        $this->model = $this->model("Message");
    }

    function display($params=null){
        
        if(isset($params[0])){
            $datos = $this->model->getMessagesByTopic($params[0]);
      
            $this->view("MessageView", $datos);
        }

        

    }

}
