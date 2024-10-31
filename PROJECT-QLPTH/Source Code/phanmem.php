<?php
require "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Phần Mềm</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>DANH SÁCH PHẦN MỀM</h2>
    <table border="1" align="center">
        <tr>
            <th>Mã Phần Mềm</th>
            <th>Tên Phần Mềm</th>
            <th><a href="themphanmem.php">Thêm</a></th>
        </tr> 
        <ul>
            <li><a href="phong_cauhinhmay.php">Trang Chủ</a></li>
            <li><a class="active" href="phanmem.php">Danh sách phần mềm</a></li>
            <li><a href="timkiemphanmem.php">Tìm kiếm tên phần mềm</a></li>
        </ul>   

        <?php
            include "connect.php";
            $sql = "SELECT * FROM PhanMem";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["MaPhanMem"];?></td>
            <td><?php echo $row["TenPhanMem"];?></td>
            <td><a href="suaphanmem.php?id=<?php echo $row['MaPhanMem']; ?>">Sửa</a> | <a href="xoaphanmem.php?id=<?php echo $row['MaPhanMem']; ?>">Xóa</a></td>
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
