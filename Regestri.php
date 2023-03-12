<?php
include("conection.php");
// $POST = json_decode(file_get_contents("php://input"),true);

$Name = $_POST['Name'];
$SDT = $_POST['SDT'];
$MatKhau = $_POST['password'];
$TEN_DN = $SDT;
$AVTAR_DEFAULT = "avtar.png";

$querycheck = "SELECT * FROM `khach_hang` WHERE `TEN_DN` = '".$SDT."' ";
$datacheck  = mysqli_query($conn, $querycheck );
$numrowcheck = mysqli_num_rows($datacheck);

if($numrowcheck > 0){
    $arr = [
        'success' => false,
        'message' =>"Tai khoan đa co nguoi đang ky",
    ];
}
else{
    $query = "INSERT INTO `khach_hang`(`TEN_KH`, `SDT`,`TEN_DN`, `MK_DN`,`HINH_DAI_DIEN` ) 
    VALUES ('".$Name."','".$SDT."','".$TEN_DN."','".$MatKhau."','".$AVTAR_DEFAULT."')";
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


?>