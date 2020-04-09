<?php


class Topic
{

    function __construct()
    {
    }


    function get_topics($params)
    {

        $db = new PDODB();
        $data = array();

        try {

            $sql = "SELECT t.id, t.title, u.nickname, t.open, t.views ";
            $sql .= "FROM topics t, users u ";
            $sql .= "WHERE t.creator_user = u.id and ";
            $sql .= "t.id_cat = " . $params['id_cat'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Topic/get_topics", $sql);
            }

            $data_topics = $db->getData($sql);

            $data['topics'] = $data_topics;

            $sql = "SELECT name ";
            $sql .= "FROM categories ";
            $sql .= "WHERE id = " . $params['id_cat'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Topic/get_topics", $sql);
            }

            $data['id_cat'] = $params['id_cat'];
            $data['name_category'] = $db->getDataSingleProp($sql, "name");



            $sql = "SELECT c.id, c.name ";
            $sql .= "FROM categories_child cch, categories c ";
            $sql .= "WHERE c.id = cch.id_cat_parent and cch.id_cat = " . $data['id_cat']  . " ";
            $sql .= "ORDER BY level";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Topic/get_topics", $sql);
            }

            $parents = $db->getData($sql);

            $numRows = $db->numRows($sql);

            if ($numRows > 0) {

                $data['breadcumbs'] = array();

                foreach ($parents as $key => $value) {
                    $breadcumb = new BreadCumb(
                        $value['name'],
                        'index.php?url=CategoryController/display/' . $value['id'],
                        null,
                        $key < ($numRows - 1)
                    );

                    array_push($data['breadcumbs'], $breadcumb);
                }
            }


            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Topic/get_topics", $e->getMessage());
        }

        $db->close();
        return $data;
    }


    function create_topic($params)
    {

        $db = new PDODB();
        $data = array();

        $data['show_message_info'] = true;

        try {

            $sql = "INSERT INTO topics VALUES (";
            $sql .= "null, ";
            $sql .= "'" . $params['title_topic'] . "', ";
            $sql .= "'" . today() . "' , ";
            $sql .= $params['id_user'] . ", ";
            $sql .=  "1, ";
            $sql .=  "0, ";
            $sql .= $params['id_cat'] . " ";
            $sql .= ");";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Topic/create_topic", $sql);
            }

            $success = $db->executeInstruction($sql);

            if ($success) {
                $id_topic = $db->getLastId();
                $data['id_topic'] = $id_topic;

                $sql = "INSERT INTO messages VALUES (";
                $sql .= "null, "; // id
                $sql .= "'" . $params['text'] . "', "; // Texto 
                $sql .= "'" . today() . "' , "; // Fecha
                $sql .= $params['id_user'] . ", "; // fecha publicacion
                $sql .=  "1 "; // abierto
                $sql .= ")";

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "Topic/create_topic", $sql);
                }

                $success = $db->executeInstruction($sql);

                if ($success) {

                    $id_message = $db->getLastId();

                    $sql = "INSERT INTO messages_public VALUES (";
                    $sql .= $id_message . ", ";
                    $sql .= $id_topic . ", ";
                    $sql .= "1 ";
                    $sql .= ")";

                    if (isModeDebug()) {
                        writeLog(INFO_LOG, "Topic/create_topic", $sql);
                    }

                    $success = $db->executeInstruction($sql);
                }
            }

            $data['success'] = $success;

            if ($data['success']) {
                $data['message'] = "El topic se ha creado correctamente. Pulsa <a href='index.php?url=MessageController/display/" . $data['id_topic'] . "'>aquí</a> para ir al topic.";
            } else {
                $data['message'] = "El topic no se creo correctamente.";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Topic/get_topics", $e->getMessage());
        }

        $db->close();

        return $data;
    }
}
