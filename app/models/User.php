<?php

class User
{

    function __construct()
    {
    }

    function checkErrors($params)
    {

        $db = new PDODB();

        $errors = array();

        if (empty($params['name'])) {
            array_push($errors, "El nombre no puede estar vacio.");
        }

        if (empty($params['nickname'])) {
            array_push($errors, "El nickname no puede estar vacio.");
        }

        if (empty($params['email'])) {
            array_push($errors, "El email no puede estar vacio.");
        }



        if (!isset($params['id_user'])) {
            if (empty($params['pass'])) {
                array_push($errors, "El pass no puede estar vacio.");
            } else {
                $this->checkPass($params, $errors);
            }
        }

        $sql = "SELECT count(*) as num_usuarios ";
        $sql .= "FROM users ";
        $sql .= "WHERE trim(lower(nickname)) = '" . trim(strtolower($params['nickname'])) . "' ";
        if (isset($params['id_user'])) {
            $sql .= "and id <> " . $params['id_user'];
        }

        if (isModeDebug()) {
            writeLog(INFO_LOG, "User/checkErrors", $sql);
        }

        $num_usuarios = $db->getDataSingleProp($sql, "num_usuarios");

        if ($num_usuarios > 0) {
            array_push($errors, "El nickname ya existe.");
        }

        $sql = "SELECT count(*) as num_usuarios ";
        $sql .= "FROM users ";
        $sql .= "WHERE trim(lower(email)) = '" . trim(strtolower($params['email'])) . "' ";
        if (isset($params['id_user'])) {
            $sql .= "and id <> " . $params['id_user'];
        }

        if (isModeDebug()) {
            writeLog(INFO_LOG, "User/checkErrors", $sql);
        }

        $num_usuarios = $db->getDataSingleProp($sql, "num_usuarios");

        if ($num_usuarios > 0) {
            array_push($errors, "El email ya existe.");
        }

        $db->close();

        return $errors;
    }

    function checkPass($params, &$errors)
    {

        if ($params['pass'] !== $params['confirm-pass']) {
            array_push($errors, "Las contraseña no coinciden.");
        }
    }

    function get_all_info_user($params)
    {

        $db = new PDODB();
        $data = array();

        try {

            $sql = "SELECT * ";
            $sql .= "FROM users ";
            $sql .= "WHERE id = " . $params['id_user'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/get_all_info_user", $sql);
            }

            $data['info_user'] = $db->getDataSingle($sql);
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/get_all_info_user", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function registry($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;

        try {

            $sql = "INSERT INTO users VALUES(";
            $sql .= "null,";
            $sql .= "'" . $params['name'] . "', ";
            $sql .= "'" . $params['surname'] . "', ";
            $sql .= "'" . $params['nickname'] . "', ";
            $sql .= "'" . $params['email'] . "', ";
            $sql .= "'" . hash_hmac("sha512", $params['pass'], "discoduroderoer") . "', ";
            $sql .= "'" . date("Y-m-d") . "', ";
            if (!empty($params['avatar'])) {
                $sql .= "'" . $params['avatar'] . "', ";
            } else {
                $sql .= "'" . PAGE_URL . "img/default-avatar.jpg', ";
            }
            $sql .= "2, ";
            $sql .= " '" . today() . "' , ";
            $sql .= "0, ";
            $sql .= "0);";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/registry", $sql);
            }

            $success = $db->executeInstruction($sql);

            $data['success'] = $success;
            $data['text-center'] = true;

            if ($success) {
                $data['message'] = "Su registro se ha completado con éxito. Pulsa <a href='/foro-ddr/'>aquí</a> para volver al inicio.";

                $id_user = $db->getLastId();
                $data['user'] = array('id' => $id_user, 'nickname' => $params['nickname'], 'rol' => '1');
                prepareDataLogin($data['user']);
            } else {
                $data['message'] = "Su registro no se ha realizado con éxito. Contacte con discoduroderoer desde este <a href='https://www.discoduroderoer.es/contactanos/'>formulario</a>.";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }


        $db->close();

        return $data;
    }

    function edit_profile($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;

        try {

            $sql = "UPDATE users ";
            $sql .= "SET name = '" . $params['name'] . "', ";
            $sql .= "surname = '" . $params['surname'] . "', ";
            $sql .= "nickname = '" . $params['nickname'] . "', ";
            $sql .= "email = '" . $params['email'] . "', ";
            if (!empty($params['avatar'])) {
                $sql .= "avatar = '" . $params['avatar'] . "' ";
            } else {
                $sql .= "avatar = '" . DEFAULT_AVATAR . "' ";
            }
            $sql .= "WHERE id = " . $params['id_user'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/edit_profile", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

            $data['text-center'] = true;
            if ($data['success']) {
                $data['message'] = "La edición se ha completado con éxito. Pulsa <a href='/foro-ddr/'>aquí</a> para volver al inicio.";

                $data['user'] = array('id' => $params['id_user'], 'nickname' => $params['nickname'], 'rol' => $params['rol']);
                prepareDataLogin($data['user']);
            } else {
                $data['message'] = "La edición no se ha realizado con éxito. Contacte con discoduroderoer desde este <a href='https://www.discoduroderoer.es/contactanos/'>formulario</a>.";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function change_password($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;

        try {
            $sql = "UPDATE users ";
            $sql .= "SET pass = '" . hash_hmac("sha512", $params['pass'], HASH_PASS_KEY) . "' ";
            $sql .= "WHERE id = " . $params['id_user'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/change_password", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);

            $data['text-center'] = true;
            if ($data['success']) {
                $data['message'] = "La contraseña ha sido cambiada";
            } else {
                $data['message'] = "Su contraseña no ha sido cambiada";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/change_password", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function unsubscribe($params)
    {

        $db = new PDODB();
        $data = array();

        try {

            $sql = "UPDATE users SET ";
            $sql .= " borrado = 1 ";
            $sql .= " WHERE id = " . $params['id_user'];

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/unsubscribe", $sql);
            }

            $data['success'] = $db->executeInstruction($sql);
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/v", $e->getMessage());
        }

        $db->close();

        return $data;
    }
}
