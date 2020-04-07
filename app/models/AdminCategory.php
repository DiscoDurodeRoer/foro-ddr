<?php

class AdminCategory
{

    function __construct()
    {
    }

    function get_categories($params)
    {

        $db = new PDODB();
        $data = array();

        try {

            $sql = "SELECT cc.id, cc.name, cc.description, cp.name as parent, cc.icon, cc.num_topics, ";
            $sql .= "(select count(*) from categories WHERE cc.id = parent_cat) as has_child ";
            $sql .= "FROM categories cc, categories cp ";
            $sql .= "WHERE cc.parent_cat = cp.id ";

            if ($params['mode'] == ONLY_PARENTS) {
                $sql .= "and cc.num_topics = 0 ";
            } else if ($params['mode'] == ONLY_CHILDS) {
                $sql .= "and (select count(*) from categories WHERE cc.id = parent_cat) = 0 ";
            }

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminCategory/get_categories", $sql);
            }

            $data['categories'] = $db->getData($sql);

            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminCategory/get_categories", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function create_category($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;

        try {
            $sql = "INSERT INTO categories ";
            $sql .= "VALUES( ";
            $sql .= "null,";
            $sql .= "'" . $params['name'] . "', ";
            $sql .= "'" . $params['description'] . "', ";
            $sql .= "'" . $params['parent_cat'] . "', ";
            $sql .= "'',"; // icono
            $sql .= "0";
            $sql .= ");";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminCategory/create_category", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

            if ($data['success']) {
                $data['message'] = "La categoria se ha creado correctamente";
            } else {
                $data['message'] = "La categoria no se ha creado correctamente";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminCategory/create_category", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function get_category($params)
    {

        $db = new PDODB();
        $data = array();

        try {
            $sql = "SELECT * ";
            $sql .= "FROM categories ";
            $sql .= "WHERE id = " . $params['id_category'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminCategory/get_category", $sql);
            }

            $data['category'] = $db->getDataSingle($sql);
            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminCategory/get_category", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function edit_category($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;

        try {
            $sql = "UPDATE categories SET ";
            $sql .= "name = '" . $params['name'] . "', ";
            $sql .= "description = '" . $params['description'] . "', ";
            $sql .= "parent_cat = '" . $params['parent_cat'] . "' ";
            $sql .= "WHERE id = " . $params['id'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminCategory/edit_category", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

            if ($data['success']) {
                $data['message'] = "Se ha editado la categoria correctamente";
            } else {
                $data['message'] = "No se ha editado la categoria correctamente";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminCategory/edit_category", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function delete_category($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;

        try {

            $sql = "DELETE FROM categories ";
            $sql .= "WHERE id = " . $params['id_category'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminCategory/delete_category", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

            if ($data['success']) {
                $data['message'] = "Se ha borrado la categoria correctamente";
            } else {
                $data['message'] = "No se ha borrado la categoria correctamente";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminCategory/delete_category", $e->getMessage());
        }

        $db->close();
        return $data;
    }
}
