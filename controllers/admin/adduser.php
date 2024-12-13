<?php
    session_start();
    chdir('../');
    include '../utils/checkUserLogin.php';
    include '../utils/checkAdminLogin.php';

    if (isset($_POST['submit'])) {
        // POST method
        try {        
            include '../models/user.php';
            $_POST['is_admin'] = ($_POST['is_admin'] == 'on' ? true : false);
            
            // Hash user password before store in database
            include '../utils/hashPassword.php';
            $_POST['password'] = hashPassword($_POST['password']);

            createUser($_POST['is_admin'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
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
        include "../views/admin/adduser.html.php";
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    $title = 'Add User';
    include "../views/admin/layout.html.php";
?>