<?php

define("PAGE_URL", "http://localhost:8080/foro-ddr/");

define("BASE_URL", "/");

define("PATH_LOG", "../app/log/");
define("FILE_LOG", "log.txt");

define("NUM_ITEMS_PAG", 10);
define("HASH_PASS_KEY", "discoduroderoer");

define("SESSION_ID_USER", "id");
define("SESSION_IS_ADMIN", "isAdmin");

define("TRUE", "1");
define("FALSE", "0");

define("IS_ADMIN", "1");
define("IS_USER", "2");

define("ALL_CATEGORIES", "1");
define("ONLY_PARENTS", "2");
define("ONLY_CHILDS", "3");

define("ERROR_GENERAL", "Ha ocurrido un error, contacte con el administrador");
define("MODE_DEBUG", "1");
define("ERROR_LOG", "E");
define("INFO_LOG", "I");

define("DEFAULT_AVATAR", "default-avatar.jpg");

define("LENGTH_USER_KEY", 20);
define("USER_KEY_NUMBER", 0);
define("USER_KEY_MAYUS", 1);
define("USER_KEY_MINUS", 2);

//  Conf Email

define("EMAIL_HOST", "smtp.mailtrap.io");
define("EMAIL_USERNAME", "8aba630f0ba7e7");
define("EMAIL_PASS", "407377b27bbf2c");
define("EMAIL_SMTPSECURE", "tls");
define("EMAIL_PORT", 2525);
define("EMAIL_ADMIN", 'ddr-288a24@inbox.mailtrap.io');

// Plantillas

define("TEMPLATE_NEW_ACCOUNT_NEED_VERIFICATION", __DIR__ . "/../templates_email/create_new_account_need_verification.html");
define("TEMPLATE_NEW_ACCOUNT_SUCCESS", __DIR__ . "/../templates_email/create_new_account_success.html");
define("TEMPLATE_EDIT_PASSWORD", __DIR__ . "/../templates_email/edit_password.html");

// Anuncios

define("SHOW_AD_MONETYZER_EACH", 4);
define("INDEX_AD_MEGABANNER_TOP", 0);
define("INDEX_AD_MEGABANNER_BOTTOM", 1);
define("MIN_HEIGHT_MEGABANNER", 100);