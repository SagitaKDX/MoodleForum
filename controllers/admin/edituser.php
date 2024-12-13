<?php 
    session_start();
    chdir('../');
    include '../utils/checkUserLogin.php';
    include '../utils/checkAdminLogin.php';

    try {
        // Fix the is_admin checkbox handling
        $_POST['is_admin'] = isset($_POST['is_admin']) ? true : false;
        
        // Get the user data
        require '../models/user.php';
        
        // Update user with all fields including is_admin
        updateUser(
            $_POST['id'],
            $_POST['is_admin'],
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            !empty($_POST['new-password']) ? password_hash($_POST['new-password'], PASSWORD_DEFAULT) : null,
            null,
            null
        );

        header('location: home.php');
        exit();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        $error = 'Update error: ' . $e->getMessage();
    }

    include '../views/admin/layout.html.php';
?>