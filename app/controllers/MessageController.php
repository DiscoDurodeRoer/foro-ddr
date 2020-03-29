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
            $data = $this->model->getMessagesByTopic(
                filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT),
                $page
            );

            $data["display"] = true;

            $this->view("MessageView", $data);
        }
    }

    function display_reply_topic($id_topic = null)
    {

        if (isset($id_topic)) {

            if ($this->model->is_open_topic($id_topic)) {
                
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

            $data = $this->model->reply_topic(
                $session->getAttribute(SESSION_ID_USER),
                $_POST['text'],
                filter_var($_POST['id_topic'], FILTER_SANITIZE_NUMBER_INT)
            );

            if ($data['success']) {
                header("Location: /foro-ddr/index.php?url=MessageController/display/" . $_POST['id_topic']);
            } else {
                $this->view("MessageView", $data);
            }
        }
    }
}
