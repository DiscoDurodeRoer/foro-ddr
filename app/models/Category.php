<?php

class Category
{

    function __construct()
    {
    }

    function getCategories($params)
    {

        $sql = "SELECT * ";
        $sql .= "FROM categories ";

        if (isset($params['id_cat_parent'])) {
            $sql .= "WHERE id = " . $params['id_cat_parent'] . " or parent_cat = " . $params['id_cat_parent'] . " ";
        }

        $sql .= "ORDER BY name";

        $db = new MySQLDB();

        $datadb = $db->getData($sql);

        $data = array();
        $data['categories'] = array();

        if (isset($params['id_cat_parent'])) {
            foreach ($datadb  as $key => $value) {
                if ($value['id'] === $params['id_cat_parent']) {
                    array_push($data['categories'], $value);
                }
            }
        } else {
            foreach ($datadb  as $key => $value) {
                if ($value['id'] === $value['parent_cat']) {
                    array_push($data['categories'], $value);
                }
            }
        }


        foreach ($data['categories'] as $key => $value) {

            $id_cat_parent_child = $value['id'];

            $child = array_filter($datadb, function ($element) use ($id_cat_parent_child) {
                return $element['parent_cat'] === $id_cat_parent_child
                    && $element['id'] != $element['parent_cat'];
            });

            $data['categories'][$key]['child'] = $child;
        }

        $db->close();

        return $data;
    }
}
