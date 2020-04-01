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

        $params = array(
            'mode' => ALL_CATEGORIES
        );

        $data = $this->model->getCategories($params);

        $this->view("AdminCategoryView", $data);
    }


    function display_create()
    {

        isLogged();

        $params = array(
            'mode' => ONLY_PARENTS
        );

        $data = $this->model->getCategories($params);

        $data['display_create'] = true;

        $this->view("AdminCategoryView", $data);
    }

    function create_category()
    {

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['action'])) {

                $params = array(
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'parent_cat' => $_POST['parent_cat'],
                );

                $this->model->create_category($params);
            }

            header("Location: index.php?url=AdminCategoryController/display");
        }
    }

    function display_edit($id_category)
    {
        isLogged();

        $params = array(
            'id_category' => $id_category
        );

        $data = $this->model->getCategory($params);

        $params = array(
            'mode' => ONLY_PARENTS
        );

        $data['categories'] = $this->model->getCategories($params)['categories'];

        $data['display_edit'] = true;

        $this->view("AdminCategoryView", $data);
    }

    function edit_category()
    {

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['action'])) {

                $params = array(
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'parent_cat' => $_POST['parent_cat'],
                    'id' => $_POST['id']
                );

                $this->model->edit_category($params);
            }
            header("Location: index.php?url=AdminCategoryController/display");
        }
    }

    function delete_category($id_category)
    {

        isLogged();

        $params = array(
            'id_category' => $id_category
        );

        $this->model->delete_category($params);

        header("Location: index.php?url=AdminCategoryController/display");
    }
}
