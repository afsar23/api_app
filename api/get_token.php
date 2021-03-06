<?php

require_once "../classes/all_classes.php";

use Afsar\lib\Database;
use Afsar\lib\Api;
use Afsar\lib\User;

use \Firebase\JWT\JWT;


// get posted data
$data = json_decode(file_get_contents("php://input"));
    // test / temp
    $Xdata = (object) [
                        "email"   => "tom@mainsite.co.uk",
                        "password"=> "tomcat"    
    ];


$api = new Api();

if (empty($data))    {

    $api->Send_Response (501,"Error","No data posted!","Empty","No data posted to API");
    //exit;

}


// get database connection
$database = new Database();
$db = $database->getConnection();
// instantiate user object
$user = new User($db);



$user->email = $data->email;
$email_exists = $user->emailExists();

// check if email exists and if password is correct
if($email_exists && password_verify($data->password, $user->password)){

    $token = array(
        "iat" => $cfg->jwt_issued_at,
        "exp" => $cfg->jwt_expiration_time,
        "iss" => $cfg->jwt_issuer,
        "data" => array(
            "id" => $user->id,
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "email" => $user->email,
            "access_level" => $user->access_level
        )
    );

    // generate jwt
    $jwt = JWT::encode($token, $cfg->jwt_key);
    
    $response_data = array("userinfo"  => $token["data"],
                    "jwt"=>$jwt
                );

    $api->Send_Response(array( "status"        =>  "ok",
                               "message"        =>  "Login extremely successful!",
                                "data"          =>  $response_data,
                                "jsCallBack"    =>  jsCallBackSuccess($jwt)
                             )
    );

}

// login failed
else {
    
    $api->Send_Response(array("status"      =>  "error",
                            "message"       =>  "Invalid login",
                            "jsCallBack"    =>  jsCallBackFail()
                            )
                        );

}

//  front-end call backs
// what to do on the client after receving the response
//
function jsCallBackSuccess($jwt) {

    return "
        setCookie('jwt_token','$jwt',1);
        alert('Well done!');            
    ";
}


function jsCallBackFail() {

    return "        
    //    alert('Ooops - sorry. Invalid login!');      
    ";
}


?>
