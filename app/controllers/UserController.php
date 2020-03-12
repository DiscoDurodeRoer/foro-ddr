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
        $data['registry'] = true;

        $this->view("UserView", $data);
    }

    function display_profile()
    {

        $data = array();

        $session = new Session();

        $data['info_user'] = $this->model->getAllInfoUser($session->getAttribute(SESSION_ID_USER));

        $data['profile'] = true;

        $this->view("UserView", $data);
    }

    function display_edit_profile()
    {

        $data = array();

        $session = new Session();

        $data = $this->model->getAllInfoUser($session->getAttribute(SESSION_ID_USER));

        $data['edit_profile'] = true;

        $this->view("UserView", $data);
    }

    function edit_profile(){

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $errors = $this->model->checkErrors(
                $_POST['nickname'],
                $_POST['email'],
                $_POST['id']
            );

            if (count($errors) === 0) {

                $data = $this->model->edit_profile(
                    $_POST['id'],
                    $_POST['username'],
                    $_POST['surname'],
                    $_POST['nickname'],
                    $_POST['email'],
                    $_POST['avatar']
                );

                if ($data['success']) {
                    prepareDataLogin($data['user']);
                    $data['message'] = "La edición se ha completado con éxito. Pulsa <a href='/foro-ddr/'>aquí</a> para volver al inicio.";
                } else {
                    $data['message'] = "La edición no se ha realizado con éxito. Contacte con discoduroderoer desde este <a href='https://www.discoduroderoer.es/contactanos/'>formulario</a>.";
                }
                $this->view("UserView", $data);
            } else {
                $data['errors'] = $errors;
                $data['edit_profile'] = true;
                $this->view("UserView", $data);
            }

        }

    }

    function edit_password()
    {

        $data = array();

        $data['change_password'] = true;

        $this->view("UserView", $data);
    }

    function registrer()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $errors = $this->model->checkErrors(
                $_POST['nickname'],
                $_POST['email'],
                null
            );

            if (count($errors) === 0) {

                $data = $this->model->registry(
                    $_POST['username'],
                    $_POST['surname'],
                    $_POST['nickname'],
                    $_POST['email'],
                    $_POST['pass'],
                    $_POST['avatar']
                );

                if ($data['success']) {
                    prepareDataLogin($data['user']);
                    $data['message'] = "Su registro se ha completado con éxito. Pulsa <a href='/foro-ddr/'>aquí</a> para volver al inicio.";
                } else {
                    $data['message'] = "Su registro no se ha realizado con éxito. Contacte con discoduroderoer desde este <a href='https://www.discoduroderoer.es/contactanos/'>formulario</a>.";
                }

                $this->view("UserView", $data);
            } else {
                $data['errors'] = $errors;
                $data['registry'] = true;
                $this->view("UserView", $data);
            }
        }
    }

    function change_password()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $errors = array();
            $this->model->checkPass($errors);

            // Si no hay errores, muestro el mensaje
            if (count($errors) === 0) {

                $session = new Session();

                $data = $this->model->change_password(
                    $session->getAttribute(SESSION_ID_USER), 
                    $_POST['pass']
                );

                if ($data['success']) {
                    $data['message'] = "La contraseña ha sido cambiada";
                } else {
                    $data['message'] = "Su contraseña no ha sido cambiada";
                }

                $this->view("UserView", $data);
            } else {
                $data['errors'] = $errors;
                $data['change_password'] = true;
                $this->view("UserView", $data);
            }
        }
    }

    function logout()
    {
        $session = new Session();
        $session->destroySession();
        header("Location: /foro-ddr/");
    }

    function display_unsubscribe()
    {
        $data = array();
        $data['display_unsubscribe'] = true;
        $this->view("UserView", $data);
    }

    function unsubscribe(){

        $session = new Session();
        
        $data = $this->model->unsubscribe(
            $session->getAttribute(SESSION_ID_USER)
        );
        
        if($data['success']){
            $session->destroySession();
            header("Location: /foro-ddr/");
        }

    }

    function no_unsubscribe(){
        header("Location: index.php?url=UserController/display_profile/");
    }
}
