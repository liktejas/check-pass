<?php
    session_start();
    include 'conn.php';
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_name']);
    session_destroy();
    header("Location:admin.php")
?>