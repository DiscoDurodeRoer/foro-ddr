<?php


class MySQLDB {

    private $host = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $db = "foroddr";

    private $connection;

    function __construct()
    {
        
        $this->connection = mysqli_connect(
            $this->host, 
            $this->usuario, 
            $this->pass, 
            $this->db
        );

        $this->connection->set_charset("utf8");

        if(mysqli_connect_errno()){
            print("error al conectarse");
        }

    }

    function getData($sql){
        $data = array();
        $result = mysqli_query($this->connection, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                array_push($data, $row);
            }
        }
        return $data;
    }

    function getDataSingle($sql){
        
        $result = mysqli_query($this->connection, $sql);
        if(mysqli_num_rows($result) > 0){
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    function insertData($sql){
        return mysqli_query($this->connection, $sql);
    }

    function close(){
        mysqli_close($this->connection);
    }

}


?>