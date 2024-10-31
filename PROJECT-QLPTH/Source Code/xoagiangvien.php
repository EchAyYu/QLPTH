<?php
require "connect.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];

    // Prepare and execute the SQL query to delete the record
    $sql = "DELETE FROM GiangVien WHERE STT = $id";
    $result = mysqli_query($connect, $sql);

    if($result){
        // Redirect back to the list of teachers after successful deletion
        header("Location: hocky_giaovien.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($connect);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($connect);
?>
