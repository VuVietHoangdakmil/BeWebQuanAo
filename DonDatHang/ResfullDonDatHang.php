<?php
    $method = $_SERVER['REQUEST_METHOD'];
    include("../conection.php");
    
    if ($method === 'GET'){

        if(isset($_GET['idKH'])){
            $idKH = $_GET['idKH'];
            $TTDH = $_GET['ttdh'];
            $query = "SELECT * FROM don_dat_hang WHERE MA_KH = '$idKH' and TINH_TRANG_HUY_DON = $TTDH";
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
    if ($method === 'PATCH'){
         parse_str(file_get_contents("php://input"), $_PATCH);
         $idDH = $_GET['idDH'];
          $idKH = $_GET['idKH'];
          $TTDH = $_GET['ttDH'];
         $TrangThaiHuy = $_PATCH['trangThaiHuy'];
        
        $queryUPDATE = "UPDATE `don_dat_hang` SET `TINH_TRANG_HUY_DON` = '$TrangThaiHuy' WHERE `don_dat_hang`.`MA_DH` = $idDH";
        $data  = mysqli_query($conn, $queryUPDATE);
        $query = "SELECT * FROM don_dat_hang WHERE MA_KH = '$idKH' and TINH_TRANG_HUY_DON = $TTDH";
            $data  = mysqli_query($conn, $query);
            $result = array();
            while ($row = mysqli_fetch_assoc($data)) {
                $result[] = $row;
            }

        if($data==true){

            
            $arr = array(
                    'success' => true,
                    'message' =>" thanh cong",
                    'result' => $result
                );
        }else{
             $arr = array(
                    'success' => false,
                    'message' =>"khong thanh cong",
                    'result' => $result
                );
        }

         $json = json_encode($arr);
            print_r($json);

    }
   
   
?>