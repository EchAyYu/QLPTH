<?php
require "connect.php";

// Xử lý khi nhấn nút Sửa
if(isset($_POST["sua"])){
    // Debugging step 1: Check form data
    var_dump($_POST); // This will show the submitted form data

    $MaPhanMem = $_POST["MaPhanMem"];
    $TenPhanMem = $_POST["TenPhanMem"];

    // Kiểm tra dữ liệu nhập vào
    $errors = array();
    if(empty($TenPhanMem)){ 
        $errors[] = "Vui lòng nhập tên phần mềm!";
    }

    // Nếu không có lỗi, thực hiện cập nhật dữ liệu vào cơ sở dữ liệu
    if(empty($errors)){
        // Debugging step 2: Check SQL query
        $sql = "UPDATE PhanMem SET TenPhanMem = '$TenPhanMem'WHERE MaPhanMem = '$MaPhanMem'";
        echo $sql; // This will display the constructed SQL query
        $result = mysqli_query($connect, $sql);

        if($result){
            // Chuyển hướng về trang danh sách phần mềm sau khi sửa thành công
            header("Location: phanmem.php");
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
    $sql = "SELECT * FROM PhanMem WHERE MaPhanMem = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Phần Mềm</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>SỬA PHẦN MỀM</h2>
    <ul>
        <li><a class="active" href="suaphanmem.php">Sửa phần mềm</a></li>
        <li><a href="phanmem.php">Quay lại</a></li>
    </ul>
    <form id="form" method="POST">
        <label>Mã phần mềm:</label><br>
        <input type="text" name="MaPhanMem" value="<?php echo $row['MaPhanMem']; ?>"><br>
        <label>Tên Phần Mềm:</label><br>
        <input type="text" name="TenPhanMem" value="<?php echo $row['TenPhanMem']; ?>"><br>
        <input type="submit" name="sua" value="Sửa">
    </form>

</body>
</html>
