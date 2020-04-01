<?php

class AdminCategory
{

    function __construct()
    {
    }

    function getCategories($params)
    {

        $data = array();

        $sql = "SELECT cc.id, cc.name, cc.description, cp.name as parent, cc.icon, cc.num_topics, ";
        $sql .= "(select count(*) from categories WHERE cc.id = parent_cat) as has_child ";
        $sql .= "FROM categories cc, categories cp ";
        $sql .= "WHERE cc.parent_cat = cp.id ";

        if ($params['mode'] == ONLY_PARENTS) {
            $sql .= "and cc.num_topics = 0 ";
        } else if ($params['mode'] == ONLY_CHILDS) {
            $sql .= "and (select count(*) from categories WHERE cc.id = parent_cat) = 0 ";
        }

        $db = new MySQLDB();

        $data['categories'] = $db->getData($sql);

        $data['success'] = true;

        $db->close();

        return $data;
    }

    function create_category($params)
    {

        $sql = "INSERT INTO categories ";
        $sql .= "VALUES( ";
        $sql .= "null,";
        $sql .= "'" . $params['name'] . "', ";
        $sql .= "'" . $params['description'] . "', ";
        $sql .= "'" . $params['parent_cat'] . "', ";
        $sql .= "'',"; // icono
        $sql .= "0";
        $sql .= ");";

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function getCategory($params)
    {

        $data = array();

        $sql = "SELECT * ";
        $sql .= "FROM categories ";
        $sql .= "WHERE id = " . $params['id_category'];

        $db = new MySQLDB();

        $data['category'] = $db->getDataSingle($sql);

        $db->close();

        return $data;
    }

    function edit_category($params)
    {

        $sql = "UPDATE categories SET ";
        $sql .= "name = '" . $params['name'] . "', ";
        $sql .= "description = '" . $params['description'] . "', ";
        $sql .= "parent_cat = '" . $params['parent_cat'] . "' ";
        $sql .= "WHERE id = " . $params['id'];

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function delete_category($params)
    {

        $sql = "DELETE FROM categories ";
        $sql .= "WHERE id = " . $params['id_category'];

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }
}
