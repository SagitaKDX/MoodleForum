<?php 
    session_start();
    chdir('../');
    include '../utils/checkUserLogin.php';
    include '../utils/checkAdminLogin.php';

    try {
        include '../models/module.php';
        updateModule($_POST['id'], $_POST['name'], $_POST['teacher']);

        // Update the profile
        header('location: home.php');
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        $error = 'Update error: ' . $e->getMessage();
    }

    include '../views/admin/layout.html.php';
?>