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

    <!-- Search form -->
    <form method="GET">
        <label for="search">Tìm kiếm tên phần mềm:</label>
        <input type="text" id="search" name="search" placeholder="Nhập từ khóa tìm kiếm">
        <button type="submit">Tìm kiếm</button>
    </form>
    <ul>
        <li><a class="active" href="timkiemphanmem.php">Tìm kiếm phần mềm</a></li>
        <li><a href="phanmem.php">Quay lại</a></li>
    </ul>
    <table border="1" align="center">
        <tr>
            <th>Mã Phần Mềm</th>
            <th>Tên Phần Mềm</th>
        </tr> 
        <?php
            // Check if search query parameter is set
            $search_query = "";
            if(isset($_GET['search'])) {
                $search_query = $_GET['search'];
            }

            include "connect.php";

            // Modify the SQL query to include search functionality
            $sql = "SELECT * FROM PhanMem";
            if(!empty($search_query)) {
                $sql .= " WHERE TenPhanMem LIKE '%$search_query%'";
            }

            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["MaPhanMem"];?></td>
            <td><?php echo $row["TenPhanMem"];?></td>
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
