<?php
require "connect.php";

if(isset($_POST["them"])){
    $STT = $_POST["STT"];
    $MaGiangVien = $_POST["MaGiangVien"];
    $TenGiangVien = $_POST["TenGiangVien"];
    
    // Kiểm tra dữ liệu nhập vào
    $errors = array();

    if(empty($STT)){ $errors[] = "Vui lòng nhập lại số thứ tự"; }
    if(empty($MaGiangVien)){ $errors[] = "Vui lòng nhập mã giảng viên!"; }
    if(empty($TenGiangVien)){ $errors[] = "Vui lòng nhập tên giảng viên!"; }

    // Nếu không có lỗi, thêm vào cơ sở dữ liệu
    if(empty($errors)){
        $sql = "INSERT INTO GiangVien(STT, MaGiangVien, TenGiangVien) 
                VALUES('$STT','$MaGiangVien', '$TenGiangVien')";
        $qr = mysqli_query($connect, $sql);
        if($qr){
            header("location: hocky_giaovien.php");
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
    <title>Thêm Giảng Viên</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>THÊM GIẢNG VIÊN</h2>
    <ul>
        <li><a class="active" href="themgiangvien.php">Thêm giảng viên</a></li>
        <li><a href="hocky_giaovien.php">Quay lại</a></li>
    </ul>  
    <form id="form" method="POST" action="">
        <label>STT:</label><br>
        <input type="text" name="STT"><br>
        <label>Mã Giảng Viên:</label><br>
        <input type="text" name="MaGiangVien"><br>
        <label>Tên Giảng Viên:</label><br>
        <input type="text" name="TenGiangVien"><br>
        <input type="submit" id="add" name="them" value="Thêm">
    </form>
    
</body>
</html>
