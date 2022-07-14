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

            $session = new Session();
            
            $params = array(
                'id_user' => $session->getAttribute(SESSION_ID_USER),
                'is_admin' => $session->getAttribute(SESSION_IS_ADMIN),
                'id_topic' => intval(filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT)),
                'url_topic' => $id_topic,
                'page' => intval(filter_var($page, FILTER_SANITIZE_NUMBER_INT))
            );

            $data = $this->model->get_messages_by_topic($params);
            
            if(!$data["exists"]){
                header("Location: " . constant('BASE_URL'));
            }else{

                $data["display"] = true;

                writeLog(INFO_LOG, "MessageController/display", json_encode($data));
    
                $this->view("MessageView", $data);
            }
            
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

                writeLog(INFO_LOG, "MessageController/display_reply_topic", json_encode($data));

                $this->view("MessageView", $data);
            } else {
                header("Location: " . constant('BASE_URL'));
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

            writeLog(INFO_LOG, "MessageController/reply_topic", json_encode($data));

            if ($data['success']) {
                $params = array(
                    'id_user' => $session->getAttribute(SESSION_ID_USER),
                    'id_message' => filter_var($data['id_message'], FILTER_SANITIZE_NUMBER_INT),
                    'id_topic' => filter_var($_POST['id_topic'], FILTER_SANITIZE_NUMBER_INT)
                );

                $data = $this->model->notify_no_read_messages($params);

                writeLog(INFO_LOG, "MessageController/reply_topic", json_encode($data));

                if ($data['success']) {
                    redirect_to_url(constant('BASE_URL') . "reply/" . $params['id_topic']);
                } else {
                    $this->view("MessageView", $data);
                }
            } else {
                $this->view("MessageView", $data);
            }
        }
    }

    function mark_message_solution($id_topic, $id_message)
    {

        if (isset($id_message)) {

            $session = new Session();
            
            $params = array(
                'id_user' => $session->getAttribute(SESSION_ID_USER),
                'id_message' => filter_var($id_message)
            );

            $data = $this->model->mark_message_solution($params);

            writeLog(INFO_LOG, "MessageController/mark_message_solution", json_encode($data));

            if ($data['success']) {
                $this->display($id_topic);
            } else {
                $this->view("MessageView", $data);
            }
        }
    }
}
