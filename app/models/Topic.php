<?php


class Topic{

    function __construct(){ }


    function getTopics($params){

        $sql = "SELECT t.id, t.title, u.nickname, t.open, t.views ";
        $sql .= "FROM topics t, users u ";
        $sql .= "WHERE t.creator_user = u.id and ";
        $sql .= "t.id_cat = ". $params['id_cat'];
        
        $db = new MySQLDB();

        $data_topics = $db->getData($sql);
        
        $data['topics'] = $data_topics;

        $sql = "SELECT name ";
        $sql .= "FROM categories ";
        $sql .= "WHERE id = ". $params['id_cat'];

        $data_single = $db->getDataSingle($sql);

        if($data_single){
            $data['name_category'] = $data_single['name'];
            $data['id_cat'] = $params['id_cat'];
        }
        
        $db->close();

        return $data;

    }


    function create_topic($params){

        $sql = "INSERT INTO topics VALUES (";
        $sql .= "null, ";
        $sql .= "'".$params['title_topic']."', "; 
        $sql .= "'" . today() . "' , ";
        $sql .= $params['id_user'] . ", ";
        $sql .=  "1, ";
        $sql .=  "0, ";
        $sql .= $params['id_cat'] ." ";
        $sql .= ");";

        $db = new MySQLDB();

        $success = $db->executeInstruction($sql);

        $data = array();

        if ($success) {
            $id_topic = $db->getLastId();
            $data['id_topic'] = $id_topic;

            $sql = "INSERT INTO messages VALUES (";
            $sql .= "null, "; // id
            $sql .= "'".$params['text']."', "; // Texto 
            $sql .= "'" . today() . "' , "; // Fecha
            $sql .= $params['id_user'] . ", "; // fecha publicacion
            $sql .=  "1 "; // abierto
            $sql .= ")";
    
            $success = $db->executeInstruction($sql);
    
            if($success){
                
                $id_message = $db->getLastId();
                
                $sql = "INSERT INTO messages_public VALUES (";
                $sql .= $id_message . ", ";
                $sql .= $id_topic . ", ";
                $sql .= "1 ";
                $sql .= ")";
    
                $success = $db->executeInstruction($sql);
    
            }
    
        }

        $data['success'] = $success;

        $db->close();

        return $data;

    }

}
