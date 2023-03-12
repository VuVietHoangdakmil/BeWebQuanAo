
<?php
include('conection.php');

//  Thực hiện truy vấn

$sql = "SELECT * FROM khach_hang";
$result = mysqli_query($conn, $sql);


while ($row = mysqli_fetch_assoc($result)) {
    
    $data[] = $row;
}

 $json = json_encode($data);

print_r($json);
?>

