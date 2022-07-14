<?php

class AdminController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Admin");
    }

    function display()
    {
        isLogged();

        header("Location: " . constant('BASE_URL') . "admin/categorias");
    }

    function back()
    {
        header("Location: " . constant('BASE_URL'));
    }
}
