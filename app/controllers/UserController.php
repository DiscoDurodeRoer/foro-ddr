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
        $datos['registry'] = true;

        $this->view("UserView", $datos);
    }

    function display_profile()
    {

        $datos = array();

        $session = new Session();

        $datos['info_user'] = $this->model->getAllInfoUser($session->getIdUser());

        $datos['profile'] = true;

        $this->view("UserView", $datos);
    }

    function edit_profile()
    {

        $datos = array();

        $session = new Session();

        $datos['info_user'] = $this->model->getAllInfoUser($session->getIdUser());

        $datos['edit_profile'] = true;

        $this->view("UserView", $datos);
    }

    function edit_password()
    {

        $datos = array();

        $datos['change_password'] = true;

        $this->view("UserView", $datos);
    }

    function registrer()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $datos = array();

            $errors = $this->model->checkErrors();

            if (count($errors) === 0) {

                $datos = $this->model->registry();

                if ($datos['success']) {
                    $session = new Session();
                    $session->login($datos['user']);
                    $datos['message'] = "Su registro se ha completado con éxito. Pulsa <a href='/foro-ddr/'>aquí</a> para volver al inicio.";
                } else {
                    $datos['message'] = "Su registro no se ha realizado con éxito. Contacte con discoduroderoer desde este <a href='https://www.discoduroderoer.es/contactanos/'>formulario</a>.";
                }

                $this->view("UserView", $datos);
            } else {
                $datos['errors'] = $errors;
                $datos['registry'] = true;
                $this->view("UserView", $datos);
            }
        }
    }

    function change_password()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $datos = array();

            $errors = array();
            $this->model->checkPass($errors);

            if (count($errors) === 0) {

                $datos = $this->model->change_password();

                if ($datos['success']) {
                    $datos['message'] = "La contraseña ha sido cambiada";
                } else {
                    $datos['message'] = "Su contraseña no ha sido cambiada";
                }

                $this->view("UserView", $datos);
            } else {
                $datos['errors'] = $errors;
                $datos['change_password'] = true;
                $this->view("UserView", $datos);
            }
        }
    }

    function logout()
    {
        $session = new Session();
        $session->logout();
        header("Location: /foro-ddr/");
    }

    function display_unsubscribe()
    {
        $datos = array();
        $datos['display_unsubscribe'] = true;
        $this->view("UserView", $datos);
    }

    function unsubscribe(){

        $datos = $this->model->unsubscribe();
        print_r($datos);
        if($datos['success']){
            $session = new Session();
            $session->logout();
            header("Location: /foro-ddr/");
        }

    }

    function no_unsubscribe(){
        header("Location: index.php?url=UserController/display_profile/");
    }
}
