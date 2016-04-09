<?php

define('URL_PUBLIC_FOLDER', 'Public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', '/Semestralka/'); //Nazev adresare ve kterem se nachazi cela webova aplikace
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'konference'); //nazev databaze
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');