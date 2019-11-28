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
      
            $datos['display'] = true;

            $this->view("TopicView", $datos);
        }

    }

    function display_create_topic($params=null){

        $datos = array();

        $datos['create'] = true;
        if(isset($params[0])){
            $datos['id_cat'] = $params[0];
        }
        

        $this->view("TopicView", $datos);

    }

    function create_topic(){

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $datos = array();

            $datos = $this->model->create_topic();

            if($datos['success']){
                $datos['message'] = "El topic se ha creado correctamente. Pulsa <a href='index.php?url=MessageController/display/" . $datos['id_topic'] . "'>aquí</a> para ir al topic.";
            }else{
                $datos['message'] = "El topic no se creo correctamente.";
            }
          
            $this->view("TopicView", $datos);

        }

    }


}
