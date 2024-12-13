<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Start a session to track the user
session_start();

// Include Composer's autoloader (adjusted path)
require '../vendor/autoload.php';  // Correct path to autoload.php

// Check if the forgot password form was submitted via POST method
if (isset($_POST['submit'])) {
    try {
        // Validate the email field
        if (empty($_POST['email'])) {
            $error = 'Email is required.';  // Error if email is empty
        }

        // Sanitize and validate the email
        $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (empty($error) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email address.';  // Error if email is not valid
        }

        // Proceed if there are no validation errors
        if (empty($error)) {
            // Include necessary models and utilities
            include '../models/user.php';
            include '../utils/hashPassword.php';

            // Fetch the user from the database by email
            $existingUser = getUser($_POST['email']);
            
            // If user exists and is not activated, use the old activation code
            if ($existingUser) {
                // Generate a new activation code
                $activationCode = bin2hex(random_bytes(16));

                // Update the user's activation code in the database
                updateUserActivationCode($_POST['email'], $activationCode);
                // Create the reset password link
                $resetLink = "http://localhost/CW2/controllers/resetpassword.php"; 
                // Send the password reset email using PHPMailer
                $mail = new PHPMailer(true);
                try {
                    // Set the SMTP server and authentication details
                    $mail->isSMTP();                          // Use SMTP
                    $mail->Host = 'smtp.gmail.com';           // Gmail SMTP server
                    $mail->SMTPAuth = true;                   // Enable SMTP authentication
                    $mail->Username = 'moodleforum1412@gmail.com';   // Gmail address
                    $mail->Password = 'slcq iosr jbcz nrvv';           // App password generated from Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use STARTTLS encryption
                    $mail->Port = 587;                        // Use port 587 for STARTTLS

                    // Set the sender's and recipient's details
                    $mail->setFrom('moodleforum1412@gmail.com', 'Moodle Forum');   // Sender's email and name
                    $mail->addAddress($_POST['email'], $existingUser['firstname'] . ' ' . $existingUser['lastname']);  // Recipient's email and name

                    // Email content (HTML format)
                    $mail->isHTML(true);                      // Set email format to HTML
                    $mail->Subject = 'Reset Your Password';   // Subject of the email
                    $mail->Body    = "Hello {$existingUser['firstname']},<br><br>Please click the link below to reset your password:<br><a href='{$resetLink}'>Reset Password</a><br><br>Your activation code is: {$activationCode}<br><br>If you didn't request this, please ignore this email.<br><br>Thank you.";
                    $mail->AltBody = 'Please click the link below to reset your password: ' . $resetLink . "\nYour activation code is: {$activationCode}"; // Plain text version
                    // Send the email
                    if ($mail->send()) {
                        $message = 'A password reset link has been sent to your email.';
                    } else {
                        $error = 'Mailer Error: ' . $mail->ErrorInfo; // Return detailed PHPMailer error message
                    }

                } catch (Exception $e) {
                    // Catch PHPMailer exceptions and output the error
                    $error = "Mailer Error: {$mail->ErrorInfo}";
                }

                // Redirect to the reset password page
                header('Location: resetpassword.php');
                exit;

            } else {
                $error = 'Email not found in our records.';  // If the email does not exist
            }
        }
    } catch (PDOException $e) {
        // Database error
        $error = 'Database error: ' . $e->getMessage();
    }
}

// Include the forgot password form HTML
include '../views/forgotpassword.html.php';
?>
