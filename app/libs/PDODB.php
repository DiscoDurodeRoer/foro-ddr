<?php

class PDODB
{

    private $host = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $db = "foroddr";

    private $connection;

    function __construct()
    {

        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::MYSQL_ATTR_FOUND_ROWS => true
        );

        $this->connection = new PDO(
            'mysql:host=' . $this->host . ';dbname=' . $this->db,
            $this->usuario,
            $this->pass,
            $opciones
        );
    }

    function getData($sql)
    {

        $data = array();
        $result = $this->connection->query($sql);

        $error = $this->connection->errorInfo();
        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    array_push($data, $row);
                }
            }
        } else {
            throw new Exception($error[2]);
        }
        return $data;
    }

    function numRows($sql)
    {
        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            return $result->rowCount();
        } else {
            throw new Exception($error[2]);
        }
    }

    function getDataSingle($sql)
    {

        $result = $this->connection->query($sql);

        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                return $result->fetch(PDO::FETCH_ASSOC);
            }
        } else {
            throw new Exception($error[2]);
        }
        return null;
    }


    function getDataSingleProp($sql, $prop)
    {

        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                $data = $result->fetch(PDO::FETCH_ASSOC);
                return $data[$prop];
            }
        } else {
            throw new Exception($error[2]);
        }
        return null;
    }

    function executeInstruction($sql)
    {

        $result = $this->connection->prepare($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            writeLog(ERROR_LOG, "Count: ({$sql})", $result->rowCount());
            return $result->rowCount() > 0;
        } else {
            throw new Exception($error[2]);
        }
    }

    function close()
    {
        $this->connection = null;
    }

    function getLastId($field, $table)
    {
        $sql = "SELECT IFNULL((MAX(".$field.") + 1), 1) as id FROM " . $table;
        return $this->getDataSingleProp($sql, "id");
    }
}
