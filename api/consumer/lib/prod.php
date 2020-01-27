<?php
	include "db_conn.php";
	
	class Prod {
		public static function getProdList() {
			$db_conn = new DbConn();
			$sql = "SELECT * FROM tb_prod;";
			$result = $db_conn->query($sql);
			$prod_list = [];
			while($row = $result->fetch_assoc()) {
				array_push($prod_list, $row);
			}
			return $prod_list;
		}
		
		public static function getProd($id) {
			$db_conn = new DbConn();
			$sql = "SELECT * FROM tb_prod where id = '{$id}';";
			$result = $db_conn->query($sql);
			if($result->num_rows > 0) {
				return $result->fetch_assoc();
			}
			else {
				return null;
			}
		}
	}

?>
