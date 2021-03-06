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
$obj        = (isset($_GET['obj'])) ? $_GET['obj'] : "";                // this will be the target model (db object - table, view); corresponds to a class in the api folder
$operation  = (isset($_GET['operation'])) ? $_GET['operation'] : "";    // what operation (method) to perform on the object (create, read, update, delete); corresponds to a method of the class

try {
            // get posted data
            $pdata      = json_decode(file_get_contents("php://input"));   // all the posted data required to perform the method

                        $DEBUG = false;
                        if ($DEBUG) {
                            // set up test data here...
                            $obj                = "user";
                            $operation          = "get_token";
                            $pdata              = json_decode('{"firstname":"joe","lastname":"bloggs","email":"tom@mainsite.co.uk","password":"tomcat"}',false);
                        }

            $api        = new Api($obj, $operation, $pdata);   
            $response   = $api->processApi();                
        }
        catch (\Throwable $e) {
            $response = [   "status"        => "error",
                            "message"       => $e->getMessage()
            ];
    }


// required headers
//
//header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example-level-2/");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 0");
header("Cache-Control: no-store");
//header("Cache-Control: private");
header("Access-Control-Allow-Headers: Cache-Control, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// set response code
// always postively send a an ok status (200)
http_response_code(200);           // eg 200 success; 401 - fail...
echo json_encode($response); 

// end
############################################################################################################
############################################################################################################
############################################################################################################
