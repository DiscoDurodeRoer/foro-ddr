<?php

class Login
{

    function __construct()
    { }

    function checkLogin($params)
    {

        $data = array();

        $sql = "SELECT id, nickname, rol ";
        $sql .= "FROM users ";
        $sql .= "WHERE (nickname = '" . strtolower($params['nick_email']) . "' or ";
        $sql .= "email = '" . strtolower($params['nick_email']) . "') and ";
        $sql .= "pass = '" . hash_hmac("sha512", $params['pass'], HASH_PASS_KEY) . "' and borrado <> 1";
        
        $db = new MySQLDB();

        $data = $db->getDataSingle($sql);

        $success = false;
        if ($db->numRows($sql) > 0) {
            $success = true;
            $data['user'] = array('id' => $data['id'], 'nickname'=>$data['nickname'], 'rol'=>$data['rol']);
        }

        $data['success'] = $success;

        $db->close();

        return $data;
    }
}
