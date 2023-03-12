<?php
    $method = $_SERVER['REQUEST_METHOD'];

    include("../conection.php");
    
    if ($method === 'GET'){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM kich_thuoc WHERE MA_SP = '$id'";
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
        }
    }
?>