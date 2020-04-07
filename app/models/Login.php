<?php

class Login
{

    function __construct()
    {
    }

    function checkLogin($params)
    {

        $db = new PDODB();
        $data = array();

        try {

            $sql = "SELECT id, nickname, rol ";
            $sql .= "FROM users ";
            $sql .= "WHERE (nickname = '" . strtolower($params['nick_email']) . "' or ";
            $sql .= "email = '" . strtolower($params['nick_email']) . "') and ";
            $sql .= "pass = '" . hash_hmac("sha512", $params['pass'], HASH_PASS_KEY) . "' and borrado <> 1";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Login/checkLogin", $sql);
            }

            $data = $db->getDataSingle($sql);

            if ($db->numRows($sql) > 0) {
                $data['success'] = true;
                $data['user'] = array('id' => $data['id'], 'nickname' => $data['nickname'], 'rol' => $data['rol']);
            } else {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = "Usuario/email o contraseña incorrectos";
            }
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Login/checkLogin", $e->getMessage());
        }

        $db->close();

        return $data;
    }
}
