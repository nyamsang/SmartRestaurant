<?php
include "../lib/inc_pack.php";

$config = Config::getJsonConfig();
$sys_name = $config["system_name"];

echo Json::getJsonResponse(true, null, $sys_name);
