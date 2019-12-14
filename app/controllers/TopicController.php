<?php

class TopicController extends Controller {

    private $model;

    function __construct()
    {
        $this->model = $this->model("Topic");
    }

    function display($id_cat=null){
        
        // Si existe la categoria, muestro los topic
        if(isset($id_cat)){
            $data = $this->model->getTopics($id_cat);
      
            // Indico que es para mostrar
            $data['display'] = true;

            $this->view("TopicView", $data);
        }

    }

    function display_create_topic($id_cat=null){

        $data = array();

        $data['create'] = true;
        
        if(isset($id_cat)){
            $data['id_cat'] = $id_cat;
        }
        
        $this->view("TopicView", $data);

    }

    function create_topic(){

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $session = new Session();

            $data = $this->model->create_topic(
                $session->getAttribute(SESSION_ID_USER),
                $_POST['title'],
                filter_var($_POST['id_cat'], FILTER_SANITIZE_NUMBER_INT),
                $_POST['text'],
            );

            if($data['success']){
                $data['message'] = "El topic se ha creado correctamente. Pulsa <a href='index.php?url=MessageController/display/" . $data['id_topic'] . "'>aquí</a> para ir al topic.";
            }else{
                $data['message'] = "El topic no se creo correctamente.";
            }
          
            $this->view("TopicView", $data);

        }

    }


}
