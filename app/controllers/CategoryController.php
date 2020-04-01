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

        $params = array(
            'id_cat_parent' => $id_cat_parent
        );

        $data = $this->model->getCategories($params);
        
        $this->view("CategoryView", $data);
    }
}
