<?php

require_once("../app/index.php");

spl_autoload_extensions('.php');
spl_autoload_register();

$router = new Router();

// $router->register(new Route('/^\/foro-ddr\/category\/\w+[-\w]*$/', 'CategoryController', 'display'));
$router->register(new Route('/^\/foro-ddr\/category\/(\w[\-\w]*)$/', 'CategoryController', 'display'));

// Topics
$router->register(new Route('/^\/foro-ddr\/topic\/(\w[\-\w]*)(\/\w+)?$/', 'TopicController', 'display'));
$router->register(new Route('/^\/foro-ddr\/crear-topic-form\/(\w+)$/', 'TopicController', 'display_create_topic'));
$router->register(new Route('/^\/foro-ddr\/crear-topic$/', 'TopicController', 'create_topic'));

$router->register(new Route('/^\/foro-ddr\/reply\/(\w[\-\w]*)(\/\w+)?$/', 'MessageController', 'display'));
$router->register(new Route('/^\/foro-ddr\/responder-mensaje-form\/(\w+)$/', 'MessageController', 'display_reply_topic'));
$router->register(new Route('/^\/foro-ddr\/responder-mensaje$/', 'MessageController', 'reply_topic'));

// Login
$router->register(new Route('/^\/foro-ddr\/login-form$/', 'LoginController', 'display'));
$router->register(new Route('/^\/foro-ddr\/login$/', 'LoginController', 'login'));
$router->register(new Route('/^\/foro-ddr\/remember$/', 'LoginController', 'remember'));
$router->register(new Route('/^\/foro-ddr\/remember-form$/', 'LoginController', 'display_remember'));

// Users
$router->register(new Route('/^\/foro-ddr\/register-form$/', 'UserController', 'display'));
$router->register(new Route('/^\/foro-ddr\/register$/', 'UserController', 'register'));
$router->register(new Route('/^\/foro-ddr\/user-verification\/(\w+)$/', 'UserController', 'verification'));
$router->register(new Route('/^\/foro-ddr\/profile$/', 'UserController', 'display_profile'));

$router->register(new Route('/^\/foro-ddr\/perfil$/', 'UserController', 'display_profile'));
$router->register(new Route('/^\/foro-ddr\/participaciones-topics$/', 'UserController', 'display_topics_user'));
$router->register(new Route('/^\/foro-ddr\/editar-perfil-form$/', 'UserController', 'display_edit_profile'));
$router->register(new Route('/^\/foro-ddr\/editar-perfil$/', 'UserController', 'edit_profile'));
$router->register(new Route('/^\/foro-ddr\/editar-password-form$/', 'UserController', 'edit_password'));
$router->register(new Route('/^\/foro-ddr\/editar-password\/(\w+)$/', 'UserController', 'edit_password'));
$router->register(new Route('/^\/foro-ddr\/change_password$/', 'UserController', 'change_password'));
$router->register(new Route('/^\/foro-ddr\/verificacion-form$/', 'UserController', 'display_verification'));
$router->register(new Route('/^\/foro-ddr\/desuscribirse-confirm$/', 'UserController', 'display_unsubscribe'));

$router->register(new Route('/^\/foro-ddr\/desuscribirse$/', 'UserController', 'unsubscribe'));
$router->register(new Route('/^\/foro-ddr\/no-desuscribirse$/', 'UserController', 'no_unsubscribe'));
$router->register(new Route('/^\/foro-ddr\/logout$/', 'UserController', 'logout'));
$router->register(new Route('/^\/foro-ddr\/reenviar-confirmacion$/', 'UserController', 'resend_confirmation'));

// admin
$router->register(new Route('/^\/foro-ddr\/admin\/categorias\/crear-categoria$/', 'AdminCategoryController', 'create_category'));
$router->register(new Route('/^\/foro-ddr\/admin\/categorias\/crear-categoria-form$/', 'AdminCategoryController', 'display_create'));
$router->register(new Route('/^\/foro-ddr\/admin\/categorias\/editar-categoria$/', 'AdminCategoryController', 'edit_category'));
$router->register(new Route('/^\/foro-ddr\/admin\/categorias\/editar-categoria-form\/(\w+)$/', 'AdminCategoryController', 'display_edit'));
$router->register(new Route('/^\/foro-ddr\/admin\/categorias\/eliminar-categoria\/(\w+)$/', 'AdminCategoryController', 'delete_category'));
$router->register(new Route('/^\/foro-ddr\/admin\/categorias(\/\w+)?$/', 'AdminCategoryController', 'display'));

$router->register(new Route('/^\/foro-ddr\/admin\/log\/delete-log$/', 'AdminLogController', 'delete_content_log'));
$router->register(new Route('/^\/foro-ddr\/admin\/log$/', 'AdminLogController', 'display'));

$router->register(new Route('/^\/foro-ddr\/admin\/back$/', 'AdminController', 'back'));

$router->register(new Route('/^\/foro-ddr\/admin\/topic\/editar-topic$/', 'AdminTopicController', 'edit_topic'));
$router->register(new Route('/^\/foro-ddr\/admin\/topic\/cerrar-topic\/(\w+)$/', 'AdminTopicController', 'close_topic'));
$router->register(new Route('/^\/foro-ddr\/admin\/topic\/abrir-topic\/(\w+)$/', 'AdminTopicController', 'open_topic'));
$router->register(new Route('/^\/foro-ddr\/admin\/topic\/editar-topic-form\/(\w+)$/', 'AdminTopicController', 'display_edit'));
$router->register(new Route('/^\/foro-ddr\/admin\/topic(\/\w+)?$/', 'AdminTopicController', 'display'));

$router->register(new Route('/^\/foro-ddr\/admin\/user\/no-banear\/(\w+)$/', 'AdminUserController', 'no_ban_user'));
$router->register(new Route('/^\/foro-ddr\/admin\/user\/banear\/(\w+)$/', 'AdminUserController', 'ban_user'));
$router->register(new Route('/^\/foro-ddr\/admin\/user\/desactivar\/(\w+)$/', 'AdminUserController', 'no_act_user'));
$router->register(new Route('/^\/foro-ddr\/admin\/user\/activar\/(\w+)$/', 'AdminUserController', 'act_user'));
$router->register(new Route('/^\/foro-ddr\/admin\/user(\/\w+)?$/', 'AdminUserController', 'display'));

$router->register(new Route('/^\/foro-ddr\/admin$/', 'AdminCategoryController', 'display'));

// search
$router->register(new Route('/^\/foro-ddr\/busqueda\/(\w+)$/', 'SearchController', 'display'));
$router->register(new Route('/^\/foro-ddr\/busqueda\/procesar$/', 'SearchController', 'proccess_search'));

// No read
$router->register(new Route('/^\/foro-ddr\/mensajes-no-leidos\/(\/\w+)?$/', 'NoReadMessagesPublicController', 'display'));
$router->register(new Route('/^\/foro-ddr\/redireccionar-mensaje\/(\w+)\/(\w+)\/(\w+)$/', 'NoReadMessagesPublicController', 'display'));

$router->register(new Route('/^\/foro-ddr/', 'CategoryController', 'display'));
$router->handleRequest($_SERVER['REQUEST_URI']);
