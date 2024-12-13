<?php
    session_start();
    chdir('../');
    include '../utils/checkUserLogin.php';
    include '../utils/checkAdminLogin.php';

    if (isset($_POST['submit'])) {
        // POST method
        try {        
            include '../models/module.php';
            createModule($_POST['name'], $_POST['teacher']);
            header('location: home.php');
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
        catch (Exception $e) {
            $error = 'Server Error: ' . $e->getMessage();
        }
    }

    // GET method
    try {
        ob_start();
        include "../views/admin/addmodule.html.php";
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    $title = 'Add User';
    include "../views/admin/layout.html.php";
?>