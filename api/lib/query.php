<?php
class Query {
    public static function getSqlResultList($sql) {
        $config = Config::getJsonConfig();
        $db_config = $config["database"];
        $servername = $db_config["host"];
        $username = $db_config["user"];
        $password = $db_config["password"];
        $db_name = $db_config["db_name"];
        $conn = new mysqli($servername, $username, $password, $db_name);
        $result = $conn->query($sql);
        $record_list = [];
        while($row = $result->fetch_assoc()) {
            array_push($record_list, $row);
        }
        return $record_list;
    }
    
    public static function getTbRecord($tb_name, $id) {
        $sql = "SELECT * FROM {$tb_name} where `id`={$id};";
        $record_list = Query::getSqlResultList($sql);
        if(count($record_list)>0) {
            return $record_list[0];
        }
        else {
            return null;
        }
    }
    
    public static function getTbRecordList($tb_name, $search_condition_list) {
        /*
         $search_condition_list = array(
              "where_field_list"=>array(
                  array(
                      "field_name"=>String,
                      "value_list"=>array(String, String, ...)
                  )
              )
         )
         */
        if(count($search_condition_list["where_field_list"])>0) {
            $where_sql_list = [];
            $where_field_list = $search_condition_list["where_field_list"];
            for($i=0; $i<count($where_field_list); $i++) {
                $where_field_name = $where_field_list[$i]["field_name"];
                $where_value_list = implode(", ", $where_field_list[$i]["value_list"]);
                $where_sql_list[] = $where_field_name." in (".$where_value_list.")";
            }
            $where_sql = "where ".implode(" and ", $where_sql_list);
        }
        else {
            $where_sql = "";
        }
        
        $sql = "SELECT * FROM {$tb_name} {$where_sql};";

        return Query::getSqlResultList($sql);
    }
}