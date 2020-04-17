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
            } else {
                $data['num_elems'] = $db->numRows($sql);
                $sql .= "LIMIT " . ($params['page'] - 1) * NUM_ITEMS_PAG . "," . NUM_ITEMS_PAG;
            }

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminCategory/get_categories", $sql);
            }

            $data['categories'] = $db->getData($sql);

            if ($params['mode'] === ALL_CATEGORIES) {
                $data["pag"] = $params['page'];
                $data['last_page'] = ceil($data['num_elems'] / NUM_ITEMS_PAG);
                $data['url_base'] = "AdminCategoryController/display";
            }

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

        $db = new MySQLDB();
        $data = array();
        $data['show_message_info'] = true;

        try {


            $sql = "SELECT IFNULL((MAX(id) + 1), 1) as id FROM categories";
            
            $id = $db->getDataSingleProp($sql, 'id');



            $sql = "INSERT INTO categories ";
            $sql .= "VALUES( ";
            $sql .= $id . ",";
            $sql .= "'" . $params['name'] . "', ";
            $sql .= "'" . $params['description'] . "', ";
            $sql .= "'" . $params['parent_cat'] . "', ";
            $sql .= "'',"; // icono
            $sql .= "0";
            $sql .= ");";

            // $sql = "INSERT INTO categories ";
            // $sql .= "SELECT IFNULL((MAX(id) + 1), 1),";
            // $sql .= "'" . $params['name'] . "', ";
            // $sql .= "'" . $params['description'] . "', ";
            // $sql .= "'" . $params['parent_cat'] . "', ";
            // $sql .= "'',"; // icono
            // $sql .= "0 ";
            // $sql .= "FROM categories;";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminCategory/create_category", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

            // $id_cat = $db->getLastId();

            // writeLog(INFO_LOG, "AdminCategory/create_category id_cat", $id_cat);


            // $sql = "SELECT id_cat_parent, level ";
            // $sql .= "FROM categories_child ";
            // $sql .= "WHERE id_cat = " . $params['parent_cat'] . " ";
            // $sql .= "ORDER BY level ";

            // if (isModeDebug()) {
            //     writeLog(INFO_LOG, "AdminCategory/create_category", $sql);
            // }

            // $categories_child = $db->getData($sql);

            // $last_level = 1;

            // foreach ($categories_child as $key => $value) {

            //     $sql = "INSERT INTO categories_child ";
            //     $sql .= "VALUES( ";
            //     $sql .= $id_cat . " ,";
            //     $sql .= $value['id_cat_parent'] . " ,";
            //     $sql .= $value['level'];
            //     $sql .= ");";

            //     $last_level = $value['level'];

            //     if (isModeDebug()) {
            //         writeLog(INFO_LOG, "AdminCategory/create_category", $sql);
            //     }

            //     $db->executeInstruction($sql);
            // }

            // $sql = "INSERT INTO categories_child ";
            // $sql .= "VALUES( ";
            // $sql .= $id_cat . " ,";
            // $sql .= $id_cat . " ,";
            // $sql .= ($last_level + 1);
            // $sql .= ");";

            // if (isModeDebug()) {
            //     writeLog(INFO_LOG, "AdminCategory/create_category", $sql);
            // }

            // $db->executeInstruction($sql);


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
        $data['message'] = array();

        try {

            if (empty($params['name']) || empty($params['description'])) {

                if (empty($params['name'])) {
                    array_push($data['message'], "El nombre de la categoria es obligatoria");
                }

                if (empty($params['description'])) {
                    array_push($data['message'], "La descripción de la categoria es obligatoria");
                }
            } else {
                $sql = "UPDATE categories SET ";
                $sql .= "name = '" . $params['name'] . "', ";
                $sql .= "description = '" . $params['description'] . "', ";
                $sql .= "parent_cat = '" . $params['parent_cat'] . "' ";
                $sql .= "WHERE id = " . $params['id'];

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "AdminCategory/edit_category", $sql);
                }

                $data['success'] = $db->executeInstruction($sql);

                $sql = "DELETE FROM categories_child ";
                $sql .= "WHERE id_cat = " . $params['id'] . " ";
                $sql .= "and level > (";
                $sql .=         "SELECT level ";
                $sql .=         "FROM categories_child ";
                $sql .=         "WHERE id_cat_parent = (";
                $sql .=             "SELECT parent_cat ";
                $sql .=             "FROM categories ";
                $sql .=             "WHERE id = ". $params['parent_cat'].")";
                $sql .=         ")";
                
                if (isModeDebug()) {
                    writeLog(INFO_LOG, "AdminCategory/edit_category", $sql);
                }

                $db->executeInstruction($sql);

                $sql = "INSERT INTO categories_child ";
                $sql .= "VALUES( ";
                $sql .= $params['id'] . " ,";
                $sql .= $params['parent_cat'] . " ,";
                $sql .= "(SELECT (level + 1) FROM categories_child WHERE id_cat_parent = (SELECT parent_cat FROM categories WHERE id = ". $params['parent_cat']."))";
                $sql .= ");";
    
                if (isModeDebug()) {
                    writeLog(INFO_LOG, "AdminCategory/create_category", $sql);
                }
    
                $db->executeInstruction($sql);


                $sql = "INSERT INTO categories_child ";
                $sql .= "VALUES( ";
                $sql .= $params['id'] . " ,";
                $sql .= $params['id'] . " ,";
                $sql .= "(SELECT (level + 2) FROM categories_child WHERE id_cat_parent = (SELECT parent_cat FROM categories WHERE id = ". $params['parent_cat']."))";
                $sql .= ");";
    
                if (isModeDebug()) {
                    writeLog(INFO_LOG, "AdminCategory/create_category", $sql);
                }
    
                $db->executeInstruction($sql);

                if ($data['success']) {
                    array_push($data['message'], "Se ha editado la categoria correctamente");
                } else {
                    array_push($data['message'], "No se ha editado la categoria correctamente");
                }
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

            $sql = "DELETE FROM categories_child ";
            $sql .= "WHERE id_cat = " . $params['id_category'];

            $db->executeInstruction($sql);

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
