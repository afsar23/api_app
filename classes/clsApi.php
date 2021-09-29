<?php

namespace Afsar\lib;
use \Firebase\JWT\JWT;


class Api {

    private $obj;
    private $operation;
    private $pdata;

    private $token;
    
    public function __construct($obj, $operation, $pdata) {

        $this->obj          = $obj;
        $this->operation    = $operation;
        $this->pdata        = $pdata;

        // get jwt
        $this->token  =   isset($this->pdata->jwt) ? $this-pdata->jwt : "";
        
        return;
    }

    function processApi() {
    
        switch ($this->obj) {
            case 'user'         :    $user = new User($this->pdata); break;
            
            // other cases here        
        }
      
        switch ($this->operation) {

            case 'get_token'                : $response = $user->get_token();           break;
            case 'create'                   : $response = $user->create();               break;
            case 'userlist'                 : $response = $user->userList();            break;
            //other cases here

            default:
                $response = [ "status"        => "error",
                            "message"       => "Api request not found"
                        ];
                break;
        }
      
        return $response;
    
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
