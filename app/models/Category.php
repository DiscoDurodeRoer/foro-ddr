<?php

class Category
{

    function __construct()
    {
    }

    function get_categories($params)
    {

        $db = new PDODB();
        $data = array();
        $data['categories'] = array();

        try {

            $sql = "SELECT * ";
            $sql .= "FROM categories ";
            if (isset($params['id_cat_parent'])) {
                $sql .= "WHERE id = " . $params['id_cat_parent'] . " or parent_cat = " . $params['id_cat_parent'] . " ";
            }
            $sql .= "ORDER BY name";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Category/get_categories", $sql);
            }

            $datadb = $db->getData($sql);

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
            
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Category/get_categories", $e->getMessage());
        }

        $db->close();

        return $data;
    }
}
