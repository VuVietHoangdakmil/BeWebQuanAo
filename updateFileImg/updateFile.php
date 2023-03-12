<?php
include('../conection.php');

$id = $_POST['id'];
$nameImg = $_FILES["fileToUpload"]["name"];
$target_dir = "E:/all_project_react/ui_ban_quan_ao/public/img/AvatarDefault/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$arr = array();
// Kiểm tra xem tệp đã tồn tại hay chưa
if (file_exists($target_file)) {

    $query = "UPDATE khach_hang SET HINH_DAI_DIEN = '$nameImg' WHERE MA_KH = $id";
        $data  = mysqli_query($conn, $query);
         if($data == true){
            $arr= [
            'success' => true,
            'message' =>"cập nhật hình ảnh thành công",
            ];
        }else{
             $arr= [
            'success' => false,
            'message' =>"cập nhật hình ảnh không thành công",
            ];
        }
    $uploadOk = 3;
}

// Kiểm tra kích thước tệp tin
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     $arr= [
//         'success' => false,
//         'message' =>"kich thuoc qu alon",
//     ];
//     $uploadOk = 0;
// }

// Kiểm tra loại tệp tin
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $arr= [
        'success' => false,
        'message' =>"không đúng định dạng hình ảnh",
    ];
    $uploadOk = 0;
}

// Kiểm tra nếu có lỗi xảy ra
if ($uploadOk != 0) {
    if($uploadOk !=3){
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $query = "UPDATE khach_hang SET HINH_DAI_DIEN = '$nameImg' WHERE MA_KH = $id";
            $data  = mysqli_query($conn, $query);
            if($data == true){
                $arr= [
                'success' => true,
                'message' =>"cập nhật hình ảnh thành công",
                ];
            }else{
                $arr= [
                'success' => false,
                'message' =>"cập nhật hình ảnh không thành công",
                ];
            }
        } else {
            $arr= [
            'success' => false,
            'message' =>"Rất tiếc, đã xảy ra lỗi khi tải lên tệp của bạn.",
            ];
        }
    }

} 
$json = json_encode($arr);
print_r($json);
?>
