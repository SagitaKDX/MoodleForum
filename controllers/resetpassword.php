<?php
session_start(); // Start the session to manage messages

// Include the user functions
include '../utils/databaseConnection.php';
include '../models/user.php';

// Handle form submission
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $activationCode = trim($_POST['activation_code']);
    $newPassword = trim($_POST['newpassword']);
    $confirmPassword = trim($_POST['confirmpassword']);

    // Validate form input
    if (empty($email) || empty($activationCode) || empty($newPassword) || empty($confirmPassword)) {
        $_SESSION['message'] = 'All fields are required.';
        $_SESSION['success'] = false;
    } elseif ($newPassword !== $confirmPassword) {
        $_SESSION['message'] = 'Passwords do not match.';
        $_SESSION['success'] = false;
    } else {
        // Fetch the user by email
        $user = getUser($email);

        if ($user && $user['activation_code'] === $activationCode){
            // Update the password
            $userId = $user['id'];
            updateUserPassword($userId, password_hash($newPassword, PASSWORD_BCRYPT));

            // Set a success message
            $_SESSION['message'] = 'Password updated successfully. You can now log in.';
            $_SESSION['success'] = true;
            // wait 1 second before redirecting
            header('refresh:1;url=login.php');
        } else {
            echo $user['activation_code']. ' ' . $activationCode . ' ' . $email;
            // Invalid email or activation code
            $_SESSION['message'] = 'Invalid email or activation code.';
            $_SESSION['success'] = false;
        }
    }
}
include '../views/resetpassword.html.php';
?>
