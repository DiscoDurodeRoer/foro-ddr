<?php


class Message{

    function __construct(){ }


    function getMessagesByTopic($id_topic){

        
        $sql = "select m.text, DATE_FORMAT(m.date_creation, '%d/%m/%Y %T') as 'date_creation', u.nickname, m.show_message, ";
        $sql .= "u.avatar, DATE_FORMAT(u.last_connection, '%d/%m/%Y %T') as last_connection,  DATE_FORMAT(u.registry_date, '%d/%m/%Y') as registry_date ";
        $sql .= "from messages m, messages_public mp, users u ";
        $sql .= "where m.id = mp.id_message and ";
        $sql .= "u.id = m.user_origin and ";
        $sql .= "mp.id_topic = " . filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT). " ";
        $sql .= "order by m.date_creation ";

        $db = new MySQLDB();

        $data['messages'] = $db->getData($sql);

        $sql = "SELECT title ";
        $sql .= "FROM topics ";
        $sql .= "WHERE id = ". $id_topic;

        $title_topic = $db->getDataSingle($sql);

        if($title_topic){
            $data['title_topic'] = $title_topic['title'];
        }

        $data['id_topic'] = $id_topic;

        $db->close();

        return $data;

    }

    function reply_topic(){

        $session = new Session();

        $db = new MySQLDB();

        $sql = "INSERT INTO messages VALUES (";
        $sql .= "null, ";
        $sql .= "'".$_POST['text']."', "; 
        $sql .= "'" . (new DateTime())->format('Y-m-d H:i') . "' , ";
        $sql .= $session->getIdUser() . ", ";
        $sql .=  "1 ";
        $sql .= ")";

        $success = $db->executeInstruction($sql);

        if($success){
            
            $idMessage = $db->getLastId();
            
            $sql = "INSERT INTO messages_public VALUES (";
            $sql .= $idMessage . ", ";
            $sql .= $_POST['id_topic'];
            $sql .= ")";

            $success = $db->executeInstruction($sql);

        }

        $datos['success'] = $success;

        $db->close();


        return $datos;
    }

}
