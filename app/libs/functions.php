<?php

function prepareDataLogin($user)
{
    $session = new Session();
    $session->setAttribute('id', $user['id']);
    $session->setAttribute('nickname', $user['nickname']);
    $session->setAttribute('login', true);
    $session->setAttribute('isAdmin', $user['rol'] == IS_ADMIN);
}

function today()
{
    $datetime = new DateTime();
    return $datetime->format('Y-m-d H:i');
}

function isModeDebug()
{
    return MODE_DEBUG === TRUE;
}

function writeLog($type, $origin, $message)
{
    $log = new Log();
    $log->writeLine($type, $origin, $message);
    $log->close();
}

function isLogged()
{
    $session = new Session();
    if (!$session->getAttribute('login')) {
        header('Location: /foro-ddr');
    }
}

function redirect_to_url($url)
{
    header("Location: " . $url);
}

function msgNoRead()
{

    $session = new Session();
    $db = new PDODB();

    $sql = "SELECT count(*) as num_messages ";
    $sql .= "FROM unread_messages_public um, ";
    $sql .= "messages_public mp ";
    $sql .= "WHERE mp.id_message = um.id_message and ";
    $sql .= "um.id_user = " . $session->getAttribute(SESSION_ID_USER);

    if (isModeDebug()) {
        writeLog(INFO_LOG, "functions/msgNoRead", $sql);
    }

    $numMessages = $db->getDataSingleProp($sql, "num_messages");

    $db->close();

    return $numMessages;
}
