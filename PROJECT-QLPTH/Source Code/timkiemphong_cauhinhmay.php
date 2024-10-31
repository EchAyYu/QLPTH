<?php
require "connect.php";

// Khởi tạo biến tìm kiếm
$search = "";

// Kiểm tra xem có dữ liệu tìm kiếm được gửi từ biểu mẫu không
if(isset($_POST["timkiem"])) {
    $search = $_POST["search"];

    // Truy vấn cơ sở dữ liệu để lấy danh sách phòng thực hành dựa trên từ khóa tìm kiếm
    $sql = "SELECT * FROM PhongThucHanh_CauHinhMayTinh WHERE TenPhong LIKE '%$search%' OR MaPhong LIKE '%$search%'";
} else {
    // Nếu không có dữ liệu tìm kiếm được gửi đi, hiển thị tất cả phòng
    $sql = "SELECT * FROM PhongThucHanh_CauHinhMayTinh";
}

$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm phòng thực hành</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>TÌM KIẾM PHÒNG THỰC HÀNH</h2>
    <form method="POST">
        <input type="text" id="search" name="search" value="<?php echo $search; ?>" placeholder="Nhập từ khóa tìm kiếm">
        <input type="submit" name="timkiem" value="Tìm kiếm">
        

    </form>
    <ul>
        <li><a class="active" href="timkiemphong_cauhinhmay.php">Tìm kiếm phòng thực hành</a></li>
        <li><a href="phong_cauhinhmay.php">Quay lại</a></li>
    </ul>  
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
        </tr> 
        <?php
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
                </tr> 
                <?php
            }
        } else {
            echo "Không tìm thấy kết quả phù hợp.";
        }
        ?>
    </table> 
</body>
</html>
