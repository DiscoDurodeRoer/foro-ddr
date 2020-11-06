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

        header("Location: /foro-ddr/admin/categorias");
    }

    function back()
    {
        header("Location: /foro-ddr");
    }
}
