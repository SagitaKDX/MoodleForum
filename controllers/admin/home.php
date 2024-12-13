<?php
    session_start();
    chdir('../'); // Change the current working directory
    include '../utils/checkUserLogin.php';
    include '../utils/checkAdminLogin.php';

    try {
        require '../models/user.php';
        $users = getAllUsers();

        require '../models/module.php';
        $modules = getAllModules();

        ob_start();
        include '../views/admin/home.html.php';
        $output = ob_get_clean();
    } catch (Exception $e) {
        $error = 'Error: ' . $e->getMessage();
    }

    $title = 'Moodle Overflow';
    include '../views/admin/layout.html.php';
?>