<?php
$connect = mysqli_connect('localhost', 'root', '29072003', 'project_pht', 3307);
if ($connect) {
    mysqli_query($connect, "SET NAMES 'UTF8'");
    //echo "KẾT NỐI THÀNH CÔNG";
} else {
    echo "KẾT NỐI THẤT BẠI: " . mysqli_connect_error();
}
