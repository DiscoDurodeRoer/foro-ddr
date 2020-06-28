<?php

class Control
{
    protected $controller = "CategoryController";
    protected $method = "display";
    protected $params;

    function __construct()
    {

        $url = "";
        if (isset($_GET['url'])) {
            $url = explode("/", $_GET['url']);
        }

        if (!empty($url)) {

            if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
                $this->controller = ucwords($url[0]);
                unset($url[0]);
            } else {
                $this->controller = "PNFController";
                $this->method = "display";
            }
        }
        
        require_once("../app/controllers/" . $this->controller . ".php");

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array(
            [$this->controller, $this->method],
            $this->params
        );
        
    }
}
