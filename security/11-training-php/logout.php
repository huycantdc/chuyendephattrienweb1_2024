<?php
session_start();
session_destroy();
header('location: login.php');
exit(); // Thêm exit sau khi chuyển hướng
?>
