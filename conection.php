
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// dùng lệnh này để clinet nhận đc http từ server
header('Access-Control-Allow-Origin: http://localhost:3005');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost";
$user = "root";
$pass= "";
$database="webbanquanao";

$conn = mysqli_connect($host,$user,$pass,$database);
mysqli_set_charset($conn,'utf8');
// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}


?>