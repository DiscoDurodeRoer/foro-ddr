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

    function banUser($idUser)
    {

        $sql = "UPDATE users ";
        $sql .= "SET baneado = 1 ";
        $sql .= "WHERE id = " . $idUser;

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function noBanUser($idUser)
    {

        $sql = "UPDATE users ";
        $sql .= "SET baneado = 0 ";
        $sql .= "WHERE id = " . $idUser;

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function actUser($idUser)
    {

        $sql = "UPDATE users ";
        $sql .= "SET borrado = 1 ";
        $sql .= "WHERE id = " . $idUser;

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }

    function noActUser($idUser)
    {

        $sql = "UPDATE users ";
        $sql .= "SET borrado = 0 ";
        $sql .= "WHERE id = " . $idUser;

        $db = new MySQLDB();

        $db->executeInstruction($sql);

        $db->close();
    }
}
