<?php
// Load thư viện PHPMailer
// dùng lệnh này để clinet nhận đc http từ server
header('Access-Control-Allow-Origin: http://localhost:3005');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type");
date_default_timezone_set('Asia/Ho_Chi_Minh');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$EmailNguoiNhan = $_POST['EmailNguoiNhan'];
$NameNguoiNhan = $_POST['NameNguoiNhan'];
$TongTien = $_POST['TongTien'];
$SDT = $_POST['SDT'];
$Diachi = $_POST['Diachi'];
$ngayDat =  date('Y-m-d H:i:s');
// Cấu hình
function sendMail($EmailNguoiNhan,$NameNguoiNhan,$TongTien,$SDT,$Diachi, $ngayDat){
    $mail = new PHPMailer(true);
    // Cấu hình charset và encoding
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    //
    $mail->isSMTP(); // Sử dụng SMTP
    $mail->Host = 'smtp.gmail.com'; // SMTP server
    $mail->SMTPAuth = true; // Bật SMTP authentication
    $mail->Username = 'vuviethoangdakmil@gmail.com'; // Tên đăng nhập SMTP
    $mail->Password = 'kvcdhbiibztdfmhl'; // Mật khẩu đăng nhập SMTP
    $mail->SMTPSecure = 'tls'; // Giao thức bảo mật SMTP
    $mail->Port = 587; // Cổng SMTP

    // Thiết lập người gửi và thông tin email
    $mail->setFrom('vuviethoangdakmil@gmail.com', 'SHOP HOANG');
    $mail->addAddress($EmailNguoiNhan,$NameNguoiNhan);
    $mail->addReplyTo('vuviethoangdakmil@gmail.com', 'Vũ Viết Hoàng');

    // Thiết lập tiêu đề và nội dung email
    $mail->Subject = 'Đặt Hàng Thành công';
    $mail->Body = '<div><b>Số Điện Thoại:</b> '.$SDT.' </div>
                       <div><b>Địa chỉ:</b> '.$Diachi.'</div>
                        <div><b>Thời Gian Đặt:</b> '.$ngayDat.'</div>
                       <div><b>Tổng Tiền:</b> '.$TongTien.'</div>
                        <div>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi</div>
                       ';
    $mail->AltBody = 'Body in plain text';

    // Gửi email
    if ($mail->send()) {
        $arr = array(
                    'success' => true,
                    'message' =>"thanh cong",
                );
    } else {
        echo 'Error sending email: ' . $mail->ErrorInfo;
         $arr = array(
                    'success' => false,
                    'message' => $mail->ErrorInfo,
                );
    }
      $json = json_encode($arr);
            print_r($json);
}
sendMail($EmailNguoiNhan,$NameNguoiNhan,$TongTien,$SDT,$Diachi, $ngayDat)
?>