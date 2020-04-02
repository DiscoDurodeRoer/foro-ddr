<?php

class NoReadMessagesPublicController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("NoReadMessagesPublic");
    }

    function display()
    {

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER)
        );

        $data = $this->model->getNoReadMessagesPublic($params);

        $data["display"] = true;

        $this->view("NoReadMessagesPublicView", $data);
    }

    function redirect_to_message($id_topic, $page, $message_index)
    {

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER),
            'id_topic' => $id_topic
        );

        $this->model->deleteNoReadMessages($params);

        $url = "/foro-ddr/index.php?url=MessageController/display/" . $id_topic . "/" . $page . "#" . $message_index;

        header("Location: " . $url);

    }
}
