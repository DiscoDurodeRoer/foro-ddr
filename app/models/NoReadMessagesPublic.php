<?php


class NoReadMessagesPublic
{

    function __construct()
    {
    }

    function get_no_read_messages_public($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            $sql = "SELECT t.id, t.title, ";
            $sql .= "count(*) as num_messages, ";
            $sql .= "min(message_index) as message_index, ";
            $sql .= "min(ceil(message_index / 10)) as page ";
            $sql .= "FROM unread_messages_public um, ";
            $sql .= "topics t, ";
            $sql .= "messages_public mp ";
            $sql .= "WHERE um.id_topic = t.id and ";
            $sql .= "mp.id_topic = t.id and ";
            $sql .= "mp.id_message = um.id_message and ";
            $sql .= "um.id_user = ? ";
            $sql .= "group by t.id, t.title ";
            
            $paramsDB = array(
                $params['id_user']
            );

            $data['num_elems'] = $db->numRowsPrepared($sql, $paramsDB);
            $sql .= "LIMIT ?, ?";

            $paramsDB = array(
                $params['id_user'],
                ($params['page'] - 1) * NUM_ITEMS_PAG,
                NUM_ITEMS_PAG
            );

            writeLog(INFO_LOG, "NoReadMessagesPublic/get_no_read_messages_public", $sql);
            writeLog(INFO_LOG, "NoReadMessagesPublic/get_no_read_messages_public", json_encode($paramsDB));
            
            $data['no_read_messages'] = $db->getDataPrepared($sql, $paramsDB);

            // Paginacion
            $data["pag"] = $params['page'];
            $data['last_page'] = ceil($data['num_elems'] / NUM_ITEMS_PAG);
            $data['url_base'] = constant('BASE_URL') . "mensajes-no-leidos/" . $data['id_topic'];

            $data['has_messages'] = count($data['no_read_messages']) > 0;

            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Message/get_no_read_messages_public", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function delete_no_read_messages($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            $sql = "DELETE FROM unread_messages_public ";
            $sql .= "WHERE id_topic = ? ";
            $sql .= "and id_user = ? ";

            $paramsDB = array(
                $params['id_topic'],
                $params['id_user']
            );

            writeLog(INFO_LOG, "NoReadMessagesPublic/delete_no_read_messages", $sql);
            writeLog(INFO_LOG, "NoReadMessagesPublic/delete_no_read_messages", json_encode($paramsDB));
            
            $db->executeInstructionPrepared($sql, $paramsDB);

            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Message/delete_no_read_messages", $e->getMessage());
        }

        $db->close();

        return $data;
    }
}
