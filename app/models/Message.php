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

        try {

            $sql = "SELECT m.text, DATE_FORMAT(m.date_creation, '%d/%m/%Y %T') as 'date_creation', u.nickname, m.show_message, ";
            $sql .= "u.avatar, DATE_FORMAT(u.last_connection, '%d/%m/%Y %T') as last_connection, ";
            $sql .= "DATE_FORMAT(u.registry_date, '%d/%m/%Y') as registry_date, mp.message_index, r.rol as rol_name ";
            $sql .= "FROM messages m, messages_public mp, users u, roles r ";
            $sql .= "WHERE m.id = mp.id_message and ";
            $sql .= "u.id = m.user_origin and ";
            $sql .= "r.id = u.rol and ";
            $sql .= "mp.id_topic = " . filter_var($params['id_topic'], FILTER_SANITIZE_NUMBER_INT) . " ";
            $sql .= "order by m.date_creation ";

            $data['num_elems'] = $db->numRows($sql);

            $sql .= "LIMIT " . ($params['page'] - 1) * NUM_ITEMS_PAG . "," . NUM_ITEMS_PAG;

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/get_messages_by_topic", $sql);
            }

            $data['messages'] = $db->getData($sql);
            $data['id_topic'] = $params['id_topic'];

            $sql = "SELECT title, open, id_cat ";
            $sql .= "FROM topics ";
            $sql .= "WHERE id = " . $params['id_topic'];

            $data_single = $db->getDataSingle($sql);

            if ($data_single) {
                $data['title_topic'] = $data_single['title'];
                $data['open_topic'] = $data_single['open'];
                $id_cat = $data_single['id_cat'];
            }

            // Paginacion
            $data["pag"] = $params['page'];
            $data['last_page'] = ceil($data['num_elems'] / NUM_ITEMS_PAG);
            $data['url_base'] = "MessageController/display/" . $data['id_topic'];

            $sql = "SELECT DISTINCT c.id, c.name ";
            $sql .= "FROM categories_child cch, categories c ";
            $sql .= "WHERE c.id = cch.id_cat_parent ";
            $sql .= "and cch.id_cat = " . $id_cat . " ";
            $sql .= "ORDER BY level";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/get_messages_by_topic", $sql);
            }

            $parents = $db->getData($sql);

            $numRows = $db->numRows($sql);

            if ($numRows > 0) {

                $data['breadcumbs'] = array();

                foreach ($parents as $key => $value) {


                    if ($key === count($parents) - 1){
                        $breadcumb = new BreadCumb(
                            $value['name'],
                            'index.php?url=TopicController/display/' . $value['id'],
                            null,
                            true
                        );    
                    }else{
                        $breadcumb = new BreadCumb(
                            $value['name'],
                            'index.php?url=CategoryController/display/' . $value['id'],
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

        try {

            $sql = "INSERT INTO messages VALUES (";
            $sql .= "null, ";
            $sql .= "'" . $params['text'] . "', ";
            $sql .= "'" . today() . "' , ";
            $sql .= $params['id_user'] . ", ";
            $sql .=  "1 ";
            $sql .= ")";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/reply_topic", $sql);
            }

            $db->executeInstruction($sql);
            $id_message = $db->getLastId();

            $sql = "SELECT (count(*) + 1) as num_index ";
            $sql .= "FROM messages_public ";
            $sql .= "WHERE id_topic = " . $params['id_topic'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/reply_topic", $sql);
            }

            $num_index = $db->getDataSingleProp($sql, 'num_index');

            $sql = "INSERT INTO messages_public VALUES (";
            $sql .= $id_message . ", ";
            $sql .= $params['id_topic'] . ", ";
            $sql .= $num_index;
            $sql .= ")";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Message/reply_topic", $sql);
            }

            $db->executeInstruction($sql);

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

        try {

            $sql = "SELECT open ";
            $sql .= "FROM topics ";
            $sql .= "WHERE id = " . $params['id_topic'];

            $isOpen = $db->getDataSingleProp($sql, 'open');
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

        try {
            $sql = "SELECT DISTINCT m.user_origin ";
            $sql .= "FROM messages m, messages_public mp ";
            $sql .= "WHERE m.id = mp.id_message ";
            $sql .= "and mp.id_topic = " . $params['id_topic'] . " ";
            $sql .= "and m.user_origin <> " . $params['id_user'];

            $datadb = $db->getData($sql);

            foreach ($datadb  as $key => $value) {

                $sql = "INSERT INTO unread_messages_public VALUES( ";
                $sql .= $value['user_origin'] . ", ";
                $sql .= $params['id_topic'] . ", ";
                $sql .= $params['id_message'] . "); ";

                $db->executeInstruction($sql);
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
