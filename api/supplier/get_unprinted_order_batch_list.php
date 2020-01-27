<?php
include "../lib/inc_pack.php";
$is_success = true;
$message = null;

if(!isset($_GET["branch_id"])||!isset($_GET["is_printed"])) {
    $is_success = false;
    $message = "Invalid Input";
    echo Json::getJsonResponse($is_success, $message, null);
    exit();
}

$branch_id = $_GET["branch_id"];
$is_printed = $_GET["is_printed"];

switch($is_printed) {
    case "printed":
        $is_print_value_list = array("true");
    break;
    case "unprinted":
        $is_print_value_list = array("false");
    break;
    case "both":
        $is_print_value_list = array("true", "false");
    break;
    default:
        $is_print_value_list = array("false");
}

/* Get Branch */
$branch = Query::getTbRecord("tb_branch", $branch_id);

/* Get Table List */
$search_condition_list = array(
    "where_field_list"=>array(
        array(
            "field_name"=>"tb_branch_id",
            "value_list"=>array($branch["id"])
        )
    )
);
$table_list = Query::getTbRecordList("tb_table", $search_condition_list);
$order_batch_json_list = [];

/* Get Table Session List */
for($ti=0; $ti<count($table_list); $ti++) {
    $table = $table_list[$ti];
    $search_condition_list = array(
        "where_field_list"=>array(
            array(
                "field_name"=>"tb_table_id",
                "value_list"=>array($table["id"])
            )
        )
    );
    $table_session_list = Query::getTbRecordList("tb_table_session", $search_condition_list);
    
    /* Get UnPrinted Order Batch List */
    for($tsi=0; $tsi<count($table_session_list); $tsi++) {
        $table_session =  $table_session_list[$tsi];
        $search_condition_list = array(
            "where_field_list"=>array(
                array(
                    "field_name"=>"tb_table_session_id",
                    "value_list"=>array($table_session["id"])
                ),
                array(
                    "field_name"=>"is_printed",
                    "value_list"=>$is_print_value_list
                )
            )
        );
        $order_batch_list = Query::getTbRecordList("tb_order_batch", $search_condition_list);
        
        /* Get Table Order Item List */
        for($obi=0; $obi<count($order_batch_list); $obi++) {
            $order_batch = $order_batch_list[$obi];
            $search_condition_list = array(
                "where_field_list"=>array(
                    array(
                        "field_name"=>"tb_order_batch_id",
                        "value_list"=>array($order_batch["id"])
                    )
                )
            );
            $order_item_list = Query::getTbRecordList("tb_order_item", $search_condition_list);
            $order_item_json_list = [];
            for($oii=0; $oii<count($order_item_list); $oii++) {
                $order_item = $order_item_list[$oii];
                $prod_id = $order_item["tb_prod_id"];
                $prod = Query::getTbRecord("tb_prod", $prod_id);
                $order_item_json_list[] = array(
                    "order_item"=>$order_item,
                    "prod"=>$prod
                );
            }
            $order_batch_json_list[] = array(
                "branch"=>$branch,
                "table"=>$table,
                "table_session"=>$table_session,
                "order_batch"=>$order_batch,
                "order_item_json_list"=>$order_item_json_list
            );
        }
    }
}

echo Json::getJsonResponse($is_success, $message, $order_batch_json_list);
