<?php
require "connect.php";
?>
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
    <h2>DANH SÁCH HỌC PHẦN VÀ PHẦN MỀM SỬ DỤNG</h2>
    <table border="1" align="center">
        <tr>
            <th>Mã Học Phần</th>
            <th>Mã Phần Mềm</th>
            <th>Tên Học Phần</th>
            <th>Tên Phần mềm</th>
            <th><a href="themhp_pm.php">Them</th>
        </tr> 
        <ul>
            <li><a href="phong_cauhinhmay.php">Trang Chủ</a></li>
            <li><a class="active" href="hp_pm.php">Danh sách học phần học cùng với phần mềm</a></li>
            <li><a href="timkiemhp_pm.php">Tìm kiếm</a></li>
            <li><a href="phanmem.php">Danh sách phần mềm</a></li>
            <li><a href="hocphan.php">Danh sách học phần</a></li>
        </ul>   
        
        <?php
            include "connect.php";
            $sql = "SELECT * FROM hp_pm";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["MaHocPhan"];?></td>
            <td><?php echo $row["MaPhanMem"];?></td>
            <td><?php echo $row["TenHocPhan"];?></td>
            <td><?php echo $row["TenPhanMem"];?></td>
            <td><a href="suahp_pm.php?id=<?php echo $row['MaHocPhan']; ?>">Sửa</a> | <a href="xoahp_pm.php?id=<?php echo $row['MaHocPhan']; ?>">Xóa</td>
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
