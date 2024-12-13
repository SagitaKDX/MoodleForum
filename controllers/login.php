<?php
    // Start a session to track the user
    session_start(); 

    // Check if the user is already logged in and has admin privileges
    if (isset($_SESSION['user'])  && $_SESSION['user'] != '' && $_SESSION['user']['is_admin']) 
        header('location: admin/home.php');  // If the user is an admin, redirect to the admin home page
    else if (isset($_SESSION['user']) && $_SESSION['user'] != '') 
        header('location: home.php');  // If the user is logged in but not an admin, redirect to the user home page

    // Check if the login form was submitted via POST method
    if (isset($_POST['submit'])) { 
        try {
            // Check if email or password is missing
            if (empty($_POST['email']) || empty($_POST['password']))
                $error = 'Login error: Your email or password is missing';  // If either field is empty, show an error

            // Sanitize and validate the email
            $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);  // Remove invalid characters from the email
            if (empty($error) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))  // Validate the email format
                $error = 'Login error: Your email is invalid';  // If the email is not valid, show an error

            // Proceed with login if no errors are found
            if (empty($error)) {
                include '../models/user.php';  // Include the file that contains user-related functions
                $user = getUser($_POST['email']);  // Retrieve the user's data from the database based on the email

                include '../utils/hashPassword.php';  // Include the file that contains password hashing functions
                if ($user && verifyPassword($_POST['password'], $user['password'])) {  // Verify if the password matches
                    $_SESSION['user'] = $user;  // Store user information in the session
                    if ($user['is_admin']) {  // If the user is an admin, redirect to the admin dashboard
                        header('location: admin/home.php');  
                    }
                    // If the user is not an admin, redirect to the user homepage
                    else header('location: home.php');  
                }
                else $error = 'Login error: Your email or password is incorrect';  // If login fails, show an error
            }
        } catch (PDOException $e) {  // Handle any database errors
            $error = 'Database error: ' . $e->getMessage();  // Display the database error message
        }
    }

    // If it's a GET request (or no POST request), display the login form
    include '../views/login.html.php';  
?>

<!-- 

session_start(): Starts a new session or resumes the current session if it exists. This is necessary for tracking user login status.
isset($_SESSION['user']): Checks if the user session variable is set, indicating that the user is logged in.
header('location: ...'): Redirects the user to another page. In this case, it redirects to either the admin dashboard or the user homepage based on the user's role.
filter_var($_POST['email'], FILTER_SANITIZE_EMAIL): Sanitizes the email input by removing any invalid characters that might be harmful or non-standard.
filter_var($_POST['email'], FILTER_VALIDATE_EMAIL): Validates the email format to ensure it conforms to the standard email format (e.g., user@example.com).
getUser($_POST['email']): A function that retrieves the user details from the database based on the provided email.
verifyPassword($_POST['password'], $user['password']): A function that verifies if the entered password matches the hashed password stored in the database.
include '../models/user.php': Includes the file that contains functions to interact with user data, such as retrieving user information.
include '../utils/hashPassword.php': Includes the file that contains password hashing and verification functions.
include '../views/login.html.php': Displays the login page to the user if they haven't submitted the form or there is an error.
-->