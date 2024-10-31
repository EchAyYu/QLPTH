<?php
require "connect.php";

// Kiểm tra xem id của phòng đã được truyền qua GET không
if(isset($_GET["id"])) {
    $MaPhong = $_GET["id"];

    // Xóa thông tin phòng từ cơ sở dữ liệu
    $delete_sql = "DELETE FROM PhongThucHanh_CauHinhMayTinh WHERE MaPhong = '$MaPhong'";
    $delete_result = mysqli_query($connect, $delete_sql);

    if($delete_result) {
        echo "Xóa thông tin thành công.";
        header("Location: phong_cauhinhmay.php"); // Chuyển hướng về trang danh sách sau khi xóa thành công
    } else {
        echo "Lỗi khi xóa thông tin: " . mysqli_error($connect);
    }
}
?>
