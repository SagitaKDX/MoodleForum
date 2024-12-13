<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Start a session to track the user
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
    // Redirect to the appropriate page based on user role
    if ($_SESSION['user']['is_admin']) {
        header('location: admin/home.php'); // Admin home
    } else {
        header('location: home.php'); // User home
    }
}

// Include Composer's autoloader (adjusted path)
require '../vendor/autoload.php';  // Correct path to autoload.php

// Function to generate a random activation code
function generateActivationCode() {
    return bin2hex(random_bytes(16)); // Generates a random code (32 characters long)
}

// Check if the signup form was submitted via POST method
if (isset($_POST['submit'])) {
    try {
        // Validate email, password, and other form fields
        if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['firstname']) || empty($_POST['lastname'])) {
            $error = 'All fields are required.';  // Error if fields are empty
        }

        // Sanitize and validate the email
        $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (empty($error) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email address.';  // Error if email is not valid
        }

        // Check if passwords match
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $error = 'Passwords do not match.';  // Error if passwords do not match
        }

        // Proceed if there are no validation errors
        if (empty($error)) {
            // Include necessary models and utilities
            include '../models/user.php';
            include '../utils/hashPassword.php';
            // Check if the email already exists and is not activated
            $existingUser = getUser($_POST['email']);
            if ($existingUser && !$existingUser['activate_status']) {
                // If the user exists but is not activated, update their details and send a new activation email
                $activationCode = generateActivationCode(); // Generate new activation code
                $hashedPassword = hashPassword($_POST['password']); // Hash the password
                updateUser($existingUser['id'], null, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $hashedPassword, null, $activationCode);

                // Create activation link for the user
                $activationLink = "http://localhost/CW2/controllers/activate.php?email=" . urlencode($_POST['email']) . "&activation_code=" . $activationCode;

                // Send the activation email using PHPMailer
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
                    $mail->addAddress($_POST['email'], $_POST['firstname'] . ' ' . $_POST['lastname']);  // Recipient's email and name

                    // Email content (HTML format)
                    $mail->isHTML(true);                      // Set email format to HTML
                    $mail->Subject = 'Activate Your Account'; // Subject of the email
                    $mail->Body    = "Hello {$_POST['firstname']},<br><br>Please click the link below to activate your account:<br><a href='{$activationLink}'>Activate Account</a><br><br>Your activation code is: <strong>{$activationCode}</strong><br><br>Thank you.";
                    $mail->AltBody = 'Please click the link below to activate your account: ' . $activationLink . "\n\nYour activation code is: " . $activationCode; // Plain text version

                    // Send the email
                    $mail->send();
                    $message = 'Your account has been created. Please check your email for the activation code.';

                } catch (Exception $e) {
                    // Error if the email could not be sent
                    $error = "Mailer Error: {$mail->ErrorInfo}";
                }

                // Redirect to the activation page
                header('Location: activate.php?email=' . urlencode($_POST['email']));
                exit;

            } elseif (!$existingUser) {
                // If the email does not exist, create a new user and send activation code
                $activationCode = generateActivationCode(); // Generate activation code
                $hashedPassword = hashPassword($_POST['password']); // Hash the password
                createUser(false, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $hashedPassword, $activationCode);

                // Create activation link for the user
                $activationLink = "http://localhost/CW2/controllers/activate.php?email=" . urlencode($_POST['email']) . "&activation_code=" . $activationCode;

                // Send the activation email using PHPMailer
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
                    $mail->addAddress($_POST['email'], $_POST['firstname'] . ' ' . $_POST['lastname']);  // Recipient's email and name

                    // Email content (HTML format)
                    $mail->isHTML(true);                      // Set email format to HTML
                    $mail->Subject = 'Activate Your Account'; // Subject of the email
                    $mail->Body    = "Hello {$_POST['firstname']},<br><br>Please click the link below to activate your account:<br><a href='{$activationLink}'>Activate Account</a><br><br>Your activation code is: <strong>{$activationCode}</strong><br><br>Thank you.";
                    $mail->AltBody = 'Please click the link below to activate your account: ' . $activationLink . "\n\nYour activation code is: " . $activationCode; // Plain text version

                    // Send the email
                    $mail->send();
                    $message = 'Your account has been created. Please check your email for the activation code.';

                } catch (Exception $e) {
                    // Error if the email could not be sent
                    $error = "Mailer Error: {$mail->ErrorInfo}";
                }

                // Redirect to the activation page
                header('Location: activate.php?email=' . urlencode($_POST['email']));
                exit;
            } else {
                $error = 'Email is already activated.';  // If email is already activated
            }
        }
    } catch (PDOException $e) {
        // Database error
        $error = 'Database error: ' . $e->getMessage();
    }
}

// Include the signup form HTML
include '../views/signup.html.php';
?>
