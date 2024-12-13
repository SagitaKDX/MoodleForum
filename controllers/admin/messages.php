<?php
    session_start();
    chdir('../'); // Change the current working directory
    include '../utils/checkUserLogin.php';
    include '../utils/checkAdminLogin.php';

    try {
        include '../models/message.php';
        $messages = getAllMessages();
        ob_start();
        include '../views/admin/messages.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    $title = 'Messages';
    include '../views/admin/layout.html.php';
?>