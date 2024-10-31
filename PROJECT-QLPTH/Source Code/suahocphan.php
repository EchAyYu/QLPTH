<?php
require "connect.php";

// Xử lý khi nhấn nút Sửa
if(isset($_POST["sua"])){
    // Bước gỡ lỗi 1: Kiểm tra dữ liệu biểu mẫu
    var_dump($_POST); // Thao tác này sẽ hiển thị dữ liệu biểu mẫu đã gửi

    $MaHocPhan = $_POST["MaHocPhan"];
    $TenHocPhan = $_POST["TenHocPhan"];

    // Kiểm tra dữ liệu nhập vào
    $errors = array();
    if(empty($TenHocPhan)){ 
        $errors[] = "Vui lòng nhập tên phần mềm!";
    }

    // Nếu không có lỗi, thực hiện cập nhật dữ liệu vào cơ sở dữ liệu
    if(empty($errors)){
        // Bước gỡ lỗi 2: Kiểm tra truy vấn SQL
        $sql = "UPDATE HocPhan SET TenHocPhan = '$TenHocPhan' WHERE MaHocPhan = '$MaHocPhan'";
        echo $sql; // Điều này sẽ hiển thị truy vấn SQL được xây dựng
        $result = mysqli_query($connect, $sql);

        if($result){
            // Chuyển hướng về trang danh sách phần mềm sau khi sửa thành công
            header("Location: hocphan.php");
            exit(); // Ngăn chặn mã HTML dưới đây được thực thi sau khi chuyển hướng
        } else {
            echo "Lỗi khi cập nhật dữ liệu: " . mysqli_error($connect);
        }
    } else {
        // In ra các thông báo lỗi
        foreach($errors as $error){
            echo $error . "<br>";
        }
    }
}

// Lấy thông tin phần mềm cần sửa từ cơ sở dữ liệu
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT * FROM HocPhan WHERE MaHocPhan = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
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
    <h2>SỬA HỌC PHẦN</h2>
    <ul>
        <li><a class="active" href="suahocphan.php">Sửa học phần</a></li>
        <li><a href="hocphan.php">Quay lại</a></li>
    </ul>
    <form id="form" method="POST">
        <label>Mã học phần:</label><br>
        <input type="text" name="MaHocPhan" value="<?php echo $row['MaHocPhan']; ?>"><br>
        <label>Tên học phần:</label><br>
        <input type="text" name="TenHocPhan" value="<?php echo $row['TenHocPhan']; ?>"><br>
        <input type="submit" name="sua" value="Sửa">
    </form>
</body>
</html>
