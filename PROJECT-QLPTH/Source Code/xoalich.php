<?php
require "connect.php";

// Kiểm tra xem ID của lịch thực hành cần xóa có tồn tại hay không
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn dữ liệu của lịch thực hành dựa trên ID
    $sql = "SELECT * FROM LichThucHanh WHERE MaLichThucHanh = '$id'";
    $result = mysqli_query($connect, $sql);

    // Kiểm tra xem có dữ liệu hay không
    if(mysqli_num_rows($result) > 0) {
        // Xóa lịch thực hành
        $sql_delete = "DELETE FROM LichThucHanh WHERE MaLichThucHanh = '$id'";
        $result_delete = mysqli_query($connect, $sql_delete);

        if($result_delete){
           header("location: lichthuchanh.php");
        } else {
            echo "Lỗi khi xóa lịch thực hành: " . mysqli_error($connect);
        }
    } else {
        echo "Không tìm thấy lịch thực hành.";
    }
} else {
    echo "ID của lịch thực hành không được cung cấp.";
}

mysqli_close($connect);
?>
