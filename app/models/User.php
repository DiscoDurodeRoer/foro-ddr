<?php

class User
{

    function __construct()
    { }

    function checkErrors($params)
    {

        $errors = array();

        if (!isset($params['id_user'])) {
            $this->checkPass($params, $errors);
        }

        $sql = "SELECT count(*) as num_usuarios ";
        $sql .= "FROM users ";
        $sql .= "WHERE trim(lower(nickname)) = '" . trim(strtolower($params['nickname'])) . "' ";
        if (isset($id_user)) {
            $sql .= "and id <> " . $params['id_user'];
        }

        $db = new MySQLDB();

        $data = $db->getDataSingle($sql);

        $data_single = $data['num_usuarios'];

        if ($data_single > 0) {
            array_push($errors, "El nickname ya existe.");
        }

        $sql = "SELECT count(*) as num_usuarios ";
        $sql .= "FROM users ";
        $sql .= "WHERE trim(lower(email)) = '" . trim(strtolower($params['email'])) . "' ";
        if (isset($params['id_user'])) {
            $sql .= "and id <> " . $params['id_user'];
        }

        $data = $db->getDataSingle($sql);

        $data_single = $data['num_usuarios'];

        if ($data_single > 0) {
            array_push($errors, "El email ya existe.");
        }

        $db->close();

        return $errors;
    }

    function checkPass($params, &$errors)
    {

        if ($params['pass'] !== $params['confirm_pass']) {
            array_push($errors, "Las contraseña no coinciden.");
        }
    }

    function getAllInfoUser($params)
    {

        $sql = "SELECT * ";
        $sql .= "FROM users ";
        $sql .= "WHERE id = " . $params['id_user'];

        $db = new MySQLDB();

        $data = $db->getDataSingle($sql);

        $db->close();

        return $data;
    }

    function registry($params)
    {

        $sql = "INSERT INTO users VALUES(";
        $sql .= "null,";
        $sql .= "'" . $params['username'] . "', ";
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

        $db = new MySQLDB();

        $success = $db->executeInstruction($sql);

        $data = array();

        $data['success'] = $success;

        if ($success) {

            $id_user = $db->getLastId();

            $data['user'] = array('id' => $id_user, 'nickname' => $params['nickname']);
        }

        $db->close();

        return $data;
    }

    function edit_profile($params)
    {
        $sql = "UPDATE users ";
        $sql .= "SET name = '" . $params['username'] . "', ";
        $sql .= "surname = '" . $params['surname'] . "', ";
        $sql .= "nickname = '" . $params['nickname'] . "', ";
        $sql .= "email = '" . $params['email'] . "', ";
        if (!empty($params['avatar'])) {
            $sql .= "avatar = '" . $params['avatar'] . "' ";
        } else {
            $sql .= "avatar = '" . PAGE_URL . "img/default-avatar.jpg' ";
        }
        $sql .= "WHERE id = " . $params['id_user'];
    
        $db = new MySQLDB();
    
        $data = array();

        $success = $db->executeInstruction($sql);

        $data['success'] = $success;

        if($success){
            $data['user'] = array('id' => $params['id_user'], 'nickname' => $params['nickname']);
        }

        $db->close();

        return $data;
    
    }

    function change_password($params)
    {

        $sql = "UPDATE users ";
        $sql .= "SET pass = '" . hash_hmac("sha512", $params['pass'], HASH_PASS_KEY) . "' ";
        $sql .= "WHERE id = " . $params['id_user'];

        $db = new MySQLDB();

        $success = $db->executeInstruction($sql);

        $db->close();

        $data = array();

        $data['success'] = $success;

        return $data;
    }

    function unsubscribe($params)
    {

        $sql = "UPDATE users SET ";
        $sql .= " borrado = 1 ";
        $sql .= " WHERE id = " . $params['id_user'];

        $db = new MySQLDB();

        $success = $db->executeInstruction($sql);

        $db->close();

        $data = array();

        $data['success'] = $success;

        return $data;
    }
}
