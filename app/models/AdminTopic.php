<?php

class AdminTopic
{

    function __construct()
    {
    }

    function getTopics()
    {
        $data = array();

        $sql = "SELECT t.id, t.title, DATE_FORMAT(t.date_creation, '%d/%m/%Y %T') as 'date_creation', ";
        $sql .= "t.open, t.views, c.name as 'category' ";
        $sql .= "FROM topics t, categories c ";
        $sql .= "WHERE t.id_cat = c.id ";
        $sql .= "ORDER BY date_creation ";

        $db = new MySQLDB();

        $data['topics'] = $db->getData($sql);

        $data['success'] = true;

        $db->close();

        return $data;
    }

    function getTopic($id_topic)
    {

        $data = array();

        $sql = "SELECT t.id, t.title, DATE_FORMAT(t.date_creation, '%d/%m/%Y %T') as 'date_creation', ";
        $sql .= "t.open, t.views, t.id_cat ";
        $sql .= "FROM topics t ";
        $sql .= "WHERE t.id = " . $id_topic . " ";
        $sql .= "ORDER BY date_creation ";

        $db = new MySQLDB();

        $data['topic'] = $db->getDataSingle($sql);

        $data['success'] = true;

        $db->close();

        return $data;
    }

    function edit_topic($params)
    {

        $sql = "UPDATE topics SET ";
        $sql .= "title = '" . $params['title'] . "', ";
        $sql .= "id_cat = '" . $params['category'] . "' ";
        $sql .= "WHERE id = " . $params['id'];

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function open_topic($id_topic)
    {

        $sql = "UPDATE topics SET ";
        $sql .= "open = '" . TRUE . "' ";
        $sql .= "WHERE id = " . $id_topic;

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function close_topic($id_topic)
    {

        $sql = "UPDATE topics SET ";
        $sql .= "open = '" . FALSE . "' ";
        $sql .= "WHERE id = " . $id_topic;

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }
}
