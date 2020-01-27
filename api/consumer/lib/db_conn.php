<?php
	include "config.php";
	
	class DbConn {
		private $conn;
		
		public function __construct() {
			$config = Config::getJsonConfig();
			$db_config = $config["database"];
			
			$servername = $db_config["host"];
			$username = $db_config["user"];
			$password = $db_config["password"];
			$db_name = $db_config["db_name"];

			$this->conn = new mysqli($servername, $username, $password, $db_name);
		}
		
		public function query($sql) {
			return $this->conn->query($sql);
		}
		
		public function __destruct() {
			$this->conn->close();
		}
	}

?>
