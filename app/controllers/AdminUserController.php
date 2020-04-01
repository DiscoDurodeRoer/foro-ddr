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

        $data = $this->model->getAllUsers();

        $this->view("AdminUserView", $data);
    }

    function banUser($id_user)
    {
        isLogged();

        $params = array(
            'id_user' => $id_user
        );

        $this->model->banUser($params);

        header("Location: index.php?url=AdminUserController/display");
    }

    function noBanUser($id_user)
    {
        isLogged();

        $params = array(
            'id_user' => $id_user
        );

        $this->model->noBanUser($params);

        header("Location: index.php?url=AdminUserController/display");
    }

    function noActUser($id_user)
    {
        isLogged();

        $params = array(
            'id_user' => $id_user
        );

        $this->model->noActUser($params);

        header("Location: index.php?url=AdminUserController/display");
    }

    function actUser($id_user)
    {
        isLogged();

        $params = array(
            'id_user' => $id_user
        );

        $this->model->actUser($params);

        header("Location: index.php?url=AdminUserController/display");
    }
}
