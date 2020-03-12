<?php

function prepareDataLogin($user){
    $session = new Session();
    $session->setAttribute('id', $user['id']);
    $session->setAttribute('nickname', $user['nickname']);
    $session->setAttribute('login', true);
    $session->setAttribute('isAdmin', $user['rol'] == IS_ADMIN);
}

function today(){
    $datetime = new DateTime();
    return $datetime->format('Y-m-d H:i');
}

function isLogged(){
    $session = new Session();
    if(!$session->getAttribute('login')){
        header('Location: /foro-ddr');
    }
}

?>