<?php


class Topic{

    function __construct(){ }


    function getTopics($id_cat){

        $sql = "SELECT t.id, t.title, u.nickname, t.open, t.views ";
        $sql .= "FROM topics t, users u ";
        $sql .= "WHERE t.creator_user = u.id and ";
        $sql .= "t.id_cat = ". $id_cat;
        $db = new MySQLDB();

        $data_topics = $db->getData($sql);
        
        $data['topics'] = $data_topics;

        $sql = "SELECT name ";
        $sql .= "FROM categories ";
        $sql .= "WHERE id = ". $id_cat;

        $name_category = $db->getDataSingle($sql);

        if($name_category){
            $data['name_category'] = $name_category['name'];
            $data['id_cat'] = $id_cat;
        }
        
        $db->close();

        return $data;

    }


    function create_topic(){

        $session = new Session();

        $sql = "INSERT INTO topics VALUES (";
        $sql .= "null, ";
        $sql .= "'".$_POST['title']."', "; 
        $sql .= "'" . (new DateTime())->format('Y-m-d H:i') . "' , ";
        $sql .= $session->getIdUser() . ", ";
        $sql .=  "1, ";
        $sql .=  "0, ";
        $sql .= $_POST['id_cat'] ." ";
        $sql .= ");";

        $db = new MySQLDB();

        $success = $db->executeInstruction($sql);

        $datos = array();

        if ($success) {
            $idTopic = $db->getLastId();
            $datos['id_topic'] = $idTopic;

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
                $sql .= $idTopic;
                $sql .= ")";
    
                $success = $db->executeInstruction($sql);
    
            }
    
        }

        $datos['success'] = $success;

        $db->close();

        return $datos;

    }

}
