<?php

class Search
{

    function __construct()
    {
    }

    function search_topics($params)
    {

        $db = new PDODB();

        $data = array();

        try {
            $wordsSearched = explode(';', $params['searched']);

            writeLog(INFO_LOG, "Search/wordsearched", json_encode($wordsSearched));


            $sql = "SELECT * ";
            $sql .= "FROM topics ";
            $sql .= "WHERE ";

            for ($i = 0; $i < count($wordsSearched); $i++) {
                if (!empty($wordsSearched[$i])) {
                    $sql .= " title LIKE '%" . $wordsSearched[$i] . "%' ";
                    if ($i !== count($wordsSearched) - 1) {
                        $sql .= " OR ";
                    }
                }
            }
            if (isModeDebug()) {
                writeLog(INFO_LOG, "Search/search_topics", $sql);
            }

            $data['topics'] = $db->getData($sql);

            $data['has_results'] = $db->numRows($sql);
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Search/search_topics", $e->getMessage());
        }

        $db->close();

        return $data;
    }
}
