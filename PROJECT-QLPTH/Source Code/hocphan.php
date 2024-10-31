<?php
require "connect.php";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Học Phần</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>DANH SÁCH HỌC PHẦN</h2>
    <table border="1" align="center">
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th><a href="themhocphan.php">Thêm</a></th>
        </tr> 
        <ul>
            <li><a href="phong_cauhinhmay.php">Trang Chủ</a></li>
            <li><a class="active" href="hocphan.php">Danh sách học phần</a></li>
            <li><a href="timkiemhocphan.php">Tìm kiếm học phần</a></li>
        </ul>   
       
        <?php
            include "connect.php";
            $sql = "SELECT * FROM HocPhan";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
             <td><?php echo $row["MaHocPhan"];?></td>
            <td><?php echo $row["TenHocPhan"];?></td>
            <td><a href="suahocphan.php?id=<?php echo $row['MaHocPhan']; ?>">Sửa</a> | <a href="xoahocphan.php?id=<?php echo $row['MaHocPhan']; ?>">Xóa</a></td>
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
