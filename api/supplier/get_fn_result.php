<?php
include "../lib/inc_pack.php";

$class_name = $_GET["class_name"];
$fn_name = $_GET["fn_name"];
$params = $_GET["params"];

switch(count($params)) {
    case 0: 
        $result = $class_name::$fn_name();
        break;
    case 1: 
        $result = $class_name::$fn_name($params[0]);
        break;
    case 2:
        $result = $class_name::$fn_name($params[0], $params[1]);
        break;
    case 3:
        $result = $class_name::$fn_name($params[0], $params[1], $params[2]);
        break;
    default:
        $result = null;
}

echo Json::getJsonResponse(true, null, $result);
