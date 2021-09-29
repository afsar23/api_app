<?php

namespace Afsar\lib;
use \PDO;

// used to get mysql database connection
class Database {

	// ***************  Consider standalone versus wp plugin
	//global $wpdb;
		
	//phpinfo();
	//die;

	// specify your own database credentials
	private $DB_host = "localhost";				//DB_HOST;
	private $DB_name = "sample_db";				//DB_NAME;
	private $DB_user = "root";					//DB_USER;
	private $DB_pass = "";						//DB_PASSWORD;
	
	private $DB_port = 3306;
	private $DB_port_ini;

	private $conn;

	// I think this is only needed 
	//$DB_port_ini 	= parse_ini_file(php_ini_loaded_file ( ))["mysqli.default_port"];		// add the port from the host information
	//$DB_port 		= ($Db_port_ini != "") ? $DB_port_ini : $DB_port;
	
	// get the database connection
	public function getConnection(){

		$this->conn = null;		
	
		try {

			$this->conn = new PDO('mysql:host=' . $this->DB_host . ';port=' . $this->DB_port . '; dbname=' . $this->DB_name, $this->DB_user, $this->DB_pass);  
			
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->conn->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8  

		}
		catch (PDOException $err) {  
			echo "Unable to connect to database<br/>";
			echo $err->getMessage() . "<br/>";
		}
				
		return $this->conn;
	}

}
?>
