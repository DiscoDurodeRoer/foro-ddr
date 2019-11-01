<?php

class UserController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("User");
    }

    function display()
    {

        $this->view("UserView");
    }

    function registrer()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $datos = array();

            $errors = $this->model->checkErrors();

            if (count($errors) === 0) {

                $success = $this->model->registry();

                $datos['success'] = $success;

                $this->view("UserView", $datos);
            } else {
                $datos['errors'] = $errors;
                $this->view("UserView", $datos);
            }
        }
    }
}
