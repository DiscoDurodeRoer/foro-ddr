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

            if (empty($params['nick_email']) && empty($params['pass'])) {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = "Usuario/email y contraseña requeridos";
            } elseif (empty($params['nick_email'])) {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = "Usuario/email requerido";
            } elseif (empty($params['pass'])) {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = "Contraseña requerida";
            } else {

                $sql = "SELECT id, nickname, rol ";
                $sql .= "FROM users ";
                $sql .= "WHERE (nickname = '" . strtolower($params['nick_email']) . "' or ";
                $sql .= "email = '" . strtolower($params['nick_email']) . "') and ";
                $sql .= "pass = '" . hash_hmac("sha512", $params['pass'], HASH_PASS_KEY) . "' ";
                $sql .= "and borrado <> 1 and verificado = 1";

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

    function sendNotificationRememeber($params)
    {
        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;

        try {

            $sql = "SELECT id, email ";
            $sql .= "FROM users ";
            $sql .= "WHERE email = '" . $params['email'] . "'";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Login/sendNotificationRememeber", $sql);
            }

            if ($db->numRows($sql) > 0) {

                $id = $db->getDataSingleProp($sql, "id");

                $key = generateUserKey();

                $sql = "INSERT INTO users_remember VALUES (";
                $sql .= $id . ", ";
                $sql .= "'" . $key . "'";
                $sql .= ")";

                $db->executeInstruction($sql);

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "Login/sendNotificationRememeber", $sql);
                }

                sendEmail($params['email'], "Cambio de contraseña Foro DDR", "Se ha solicitado un cambio de contraseña, puedes hacerlo desde <a href='" . PAGE_URL . "index.php?url=UserController/edit_password/" . $key . "'>aqui</a>");

                $data['success'] = true;
                $data['message'] = "Se ha enviado un correo para poder cambiar la contraseña";
            } else {
                $data['success'] = false;
                $data['message'] = "El email no existe";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Login/sendNotificationRememeber", $e->getMessage());
        }

        $db->close();

        return $data;
    }
}
