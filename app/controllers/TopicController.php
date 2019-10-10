<?php

class TopicController extends Controller {

    private $modelo;

    function __construct()
    {
        $this->modelo = $this->model("Topic");
    }

    function display(){
        $datos = array();

        $datos[0] = "Valor 1";
        $datos[1] = "Valor 2";
        $datos[2] = "Valor 3";


        $this->view("TopicView", $datos);

    }

}

?>