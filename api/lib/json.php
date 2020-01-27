<?php
class Json {
    public static function getJsonResponse($is_success, $messgae, $fn_output) {
        return json_encode(array("is_success"=>$is_success, "messgae"=>$messgae, "fn_output"=>$fn_output));
    }
}
