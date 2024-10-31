<?php
require "connect.php";

if(isset($_POST["them"])){

    $MaHocPhan = $_POST["MaHocPhan"];
    $TenHocPhan = $_POST["TenHocPhan"];
    $MaPhanMem = $_POST["MaPhanMem"];
    $TenPhanMem = $_POST["TenPhanMem"];
    
    // Kiểm tra dữ liệu nhập vào
    $errors = array();

    if(empty($MaHocPhan)){ $errors[] = "Vui lòng nhập mã học phần!"; }
    if(empty($TenHocPhan)){ $errors[] = "Vui lòng nhập tên học phần!"; }
    if(empty($MaPhanMem)){ $errors[] = "Vui lòng nhập mã phần mềm!"; }
    if(empty($TenPhanMem)){ $errors[] = "Vui lòng nhập tên phần mềm!"; }

    // Nếu không có lỗi, thêm vào cơ sở dữ liệu
    if(empty($errors)){
        $sql = "INSERT INTO hp_pm( MaHocPhan, TenHocPhan, MaPhanMem, TenPhanMem) 
                VALUES('$MaHocPhan', '$TenHocPhan', '$MaPhanMem', '$TenPhanMem')";
        $qr = mysqli_query($connect, $sql);
        if($qr){
            header("location: hp_pm.php");
            exit;
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
    <title>THÊM HP_PM</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>THÊM HỌC PHẦN HỌC VỚI PHẦN MỀM</h2>
    <ul>
        <li><a class="active" href="themhp_pm.php">Thêm học phần với phần mềm</a></li>
        <li><a href="hp_pm.php">Quay lại</a></li>
    </ul>
    <form id="form" method="POST" action="">
        <label>Mã Học Phần:</label><br>
        <input type="text" name="MaHocPhan"><br>
        <label>Tên Học Phần:</label><br>
        <input type="text" name="TenHocPhan"><br>
        <label>Mã Phần Mềm:</label><br>
        <input type="text" name="MaPhanMem"><br>
        <label>Tên Phần Mềm:</label><br>
        <input type="text" name="TenPhanMem"><br>
        <input id="add" type="submit" name="them" value="Thêm">
    </form>

</body>
</html>
