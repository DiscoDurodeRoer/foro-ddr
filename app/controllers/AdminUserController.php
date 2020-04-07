<?php

class AdminUserController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("AdminUser");
    }

    function display()
    {
        isLogged();

        $data = $this->model->get_all_users();

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminUserController/display", json_encode($data));
        }

        $this->view("AdminUserView", $data);
    }

    function ban_user($id_user)
    {
        isLogged();

        $params = array(
            'id_user' => filter_var($id_user, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->ban_user($params);

        $users = $this->model->get_all_users();

        $data['users'] = $users['users'];

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminUserController/ban_user", json_encode($data));
        }

        $this->view("AdminUserView", $data);
    }

    function no_ban_user($id_user)
    {
        isLogged();

        $params = array(
            'id_user' => filter_var($id_user, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->no_ban_user($params);

        $users = $this->model->get_all_users();

        $data['users'] = $users['users'];

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminUserController/no_ban_user", json_encode($data));
        }

        $this->view("AdminUserView", $data);
    }

    function no_act_user($id_user)
    {
        isLogged();

        $params = array(
            'id_user' => filter_var($id_user, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->no_act_user($params);

        $users = $this->model->get_all_users();

        $data['users'] = $users['users'];

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminUserController/no_act_user", json_encode($data));
        }

        $this->view("AdminUserView", $data);
    }

    function act_user($id_user)
    {
        isLogged();

        $params = array(
            'id_user' => filter_var($id_user, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->act_user($params);

        $users = $this->model->get_all_users();

        $data['users'] = $users['users'];

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminUserController/act_user", json_encode($data));
        }

        $this->view("AdminUserView", $data);
    }
}
