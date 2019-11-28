<?php

class MessageController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Message");
    }

    function display($params = null)
    {

        if (isset($params)) {
            $datos = $this->model->getMessagesByTopic($params);

            $datos["display"] = true;

            $this->view("MessageView", $datos);
        }
    }

    function display_reply_topic($params = null)
    {

        if (isset($params)) {

            $datos["reply_message"] = true;

            $datos['id_topic'] = $params;

            $this->view("MessageView", $datos);
        }
    }

    function reply_topic()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") { 

            $datos = $this->model->reply_topic();

            if($datos['success']){
                header("Location: /foro-ddr/index.php?url=MessageController/display/".$_POST['id_topic']);
            }else{
                $this->view("MessageView", $datos);
            }



        }

    }
}
