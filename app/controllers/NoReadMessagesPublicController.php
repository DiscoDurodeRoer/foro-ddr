<?php

class NoReadMessagesPublicController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("NoReadMessagesPublic");
    }

    function display($page = 1)
    {

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER),
            'page' => filter_var($page, FILTER_VALIDATE_INT)
        );

        $data = $this->model->get_no_read_messages_public($params);

        $data["display"] = true;

        if (isModeDebug()) {
            writeLog(INFO_LOG, "NoReadMessagesPublicController/display", json_encode($data));
        }

        $this->view("NoReadMessagesPublicView", $data);
    }

    function redirect_to_message($id_topic, $page, $message_index)
    {

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER),
            'id_topic' => filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT)
        );

        $this->model->delete_no_read_messages($params);

        $url = "/foro-ddr/index.php?url=MessageController/display/" . $id_topic . "/" . $page . "#" . $message_index;

        redirect_to_url($url);

    }
}
