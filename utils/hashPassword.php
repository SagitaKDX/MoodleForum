<?php

    // Function to hash a password
    function hashPassword($password) {
        // Generate a password hash using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Return the hashed password
        return $hashedPassword;
    }

    // Function to verify a password
    function verifyPassword($password, $hashedPassword) {
        // Use password_verify to check if the entered password matches the hashed password
        return password_verify($password, $hashedPassword);
    }

    // // Example usage:

    // // User registration (hashing the password before storing it in the database)
    // $userPassword = "user123"; // Replace with the actual password entered by the user during registration
    // $hashedPassword = hashPassword($userPassword);

    // // Storing $hashedPassword in the database along with other user details

    // // User login (verifying the entered password during login)
    // $enteredPassword = "user123"; // Replace with the actual password entered by the user during login

    // // Fetch the hashed password from the database based on the username or email
    // // For example: $hashedPasswordFromDatabase = fetchHashedPassword($usernameOrEmail);

    // // Verify the entered password
    // if (verifyPassword($enteredPassword, $hashedPasswordFromDatabase)) {
    //     // Password is correct, proceed with login
    //     echo "Login successful!";
    // } else {
    //     // Password is incorrect
    //     echo "Incorrect password. Please try again.";
    // }

?>
