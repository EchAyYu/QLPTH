<?php
require "connect.php";

if(isset($_POST["them"])){
    $MaPhanMem = $_POST["MaPhanMem"];
    $TenPhanMem = $_POST["TenPhanMem"];
    
    // Kiểm tra dữ liệu nhập vào
    $errors = array();

    if(empty($MaPhanMem)){ $errors[] = "Vui lòng nhập mã phần mềm!"; }
    if(empty($TenPhanMem)){ $errors[] = "Vui lòng nhập tên phần mềm!"; }

    // Nếu không có lỗi, thêm vào cơ sở dữ liệu
    if(empty($errors)){
        $sql = "INSERT INTO PhanMem( MaPhanMem, TenPhanMem) 
                VALUES('$MaPhanMem', '$TenPhanMem')";
        $qr = mysqli_query($connect, $sql);
        if($qr){
            header("location: phanmem.php");
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
    <title>Thêm Phần Mềm</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>THÊM PHẦN MỀM</h2>
    <ul>
        <li><a class="active" href="themphanmem.php">Thêm phần mềm</a></li>
        <li><a href="phanmem.php">Quay lại</a></li>
    </ul>
    <form id="form" method="POST" action="">
        <label>Mã Phần Mềm:</label><br>
        <input type="text" name="MaPhanMem"><br>
        <label>Tên Phần Mềm:</label><br>
        <input type="text" name="TenPhanMem"><br>
        <input id="add" type="submit" name="them" value="Thêm">
    </form>

</body>
</html>
