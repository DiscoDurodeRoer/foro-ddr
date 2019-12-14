<?php

function prepareDataLogin($user){
    $session = new Session();
    $session->setAttribute('id', $user['id']);
    $session->setAttribute('nickname', $user['nickname']);
    $session->setAttribute('login', true);
}

function today(){
    $datetime = new DateTime();
    return $datetime->format('Y-m-d H:i');
}

?>