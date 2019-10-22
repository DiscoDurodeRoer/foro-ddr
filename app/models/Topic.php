<?php


class Topic{

    function __construct(){ }


    function getTopics(){

        $sql = "SELECT * ";
        $sql .= "FROM topics";

        $db = new MySQLDB();

        $data = $db->getData($sql);

        $db->close();

        return $data;

    }

}


?>