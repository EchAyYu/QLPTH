<?php
require "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Học Phần</title>
</head>
<body>
    <h2>DANH SÁCH HỌC PHẦN</h2>

   
    <form method="GET">
        <label for="search">Tìm kiếm:</label>
        <input type="text" id="search" name="search" placeholder="Nhập mã học phần">
        <button type="submit">Tìm kiếm</button>
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	    <link rel="stylesheet" type="text/css" href="style.css">
    </form>
    <ul>
        <li><a class="active" href="timkiemhocphan.php">Tìm kiếm học phần</a></li>
        <li><a href="hocphan.php">Quay lại</a></li>
    </ul>  
    <table border="1" align="center">
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
        </tr> 
        <?php
            // Kiểm tra nếu có tham số tìm kiếm được đưa vào
            $search_query = "";
            if(isset($_GET['search'])) {
                $search_query = $_GET['search'];
            }

            include "connect.php";

            // Sửa câu truy vấn SQL để thêm chức năng tìm kiếm
            $sql = "SELECT * FROM HocPhan";
            if(!empty($search_query)) {
                $sql .= " WHERE MaHocPhan LIKE '%$search_query%'";
            }

            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["MaHocPhan"];?></td>
            <td><?php echo $row["TenHocPhan"];?></td>
        </tr> 
        <?php
                }
            } else {
                echo "<tr><td colspan='4'>Không tìm thấy kết quả</td></tr>";
            }
            mysqli_close($connect);
        ?>
    </table>
    
</body>
</html>
