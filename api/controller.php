<?php

require_once "../classes/all_classes.php";

use Afsar\lib\Database;
use Afsar\lib\Api;
use Afsar\lib\User;

use \Firebase\JWT\JWT;

//get query params
$obj = $_GET['obj'];                // this will be the target model (db object - table, view); corresponds to a class in the api folder
$action = $_GET['operation'];       // what operation (method) to perform on the object (create, read, update, delete); corresponds to a method of the class

// get posted data
$input_data = json_decode(file_get_contents("php://input"));   // all the posted data required to perform the method

$api = new Api();

function processApi() {

	if ( is_user_logged_in() ) {
		
		switch ($fnc) {

			case 'apphome':			require_once 'apphome.php';							break;			// new single page app

			case 'planmgr':			require_once 'w2app.php'; 							break;			// new single page app

			case 'manageclients':	require_once 'adm_clients.php'; break;

			case 'manageusers':		require_once 'adm_users.php'; break;

			case 'datamanager':		require_once 'data_manager.php'; break;

			case 'indexmanager':	require_once 'index_manager.php'; break;
			
			case 'view_report':		require_once 'view_report.php'; break;
			
			default:				
				if(file_exists(dirname(__FILE__).'/'.$fnc.'.php')) {
					require_once $fnc.'.php';
				} else {			
					require_once 'w2app.php';    // default home page
				}
				break;
		}


	} else {
		
		echo $fvc->warning('You need to <a href="'.wp_login_url().'">login</a> to access the FVC Calculator');

	}    


}








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
                                "jsCallBack"    =>  jsCallBackSuccess()
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
function jsCallBackSuccess() {

    return "
        alert('Well done!');            
    ";
}


function jsCallBackFail() {

    return "        
        alert('Ooops - sorry. Invalid login!');      
    ";
}


?>
