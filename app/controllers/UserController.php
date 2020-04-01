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

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER)
        );

        $data['info_user'] = $this->model->getAllInfoUser($params);

        $data['profile'] = true;

        $this->view("UserView", $data);
    }

    function display_edit_profile()
    {

        $data = array();

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER)
        );

        $data = $this->model->getAllInfoUser($params);

        $data['edit_profile'] = true;

        $this->view("UserView", $data);
    }

    function edit_profile()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $params = array(
                'nickname' => $_POST['nickname'],
                'email' => $_POST['email'],
                'id' => $_POST['id']
            );

            $errors = $this->model->checkErrors($params);

            if (count($errors) === 0) {

                $params = array(
                    'nickname' => $_POST['nickname'],
                    'email' => $_POST['email'],
                    'id' => $_POST['id'],
                    'username' => $_POST['username'],
                    'surname' => $_POST['surname'],
                    'avatar' => $_POST['avatar']
                );    

                $data = $this->model->edit_profile($params);

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

            $params = array(
                'nickname' => $_POST['nickname'],
                'email' => $_POST['email'],
                'id' => null,
                'pass' => $_POST['pass'],
                'confirm_pass' => $_POST['confirm_pass']
            );

            $errors = $this->model->checkErrors($params);

            if (count($errors) === 0) {

                $params = array(
                    'username' => $_POST['username'],
                    'surname' => $_POST['surname'],
                    'nickname' => $_POST['nickname'],
                    'email' => $_POST['email'],
                    'pass' => $_POST['pass'],
                    'avatar' => $_POST['avatar']
                );

                $data = $this->model->registry($params);

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

            $params = array(
                'pass' => $_POST['pass'],
                'confirm-pass' => $_POST['confirm-pass']
            );

            $errors = array();

            $this->model->checkPass($params, $errors);

            // Si no hay errores, muestro el mensaje
            if (count($errors) === 0) {

                $session = new Session();

                $params = array(
                    'id_user' => $session->getAttribute(SESSION_ID_USER),
                    'pass' => $_POST['pass']
                );

                $data = $this->model->change_password($params);

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

    function unsubscribe()
    {

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER)
        );

        $data = $this->model->unsubscribe($params);

        if ($data['success']) {
            $session->destroySession();
            header("Location: /foro-ddr/");
        }
    }

    function no_unsubscribe()
    {
        header("Location: index.php?url=UserController/display_profile/");
    }
}
