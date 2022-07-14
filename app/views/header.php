<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/includes/bootstrap-4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/includes/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/styles.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href="<?php echo BASE_URL ?>public/includes/ckeditor4/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css" rel="stylesheet">
    <title>Foro DDR</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W8XW2YXKE5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-W8XW2YXKE5');
    </script>

    <!-- Monetyzer -->
    <!-- Quantcast Choice. Consent Manager Tag v2.0 (for TCF 2.0) -->
    <script type="text/javascript" async="true">
        (function() {
            var host = 'www.themoneytizer.com';
            var element = document.createElement('script');
            var firstScript = document.getElementsByTagName('script')[0];
            var url = 'https://quantcast.mgr.consensu.org'
                .concat('/choice/', '6Fv0cGNfc_bw8', '/', host, '/choice.js')
            var uspTries = 0;
            var uspTriesLimit = 3;
            element.async = true;
            element.type = 'text/javascript';
            element.src = url;

            firstScript.parentNode.insertBefore(element, firstScript);

            function makeStub() {
                var TCF_LOCATOR_NAME = '__tcfapiLocator';
                var queue = [];
                var win = window;
                var cmpFrame;

                function addFrame() {
                    var doc = win.document;
                    var otherCMP = !!(win.frames[TCF_LOCATOR_NAME]);

                    if (!otherCMP) {
                        if (doc.body) {
                            var iframe = doc.createElement('iframe');

                            iframe.style.cssText = 'display:none';
                            iframe.name = TCF_LOCATOR_NAME;
                            doc.body.appendChild(iframe);
                        } else {
                            setTimeout(addFrame, 5);
                        }
                    }
                    return !otherCMP;
                }

                function tcfAPIHandler() {
                    var gdprApplies;
                    var args = arguments;

                    if (!args.length) {
                        return queue;
                    } else if (args[0] === 'setGdprApplies') {
                        if (
                            args.length > 3 &&
                            args[2] === 2 &&
                            typeof args[3] === 'boolean'
                        ) {
                            gdprApplies = args[3];
                            if (typeof args[2] === 'function') {
                                args[2]('set', true);
                            }
                        }
                    } else if (args[0] === 'ping') {
                        var retr = {
                            gdprApplies: gdprApplies,
                            cmpLoaded: false,
                            cmpStatus: 'stub'
                        };

                        if (typeof args[2] === 'function') {
                            args[2](retr);
                        }
                    } else {
                        queue.push(args);
                    }
                }

                function postMessageEventHandler(event) {
                    var msgIsString = typeof event.data === 'string';
                    var json = {};

                    try {
                        if (msgIsString) {
                            json = JSON.parse(event.data);
                        } else {
                            json = event.data;
                        }
                    } catch (ignore) {}

                    var payload = json.__tcfapiCall;

                    if (payload) {
                        window.__tcfapi(
                            payload.command,
                            payload.version,
                            function(retValue, success) {
                                var returnMsg = {
                                    __tcfapiReturn: {
                                        returnValue: retValue,
                                        success: success,
                                        callId: payload.callId
                                    }
                                };
                                if (msgIsString) {
                                    returnMsg = JSON.stringify(returnMsg);
                                }
                                event.source.postMessage(returnMsg, '*');
                            },
                            payload.parameter
                        );
                    }
                }

                while (win) {
                    try {
                        if (win.frames[TCF_LOCATOR_NAME]) {
                            cmpFrame = win;
                            break;
                        }
                    } catch (ignore) {}

                    if (win === window.top) {
                        break;
                    }
                    win = win.parent;
                }
                if (!cmpFrame) {
                    addFrame();
                    win.__tcfapi = tcfAPIHandler;
                    win.addEventListener('message', postMessageEventHandler, false);
                }
            };

            if (typeof module !== 'undefined') {
                module.exports = makeStub;
            } else {
                makeStub();
            }

            var uspStubFunction = function() {
                var arg = arguments;
                if (typeof window.__uspapi !== uspStubFunction) {
                    setTimeout(function() {
                        if (typeof window.__uspapi !== 'undefined') {
                            window.__uspapi.apply(window.__uspapi, arg);
                        }
                    }, 500);
                }
            };

            var checkIfUspIsReady = function() {
                uspTries++;
                if (window.__uspapi === uspStubFunction && uspTries < uspTriesLimit) {
                    console.warn('USP is not accessible');
                } else {
                    clearInterval(uspInterval);
                }
            };

            if (typeof window.__uspapi === 'undefined') {
                window.__uspapi = uspStubFunction;
                var uspInterval = setInterval(checkIfUspIsReady, 6000);
            }
        })();
    </script>
    <!-- End Quantcast Choice. Consent Manager Tag v2.0 (for TCF 2.0) -->

</head>

<body>

    <div class="row-no-gutters" id="header">
        <!-- Cabecera -->
        <div class="col-12">
            <!-- Menu -->

            <div class="container">

                <div class="row">
                    <div class="col-lg-4 col-12 block-logo">
                        <a class="navbar-brand" href="index.php">
                            <img src="<?php echo BASE_URL ?>public/img/logo-foro.png" alt="">
                        </a>
                    </div>
                    <div class="col-lg-8 col-12 mt-2 block-buttons">

                       

                        <div class="row">
                            <div class="col-md-4 col-12 text-truncate mb-2 mb-sm-0">
                                <?php
                                 if (isset($data) && $data['login']) {

                                    $nickname = $data['nickname'];
                                    ?>
                                    <span class="greeting mr-3" title="<?php echo 'Hola, ' . $nickname; ?>">Hola, <?php echo $nickname ?></span>
                                    <?php
                                }
                                ?>    
                            </div>
                            <div class="col-md-4 col-9">
                                <form action="<?php echo BASE_URL; ?>procesar-busqueda" method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Buscar en el foro...">
                                        <div class="input-group-append">
                                            <button class="btn btn-icon btn-outline-secondary" type="submit">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 col-3">
                                <nav class="navbar navbar-expand navbar-menu">

                                <div class="collapse navbar-collapse flex-row-reverse" id="navbarSupportedContent">
                                    <ul class="navbar-nav">
                                    
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars" id="icon-menu"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php

                                        if (isset($data) && $data['login']) {

                                            if ($data['isAdmin']) {
                                                ?>
                                                    <a class="dropdown-item" href="<?php echo BASE_URL ?>admin">
                                                        <i class="fa fa-home" aria-hidden="true"></i> Admin
                                                    </a>
                                                <?php
                                            }

                                            ?>
                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>mensajes-no-leidos">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i> Mensajes no leidos <span class="badge badge-light"><?php echo $data['msg_no_read'] ?></span>
                                            </a>

                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>perfil">
                                                <i class="fa fa-user" aria-hidden="true"></i> Ver perfil
                                            </a>

                                            <a class="dropdown-item" href="<?php echo BASE_URL ?>logout">
                                                <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                                            </a>
                                            <?php
                                       
                                        } else {
                                        ?>
                                        
                                        <a class="dropdown-item" href="<?php echo BASE_URL ?>register-form">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i> Registrarse
                                        </a>
                                        <a class="dropdown-item" href="<?php echo BASE_URL ?>login-form">
                                            <i class="fa fa-user" aria-hidden="true"></i> Iniciar sesión
                                        </a>
                                        <?php
                                        }
                                        ?>

                                    </li>
                                
                                    </form>
                                </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Contenido -->
    <div class="row-no-gutters vh-100" id="content">
        <div class="col-12">
            <div class="container">
                <div class="content-start">

                    <?php
                    $index_ad = INDEX_AD_MEGABANNER_TOP;
                    $min_height = MIN_HEIGHT_MEGABANNER;
                    include 'ads-monetyzer.php';
                    ?>


                    <?php
                    include_once "show-info-message.php";
                    ?>