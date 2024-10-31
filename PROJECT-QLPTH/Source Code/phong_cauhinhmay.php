<?php require "connect.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Phòng Thực Hành</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>DANH SÁCH PHÒNG THỰC HÀNH</h2>
    <table border="1" align="center">
        <tr>
            <th>Mã Phòng</th>
            <th>Tên Phòng</th>
            <th>Số lượng máy</th>
            <th>CPU</th>
            <th>RAM</th>
            <th>Bộ Nhớ</th>
            <th>OS</th>
            <th>Thông tin</th>
            <th><a href="themphong_cauhinhmay.php">Thêm</th>
        </tr>
        <ul>
            <li><a class="active" href="">Trang chủ </a></li>
            <li><a href="timkiemphong_cauhinhmay.php">Tìm kiếm phòng thực hành</a></li>
            <li><a href="phanmem.php">Danh sách phần mềm</a></li>
            <li><a href="hocphan.php">Danh sách học phần</a></li>
            <li><a href="hp_pm.php">Danh sách học phần học cùng với phần mềm</a></li>
            <li><a href="hocky_giaovien.php">Danh sách giảng viên</a></li>
            <li><a href="lichthuchanh.php">Lịch thực hành</a></li>
        </ul>      
    
        <?php
            include "connect.php";
            $sql = "SELECT * FROM PhongThucHanh_CauHinhMayTinh";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["MaPhong"];?></td>
            <td><?php echo $row["TenPhong"];?></td>
            <td><?php echo $row["SoLuongMay"];?></td>
            <td><?php echo $row["CPU"];?></td>
            <td><?php echo $row["RAM"];?></td>
            <td><?php echo $row["BoNho"];?></td>
            <td><?php echo $row["OS"];?></td>
            <td><?php echo $row["ThongTin"];?></td>
            <td><a href="suaphong_cauhinhmay.php?id=<?php echo $row['MaPhong']; ?>">Sửa</a> | <a href="xoaphong_cauhinhmay.php?id=<?php echo $row['MaPhong']; ?>">Xóa</td>
        </tr> 
        <?php
                }
            } else {
               // echo "0 results";
            }
            mysqli_close($connect);
        ?>
    </table>

<?php include "footer.php" ?>    
