<?php

class TopicController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Topic");
    }

    function display($id_cat = null)
    {

        // Si existe la categoria, muestro los topic
        if (isset($id_cat)) {

            $params = array(
                'id_cat' => $id_cat
            );

            $data = $this->model->getTopics($params);

            // Indico que es para mostrar
            $data['display'] = true;

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
                'id_cat' => filter_var($_POST['id_cat'], FILTER_SANITIZE_NUMBER_INT),
                'text' => $_POST['text']
            );

            $data = $this->model->create_topic($params);

            if ($data['success']) {
                $data['message'] = "El topic se ha creado correctamente. Pulsa <a href='index.php?url=MessageController/display/" . $data['id_topic'] . "'>aquí</a> para ir al topic.";
            } else {
                $data['message'] = "El topic no se creo correctamente.";
            }

            $this->view("TopicView", $data);
        }
    }
}
