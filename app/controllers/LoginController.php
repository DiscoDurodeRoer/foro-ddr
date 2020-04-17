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

            if (isset($_POST['action'])) {

                $data = array();

                $params = array(
                    'nick_email' => $_POST['nick_email'],
                    'pass' => $_POST['pass']
                );

                $data = $this->model->checkLogin($params);

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "Login/login", json_encode($data));
                }

                if ($data['success']) {
                    if ($data['user']) {
                        prepareDataLogin($data['user']);
                    }
                    redirect_to_url(BASE_URL);
                } else {
                    $this->view("LoginView", $data);
                }
            } else {
                redirect_to_url("index.php");
            }
        }
    }
}
