<?php

class AdminTopic
{

    function __construct()
    {
    }

    function get_topics($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {
            $sql = "SELECT t.id, t.title, DATE_FORMAT(t.date_creation, '%d/%m/%Y %T') as 'date_creation', ";
            $sql .= "t.open, t.views, c.name as 'category' ";
            $sql .= "FROM topics t, categories c ";
            $sql .= "WHERE t.id_cat = c.id ";
            $sql .= "ORDER BY date_creation ";

            $data['num_elems'] = $db->numRowsPrepared($sql, $paramsDB);

            $sql .= "LIMIT ?, ?";

            $paramsDB = array(
                ($params['page'] - 1) * NUM_ITEMS_PAG,
                NUM_ITEMS_PAG
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/get_topics", $sql);
                writeLog(INFO_LOG, "AdminTopic/get_topics", json_encode($paramsDB));
            }

            $data['topics'] = $db->getDataPrepared($sql, $paramsDB);

            // Paginacion
            $data["pag"] = $params['page'];
            $data['last_page'] = ceil($data['num_elems'] / NUM_ITEMS_PAG);
            $data['url_base'] = "/foro-ddr/admin/topic";

            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminTopic/get_topic", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function get_topic($id_topic)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {
            $sql = "SELECT t.id, t.title, DATE_FORMAT(t.date_creation, '%d/%m/%Y %T') as 'date_creation', ";
            $sql .= "t.open, t.views, t.id_cat ";
            $sql .= "FROM topics t ";
            $sql .= "WHERE t.id = ? ";
            $sql .= "ORDER BY date_creation ";

            $paramsDB = array(
                $id_topic
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/get_topic", $sql);
                writeLog(INFO_LOG, "AdminTopic/get_topic", json_encode($paramsDB));
            }

            $data['topic'] = $db->getDataSinglePrepared($sql, $paramsDB);

            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminTopic/get_topic", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function edit_topic($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();

        try {
            $sql = "UPDATE topics SET ";
            $sql .= "title = ?, ";
            $sql .= "id_cat = ? ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                $params['title'],
                $params['category'],
                $params['id']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/edit_topic", $sql);
                writeLog(INFO_LOG, "AdminTopic/edit_topic", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);

            if ($data['success']) {
                $data['message'] = "Se ha editado el topic correctamente";
            } else {
                $data['message'] = "No se ha editado el topic correctamente";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminTopic/edit_topic", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function open_topic($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();

        try {

            $sql = "UPDATE topics SET ";
            $sql .= "open = ? ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                TRUE,
                $params['id_topic']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/open_topic", $sql);
                writeLog(INFO_LOG, "AdminTopic/open_topic", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);

            if ($data['success']) {
                $data['message'] = "Se ha abierto el topic correctamente";
            } else {
                $data['message'] = "No se ha abierto el topic correctamente";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminTopic/open_topic", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function close_topic($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();

        try {
            $sql = "UPDATE topics SET ";
            $sql .= "open = ? ";
            $sql .= "WHERE id = ?";

            $paramsDB = array(
                FALSE,
                $params['id_topic']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/close_topic", $sql);
                writeLog(INFO_LOG, "AdminTopic/close_topic", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);

            if ($data['success']) {
                $data['message'] = "Se ha cerrado el topic correctamente";
            } else {
                $data['message'] = "No se ha cerrado el topic correctamente";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "AdminTopic/close_topic", $e->getMessage());
        }

        $db->close();
        return $data;
    }
}
