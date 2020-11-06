<?php


class Message
{

    function __construct()
    {
    }


    function get_messages_by_topic($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            $sql = "SELECT m.text, DATE_FORMAT(m.date_creation, '%d/%m/%Y %T') as 'date_creation', u.nickname, m.show_message, ";
            $sql .= "u.avatar, DATE_FORMAT(u.last_connection, '%d/%m/%Y %T') as last_connection, ";
            $sql .= "DATE_FORMAT(u.registry_date, '%d/%m/%Y') as registry_date, mp.message_index, r.rol as rol_name ";
            $sql .= "FROM messages m, messages_public mp, users u, roles r ";
            $sql .= "WHERE m.id = mp.id_message and ";
            $sql .= "u.id = m.user_origin and ";
            $sql .= "r.id = u.rol and ";
            $sql .= "mp.id_topic = ? ";
            $sql .= "order by m.date_creation ";

            $paramsDB = array(
                $params['id_topic']
            );

            $data['num_elems'] = $db->numRowsPrepared($sql, $paramsDB);

            $sql .= "LIMIT  ?, ?";


            $paramsDB = array(
                $params['id_topic'],
                ($params['page'] - 1) * NUM_ITEMS_PAG,
                NUM_ITEMS_PAG
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/get_messages_by_topic", $sql);
                writeLog(INFO_LOG, "Message/get_messages_by_topic", json_encode($params));
            }

            $data['messages'] = $db->getDataPrepared($sql, $paramsDB);
            $data['id_topic'] = $params['id_topic'];

            $sql = "SELECT title, open, id_cat ";
            $sql .= "FROM topics ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                $params['id_topic']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/get_messages_by_topic", $sql);
                writeLog(INFO_LOG, "Message/get_messages_by_topic", json_encode($params));
            }

            $data_single = $db->getDataSinglePrepared($sql, $paramsDB);

            if ($data_single) {
                $data['title_topic'] = $data_single['title'];
                $data['open_topic'] = $data_single['open'];
                $id_cat = $data_single['id_cat'];
                $data['path_topic'] = $params['id_topic'] . '-' . $data['title_topic'];
            }

            // Paginacion
            $data["pag"] = $params['page'];
            $data['last_page'] = ceil($data['num_elems'] / NUM_ITEMS_PAG);
            $data['url_base'] = "/foro-ddr/reply/" . $data['id_topic'];

            $sql = "SELECT DISTINCT c.id, c.name ";
            $sql .= "FROM categories_child cch, categories c ";
            $sql .= "WHERE c.id = cch.id_cat_parent ";
            $sql .= "and cch.id_cat = ? ";
            $sql .= "ORDER BY level";

            $paramsDB = array(
                $id_cat
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/get_messages_by_topic", $sql);
                writeLog(INFO_LOG, "Message/get_messages_by_topic", json_encode($params));
            }

            $numRows = $db->numRowsPrepared($sql, $paramsDB);

            if ($numRows > 0) {

                $parents = $db->getDataPrepared($sql, $paramsDB);

                $data['breadcumbs'] = array();

                foreach ($parents as $key => $value) {

                    if ($key === count($parents) - 1) {
                        $breadcumb = new BreadCumb(
                            $value['name'],
                            '/foro-ddr/topic/' . $value['id'] . '-' . stringToPath($value['name']),
                            null,
                            true
                        );
                    } else {
                        $breadcumb = new BreadCumb(
                            $value['name'],
                            '/foro-ddr/category/' . $value['id'] . '-' . stringToPath($value['name']),
                            null,
                            true
                        );
                    }

                    array_push($data['breadcumbs'], $breadcumb);
                }

                $breadcumb = new BreadCumb(
                    $data['title_topic'],
                    "",
                    null,
                    false
                );
                array_push($data['breadcumbs'], $breadcumb);
            }
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Message/get_messages_by_topic", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function reply_topic($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            $id_message = $db->getLastId("id", "messages");

            $sql = "INSERT INTO messages VALUES (?, ?, ?, ?, 1);";

            $paramsDB = array(
                $id_message,
                $params['text'],
                today(),
                $params['id_user']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/reply_topic", $sql);
                writeLog(INFO_LOG, "Message/reply_topic", json_encode($paramsDB));
            }

            $db->executeInstructionPrepared($sql, $paramsDB);

            $sql = "SELECT (count(*) + 1) as num_index ";
            $sql .= "FROM messages_public ";
            $sql .= "WHERE id_topic = ? ";

            $paramsDB = array(
                $params['id_topic']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/reply_topic", $sql);
            }

            $num_index = $db->getDataSinglePropPrepared($sql, 'num_index', $paramsDB);

            $sql = "INSERT INTO messages_public VALUES (?, ?, ?);";

            $paramsDB = array(
                $id_message,
                $params['id_topic'],
                $num_index
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/reply_topic", $sql);
                writeLog(INFO_LOG, "Message/reply_topic", json_encode($paramsDB));
            }

            $db->executeInstructionPrepared($sql, $paramsDB);

            $data['id_message'] = $id_message;

            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Message/reply_topic", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function is_open_topic($params)
    {

        $db = new PDODB();
        $isOpen = FALSE;
        $paramsDB = array();

        try {

            $sql = "SELECT open ";
            $sql .= "FROM topics ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                $params['id_topic']
            );

            $isOpen = $db->getDataSinglePropPrepared($sql, 'open', $paramsDB);
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Message/is_open_topic", $e->getMessage());
        }

        $db->close();
        return $isOpen == TRUE;
    }

    function notify_no_read_messages($params)
    {

        $db = new PDODB();
        $data = array();

        $data['success'] = true;

        $paramsDB = array();

        try {
            $sql = "SELECT DISTINCT m.user_origin ";
            $sql .= "FROM messages m, messages_public mp ";
            $sql .= "WHERE m.id = mp.id_message ";
            $sql .= "and mp.id_topic = ? ";
            $sql .= "and m.user_origin <> ? ";

            $paramsDB = array(
                $params['id_topic'],
                $params['id_user']
            );

            $datadb = $db->getDataPrepared($sql, $paramsDB);

            foreach ($datadb  as $key => $value) {

                $sql = "INSERT INTO unread_messages_public VALUES(?, ?, ?);";

                $paramsDB = array(
                    $value['user_origin'],
                    $params['id_topic'],
                    $params['id_message']
                );

                $db->executeInstructionPrepared($sql, $paramsDB);
            }
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Message/notify_no_read_messages", $e->getMessage());
        }

        $db->close();
        return $data;
    }
}
