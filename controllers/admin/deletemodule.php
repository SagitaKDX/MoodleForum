<?php 
    session_start();
    chdir('../');
    include '../utils/checkUserLogin.php';
    include '../utils/checkAdminLogin.php';

    try {
        include '../models/module.php';
        deleteModule($_POST['id']);
        // Update the profile
        header('location: home.php');
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    include '../views/admin/layout.html.php';
?>