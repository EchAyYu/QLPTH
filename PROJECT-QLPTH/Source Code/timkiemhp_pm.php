<?php
require "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm Học Phần và Phần Mềm</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>TÌM KIẾM HỌC PHẦN VÀ PHẦN MỀM</h2>

    <!-- Search form -->
    <form method="GET">
        <label for="search">Tìm kiếm:</label><br>
        <input type="text" id="search" name="search">
        <button type="submit">Tìm kiếm</button>
    </form>

    <ul>
        <li><a class="active" href="timkiemhp_pm.php">Tìm kiếm học phần và phần mềm </a></li>
        <li><a href="hp_pm.php">Quay lại</a></li>
    </ul>  
    <table border="1" align="center">
        <tr>
            <th>Mã Học Phần</th>
            <th>Mã Phần Mềm</th>
            <th>Tên Học Phần</th>
            <th>Tên Phần mềm</th>
        </tr> 
        <?php
            // Check if search query parameter is set
            $search_query = "";
            if(isset($_GET['search'])) {
                $search_query = $_GET['search'];
            }

            include "connect.php";

            // Modify the SQL query to include search functionality
            $sql = "SELECT * FROM hp_pm";
            if(!empty($search_query)) {
                $sql .= " WHERE MaHocPhan LIKE '%$search_query%' OR MaPhanMem LIKE '%$search_query%'";
            }

            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row["MaHocPhan"];?></td>
            <td><?php echo $row["MaPhanMem"];?></td>
            <td><?php echo $row["TenHocPhan"];?></td>
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
