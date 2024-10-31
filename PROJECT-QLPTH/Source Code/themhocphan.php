<?php
require "connect.php";

if(isset($_POST["them"])){
   $MaHocPhan = $_POST["MaHocPhan"];
    $TenHocPhan = $_POST["TenHocPhan"];
    
    // Kiểm tra dữ liệu nhập vào
    $errors = array();

    if(empty($MaHocPhan)){ $errors[] = "Vui lòng nhập mã học phần!"; }
    if(empty($TenHocPhan)){ $errors[] = "Vui lòng nhập tên học phần!"; }

    // Nếu không có lỗi, thêm vào cơ sở dữ liệu
    if(empty($errors)){
        $sql = "INSERT INTO HocPhan(MaHocPhan, TenHocPhan) 
                VALUES('$MaHocPhan', '$TenHocPhan')";
        $qr = mysqli_query($connect, $sql);
        if($qr){
            header("location: hocphan.php");
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
    <title>Thêm Học Phần</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>THÊM HỌC PHẦN</h2>
    <ul>
        <li><a class="active" href="hocphan.php">Thêm học phần </a></li>
        <li><a href="hocphan.php">Quay lại</a></li>
    </ul>  
    <form id="form" method="POST" action="">
        <label>Mã học phần:</label><br>
        <input type="text" name="MaHocPhan"><br>
        <label>Tên học phần:</label><br>
        <input type="text" name="TenHocPhan"><br>
        <input type="submit" id="add" name="them" value="Thêm">
    </form>
    
</body>
</html>
