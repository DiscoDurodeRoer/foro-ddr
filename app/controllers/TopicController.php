<?php

class TopicController extends Controller {

    private $model;

    function __construct()
    {
        $this->model = $this->model("Topic");
    }

    function display($params=null){
        
        if(isset($params[0])){
            $datos = $this->model->getTopics($params[0]);
      
            $this->view("TopicView", $datos);
        }

        

    }

}
