<?php
require "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Giảng Viên</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>DANH SÁCH GiẢNG VIÊN</h2>
    <table border="1" align="center">
        <tr>
            <th>STT</th>
            <th>Mã Giảng Viên</th>
            <th>Tên Giảng Viên</th>
            <th><a href="themgiangvien.php">Them</th>
        </tr> 
        <ul>
            <li><a href="phong_cauhinhmay.php">Trang Chủ</a></li>
            <li><a class="active" href="hocky_giaovien">Danh sách giảng viên</a></li>
            <li><a href="timkiemgiangvien.php">Tìm kiếm </a></li>
            <li><a href="phong_cauhinhmay.php">Danh sách phòng thực hành </a></li>
            <li><a href="phanmem.php">Danh sách phần mềm</a></li>
            <li><a href="hocphan.php">Danh sách học phần</a></li>
            <li><a href="hp_pm.php">Danh sách học phần học cùng với phần mềm</a></li>
        </ul>   

        
        <?php
            include "connect.php";
            $sql = "SELECT * FROM GiangVien";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["STT"];?></td>
            <td><?php echo $row["MaGiangVien"];?></td>
            <td><?php echo $row["TenGiangVien"];?></td>
            <td><a href="suagiangvien.php?id=<?php echo $row['STT']; ?>">Sữa |<a href="xoagiangvien.php?id=<?php echo $row['STT']; ?>">Xóa</td>
        </tr> 
        <?php
                }
            } else {
               // echo "0 results";
            }
            mysqli_close($connect);
        ?>
    </table><br>

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
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["MaHocKy"];?></td>
            <td><?php echo $row["TenHocKy"];?></td>
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
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["MaNhom"];?></td>
            <td><?php echo $row["TenNhom"];?></td>
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
