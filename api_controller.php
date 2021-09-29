<?php
namespace Afsar\lib;
/** 
 * Entry point for all externally initiated api request (client on same or other domain) 
 * 
*/
require_once "classes/all_classes.php";

use Afsar\lib;
use \Firebase\JWT\JWT;

// consider mplementing proper API routing and endpoints...

//get query params
$obj        = $_GET['obj'];             // this will be the target model (db object - table, view); corresponds to a class in the api folder
$operation  = $_GET['operation'];       // what operation (method) to perform on the object (create, read, update, delete); corresponds to a method of the class

// get posted data
$pdata      = json_decode(file_get_contents("php://input"));   // all the posted data required to perform the method

            $DEBUG = false;
            if ($DEBUG) {
                // set up test data here...
                $obj                = "user";
                $operation          = "get_token";
                $pdata              = json_decode('{"email":"tom@mainsite.co.uk","password":"tomcat"}',false);
            }

$api        = new Api($obj, $operation, $pdata);   
$response   = $api->processApi();
    
// required headers
//
//header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example-level-2/");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// set response code
// always postively send a an ok status (200)
http_response_code(200);           // eg 200 success; 401 - fail...
echo json_encode($response); 
// end








