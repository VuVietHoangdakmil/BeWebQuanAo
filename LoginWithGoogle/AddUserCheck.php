<?php
    $method = $_SERVER['REQUEST_METHOD'];
    include("../conection.php");
    if($method === "POST"){
        $Name = $_POST['Name'];
        $MatKhau = $_POST['password'];
        $TEN_DN = $_POST['email'];
        $Email = $_POST['email'];
        $AVTAR_DEFAULT = $_POST['AVTAR_DEFAULT'];

        $querycheck = "SELECT * FROM `khach_hang` WHERE `TEN_DN` = '".$TEN_DN."' ";
        $datacheck  = mysqli_query($conn, $querycheck );
        $numrowcheck = mysqli_num_rows($datacheck);

        if($numrowcheck > 0){
            $arr = [
                'success' => false,
                'message' =>"Tai khoan đa co nguoi đang ky",
            ];
        }
        else{
            $query = "INSERT INTO `khach_hang`(`TEN_KH`,`TEN_DN`, `MK_DN`,`HINH_DAI_DIEN`,`EMAIL` ) 
            VALUES ('".$Name."','".$TEN_DN."','".$MatKhau."','".$AVTAR_DEFAULT."','".$Email."')";
            $data  = mysqli_query($conn, $query);
            
            if($data == true){
                
                $queryLastRow = "SELECT * FROM khach_hang ORDER BY MA_KH DESC LIMIT 1";
                $dataLastRow =  mysqli_query($conn, $queryLastRow);
                $InfoRow = array();
                $InfoRow = mysqli_fetch_assoc($dataLastRow);

                $queryAdd = "INSERT INTO thong_tin_thanh_toan ( MA_KH, SDT_NHAN_HANG, TEN_KH) 
                VALUES ( '$InfoRow[MA_KH]', '$InfoRow[SDT]', '$InfoRow[TEN_KH]')";
                mysqli_query($conn,  $queryAdd);

            $arr = [
                    'success' => true,
                    'message' =>"thanh cong",
                    
                ];
            }
            else{
                $arr = [
                    'success' => false,
                    'message' =>"khong thanh cong",
                ];
            }


        }

        print_r(json_encode($arr));

    }

   

?>