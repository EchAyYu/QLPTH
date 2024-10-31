<?php
require "connect.php";

// Kiểm tra xem ID của học phần cần sửa đã được truyền qua URL hay không
if(isset($_GET["id"])){
    $MaHocPhan = $_GET["id"];

    // Lấy thông tin của học phần từ cơ sở dữ liệu
    $sql = "SELECT * FROM hp_pm WHERE MaHocPhan = '$MaHocPhan'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    // Xử lý khi form được gửi đi
    if(isset($_POST["sua"])){
        $TenHocPhan = $_POST["TenHocPhan"];
        $MaPhanMem = $_POST["MaPhanMem"];
        $TenPhanMem = $_POST["TenPhanMem"];

        // Cập nhật thông tin học phần vào cơ sở dữ liệu
        $sql_update = "UPDATE hp_pm 
               SET TenHocPhan = '$TenHocPhan', 
                   MaPhanMem = '$MaPhanMem', 
                   TenPhanMem = '$TenPhanMem' 
               WHERE MaHocPhan = '$MaHocPhan'";

        $qr = mysqli_query($connect, $sql_update);
        if($qr){
            header("location: hp_pm.php");
        } else {
            echo "Lỗi khi cập nhật thông tin học phần: " . mysqli_error($connect);
        }
    }
} else {
    echo '<script>alert("ID của học phần không được cung cấp.")</script>'  . "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Học Phần</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>SỬA HỌC PHẦN CÙNG VỚI PHẦN MỀM</h2>
    <ul>
        <li><a class="active" href="">Sủa học phần cùng với phần mềm</a></li>
        <li><a href="hp_pm.php">Quay lại</a></li>
    </ul>
<form id="form" method="POST" action="">
    <label>Mã Học Phần:</label><br>
    <input type="text" name="MaHocPhan" value="<?php echo $row['MaHocPhan']; ?>" readonly><br>
    <label>Mã Phần Mềm:</label><br>
    <input type="text" name="MaPhanMem" value="<?php echo $row['MaPhanMem']; ?>"><br>
    <label>Tên Học Phần:</label><br>
    <input type="text" name="TenHocPhan" value="<?php echo $row['TenHocPhan']; ?>"><br>
    <input type="hidden" name="TenPhanMem" value="<?php echo $row['TenPhanMem']; ?>">
    <label>Tên Phần Mềm:</label><br>
    <input type="text" name="TenPhanMem" value="<?php echo $row['TenPhanMem']; ?>"><br>
    <input type="submit" name="sua" value="Sửa">
</form>

</body>
</html>
