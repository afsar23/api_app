<?php
namespace Afsar\lib;
session_start();

define("C_DEBUG",true);

// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Asia/Manila');       // Europe/London

/** Define ABSPATH as this file's directory */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
use \Afsar\lib;


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

global $dbConn;
// get database connection
$dbConn = (new Database())->getConnection();

