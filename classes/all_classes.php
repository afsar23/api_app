<?php

// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Asia/Manila');       // Europe/London


session_start();

/** Define ABSPATH as this file's directory */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
use \Afsar\lib\Config;


require_once "clsConfig.php";
require_once 'clsDatabase.php';
require_once 'clsUser.php';

require_once 'clsWebPage.php';
require_once 'clsApi.php';


// generate json web token
require_once 'php-jwt-master/src/BeforeValidException.php';
require_once 'php-jwt-master/src/ExpiredException.php';
require_once 'php-jwt-master/src/SignatureInvalidException.php';
require_once 'php-jwt-master/src/JWT.php';


global $cfg;
$cfg = new Config();
