<?php

namespace Afsar\lib;
use \Firebase\JWT\JWT;


class Api {

    public $request_data;

    public $token;
    public $action;

    public function Init_Request() {

        // get posted data
        $this->request_data = json_decode(file_get_contents("php://input"));

        // get jwt
        $this->token  =   isset($this->request_data->jwt) ? $this->request_data->jwt : "";
        $this->action =   isset($this->request_data->action) ? $this->request_data->action : "";

        return;
    }

    // all apis file will send a response back through this function
    public function Send_Response($response) {

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

        return;
    }


    function loggedIn() {
        // if jwt is not empty
        $payload = "";

        $jwt = $this->token;

        if($jwt){
            // if decode succeed, show user details
            try {
                // decode jwt
                $payload = JWT::decode($jwt, $key, array('HS256'));
            }
            catch (Exception $e) {
                $payload = ""; // do thing
            }
        }    
        return $payload;
    }

    public function Validate_Token() {

        // if jwt is not empty
        $jwt = $this->token;

        if($jwt){

            // if decode succeed, show user details
            try {
                // decode jwt
                $payload = JWT::decode($jwt, $key, array('HS256'));
                http_response_code(200);
                return $payload;  
            }

            // if decode fails, it means jwt is invalid
            catch (Exception $e){

                // set response code
                http_response_code(401);

                // tell the user access denied  & show error message
                echo json_encode(array(
                    "message" => "Access denied - Invalid Token",
                    "error" => $e->getMessage()
                ));
            }
        }

        // show error message if jwt is empty
        else{

            // set response code
            http_response_code(401);

            // tell the user access denied
            echo json_encode(array("message" => "Access denied - Missing Token"));
        }

    }


} // end class api_handler

?>
