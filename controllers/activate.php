<?php
// Start session
session_start();

// Include user model for database operations
include '../models/user.php';

// Check if the activation form was submitted
if (isset($_POST['submit'])) {
    // Retrieve and sanitize user input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $activationCode = trim($_POST['activation_code']); // Remove whitespace from the beginning and end of the activation code

    // Validate user input
    if (empty($email) || empty($activationCode)) {
        $message = 'Both email and activation code are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email format.';
    } else {
        // Check if the activation code matches the user in the database
        $user = getUser($email); // Function to retrieve user data from the database based on email
        if ($user && $user['activation_code'] === $activationCode) {
            // Activate the user account
            activateUser($email , $activationCode); // Function to mark user as activated in the database
            $message = 'Your account has been activated successfully!';
            // wait for 3 seconds before redirecting to login page
            header('Refresh: 1; URL=login.php');
        } else {
            $message = 'Invalid activation code or email.';
        }
    }
}

// Include the activation form HTML
include '../views/activate.html.php';
?>

<!-- 
Functions used:
- trim(): Removes whitespace from the beginning and end of a string.
- getUser($email): Retrieves user data from the database based on the provided email.
- activateUser($email, $activationCode): Marks the user as activated in the database.
-->
