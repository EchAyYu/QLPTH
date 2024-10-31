<?php
require "connect.php";

// Kiểm tra xem id của phòng đã được truyền qua GET không
if(isset($_GET["id"])) {
    $MaHocPhan = $_GET["id"];

    // Xóa thông tin phòng từ cơ sở dữ liệu
    $delete_sql = "DELETE FROM hp_pm WHERE MaHocPhan = '$MaHocPhan'";
    $delete_result = mysqli_query($connect, $delete_sql);

    if($delete_result) {
        echo "Xóa thông tin thành công.";
        header("Location: hp_pm.php"); // Chuyển hướng về trang danh sách sau khi xóa thành công
    } else {
        echo "Lỗi khi xóa thông tin: " . mysqli_error($connect);
    }
}
?>
