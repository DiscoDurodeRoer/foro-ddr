<?php

class Login
{

    function __construct()
    { }

    function checkLogin($nick_email, $pass)
    {

        $data = array();

        $sql = "SELECT id, nickname ";
        $sql .= "FROM users ";
        $sql .= "WHERE (nickname = '" . strtolower($nick_email) . "' or ";
        $sql .= "email = '" . strtolower($nick_email) . "') and ";
        $sql .= "pass = '" . hash_hmac("sha512", $pass, HASH_PASS_KEY) . "' and borrado <> 1";
        
        $db = new MySQLDB();

        $data = $db->getDataSingle($sql);

        $success = false;
        if ($db->numRows($sql) > 0) {
            $success = true;
            $data['user'] = array('id' => $data['id'], 'nickname'=>$data['nickname']);
        }

        $data['success'] = $success;

        $db->close();

        return $data;
    }
}
