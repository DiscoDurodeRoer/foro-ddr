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

        $data = $this->model->get_all_info_user($params);

        $data['profile'] = true;

        if (isModeDebug()) {
            writeLog(INFO_LOG, "UserController/display_profile", json_encode($data));
        }

        $this->view("UserView", $data);
    }

    function display_edit_profile()
    {

        $data = array();

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER)
        );

        $data = $this->model->get_all_info_user($params);

        $data['edit_profile'] = true;

        if (isModeDebug()) {
            writeLog(INFO_LOG, "UserController/display_edit_profile", json_encode($data));
        }

        $this->view("UserView", $data);
    }

    function edit_profile()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {


            if (isset($_POST['action'])) {

                $data = array();

                $params = array(
                    'name' => $_POST['name'],
                    'surname' => $_POST['surname'],
                    'nickname' => $_POST['nickname'],
                    'email' => $_POST['email'],
                    'id_user' => filter_var($_POST['id_user'], FILTER_SANITIZE_NUMBER_INT)
                );

                $errors = $this->model->checkErrors($params);

                if (count($errors) === 0) {

                    $params = array(
                        'nickname' => $_POST['nickname'],
                        'email' => $_POST['email'],
                        'id_user' => $_POST['id_user'],
                        'name' => $_POST['name'],
                        'rol' => $_POST['rol'],
                        'surname' => $_POST['surname'],
                        'avatar' => $_POST['avatar']
                    );

                    $data = $this->model->edit_profile($params);
                } else {

                    $data['info_user'] = array(
                        'name' => $_POST['name'],
                        'surname' => $_POST['surname'],
                        'nickname' => $_POST['nickname'],
                        'email' => $_POST['email'],
                        'rol' => $_POST['rol'],
                        'id' => filter_var($_POST['id_user'], FILTER_SANITIZE_NUMBER_INT),
                        'avatar' => $_POST['avatar']
                    );

                    $data['show_message_info'] = true;
                    $data['success'] = false;
                    $data['message'] = $errors;
                    $data['edit_profile'] = true;
                }

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "UserController/edit_profile", json_encode($data));
                }

                $this->view("UserView", $data);
            } else {
                redirect_to_url("index.php?url=UserController/display_profile");
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

            if (isset($_POST['action'])) {
                $data = array();

                $params = array(
                    'name' => $_POST['name'],
                    'nickname' => $_POST['nickname'],
                    'email' => $_POST['email'],
                    'pass' => $_POST['pass'],
                    'confirm-pass' => $_POST['confirm-pass']
                );

                $errors = $this->model->checkErrors($params);

                if (count($errors) === 0) {

                    $params = array(
                        'name' => $_POST['name'],
                        'surname' => $_POST['surname'],
                        'nickname' => $_POST['nickname'],
                        'email' => $_POST['email'],
                        'pass' => $_POST['pass'],
                        'avatar' => $_POST['avatar']
                    );

                    $data = $this->model->registry($params);
                } else {
                    $data['show_message_info'] = true;
                    $data['success'] = false;
                    $data['message'] = $errors;
                    $data['registry'] = true;
                }

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "UserController/registrer", json_encode($data));
                }

                $this->view("UserView", $data);
            } else {
                redirect_to_url("index.php");
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
            } else {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = $errors;
                $data['change_password'] = true;
            }

            if (isModeDebug()) {
                writeLog(INFO_LOG, "UserController/change_password", json_encode($data));
            }

            $this->view("UserView", $data);
        }
    }

    function logout()
    {
        $session = new Session();
        $session->destroySession();
        redirect_to_url(BASE_URL);
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

        if (isModeDebug()) {
            writeLog(INFO_LOG, "UserController/unsubscribe", json_encode($data));
        }

        if ($data['success']) {
            $session->destroySession();
            redirect_to_url(BASE_URL);
        }
    }

    function verification($key){

        $params = [
            'key' => $key
        ];

        $data = $this->model->verification($params);

        $this->view("UserView", $data);

    }

    function no_unsubscribe()
    {
        header("Location: index.php?url=UserController/display_profile/");
    }
}
