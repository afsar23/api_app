<?php

namespace Afsar\lib;

// used to get mysql database connection
class Config {

    public $home_url;
    
    public $jwt_key;
    public $jwt_issued_at;
    public $jwt_expiration_time;
    public $jwt_issuer;

	// constructor
    public function __construct() {
		
		$this->home_url = "http://localhost/fvc_standalone/"; 

        // variables used for jwt
        $this_jwt_key = "example_key";
        $this_jwt_issued_at = time();
        $this_jwt_expiration_time = $this_jwt_issued_at + (60 * 60); // valid for 1 hour
        $this_jwt_issuer = $this->home_url;

	}
   
}

?>

