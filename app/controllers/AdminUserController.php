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

    function banUser($idUser)
    {
        isLogged();

        $this->model->banUser($idUser);

        header("Location: index.php?url=AdminUserController/display");
    }

    function noBanUser($idUser)
    {
        isLogged();

        $this->model->noBanUser($idUser);

        header("Location: index.php?url=AdminUserController/display");
    }

    function noActUser($idUser)
    {
        isLogged();

        $this->model->noActUser($idUser);

        header("Location: index.php?url=AdminUserController/display");
    }

    function actUser($idUser)
    {
        isLogged();

        $this->model->actUser($idUser);

        header("Location: index.php?url=AdminUserController/display");
    }
}
