<?php


// required headers
//
//header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example-level-2/");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "../class_common_config.php";
require_once '../inc_funcs_generic.php';

require_once 'class_user.php';



use \Firebase\JWT\JWT;

$fjwt = new JWT();


// get posted data
$data = json_decode(file_get_contents("php://input"));

if (empty($data))    {

    $api = new api_handler();
    $api->Send_Response (501,"Error","No data posted!","Empty","No data posted to API");
    
    exit;

}


class api_handler {

    public $request_data;
    public $response_data;

    public $user_data;

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
    public function Send_Response($code, $status ,$msg, $data) {

        $this->response_data = array(
                                "status"    =>  $status, 
                                "msg"       =>  $msg, 
                                "request"   =>  $this->request_data,
                                "response"  =>  $data);

        // set response code
        http_response_code($code);           // eg 2000 success; 401 - fail...
        echo json_encode($this->response_data); 

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
                    "message" => "Access denied.",
                    "error" => $e->getMessage()
                ));
            }
        }

        // show error message if jwt is empty
        else{

            // set response code
            http_response_code(401);

            // tell the user access denied
            echo json_encode(array("message" => "Access denied."));
        }

    }


} // end class api_handler

?>
