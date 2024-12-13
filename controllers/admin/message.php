<?php 
    session_start();
    chdir('../'); // Change the current working directory
    include '../utils/checkUserLogin.php';
    include '../utils/checkAdminLogin.php';

    try {
        include '../models/message.php';
        $message = getMessage($_GET['id']);

        ob_start();
        include '../views/admin/message.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    $title = $message['subject'];
    include '../views/admin/layout.html.php';
?>