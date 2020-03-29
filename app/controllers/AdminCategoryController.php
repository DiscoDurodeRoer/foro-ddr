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

        $data = $this->model->getCategories(ONLY_PARENTS);

        $data['display_create'] = true;

        $this->view("AdminCategoryView", $data);
    }

    function create_category()
    {

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['action'])) {
                $this->model->create_category();
            }

            header("Location: index.php?url=AdminCategoryController/display");
        }
    }

    function display_edit($idCategory)
    {
        isLogged();

        $data = $this->model->getCategory($idCategory);
        $data['categories'] = $this->model->getCategories(ONLY_PARENTS)['categories'];

        $data['display_edit'] = true;

        $this->view("AdminCategoryView", $data);
    }

    function edit_category()
    {

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['action'])) {
                $this->model->edit_category();
            }
            header("Location: index.php?url=AdminCategoryController/display");
        }
    }

    function delete_category($idCategory)
    {

        isLogged();

        $this->model->delete_category($idCategory);

        header("Location: index.php?url=AdminCategoryController/display");
    
    }
}
