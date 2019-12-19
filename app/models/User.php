<?php

class User
{

    function __construct()
    { }

    function checkErrors($nickname, $email, $id_user)
    {

        $errors = array();

        if (!isset($id_user)) {
            $this->checkPass($errors);
        }

        $sql = "SELECT count(*) as num_usuarios ";
        $sql .= "FROM users ";
        $sql .= "WHERE trim(lower(nickname)) = '" . trim(strtolower($nickname)) . "' ";
        if (isset($id_user)) {
            $sql .= "and id <> " . $id_user;
        }

        $db = new MySQLDB();

        $data = $db->getDataSingle($sql);

        $data_single = $data['num_usuarios'];

        if ($data_single > 0) {
            array_push($errors, "El nickname ya existe.");
        }

        $sql = "SELECT count(*) as num_usuarios ";
        $sql .= "FROM users ";
        $sql .= "WHERE trim(lower(email)) = '" . trim(strtolower($email)) . "' ";
        if (isset($id_user)) {
            $sql .= "and id <> " . $id_user;
        }

        $data = $db->getDataSingle($sql);

        $data_single = $data['num_usuarios'];

        if ($data_single > 0) {
            array_push($errors, "El email ya existe.");
        }

        $db->close();

        return $errors;
    }

    function checkPass(&$errors)
    {
        $pass = $_POST['pass'];
        $confirm_pass = $_POST['confirm-pass'];

        if ($pass !== $confirm_pass) {
            array_push($errors, "Las contraseña no coinciden.");
        }
    }

    function getAllInfoUser($id_user)
    {

        $sql = "SELECT * ";
        $sql .= "FROM users ";
        $sql .= "WHERE id = " . $id_user;

        $db = new MySQLDB();

        $data = $db->getDataSingle($sql);

        $db->close();

        return $data;
    }

    function registry($username, $surname, $nickname, $email, $pass, $avatar)
    {

        $sql = "INSERT INTO users VALUES(";
        $sql .= "null,";
        $sql .= "'" . $username . "', ";
        $sql .= "'" . $surname . "', ";
        $sql .= "'" . $nickname . "', ";
        $sql .= "'" . $email . "', ";
        $sql .= "'" . hash_hmac("sha512", $pass, "discoduroderoer") . "', ";
        $sql .= "'" . date("Y-m-d") . "', ";
        if (empty($avatar)) {
            $sql .= "'" . $avatar . "', ";
        } else {
            $sql .= "null, ";
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

            $data['user'] = array('id' => $id_user, 'nickname' => $nickname);
        }

        $db->close();

        return $data;
    }

    function edit_profile($id_user, $username, $surname, $nickname, $email, $avatar)
    {
        $sql = "UPDATE users ";
        $sql .= "SET name = '" . $username . "', ";
        $sql .= "surname = '" . $surname . "', ";
        $sql .= "nickname = '" . $nickname . "', ";
        $sql .= "email = '" . $email . "', ";
        $sql .= "avatar = '" . $avatar . "' ";
        $sql .= "WHERE id = " . $id_user;

        print $sql;
    
        $db = new MySQLDB();
    
        $data = array();

        $success = $db->executeInstruction($sql);

        $data['success'] = $success;

        if($success){
            $data['user'] = array('id' => $id_user, 'nickname' => $nickname);
        }

        $db->close();

        return $data;
    
    }

    function change_password($id_user, $pass)
    {

        $sql = "UPDATE users ";
        $sql .= "SET pass = '" . hash_hmac("sha512", $pass, HASH_PASS_KEY) . "' ";
        $sql .= "WHERE id = " . $id_user;

        $db = new MySQLDB();

        $success = $db->executeInstruction($sql);

        $db->close();

        $data = array();

        $data['success'] = $success;

        return $data;
    }

    function unsubscribe($id_user)
    {

        $sql = "UPDATE users SET ";
        $sql .= " borrado = 1 ";
        $sql .= " WHERE id = " . $id_user;

        $db = new MySQLDB();

        $success = $db->executeInstruction($sql);

        $db->close();

        $data = array();

        $data['success'] = $success;

        return $data;
    }
}
