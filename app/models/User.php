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
        $paramsDB = array();

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
        $sql .= "WHERE trim(lower(nickname)) = ? ";
        if (isset($params['id_user'])) {
            $sql .= "and id <> ? ";
            $paramsDB = array(
                trim(strtolower($params['nickname'])),
                $params['id_user']
            );
        } else {
            $paramsDB = array(
                trim(strtolower($params['nickname']))
            );
        }

        writeLog(INFO_LOG, "User/checkErrors", $sql);
        writeLog(INFO_LOG, "User/checkErrors", json_encode($paramsDB));
        
        $num_usuarios = $db->getDataSinglePropPrepared($sql, "num_usuarios", $paramsDB);

        if ($num_usuarios > 0) {
            array_push($errors, "El nickname ya existe.");
        }

        $sql = "SELECT count(*) as num_usuarios ";
        $sql .= "FROM users ";
        $sql .= "WHERE trim(lower(email)) = ? ";
        if (isset($params['id_user'])) {
            $sql .= "and id <> ? ";
            $paramsDB = array(
                trim(strtolower($params['nickname'])),
                $params['id_user']
            );
        } else {
            $paramsDB = array(
                trim(strtolower($params['nickname']))
            );
        }

        writeLog(INFO_LOG, "User/checkErrors", $sql);
        writeLog(INFO_LOG, "User/checkErrors", json_encode($paramsDB));
        
        $num_usuarios = $db->getDataSinglePropPrepared($sql, "num_usuarios", $paramsDB);

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
        $paramsDB = array();

        try {

            $sql = "SELECT * ";
            $sql .= "FROM users ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                $params['id_user']
            );

            writeLog(INFO_LOG, "User/get_all_info_user", $sql);
            writeLog(INFO_LOG, "User/get_all_info_user", json_encode($paramsDB));
            
            $data['info_user'] = $db->getDataSinglePrepared($sql, $paramsDB);
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
        $paramsDB = array();

        try {

            $id_user = $db->getLastId("id", "users");

            $sql = "INSERT INTO users VALUES(?,?,?,?,?,?,?,?,2,?,0,0,0)";

            if (!empty($params['avatar'])) {
                $avatar = $params['avatar'];
            } else {
                $avatar = PAGE_URL . "/public/img/default-avatar.jpg";
            }

            $paramsDB = array(
                $id_user,
                $params['name'],
                $params['surname'],
                $params['nickname'],
                $params['email'],
                hash_hmac("sha512", $params['pass'], "discoduroderoer"),
                date("Y-m-d"),
                $avatar,
                today()
            );

            writeLog(INFO_LOG, "User/registry", $sql);
            writeLog(INFO_LOG, "User/registry", json_encode($paramsDB));
            
            $success = $db->executeInstructionPrepared($sql, $paramsDB);

            $key = generateUserKey();

            $sql = "INSERT INTO users_activation VALUES(?,?)";

            $paramsDB = array(
                $id_user,
                $key
            );

            $db->executeInstructionPrepared($sql, $paramsDB);

            $data['success'] = $success;
            $data['text-center'] = true;

            if ($success) {
                $data['message'] = "Su registro se ha completado con éxito, recibirás un correo para validar tu cuenta. Pulsa <a href='". constant('BASE_URL') ."'>aquí</a> para volver al inicio.";

                $paramsEmail = array(
                    'key' => $key
                );

                sendEmail($params['email'], "Validación cuenta Foro DDR", TEMPLATE_NEW_ACCOUNT_NEED_VERIFICATION, $paramsEmail);
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

        $paramsDB = array();

        try {

            $sql = "UPDATE users ";
            $sql .= "SET name = ?, ";
            $sql .= "surname = ?, ";
            $sql .= "nickname = ?, ";
            $sql .= "email = ?, ";
            $sql .= "avatar = ? ";
            $sql .= "WHERE id = ? ";

            if (!empty($params['avatar'])) {
                $avatar = $params['avatar'];
            } else {
                $avatar = DEFAULT_AVATAR;
            }

            $paramsDB = array(
                $params['name'],
                $params['surname'],
                $params['nickname'],
                $params['email'],
                $avatar,
                $params['id_user']
            );

            writeLog(INFO_LOG, "User/edit_profile", $sql);
            writeLog(INFO_LOG, "User/edit_profile", json_encode($paramsDB));
            
            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);

            $data['text-center'] = true;
            if ($data['success']) {
                $data['message'] = "La edición se ha completado con éxito. Pulsa <a href='" . constant('BASE_URL') ."'>aquí</a> para volver al inicio.";

                $data['user'] = array(
                    'id' => $params['id_user'],
                    'nickname' => $params['nickname'],
                    'rol' => $params['rol']
                );
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
        $paramsDB = array();

        try {

            if (isset($params['user_key'])) {

                // comprobar que el user key existe en la bd

                $sql = "UPDATE users ";
                $sql .= "SET pass = ? ";
                $sql .= "WHERE id = (SELECT id_user ";
                $sql .= "            FROM users_remember ";
                $sql .= "            WHERE user_key = ?)";

                $paramsDB = array(
                    hash_hmac("sha512", $params['pass'], HASH_PASS_KEY),
                    $params['user_key']
                );

                writeLog(INFO_LOG, "User/change_password", $sql);
                writeLog(INFO_LOG, "User/change_password", json_encode($paramsDB));
                
                $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);

                $sql = "DELETE FROM users_remember ";
                $sql .= "WHERE user_key = ? ";

                $paramsDB = array(
                    $params['user_key']
                );

                writeLog(INFO_LOG, "User/change_password", $sql);
                writeLog(INFO_LOG, "User/change_password", json_encode($paramsDB));
                
                $db->executeInstructionPrepared($sql, $paramsDB);
            } else {

                $sql = "UPDATE users ";
                $sql .= "SET pass = ? ";
                $sql .= "WHERE id = ? ";

                $paramsDB = array(
                    hash_hmac("sha512", $params['pass'], HASH_PASS_KEY),
                    $params['id_user']
                );

                writeLog(INFO_LOG, "User/change_password", $sql);
                writeLog(INFO_LOG, "User/change_password", json_encode($paramsDB));
                
                $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);
            }

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
        $paramsDB = array();

        try {

            $sql = "UPDATE users SET ";
            $sql .= " borrado = 1 ";
            $sql .= " WHERE id = ? ";

            $paramsDB = array(
                $params['id_user']
            );

            writeLog(INFO_LOG, "User/unsubscribe", $sql);
            writeLog(INFO_LOG, "User/unsubscribe", json_encode($paramsDB));
            
            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/unsubscribe", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function verification($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();

        try {

            $sql = "SELECT ua.id_user, u.email, u.nickname, u.rol ";
            $sql .= "FROM users_activation ua, users u ";
            $sql .= "WHERE u.id = ua.id_user and ";
            $sql .= "ua.user_key = ? ";

            $paramsDB = array(
                $params['key']
            );

            writeLog(INFO_LOG, "User/verification", $sql);
            writeLog(INFO_LOG, "User/verification", json_encode($paramsDB));
            
            $nRows = $db->numRowsPrepared($sql, $paramsDB);

            if ($nRows === 1) {

                $dataUser = $db->getDataSinglePrepared($sql, $paramsDB);
                $id = $dataUser['id_user'];
                $email = $dataUser['email'];
                $nickname = $dataUser['nickname'];

                $sql = "UPDATE users SET ";
                $sql .= "verificado = 1 ";
                $sql .= "WHERE id = ? ";

                $paramsDB = array(
                    $id
                );

                writeLog(INFO_LOG, "User/verification", $sql);
                writeLog(INFO_LOG, "User/verification", json_encode($paramsDB));
                
                $db->executeInstructionPrepared($sql, $paramsDB);

                $sql = "DELETE FROM users_activation ";
                $sql .= "WHERE id_user = ? ";

                writeLog(INFO_LOG, "User/verification", $sql);
                writeLog(INFO_LOG, "User/verification", json_encode($paramsDB));
                
                $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);

                $data['text-center'] = true;
                if ($data['success']) {

                    $data['message'] = "¡Has sido verificado! ¡Bienvenido a Foro DDR!";

                    sendEmail($email, "¡Bienvenido al Foro DDR!", TEMPLATE_NEW_ACCOUNT_SUCCESS);

                    $data['user'] = array(
                        'id' => $id,
                        'nickname' => $nickname,
                        'rol' => IS_USER
                    );
                    prepareDataLogin($data['user']);
                } else {
                    $data['message'] = "Clave incorrecta.";
                }
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/verification", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function resend_confirmation($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();

        try {

            $sql = "SELECT ua.id_user, ua.user_key ";
            $sql .= "FROM users_activation ua, users u ";
            $sql .= "WHERE ua.id_user = u.id ";
            $sql .= "AND u.email = ? ";
            $sql .= "AND u.verificado = ? ";

            $paramsDB = array(
                $params['email'],
                FALSE
            );

            writeLog(INFO_LOG, "User/resend_confirmation", $sql);
            writeLog(INFO_LOG, "User/resend_confirmation", json_encode($paramsDB));
            
            $nRows = $db->numRowsPrepared($sql, $paramsDB);

            if ($nRows === 1) {
                $dataUserActivation = $db->getDataSinglePrepared($sql, $paramsDB);
                $data['success'] = true;
                $data['message'] = "Se ha reenviado el correo de activación";
                $paramsEmail = array(
                    'key' => $dataUserActivation['user_key']
                );

                sendEmail($params['email'], "Validación cuenta Foro DDR", TEMPLATE_NEW_ACCOUNT_NEED_VERIFICATION, $paramsEmail);
            } else {
                $data['success'] = false;
                $data['message'] = "No existe el correo o ya estas verificado";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/verification", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function search_topics_user($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            $sql = "SELECT mp.id_topic, t.title, ";
            $sql .= "DATE_FORMAT(MAX(m.date_creation), '%d/%m/%Y %T') as date_last_message, ";
            $sql .= "COUNT(*) as num_post ";
            $sql .= "FROM messages m, messages_public mp, topics t ";
            $sql .= "WHERE m.id = mp.id_message ";
            $sql .= "AND t.id = mp.id_topic ";
            $sql .= "AND m.user_origin = ? ";
            $sql .= "GROUP BY mp.id_topic, t.title ";
            $sql .= "ORDER BY date_last_message DESC";

            $paramsDB = array(
                $params['id_user']
            );

            writeLog(INFO_LOG, "User/search_topics_user", $sql);
            writeLog(INFO_LOG, "User/search_topics_user", json_encode($paramsDB));
            
            $data['topics_user'] = $db->getDataPrepared($sql, $paramsDB);

            $data['has_results'] = $db->numRowsPrepared($sql, $paramsDB) > 0;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/verification", $e->getMessage());
        }

        $db->close();
        return $data;
    }
}
