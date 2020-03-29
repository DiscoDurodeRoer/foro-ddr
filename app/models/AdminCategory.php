<?php

class AdminCategory
{

    function __construct()
    {
    }

    function getCategories($mode = ALL_CATEGORIES)
    {

        $data = array();

        $sql = "SELECT cc.id, cc.name, cc.description, cp.name as parent, cc.icon, cc.num_topics, ";
        $sql .= "(select count(*) from categories WHERE cc.id = parent_cat) as has_child ";
        $sql .= "FROM categories cc, categories cp ";
        $sql .= "WHERE cc.parent_cat = cp.id ";

        if ($mode == ONLY_PARENTS) {
            $sql .= "and cc.num_topics = 0 ";
        }else if ($mode == ONLY_CHILDS){
            $sql .= "and (select count(*) from categories WHERE cc.id = parent_cat) = 0 ";
        }

        $db = new MySQLDB();

        $data['categories'] = $db->getData($sql);

        $data['success'] = true;

        $db->close();

        return $data;
    }

    function create_category()
    {

        $sql = "INSERT INTO categories ";
        $sql .= "VALUES( ";
        $sql .= "null,";
        $sql .= "'" . $_POST['name'] . "', ";
        $sql .= "'" . $_POST['description'] . "', ";
        $sql .= "'" . $_POST['parent_cat'] . "', ";
        $sql .= "'',"; // icono
        $sql .= "0";
        $sql .= ");";

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function getCategory($idCategory)
    {

        $data = array();

        $sql = "SELECT * ";
        $sql .= "FROM categories ";
        $sql .= "WHERE id = " . $idCategory;

        $db = new MySQLDB();

        $data['category'] = $db->getDataSingle($sql);

        $db->close();

        return $data;
    }

    function edit_category()
    {

        $sql = "UPDATE categories SET ";
        $sql .= "name = '" . $_POST['name'] . "', ";
        $sql .= "description = '" . $_POST['description'] . "', ";
        $sql .= "parent_cat = '" . $_POST['parent_cat'] . "' ";
        $sql .= "WHERE id = " . $_POST['id'];

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function delete_category($idCategory)
    {

        $sql = "DELETE FROM categories ";
        $sql .= "WHERE id = " . $idCategory;

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }
}
