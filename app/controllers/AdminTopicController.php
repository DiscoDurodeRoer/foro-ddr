<?php

class AdminTopicController extends Controller
{

    private $model;
    private $modelCategory;

    function __construct()
    {
        $this->model = $this->model("AdminTopic");
        $this->modelCategory = $this->model("AdminCategory");
    }

    function display($page = 1)
    {
        isLogged();

        $params = array(
            'page' => filter_var($page, FILTER_VALIDATE_INT)
        );

        $data = $this->model->get_topics($params);

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminTopicController/display", json_encode($data));
        }

        $this->view("AdminTopicView", $data);
    }

    function display_edit($id_topic)
    {
        isLogged();

        $data = $this->model->get_topic($id_topic);

        $data['display_edit'] = true;

        $params = array(
            'mode' => ONLY_CHILDS
        );

        $data['categories'] = $this->modelCategory->get_categories($params)['categories'];

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminTopicController/display_edit", json_encode($data));
        }

        $this->view("AdminTopicView", $data);
    }

    function edit_topic()
    {

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['action'])) {

                $params = array(
                    'title' => $_POST['title'],
                    'category' => filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT),
                    'id' => filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT)
                );

                $data = $this->model->edit_topic($params);

                $topics = $this->model->get_topics();

                $data['topics'] = $topics['topics'];

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "AdminTopicController/edit_topic", json_encode($data));
                }

                $this->view("AdminTopicView", $data);
            } else {
                header("Location: index.php?url=AdminTopicController/display");
            }
        }
    }

    function open_topic($id_topic)
    {

        isLogged();

        $params = array(
            'id_topic' => filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->open_topic($params);

        $topics = $this->model->get_topics();

        $data['topics'] = $topics['topics'];

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminTopicController/open_topic", json_encode($data));
        }

        $this->view("AdminTopicView", $data);
    }

    function close_topic($id_topic)
    {

        isLogged();

        $params = array(
            'id_topic' => filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->close_topic($params);

        $topics = $this->model->get_topics();

        $data['topics'] = $topics['topics'];

        if (isModeDebug()) {
            writeLog(INFO_LOG, "AdminTopicController/close_topic", json_encode($data));
        }

        $this->view("AdminTopicView", $data);
    }
}
