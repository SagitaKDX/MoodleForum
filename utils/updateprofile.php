<?php
    // Validate user input
    if (empty($_POST['id']) || empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']))
    $error = 'Update error: One or more of your info is missing';
    // Sanitize input data
    $_POST['id'] = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $_POST['firstname'] = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $_POST['lastname'] = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    // Validate email
    if (empty($error) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        $error = 'Update error: Your email is invalid';
    // Validate password
    if (empty($error) && !empty($_POST['new-password']) && 0 < strlen($_POST['new-password']) && strlen($_POST['new-password']) < 8) {
        $error = "Password must be at least 8 characters long";
    }

    // Update user info in database
    if (empty($error)) {
        // Upload avatar to server
        $imgUrl = null;
        if (!empty($_FILES['image']['tmp_name'])) {
            // User did upload an image
            include '../utils/uploadImage.php';
            $imgUrl = $target_file;    
        }

        include '../models/user.php';
        if (!$_POST['new-password']) $_POST['new-password'] = null;
        else {
            // Hash input password before store in database
            $_POST['new-password'] = hashPassword($_POST['new-password']);
        }
        updateUser($_POST['id'], $_POST['is_admin'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['new-password'], $imgUrl);
    }    
?>