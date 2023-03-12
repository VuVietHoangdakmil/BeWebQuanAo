<?php
include("../conection.php");


$DataGioHang=json_decode($_POST['DataGioHang'],true);

$Makh = $_POST['Makh'];
$TongTien = $_POST['TongTien'];
$SDT = $_POST['SDT'];
$Email = $_POST['Email'];
$Diachi = mysqli_real_escape_string($conn, $_POST['Diachi']);//format chuoi co nhung ky tu dac bietj
$current_datetime = date('Y-m-d H:i:s');

$queryAddDon = "INSERT INTO don_dat_hang(MA_KH, TONG_TIEN, DIA_CHI_NHAN_HANG, SDT_NHAN_HANG , EMAIL_NHAN_HANG, THOI_GIAN_DAT) 
VALUES ('$Makh', '$TongTien', '$Diachi', '$SDT', '$Email', '$current_datetime' )";
$dataDonHang  = mysqli_query($conn, $queryAddDon);

if($dataDonHang == true){

    $queryLastRow = "SELECT * FROM don_dat_hang ORDER BY MA_DH DESC LIMIT 1";
    $dataLastRow =  mysqli_query($conn, $queryLastRow);
    $InfoRowLast = array();
    $InfoRowLast = mysqli_fetch_assoc($dataLastRow);

    if($dataLastRow == true){
        foreach ($DataGioHang as $item) {
           $queryAddCTDon = 
           "INSERT INTO ct_dh (MA_DH, MA_SP, SL , DON_GIA ,TONG_TIEN, MA_SIZE ) 
           VALUES ('$InfoRowLast[MA_DH]' , '$item[MA_SP]' , '$item[SL]', '$item[GIA_BAN]', '$item[Price]' ,'$item[MA_SIZE]')";
           mysqli_query($conn, $queryAddCTDon);
        }
        $arr = [
            'success' => true,
            'message' =>"Thanh cong",
        ];
    }

}
else{
 $arr = [
            'success' => false,
            'message' =>"khong thanh cong",
        ];
}
print_r(json_encode($arr));
?>