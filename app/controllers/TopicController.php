<?php

class TopicController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Topic");
    }

    function display($id_cat = null, $page = 1)
    {

        // Si existe la categoria, muestro los topic
        if (isset($id_cat)) {

            $params = array(
                'id_cat' => intval(filter_var($id_cat, FILTER_SANITIZE_NUMBER_INT)),
                'page' => intval(filter_var($page, FILTER_VALIDATE_INT))
            );

            $data = $this->model->get_topics($params);

            // Indico que es para mostrar
            $data['display'] = true;

            if (isModeDebug()) {
                writeLog(INFO_LOG, "TopicController/display", json_encode($data));
            }

            $this->view("TopicView", $data);
        }
    }

    function display_create_topic($id_cat = null)
    {

        $data = array();

        $data['create'] = true;

        if (isset($id_cat)) {
            $data['id_cat'] = $id_cat;
        }

        if (isModeDebug()) {
            writeLog(INFO_LOG, "TopicController/display_create_topic", json_encode($data));
        }

        $this->view("TopicView", $data);
    }

    function create_topic()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $session = new Session();

            $params = array(
                'id_user' => $session->getAttribute(SESSION_ID_USER),
                'title_topic' => $_POST['title'],
                'id_cat' => intval(filter_var($_POST['id_cat'], FILTER_SANITIZE_NUMBER_INT)),
                'text' => trim($_POST['text'])
            );

            $data = $this->model->create_topic($params);

            if (isModeDebug()) {
                writeLog(INFO_LOG, "TopicController/create_topic", json_encode($data));
            }

            if (!$data['success']) {
                // redirect_to_url("/foro-ddr/crear-topic-form/" . $_POST['id_cat']);
                $data['create'] = true;
                $data['id_cat'] = $_POST['id_cat'];
                $data['title_topic'] = $_POST['title_topic'];
                $data['text'] = $_POST['text'];
            } 

            $this->view("TopicView", $data);
        }
    }
}
