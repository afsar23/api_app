<?php


require_once 'class_api_handler.php';


// get database connection
$database = new AppDatabase();
$db = $database->getConnection();


// instantiate user object
$user = new User($db);


// $data is populated in the class_api_handler


// set product property values
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

    // set response code
    http_response_code(200);

    // generate jwt
    $jwt = $fjwt::encode($token, $cfg->jwt_key);
    echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );

}

// login failed
else{
    
    // set response code
    http_response_code(401);

    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}
?>
