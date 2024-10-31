<?php
require "connect.php";

if(isset($_POST["them"])){
    $MaPhong = $_POST["MaPhong"];
    $SoLuongMay = $_POST["SoLuongMay"];
    $TenPhong = $_POST["TenPhong"];
    $CPU = $_POST["CPU"];
    $RAM = $_POST["RAM"];
    $BoNho = $_POST["BoNho"];
    $OS = $_POST["OS"];
    $ThongTin = $_POST["ThongTin"];

    // Kiểm tra dữ liệu nhập vào
    $errors = array();

    if(empty($MaPhong)){ $errors[] = "Vui lòng nhập mã phòng!"; }
    if(empty($TenPhong)){ $errors[] = "Vui lòng nhập tên phòng!"; }
    if(empty($SoLuongMay)){ $errors[] = "Vui lòng nhập số lượng máy!"; }
    if(empty($CPU)){ $errors[] = "Vui lòng nhập CPU của máy!"; }
    if(empty($RAM)){ $errors[] = "Vui lòng nhập RAM của máy!"; }
    if(empty($BoNho)){ $errors[] = "Vui lòng nhập bộ nhớ máy!"; }
    if(empty($OS)){ $errors[] = "Vui lòng nhập OS của máy!"; }


    // Nếu không có lỗi, thêm vào cơ sở dữ liệu
    if(empty($errors)){
        $sql = "INSERT INTO PhongThucHanh_CauHinhMayTinh(MaPhong, TenPhong, SoLuongMay, CPU, RAM, BoNho, OS, ThongTin) 
                VALUES('$MaPhong', '$TenPhong', '$SoLuongMay', '$CPU', '$RAM', '$BoNho', '$OS', '$ThongTin')";
        $qr = mysqli_query($connect, $sql);
        if($qr){
            header("location: phong_cauhinhmay.php");
        } else {
            echo "Lỗi khi thêm vào cơ sở dữ liệu: " . mysqli_error($connect);
        }
    } else {
        /*// Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }*/
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin!")</script>'  . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phòng Thực Hành</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>THÊM PHÒNG THỰC HÀNH</h2>
    <ul>
        <li><a class="active" href="themphong_cauhinhmay.php">Thêm phòng thực hành</a></li>
        <li><a href="phong_cauhinhmay.php">Quay lại</a></li>
    </ul>
    <form id="form" method="POST" action="">
        <label>Mã Phòng:</label><br>
        <input type="text" name="MaPhong"><br>
        <label>Tên Phòng:</label><br>
        <input type="text" name="TenPhong"><br>
        <label>Số lượng máy:</label><br>
        <input type="text" name="SoLuongMay"><br>
        <label>CPU:</label><br>
        <input type="text" name="CPU"><br>
        <label>RAM:</label><br>
        <input type="text" name="RAM"><br>
        <label>Bộ nhớ:</label><br>
        <input type="text" name="BoNho"><br>
        <label>OS:</label><br>
        <input type="text" name="OS"><br>
        <label>Thông tin:</label><br>
        <input type="text" name="ThongTin"><br>
        <input id="add" type="submit" name="them" value="Thêm">
    </form>

</body>
</html>