<?php

class CategoryController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Category");
    }

    function display($id_cat_parent=null)
    {

        $data = $this->model->getCategories($id_cat_parent);
        
        $this->view("CategoryView", $data);
    }
}
