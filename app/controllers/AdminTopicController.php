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

    function display()
    {
        isLogged();

        $data = $this->model->getTopics();

        $this->view("AdminTopicView", $data);
    }

    function display_edit($idTopic)
    {
        isLogged();

        $data = $this->model->getTopic($idTopic);

        $data['display_edit'] = true;
        $data['categories'] = $this->modelCategory->getCategories(ONLY_CHILDS)['categories'];

        $this->view("AdminTopicView", $data);
    }

    function edit_topic()
    {

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['action'])) {
                $this->model->edit_topic();
            }
            header("Location: index.php?url=AdminTopicController/display");
        }
    }

    function open_topic($idTopic)
    {
      
        isLogged();

        $this->model->open_topic($idTopic);

        header("Location: index.php?url=AdminTopicController/display");
    }

    function close_topic($idTopic)
    {
      
        isLogged();

        $this->model->close_topic($idTopic);

        header("Location: index.php?url=AdminTopicController/display");
    }
}
