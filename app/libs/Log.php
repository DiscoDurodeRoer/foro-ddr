<?php

class Log
{

    // estructura del log
    // [Tipo_mensaje] [fecha_hora] [origen] [mensaje]

    private $fileLog;

    function __construct()
    {
        $this->fileLog = fopen(PATH_LOG . FILE_LOG, "a");
    }

    function writeLine($type, $origin, $message)
    {
        $date = new DateTime();
        fputs($this->fileLog, "[" . $type . "][" . $date->format('d-m-Y H:i:s') . "][" . $origin . "]: " . $message . "\n");
    }

    function close()
    {
        fclose($this->fileLog);
    }
}
