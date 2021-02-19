<?php


class Topic
{

    function __construct()
    {
    }


    function get_topics($params)
    {

        $db = new PDODB();
        $data = array();

        $paramsDB = array();

        try {

            $sql = "SELECT t.id, t.title, u.nickname, t.open, t.views ";
            $sql .= "FROM topics t, users u ";
            $sql .= "WHERE t.creator_user = u.id and ";
            $sql .= "t.id_cat = ? ";

            $paramsDB = array(
                $params['id_cat'],
            );

            $data['num_elems'] = $db->numRowsPrepared($sql, $paramsDB);

            $sql .= "LIMIT ?, ?";

            $paramsDB = array(
                $params['id_cat'],
                ($params['page'] - 1) * NUM_ITEMS_PAG,
                NUM_ITEMS_PAG
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Topic/get_topics", $sql);
                writeLog(INFO_LOG, "Topic/get_topics", json_encode($paramsDB));
            }

            $data['topics'] = $db->getDataPrepared($sql, $paramsDB);
            $data['id_cat'] = $params['id_cat'];

            foreach ($data['topics'] as $key => $value) {
                $data['topics'][$key]['path'] = $value['id'] . '-' . stringToPath($value['title']);
            }


            // Paginacion
            $data["pag"] = $params['page'];
            $data['last_page'] = ceil($data['num_elems'] / NUM_ITEMS_PAG);
            $data['url_base'] = "/foro-ddr/topic/" . $data['id_cat'];

            $sql = "SELECT name ";
            $sql .= "FROM categories ";
            $sql .= "WHERE id = ? ";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Topic/get_topics", $sql);
            }

            $paramsDB = array(
                $data['id_cat']
            );

            $data['name_category'] = $db->getDataSinglePropPrepared($sql, "name", $paramsDB);

            $sql = "SELECT c.id, c.name ";
            $sql .= "FROM categories_child cch, categories c ";
            $sql .= "WHERE c.id = cch.id_cat_parent and cch.id_cat = ? ";
            $sql .= "ORDER BY level";

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Topic/get_topics", $sql);
                writeLog(INFO_LOG, "Topic/get_topics", json_encode($paramsDB));
            }

            $parents = $db->getDataPrepared($sql, $paramsDB);

            $numRows = $db->numRowsPrepared($sql, $paramsDB);

            if ($numRows > 0) {

                $data['breadcumbs'] = array();

                foreach ($parents as $key => $value) {

                    $breadcumb = new BreadCumb(
                        $value['name'],
                        '/foro-ddr/categoria/' . $value['id'] . '-' . stringToPath($value['name']),
                        null,
                        $key < ($numRows - 1)
                    );

                    array_push($data['breadcumbs'], $breadcumb);
                }
            }


            $data['success'] = true;
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Topic/get_topics", $e->getMessage());
        }

        $db->close();
        return $data;
    }


    function create_topic($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();

        try {

            if (empty($params['title_topic'])) {
                $data['success'] = false;
                $data['message'] = "El titulo no puede estar vacio.";
            } else if (empty($params['text'])) {
                $data['success'] = false;
                $data['message'] = "El mensaje no puede estar vacio.";
            } else {

                $id_topic = $db->getLastId("id", "topics");

                $sql = "INSERT INTO topics VALUES (?, ?, ?, ?, 1, 0, ?);";

                $paramsDB = array(
                    $id_topic,
                    $params['title_topic'],
                    today(),
                    $params['id_user'],
                    $params['id_cat']
                );

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "Topic/create_topic", $sql);
                    writeLog(INFO_LOG, "Topic/create_topic", json_encode($params));
                }

                $success = $db->executeInstructionPrepared($sql, $paramsDB);

                if ($success) {
                    $data['id_topic'] = $id_topic;

                    $id_message = $db->getLastId("id", "messages");

                    $sql = "INSERT INTO messages VALUES (?, ?, ?, ?, 1);";

                    $paramsDB = array(
                        $id_message,
                        $params['text'],
                        today(),
                        $params['id_user']
                    );

                    if (isModeDebug()) {
                        writeLog(INFO_LOG, "Topic/create_topic", $sql);
                        writeLog(INFO_LOG, "Topic/create_topic", json_encode($paramsDB));
                    }

                    $success = $db->executeInstructionPrepared($sql, $paramsDB);

                    if ($success) {

                        $sql = "INSERT INTO messages_public VALUES (?,?,1,0);";

                        $paramsDB = array(
                            $id_message,
                            $id_topic
                        );

                        if (isModeDebug()) {
                            writeLog(INFO_LOG, "Topic/create_topic", $sql);
                            writeLog(INFO_LOG, "Topic/create_topic", json_encode($paramsDB));
                        }

                        $success = $db->executeInstructionPrepared($sql, $paramsDB);
                    }
                }

                $data['success'] = $success;

                if ($data['success']) {
                    $data['message'] = "El topic se ha creado correctamente. Pulsa <a href='/foro-ddr/reply/" . $data['id_topic'] . "'>aquí</a> para ir al topic.";
                } else {
                    $data['message'] = "El topic no se creo correctamente.";
                }
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Topic/create_topic", $e->getMessage());
        }

        $db->close();
        return $data;
    }
}
