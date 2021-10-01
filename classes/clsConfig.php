<?php

namespace Afsar\lib;

use \Firebase\JWT\JWT;

// used to get mysql database connection
class Config {

    public $home_url;
    
    public $jwt_key;
    public $jwt_alg;    
    public $jwt_issued_at;
    public $jwt_expiration_time;
    public $jwt_issuer;
    
    public $token_validation;       // validation status and message (only really relevant if error status)
    public $UserInfo;               // user info gleaned from the token is stoed here
    public $tab_prefix;

	// constructor
    public function __construct() {
		
		$this->home_url = "http://localhost/fvc_standalone/"; 

        // variables used for jwt
        $this->jwt_key = "example_key";
        $this->jwt_alg = 'HS256';
        $this->jwt_issued_at = time();
        $this->jwt_expiration_time = $this->jwt_issued_at + (60 * 60); // valid for 1 hour
               
        $this->jwt_issuer = $this->home_url;
        $this->tab_prefix = "api_";

        // authenticate...and set up user info
        $this->UserInfo = [];
        $this->UserInfo["id"]              =   0;
        $this->UserInfo["firstname"]       =   "";
        $this->UserInfo["lastname"]        =   "";
        $this->UserInfo["email"]           =   "";
        $this->UserInfo["access_level"]    =   "";

        $jwt_token = $this->get_bearer_or_cookie_token();
    
        try {        
            $decoded_jwt = JWT::decode($jwt_token, $this->jwt_key, [$this->jwt_alg]);       // validates token and will throw errors if token is not valid
            $this->UserInfo = (array) $decoded_jwt->data;         
            $this->token_validation = ["status"=>"ok", "message"=>"Valid Token"];
        }
        catch (\Throwable $e) {
            $this->token_validation = [ "status"=> "error",  "message"    => "Invalid Token - ".$e->getMessage() ];
        }

	}

    private function get_bearer_or_cookie_token() {
        $headers = $this->get_authorization_header();
        
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        // default return cookie token....
        return $_COOKIE["jwt_token"];
    }

    private function get_authorization_header() {

        $headers = null;
        
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        
        return $headers;
    }


}


?>

