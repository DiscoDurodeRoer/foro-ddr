<?php

class TopicController extends Controller {

    private $model;

    function __construct()
    {
        $this->model = $this->model("Topic");
    }

    function display(){
        
        $datos = $this->model->getTopics();
      
        $this->view("TopicView", $datos);

    }

}

?>