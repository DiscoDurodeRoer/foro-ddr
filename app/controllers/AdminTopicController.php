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
            'page' => intval(filter_var($page, FILTER_SANITIZE_NUMBER_INT))
        );

        $data = $this->model->get_topics($params);

        writeLog(INFO_LOG, "AdminTopicController/display", json_encode($data));

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

        writeLog(INFO_LOG, "AdminTopicController/display_edit", json_encode($data));

        $this->view("AdminTopicView", $data);
    }

    function edit_topic()
    {

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {


            $params = array(
                'title' => $_POST['title'],
                'category' => filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT),
                'id' => filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT)
            );

            $data = $this->model->edit_topic($params);

            $params = array(
                'page' => 1
            );

            $topics = $this->model->get_topics($params);

            $data['topics'] = $topics['topics'];
            $data['pag'] = $topics['pag'];
            $data['last_page'] = $topics['last_page'];
            $data['num_elems'] = $topics['num_elems'];
            $data['url_base'] = $topics['url_base'];

            writeLog(INFO_LOG, "AdminTopicController/edit_topic", json_encode($data));

            $this->view("AdminTopicView", $data);
        }
    }

    function open_topic($id_topic)
    {

        isLogged();

        $params = array(
            'id_topic' => filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT),
        );

        $data = $this->model->open_topic($params);

        $params = array(
            'page' => 1
        );

        $topics = $this->model->get_topics($params);

        $data['topics'] = $topics['topics'];
        $data['pag'] = $topics['pag'];
        $data['last_page'] = $topics['last_page'];
        $data['num_elems'] = $topics['num_elems'];
        $data['url_base'] = $topics['url_base'];

        writeLog(INFO_LOG, "AdminTopicController/open_topic", json_encode($data));

        $this->view("AdminTopicView", $data);
    }

    function close_topic($id_topic)
    {

        isLogged();

        $params = array(
            'id_topic' => filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->close_topic($params);

        $params = array(
            'page' => 1
        );

        $topics = $this->model->get_topics($params);
        
        $data['topics'] = $topics['topics'];
        $data['pag'] = $topics['pag'];
        $data['last_page'] = $topics['last_page'];
        $data['num_elems'] = $topics['num_elems'];
        $data['url_base'] = $topics['url_base'];

        writeLog(INFO_LOG, "AdminTopicController/close_topic", json_encode($data));

        $this->view("AdminTopicView", $data);
    }

    
    function delete_topic($id_topic)
    {

        isLogged();

        $params = array(
            'id_topic' => filter_var($id_topic, FILTER_SANITIZE_NUMBER_INT)
        );

        $data = $this->model->delete_topic($params);

        $params = array(
            'page' => 1
        );

        $topics = $this->model->get_topics($params);
        
        $data['topics'] = $topics['topics'];
        $data['pag'] = $topics['pag'];
        $data['last_page'] = $topics['last_page'];
        $data['num_elems'] = $topics['num_elems'];
        $data['url_base'] = $topics['url_base'];

        writeLog(INFO_LOG, "AdminTopicController/close_topic", json_encode($data));

        $this->view("AdminTopicView", $data);
    }
}
