<?php
    $method = $_SERVER['REQUEST_METHOD'];
    include("../conection.php");
    
    if ($method === 'GET'){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM khach_hang WHERE MA_KH = '$id'";
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
        }
        else{
            $query = "SELECT * FROM san_pham ORDER BY `MA_SP` DESC ";
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

    if ($method === 'PUT'){
         parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_GET['id'];
        $name= $_PUT['name'];
        $sdt = $_PUT['sdt'];
        $email = $_PUT['email'];

        $query = "UPDATE khach_hang SET TEN_KH = '$name', SDT = '$sdt', EMAIL = '$email' WHERE MA_KH = $id";
        
        $data = mysqli_query($conn, $query);
        
        $result = array('name' => $name, 'sdt' => $sdt, 'email' => $email);

        if($data == true){
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
                
                );
        }
    header('Content-Type: application/json');
        $json = json_encode($arr);
        print_r($json);
        

    }
   
?>