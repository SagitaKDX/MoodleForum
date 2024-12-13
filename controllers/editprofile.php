<?php 
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        include '../utils/hashPassword.php';
        if ($_POST['new-password'] && !verifyPassword($_POST['old-password'], $user['password'])) {
            throw new Exception('Your old password is incorrect');
        }

        include '../utils/updateprofile.php';
        // Update user session
        $_SESSION['user'] = getUser($_POST['email']);
        // // Update the profile
        header('location: profile.php');
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        $error = 'Update error: ' . $e->getMessage();
    }

    if (!isset($admin) || !$admin) include '../views/layout.html.php';
    else include '../views/admin/layout.html.php';
?>