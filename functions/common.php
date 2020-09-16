<?php
function getIPAddress() { 
    $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');  
     return $ip;  
}

function get_custom_objects($conn, $qry){
    return $conn->query($qry);
}
function get_object_by_id($conn, $table_name, $id){
    $qry = "SELECT * FROM $table_name WHERE id = $id";
    return $conn->query($qry)->fetch_assoc();
}

function get_objects($conn, $table_name, $filter_set=array(), $order_by='id', $sorted='ASC'){
    if(!empty($filter_set)){
        $filter = '';
        $index = 0;
        foreach($filter_set as $key=>$value){
            if($index==0){
                if($value == ''){
                    $filter .= "WHERE $key IS NULL";
                }else{
                    $filter .= "WHERE $key = '$value'";
                }
            }else{
                if($value == ''){
                    $filter .= " AND $key IS NULL";
                }else{
                    $filter .= " AND $key = '$value'";                    
                }
            }
            $index = $index + 1;
        }
        $qry = "SELECT * FROM $table_name $filter ORDER BY $order_by $sorted";
    }else{
        $qry = "SELECT * FROM $table_name ORDER BY $order_by $sorted";
    }
    return $conn->query($qry);
}
?>