<?php

class MessageController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Message");
    }

    function display($id_topic, $page = 1)
    {

        if (isset($id_topic)) {

            $params = array(
                'id_topic' => filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT),
                'page' => $page
            );

            $data = $this->model->getMessagesByTopic($params);

            $data["display"] = true;

            $this->view("MessageView", $data);
        }
    }

    function display_reply_topic($id_topic = null)
    {

        if (isset($id_topic)) {

            $params = array(
                'id_topic' => $id_topic
            );

            if ($this->model->is_open_topic($params)) {

                $data["reply_message"] = true;

                $data['id_topic'] = $id_topic;

                $this->view("MessageView", $data);
            } else {
                header("Location: /foro-ddr");
            }
        }
    }

    function reply_topic()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $session = new Session();

            $params = array(
                'id_user' => $session->getAttribute(SESSION_ID_USER),
                'text' => $_POST['text'],
                'id_topic' => filter_var($_POST['id_topic'], FILTER_SANITIZE_NUMBER_INT)
            );

            $data = $this->model->reply_topic($params);

            $params = array(
                'id_user' => $session->getAttribute(SESSION_ID_USER),
                'id_message' => $data['id_message'],
                'id_topic' => filter_var($_POST['id_topic'], FILTER_SANITIZE_NUMBER_INT)
            );

            $data = $this->model->notifyNoReadMessages($params);

            if ($data['success']) {
                header("Location: /foro-ddr/index.php?url=MessageController/display/" . $_POST['id_topic']);
            } else {
                $this->view("MessageView", $data);
            }
        }
    }
}
