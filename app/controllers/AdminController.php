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

        header("Location: index.php?url=AdminCategoryController/display");
    }

    function back()
    {
        header("Location: /foro-ddr");
    }
}
