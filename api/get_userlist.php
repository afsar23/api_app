<?php

require_once "../classes/all_classes.php";

use Afsar\lib\Database;
use Afsar\lib\Api;
use Afsar\lib\User;

use \Firebase\JWT\JWT;

$api = new Api();

// get database connection
$database = new Database();
$db = $database->getConnection();
// instantiate user object
$user = new User($db);

// validate user and access level

$response_data = $user->userList();
$api->Send_Response($response_data);

?>
