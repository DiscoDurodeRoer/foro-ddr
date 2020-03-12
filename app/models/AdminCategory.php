<?php

class AdminCategory
{

    function __construct()
    {
    }

    function getCategories()
    {

        $data = array();

        $sql = "SELECT cc.id, cc.name, cc.description, cp.name as parent, cc.icon, cc.num_topics ";
        $sql .= "FROM categories cc, categories cp ";
        $sql .= "WHERE cc.parent_cat = cp.id ";

        $db = new MySQLDB();

        $data['categories'] = $db->getData($sql);

        $data['success'] = true;

        $db->close();

        return $data;
    }

    function create_category()
    {

        $data = array();

        $sql = "INSERT INTO categories ";
        $sql .= "VALUES( ";
        $sql .= "null,";
        $sql .= "'" . $_POST['name'] . "', ";
        $sql .= "'" . $_POST['description'] . "', ";
        $sql .= "'" . $_POST['parent'] . "', ";
        $sql .= "'',"; // icono
        $sql .= "0"; 
        $sql .= ");";

        echo $sql;

        $db = new MySQLDB();

        $success = $db->executeInstruction($sql);

        $data['success'] = $success;

        $db->close();

        return $data;
    }
}
