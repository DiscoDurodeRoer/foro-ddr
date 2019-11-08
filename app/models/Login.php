<?php

class Login
{

    function __construct()
    { }

    function checkLogin()
    {

        $datos = array();

        $sql = "SELECT id, nickname ";
        $sql .= "FROM users ";
        $sql .= "WHERE (nickname = '" . strtolower($_POST['nick_email']) . "' or ";
        $sql .= "email = '" . strtolower($_POST['nick_email']) . "') and ";
        $sql .= "pass = '" . hash_hmac("sha512", $_POST['pass'], "discoduroderoer") . "'";
        print $sql;
        
        $db = new MySQLDB();

        $data = $db->getDataSingle($sql);

        $success = false;
        if ($db->numRows($sql) > 0) {
            $success = true;
            $datos['user'] = array('id' => $data['id'], 'nickname'=>$data['nickname']);
        }

        $datos['success'] = $success;

        $db->close();

        return $datos;
    }
}
