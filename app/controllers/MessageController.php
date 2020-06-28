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
                'page' => filter_var($page, FILTER_SANITIZE_NUMBER_INT)
            );

            $data = $this->model->get_messages_by_topic($params);
            $data["display"] = true;

            if (isModeDebug()) {
                writeLog(INFO_LOG, "MessageController/display", json_encode($data));
            }

            $this->view("MessageView", $data);
        }
    }

    function display_reply_topic($id_topic = null)
    {

        if (isset($id_topic)) {

            $params = array(
                'id_topic' => filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT)
            );

            if ($this->model->is_open_topic($params)) {

                $data["reply_message"] = true;

                $data['id_topic'] = $id_topic;

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "MessageController/display_reply_topic", json_encode($data));
                }

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

            if (isModeDebug()) {
                writeLog(INFO_LOG, "MessageController/reply_topic", json_encode($data));
            }

            if ($data['success']) {
                $params = array(
                    'id_user' => $session->getAttribute(SESSION_ID_USER),
                    'id_message' => filter_var($data['id_message'], FILTER_SANITIZE_NUMBER_INT),
                    'id_topic' => filter_var($_POST['id_topic'], FILTER_SANITIZE_NUMBER_INT)
                );

                $data = $this->model->notify_no_read_messages($params);

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "MessageController/reply_topic", json_encode($data));
                }

                if ($data['success']) {
                    redirect_to_url("/foro-ddr/index.php?url=MessageController/display/" . $params['id_topic']);
                } else {
                    $this->view("MessageView", $data);
                }
            } else {
                $this->view("MessageView", $data);
            }
        }
    }
}
