<?php
    include("../conection.php");
   
    $query = "SELECT * FROM san_pham ORDER BY MA_SP DESC LIMIT 8 ";
    $data  = mysqli_query($conn, $query);
    $result = array();
    
    while ($row = mysqli_fetch_assoc($data)) {
        $result[] = $row;
    }
   
    if(!empty($result)){
        $arr = array(
            'success' => true,
            'message' =>"thanh cong",
            'result'  => $result
        );
    }
    else{
        $arr = array(
            'success' => false,
            'message' =>"khong thanh cong",
            'result' => $result
        );
    }
    
    $json = json_encode($arr);
    print_r($json);
?>