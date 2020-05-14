<?php

define("PAGE_URL", "http://localhost:8080/foro-ddr/public/");

define("BASE_URL", "/foro-ddr/");

define("PATH_LOG", "../app/log/");
define("FILE_LOG", "log.txt");

define("NUM_ITEMS_PAG", 10);
define("HASH_PASS_KEY", "discoduroderoer");

define("SESSION_ID_USER", "id");

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

define("DEFAULT_AVATAR", PAGE_URL."img/default-avatar.jpg");

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
