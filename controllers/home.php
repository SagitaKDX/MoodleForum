<?php
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        ob_start();
        include '../views/home.html.php';
        $output = ob_get_clean();
    } catch (Exception $e) {
        $error = 'Error: ' . $e->getMessage();
    }
    
    include '../views/layout.html.php';
?>