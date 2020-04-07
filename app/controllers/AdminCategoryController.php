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

        $data = $this->model->get_categories($params);

        if(isModeDebug()){
            writeLog(INFO_LOG, "AdminCategoryController/display", json_encode($data));
        }

        $this->view("AdminCategoryView", $data);
    }


    function display_create()
    {

        isLogged();

        $params = array(
            'mode' => ONLY_PARENTS
        );

        $data = $this->model->get_categories($params);

        $data['display_create'] = true;

        if(isModeDebug()){
            writeLog(INFO_LOG, "AdminCategoryController/display_create", json_encode($data));
        }

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
                    'parent_cat' => filter_var($_POST['parent_cat'], FILTER_SANITIZE_NUMBER_INT)
                );

                $data = $this->model->create_category($params);

                $params = array(
                    'mode' => ALL_CATEGORIES
                );

                $categories = $this->model->get_categories($params);

                $data['categories'] = $categories['categories'];

                if(isModeDebug()){
                    writeLog(INFO_LOG, "AdminCategoryController/create_category", json_encode($data));
                }

                $this->view("AdminCategoryView", $data);
            } else {
                header("Location: index.php?url=AdminCategoryController/display");
            }
        }
    }

    function display_edit($id_category)
    {
        isLogged();

        $params = array(
            'id_category' => $id_category
        );

        $data = $this->model->get_category($params);

        $params = array(
            'mode' => ONLY_PARENTS
        );

        $data['categories'] = $this->model->get_categories($params)['categories'];

        $data['display_edit'] = true;

        if(isModeDebug()){
            writeLog(INFO_LOG, "AdminCategoryController/display_edit", json_encode($data));
        }

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
                    'parent_cat' => filter_var($_POST['parent_cat'], FILTER_SANITIZE_NUMBER_INT),
                    'id' => filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT)
                );

                $data = $this->model->edit_category($params);

                $params = array(
                    'mode' => ALL_CATEGORIES
                );

                $categories = $this->model->get_categories($params);

                $data['categories'] = $categories['categories'];

                if(isModeDebug()){
                    writeLog(INFO_LOG, "AdminCategoryController/edit_category", json_encode($data));
                }

                $this->view("AdminCategoryView", $data);
            } else {
                header("Location: index.php?url=AdminCategoryController/display");
            }
        }
    }

    function delete_category($id_category)
    {

        isLogged();

        $params = array(
            'id_category' => filter_var($id_category, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->delete_category($params);

        $params = array(
            'mode' => ALL_CATEGORIES
        );

        $categories = $this->model->get_categories($params);

        $data['categories'] = $categories['categories'];

        if(isModeDebug()){
            writeLog(INFO_LOG, "AdminCategoryController/delete_category", json_encode($data));
        }

        $this->view("AdminCategoryView", $data);
    }
}
