<?php

    include("conection.php");

    $POST = json_decode(file_get_contents("php://input"),true);
    // $SDT = $_POST['SDT'];
    // $password = $_POST['password'];
    $SDT = $POST['SDT'];
    $password = $POST['password'];
   
    $query = "SELECT * FROM `khach_hang` WHERE `TEN_DN` = '".$SDT."' AND `MK_DN` = '".$password."'";
    $data  = mysqli_query($conn, $query);
    $result = array();
    $result = mysqli_fetch_assoc($data);

   
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