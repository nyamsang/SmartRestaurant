<?php
	class Config {
		public static function getJsonConfig() {
			$str_config = file_get_contents("config.json");
			$json_config = json_decode($str_config, true);
			return $json_config;
		}
		
	}

?>
