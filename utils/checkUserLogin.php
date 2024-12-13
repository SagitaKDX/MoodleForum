<?php
    if (!isset($_SESSION['user']) || !$_SESSION['user']) 
        header('location: login.php');
    else {
        if ($_SESSION['user']['is_admin']) $admin = true;
        $user = $_SESSION['user'];
    }
?>