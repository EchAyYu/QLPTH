<?php
require "connect.php";

// Xử lý khi nhấn nút Xóa
if(isset($_GET["id"])){
    $id = $_GET["id"];

    // Xóa dữ liệu trong cơ sở dữ liệu
    $sql = "DELETE FROM HocPhan WHERE MaHocPhan = $id";
    $result = mysqli_query($connect, $sql);

    if($result){
        // Kiểm tra xem có dòng dữ liệu nào bị ảnh hưởng không
        if(mysqli_affected_rows($connect) > 0){
            // Chuyển hướng về trang danh sách phần mềm sau khi xóa thành công
            header("Location: hocphan.php");
        } else {
            echo "Không có dữ liệu nào bị xóa.";
        }
    } else {
        // In ra thông báo lỗi cụ thể nếu có lỗi xảy ra trong quá trình thực thi truy vấn
        echo "Lỗi khi xóa dữ liệu: " . mysqli_error($connect);
    }
}
?>
    