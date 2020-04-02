<?php


class NoReadMessagesPublic
{

    function __construct()
    {
    }

    function getNoReadMessagesPublic($params)
    {

        $data = array();

        $db = new MySQLDB();

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
        $sql .= "um.id_user = " . $params['id_user'] . " ";
        $sql .= "group by t.id, t.title";

        $data['no_read_messages'] = $db->getData($sql);

        $data['has_messages'] = count($data['no_read_messages']) > 0;

        $data['success'] = true;

        $db->close();

        return $data;
    }

    function deleteNoReadMessages($params){

        $db = new MySQLDB();

        $sql = "DELETE FROM unread_messages_public ";
        $sql .= "WHERE id_topic =  " . $params['id_topic'] . " ";
        $sql .= "and id_user =  " . $params['id_user'];

        $db->executeInstruction($sql);

        $db->close();

    }


}
