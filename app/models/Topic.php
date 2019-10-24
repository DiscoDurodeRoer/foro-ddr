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
        }
        
        $db->close();

        return $data;

    }

}


?>