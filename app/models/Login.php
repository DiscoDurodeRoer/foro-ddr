<?php

class Login
{

    function __construct()
    { }

    function checkLogin()
    {

        $sql = "SELECT count(*) as num_usuarios ";
        $sql .= "FROM users ";
        $sql .= "WHERE (nickname = '" . strtolower($_POST['nick_email']) . "' or ";
        $sql .= "email = '" . strtolower($_POST['nick_email']) . "') and ";
        $sql .= "pass = '" . hash_hmac("sha512", $_POST['pass'], "discoduroderoer") . "'";
        
        
        $db = new MySQLDB();

        $data = $db->getDataSingle($sql);

        $num_users = $data['num_usuarios'];

        $success = false;
        if ($num_users > 0) {
            $success = true;
        }

        $db->close();

        return $success;
    }
}
