<?php

class CategoryController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Category");
    }

    function display($params=null)
    {

        if (isset($params)) {
            $datos = $this->model->getCategories($params[0]);
        } else {
            $datos = $this->model->getCategories();
        }


        $this->view("CategoryView", $datos);
    }
}
