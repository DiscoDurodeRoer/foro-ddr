<?php

class Category {

    function __construct()
    { }

    function getCategories($id_parent = null){

        $sql = "SELECT * ";
        $sql .= "FROM categories ";

        if(isset($id_parent)){
            $sql .= "WHERE id = " .$id_parent. " or parent_cat = " .$id_parent;
        }

        $db = new MySQLDB();

        $datadb = $db->getData($sql);

        $data = array();
        $data['categories'] = array();

        if(isset($id_parent)){
            foreach ($datadb  as $key => $value) {
                if($value['id'] === $id_parent){
                    array_push($data['categories'], $value);
                }
            }
        }else{
            foreach ($datadb  as $key => $value) {
                if($value['id'] === $value['parent_cat']){
                    array_push($data['categories'], $value);
                }
            }
        }


        foreach ($data['categories'] as $key => $value) {

            $id_parent_child = $value['id'];

            $child = array_filter($datadb, function($element) use ($id_parent_child){
                return $element['parent_cat'] === $id_parent_child 
                        && $element['id'] != $element['parent_cat'];
            });

            $data['categories'][$key]['child'] = $child;

        }

        $db->close();

        return $data;

    }

}
