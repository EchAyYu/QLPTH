<?php
require "connect.php";

// Xử lý khi nhấn nút Sửa
if(isset($_POST["sua"])){
    // Debugging step 1: Check form data
    var_dump($_POST); // This will show the submitted form data

    $STT = $_POST["STT"];
    $MaGiangVien = $_POST["MaGiangVien"];
    $TenGiangVien = $_POST["TenGiangVien"];

    // Kiểm tra dữ liệu nhập vào
    $errors = array();
    if(empty($TenGiangVien)){ 
        $errors[] = "Vui lòng nhập tên giảng viên!";
    }

    // Nếu không có lỗi, thực hiện cập nhật dữ liệu vào cơ sở dữ liệu
    if(empty($errors)){
        // Debugging step 2: Check SQL query
        $sql = "UPDATE GiangVien SET TenGiangVien = '$TenGiangVien', MaGiangVien = '$MaGiangVien' WHERE STT = $STT";
        echo $sql; // This will display the constructed SQL query
        $result = mysqli_query($connect, $sql);

        if($result){
            // Chuyển hướng về trang danh sách phần mềm sau khi sửa thành công
            header("Location: hocky_giaovien.php");
            exit(); // Ngăn chặn mã HTML dưới đây được thực thi sau khi chuyển hướng
        } else {
            echo "Lỗi khi cập nhật dữ liệu: " . mysqli_error($connect);
        }
    } else {
        /*// Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }*/
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin!")</script>'  . "<br>";
    }
}

// Lấy thông tin phần mềm cần sửa từ cơ sở dữ liệu
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT * FROM GiangVien WHERE STT = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Giảng Viên</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>SỬA GIẢNG VIÊN</h2>
    <ul>
        <li><a class="active" href="suagiangvien.php">Sửa giảng viên</a></li>
        <li><a href="hocky_giaovien.php">Quay lại</a></li>
    </ul>
    <form id="form" method="POST">
        <label>STT:</label><br>
        <input type="text" name="STT" value="<?php echo $row['STT']; ?>"><br>
        <label>Mã học phần:</label><br>
        <input type="text" name="MaGiangVien" value="<?php echo $row['MaGiangVien']; ?>"><br>
        <label>Tên học phần:</label><br>
        <input type="text" name="TenGiangVien" value="<?php echo $row['TenGiangVien']; ?>"><br>
        <input type="submit" name="sua" value="Sửa">
    </form>

</body>
</html>
