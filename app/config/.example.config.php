<?php
define('DB_HOST', '_YOUR_DB_HOST_');
define('DB_USER', '_YOUR_USER_');
define('DB_PASS', '_YOUR_PASSWORD_');
define('DB_NAME', '_YOUR_DB_NAME_');

define('ENVIRONMENT', 'development');
if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
define('APPROOT', dirname(dirname(__FILE__)));

define('URLROOT', 'http://student.test/');

define('URL_PUBLIC_FOLDER', '');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);