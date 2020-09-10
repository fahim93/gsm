<?php
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
// function get_objects($conn, $table_name, $filter_set=array(), $order_by='id', $sorted='ASC', $limit_offset=18446744073709551615){
//     if(!empty($filter_set)){
//         $filter = '';
//         $index = 0;
//         foreach($filter_set as $key=>$value){
//             if($index==0){
//                 $filter .= "WHERE $key = '$value'";
//             }else{
//                 $filter .= " AND $key = '$value'";
//             }
//             $index = $index + 1;
//         }
//         $qry = "SELECT * FROM $table_name $filter ORDER BY $order_by $sorted LIMIT 0, $limit_offset";
//     }else{
//         $qry = "SELECT * FROM $table_name ORDER BY $order_by $sorted LIMIT 0, $limit_offset";
//     }
//     echo $qry;
//     // return $conn->query($qry);
//     // return $qry;
// }

function get_custom_objects($conn, $qry){
    return $conn->query($qry);
}
// include('../conf/dbConfig.php');
// get_objects($conn=$conn, $table_name='files');

?>