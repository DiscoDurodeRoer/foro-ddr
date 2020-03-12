<?php

class AdminCategoryController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("AdminCategory");
    }

    function display()
    {
        isLogged();

        $data = $this->model->getCategories();

        $this->view("AdminCategoryView", $data);
    }


    function display_create()
    {

        isLogged();

        $data = $this->model->getCategories();

        $data['display_create'] = true;

        $this->view("AdminCategoryView", $data);
    }

    function create_category(){

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $this->model->create_category();

            header("Location: index.php?url=AdminCategoryController/display");

        }

    }
}
