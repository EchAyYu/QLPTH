<?php
require "connect.php";

// Hàm kiểm tra trùng lặp lịch thực hành
function checkDuplicateSchedule($connect, $ThoiGianBatDau, $ThoiGianKetThuc, $DiaDiem)
{
    $sql = "SELECT * FROM LichThucHanh WHERE (('$ThoiGianBatDau' >= ThoiGianBatDau AND '$ThoiGianBatDau' < ThoiGianKetThuc) OR ('$ThoiGianKetThuc' > ThoiGianBatDau AND '$ThoiGianKetThuc' <= ThoiGianKetThuc)) AND DiaDiem = '$DiaDiem'";
    $result = mysqli_query($connect, $sql);
    return mysqli_num_rows($result) > 0;
}

if (isset($_POST["them"])) {
    // Retrieve form data
    $MaLichThucHanh = $_POST["MaLichThucHanh"];
    $MaNhom = $_POST["MaNhom"];
    $ThoiGianBatDau = $_POST["ThoiGianBatDau"];
    $ThoiGianKetThuc = $_POST["ThoiGianKetThuc"];
    $DiaDiem = $_POST["DiaDiem"];
    $TenGiangVien = $_POST["TenGiangVien"];

    // Check for input validation errors
    $errors = array();
    if (empty($MaLichThucHanh)) {
        $errors[] = "Vui lòng nhập mã lịch";
    }
    if (empty($MaNhom)) {
        $errors[] = "Vui lòng nhập mã nhóm!";
    }
    if (empty($ThoiGianBatDau)) {
        $errors[] = "Vui lòng nhập thời gian bắt đầu!";
    }
    if (empty($ThoiGianKetThuc)) {
        $errors[] = "Vui lòng nhập thời gian kết thúc!";
    }
    if (empty($DiaDiem)) {
        $errors[] = "Vui lòng nhập địa điểm!";
    }
    if (empty($TenGiangVien)) {
        $errors[] = "Vui lòng nhập tên giảng viên!";
    }
    if ($ThoiGianBatDau >= $ThoiGianKetThuc) {
        $errors[] = "Thời gian bắt đầu phải sớm hơn thời gian kết thúc. Vui lòng nhập lại.";
    }

    // If no validation errors, insert into database
    if (empty($errors)) {
        // Check for duplicate schedule
        $isDuplicate = checkDuplicateSchedule($connect, $ThoiGianBatDau, $ThoiGianKetThuc, $DiaDiem);

        if ($isDuplicate) {
            echo "Phòng đã được đăng ký vào thời gian này tại địa điểm này. Vui lòng quay lại và kiểm tra phòng còn trống.";
        } else {
            // Insert schedule into database
            $sql = "INSERT INTO LichThucHanh(MaLichThucHanh, MaNhom, ThoiGianBatDau, ThoiGianKetThuc, DiaDiem, TenGiangVien) 
                    VALUES('$MaLichThucHanh', '$MaNhom', '$ThoiGianBatDau', '$ThoiGianKetThuc', '$DiaDiem', '$TenGiangVien')";
            $qr = mysqli_query($connect, $sql);

            if ($qr) {
                // Redirect to schedule page if added successfully
                header("location: lichthuchanh.php");
            } else {
                echo "Lỗi khi thêm vào cơ sở dữ liệu: " . mysqli_error($connect);
            }
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





<table border="1" align="right">
    <tr>
        <th>Mã Học Kỳ</th>
        <th>Tên Học Kỳ</th>
    </tr>
    <?php
    include "connect.php";
    $sql = "SELECT * FROM HocKy";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <tr>
                <td><?php echo $row["MaHocKy"]; ?></td>
                <td><?php echo $row["TenHocKy"]; ?></td>
            </tr>
    <?php
        }
    } else {
        // echo "0 results";
    }
    mysqli_close($connect);
    ?>
</table>

<table border="1" align="right">
    <tr>
        <th>Mã Nhóm</th>
        <th>Tên Nhóm</th>
    </tr>
    <?php
    include "connect.php";
    $sql = "SELECT * FROM NhomHoc";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <tr>
                <td><?php echo $row["MaNhom"]; ?></td>
                <td><?php echo $row["TenNhom"]; ?></td>
            </tr>
    <?php
        }
    } else {
        // echo "0 results";
    }
    mysqli_close($connect);
    ?>
</table>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Lịch Thực Hành</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <ul>
        <li><a class="active" href="dangkylich.php">Đăng ký lịch thực hành</a></li>
        <li><a href="lichthuchanh.php">Quay lại</a></li>
    </ul>
    <form id="form" method="POST" action="">
        <h2>ĐĂNG KÝ LỊCH THỰC HÀNH</h2>
        <label>Mã lịch thực hành:</label><br>
        <input type="text" name="MaLichThucHanh"><br>
        <label>Mã nhóm:</label><br>
        <input type="text" name="MaNhom"><br>
        <label for="ThoiGianBatDau">Thời Gian Bắt Đầu:</label><br>
        <input type="datetime-local" id="ThoiGianBatDau" name="ThoiGianBatDau"><br><br>
        <label for="ThoiGianKetThuc">Thời Gian Kết Thúc:</label><br>
        <input type="datetime-local" id="ThoiGianKetThuc" name="ThoiGianKetThuc"><br><br>
        <label>Địa điểm:</label><br>
        <input type="text" name="DiaDiem"><br><br>
        <label>Tên Giảng Viên:</label><br>
        <input type="text" name="TenGiangVien"><br><br>
        <input id="add" type="submit" name="them" value="THÊM">
    </form>


</body>

</html>