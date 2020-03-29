<?php


class Message
{

    function __construct()
    {
    }


    function getMessagesByTopic($id_topic, $page)
    {


        $sql = "select m.text, DATE_FORMAT(m.date_creation, '%d/%m/%Y %T') as 'date_creation', u.nickname, m.show_message, ";
        $sql .= "u.avatar, DATE_FORMAT(u.last_connection, '%d/%m/%Y %T') as last_connection,  DATE_FORMAT(u.registry_date, '%d/%m/%Y') as registry_date ";
        $sql .= "from messages m, messages_public mp, users u ";
        $sql .= "where m.id = mp.id_message and ";
        $sql .= "u.id = m.user_origin and ";
        $sql .= "mp.id_topic = " . filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT) . " ";
        $sql .= "order by m.date_creation ";
        $sql .= "LIMIT " . ($page - 1) * NUM_ITEMS_PAG . "," . NUM_ITEMS_PAG;

        $db = new MySQLDB();

        $data['messages'] = $db->getData($sql);

        $data["pag"] = $page;
        $data['id_topic'] = $id_topic;

        $sql = "SELECT title, open ";
        $sql .= "FROM topics ";
        $sql .= "WHERE id = " . $id_topic;

        $data_single = $db->getDataSingle($sql);

        if ($data_single) {
            $data['title_topic'] = $data_single['title'];
            $data['open_topic'] = $data_single['open'];
        }

        $sql = "select count(*) as num_messages ";
        $sql .= "from messages m, messages_public mp, users u ";
        $sql .= "where m.id = mp.id_message and ";
        $sql .= "u.id = m.user_origin and ";
        $sql .= "mp.id_topic = " . $id_topic . " ";

        $data_single = $db->getDataSingle($sql);

        if ($data_single) {
            $data['num_messages'] = $data_single['num_messages'];
        }

        $data['last_page'] = ceil($data['num_messages'] / NUM_ITEMS_PAG);

        $data['url_base'] = "MessageController/display/" . $data['id_topic'];

        $db->close();

        return $data;
    }

    function reply_topic($id_user, $text, $id_topic)
    {

        $db = new MySQLDB();

        $sql = "INSERT INTO messages VALUES (";
        $sql .= "null, ";
        $sql .= "'" . $text . "', ";
        $sql .= "'" . today() . "' , ";
        $sql .= $id_user . ", ";
        $sql .=  "1 ";
        $sql .= ")";

        $success = $db->executeInstruction($sql);

        if ($success) {

            $id_message = $db->getLastId();

            $sql = "INSERT INTO messages_public VALUES (";
            $sql .= $id_message . ", ";
            $sql .= $id_topic;
            $sql .= ")";

            $success = $db->executeInstruction($sql);
        }

        $data['success'] = $success;

        $db->close();


        return $data;
    }

    function is_open_topic($id_topic)
    {

        $db = new MySQLDB();

        $sql = "SELECT open ";
        $sql .= "FROM topics ";
        $sql .= "WHERE id = " . $id_topic;

        $data_single = $db->getDataSingle($sql);

        $db->close();
        if ($data_single) {
            return $data_single['open'] == TRUE;
        }

        return false;
    }
}
