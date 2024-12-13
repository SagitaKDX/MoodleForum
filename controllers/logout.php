<?php
    session_start();
    include '../utils/checkUserLogin.php';

    session_destroy();
    header('location: login.php')
?>