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

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $params = array(
                'nick_email' => $_POST['nick_email'],
                'pass' => $_POST['pass']
            );

            $data = $this->model->checkLogin($params);

            if($data['success']){
                
                if($data['user']){
                    prepareDataLogin($data['user']);
                }
                header("Location: /foro-ddr/");
            }else{
                $data['error'] = "Usuario/email o contraseña incorrectos";
                $this->view("LoginView", $data);
            }

        }
    }
}
