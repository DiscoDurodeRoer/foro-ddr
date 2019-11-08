<?php

class LoginController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Login");
    }

    function display()
    {

        $this->view("LoginView");
    }

    function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $datos = array();

            $datos = $this->model->checkLogin();

            if($datos['success']){
                $session = new Session();
                $session->login($datos['user']);
                header("Location: /foro-ddr/");
            }else{
                $datos['error'] = "Usuario/email o contraseña incorrectos";
                $this->view("LoginView", $datos);
            }

        }
    }
}
