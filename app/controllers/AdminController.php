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

        $this->view("AdminView");
    }

    function back(){
        header("Location: /foro-ddr");
    }
}
