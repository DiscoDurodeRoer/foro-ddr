<?php

use PHPMailer\PHPMailer\PHPMailer;

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

function generateUserKey()
{

    $userKey = "";

    for ($i = 0; $i < LENGTH_USER_KEY; $i++) {

        $typeCharacter = rand(0, 2);

        if ($typeCharacter === USER_KEY_NUMBER) {
            $userKey .= rand(0, 9);
        } elseif ($typeCharacter === USER_KEY_MAYUS) {
            $userKey .= chr(rand(65, 90));
        } else {
            $userKey .= chr(rand(97, 122));
        }
    }

    return $userKey;
}


function sendEmail($email, $subject, $message)
{

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = EMAIL_HOST;
    $mail->Username = EMAIL_USERNAME;
    $mail->Password = EMAIL_PASS;
    $mail->SMTPSecure = EMAIL_SMTPSECURE;
    $mail->Port = EMAIL_PORT;
    $mail->setFrom(EMAIL_ADMIN);
    $mail->addAddress($email);
    $mail->Subject  = $subject;
    $mail->isHTML(true);
    $mail->Body     = $message;
    if (!$mail->send()) {
        writeLog(ERROR_LOG, "functions/sendEmail", "No se envido el mensaje" . $mail->ErrorInfo);
        return false;
    } else {
        if (isModeDebug()) {
            writeLog(INFO_LOG, "functions/sendEmail", "Se ha enviado el correo correctamente");
        }
        return true;
    }
}
