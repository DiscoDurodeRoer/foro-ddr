<?php

class AdminUser
{

    function __construct()
    {
    }

    function getAllUsers()
    {

        $data = array();

        $sql = "SELECT * ";
        $sql .= "FROM users ";

        $db = new MySQLDB();

        $data['users'] = $db->getData($sql);

        $data['success'] = true;

        $db->close();

        return $data;
    }

    function banUser($params)
    {

        $sql = "UPDATE users ";
        $sql .= "SET baneado = 1 ";
        $sql .= "WHERE id = " . $params['id_user'];

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function noBanUser($params)
    {

        $sql = "UPDATE users ";
        $sql .= "SET baneado = 0 ";
        $sql .= "WHERE id = " . $params['id_user'];

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function actUser($params)
    {

        $sql = "UPDATE users ";
        $sql .= "SET borrado = 1 ";
        $sql .= "WHERE id = " . $params['id_user'];

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function noActUser($params)
    {

        $sql = "UPDATE users ";
        $sql .= "SET borrado = 0 ";
        $sql .= "WHERE id = " . $params['id_user'];

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }
}
