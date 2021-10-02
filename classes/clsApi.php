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
    
        global $cfg;

        if ( ($this->operation <> 'get_token') And ($this->operation <> 'create') )   {    // authentication not required for login and register
            if ($cfg->token_validation["status"]=="error") {
                return $cfg->token_validation;
            }
        }     

        // we now global $UserInfo populated
        // and we can check necessary user access before performing requested operation...




        // instatiate an object of the class supplied in the variable $this->obj
        //$classname=strtoupper($this->obj);  //.'Class';
       // $user=new $classname($this->pdata);

        switch ($this->obj) {
            case 'user'         :    $user = new User($this->pdata); break;
            
            // other cases here        
        }
      
        switch ($this->operation) {

            case 'get_token'                : $response = $user->get_token();           break;
            case 'create'                   : $response = $user->create();              break;
            case 'delete'                   : $response = $user->delete();              break;
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
 

} // end class api_handler

?>
