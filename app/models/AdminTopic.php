<?php

class AdminTopic
{

    function __construct()
    {
    }

    function get_topics()
    {

        $db = new PDODB();
        $data = array();

        try {
            $sql = "SELECT t.id, t.title, DATE_FORMAT(t.date_creation, '%d/%m/%Y %T') as 'date_creation', ";
            $sql .= "t.open, t.views, c.name as 'category' ";
            $sql .= "FROM topics t, categories c ";
            $sql .= "WHERE t.id_cat = c.id ";
            $sql .= "ORDER BY date_creation ";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/get_topics", $sql);
            }

            $data['topics'] = $db->getData($sql);

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

        try {
            $sql = "SELECT t.id, t.title, DATE_FORMAT(t.date_creation, '%d/%m/%Y %T') as 'date_creation', ";
            $sql .= "t.open, t.views, t.id_cat ";
            $sql .= "FROM topics t ";
            $sql .= "WHERE t.id = " . $id_topic . " ";
            $sql .= "ORDER BY date_creation ";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/get_topic", $sql);
            }

            $data['topic'] = $db->getDataSingle($sql);

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

        try {
            $sql = "UPDATE topics SET ";
            $sql .= "title = '" . $params['title'] . "', ";
            $sql .= "id_cat = '" . $params['category'] . "' ";
            $sql .= "WHERE id = " . $params['id'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/edit_topic", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

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

        try {

            $sql = "UPDATE topics SET ";
            $sql .= "open = '" . TRUE . "' ";
            $sql .= "WHERE id = " . $params['id_topic'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/open_topic", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

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

        try {
            $sql = "UPDATE topics SET ";
            $sql .= "open = '" . FALSE . "' ";
            $sql .= "WHERE id = " . $params['id_topic'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "AdminTopic/close_topic", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

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
