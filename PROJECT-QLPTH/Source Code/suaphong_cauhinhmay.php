<?php
require "connect.php";

// Kiểm tra xem id của phòng đã được truyền qua GET không
if(isset($_GET["id"])) {
    $MaPhong = $_GET["id"];

    // Lấy thông tin phòng từ cơ sở dữ liệu
    $sql = "SELECT * FROM PhongThucHanh_CauHinhMayTinh WHERE MaPhong = '$MaPhong'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    // Kiểm tra xem form đã được gửi chưa
    if(isset($_POST["sua"])) {
        // Lấy dữ liệu từ form
        $TenPhong = $_POST["TenPhong"];
        $SoLuongMay = $_POST["SoLuongMay"];
        $CPU = $_POST["CPU"];
        $RAM = $_POST["RAM"];
        $BoNho = $_POST["BoNho"];
        $OS = $_POST["OS"];
        $ThongTin = $_POST["ThongTin"];

        // Cập nhật thông tin trong cơ sở dữ liệu
        $update_sql = "UPDATE PhongThucHanh_CauHinhMayTinh SET TenPhong = '$TenPhong', SoLuongMay = '$SoLuongMay', CPU = '$CPU', RAM = '$RAM', BoNho = '$BoNho', OS = '$OS', ThongTin = '$ThongTin' WHERE MaPhong = '$MaPhong'";
        $update_result = mysqli_query($connect, $update_sql);

        if($update_result) {
            echo "Cập nhật thông tin thành công.";
            header("Location: phong_cauhinhmay.php"); // Chuyển hướng về trang danh sách sau khi cập nhật thành công
        } else {
            /*// Display validation errors
            foreach ($errors as $error) {
                echo $error . "<br>";
            }*/
            echo '<script>alert("Vui lòng nhập đầy đủ thông tin!")</script>'  . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin phòng</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>SỬA THÔNG TIN PHÒNG THỰC HÀNH</h2>
    <ul>
        <li><a class="active" href="suaphong_cauhinhmay.php">Sửa thông tin phòng thực hành</a></li>
        <li><a href="phong_cauhinhmay.php">Quay lại</a></li>
    </ul>
    <form id="form" method="POST">
        <label>Tên Phòng:</label><br>
        <input type="text" name="TenPhong" value="<?php echo $row['TenPhong']; ?>"><br>

        <label>Số Lượng Máy:</label><br>
        <input type="text" name="SoLuongMay" value="<?php echo $row['SoLuongMay']; ?>"><br>

        <label>CPU:</label><br>
        <input type="text" name="CPU" value="<?php echo $row['CPU']; ?>"><br>

        <label>RAM:</label><br>
        <input type="text" name="RAM" value="<?php echo $row['RAM']; ?>"><br>

        <label>Bộ Nhớ:</label><br>
        <input type="text" name="BoNho" value="<?php echo $row['BoNho']; ?>"><br>

        <label>OS:</label><br>
        <input type="text" name="OS" value="<?php echo $row['OS']; ?>"><br>

        <label>Thông Tin:</label><br>
        <input type="text" name="ThongTin" value="<?php echo $row['ThongTin']; ?>"><br><br>

        <input type="submit" name="sua" value="Lưu thay đổi"><BR>

    </form>
</body>
</html>
