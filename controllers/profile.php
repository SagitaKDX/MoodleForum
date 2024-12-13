<?php 
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        ob_start();
        include '../views/profile.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    $title = 'Profile';
    if (isset($admin)) include '../views/admin/layout.html.php';
    else include '../views/layout.html.php';
?>