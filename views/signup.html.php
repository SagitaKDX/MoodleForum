<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/png" href="../views/images/icons/favicon.ico"/>
    <link rel="stylesheet" href="../views/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../views/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../views/vendor/animate/animate.css">
    <link rel="stylesheet" href="../views/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" href="../views/vendor/select2/select2.min.css">
    <link rel="stylesheet" href="../views/css/util.css">
    <link rel="stylesheet" href="../views/css/main.css">
    <style>
        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            width: 20px;
            height: 20px;
        }

        .input100 {
            padding-right: 30px;
        }

        /* Error message style */
        .error-container {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .error-container p {
            margin: 0;
        }

        /* Move input fields and title higher */
        .wrap-login100 {
            margin-top: -60px; /* Increased the value to move the form higher */
        }

        .login100-form-title {
            margin-top: 10px; /* Reduced space above title */
        }

        .container-login100-form-btn {
            margin-top: 20px;
        }

        .login100-form-btn {
            background-color: #007bff; /* Change to blue */
            color: white;
            border: none;
            border-radius: 25px;  /* Changed from 5px to 25px to match input fields */
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login100-form-btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="../views/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="signup.php" method="POST">
                    <span class="login100-form-title">
                        Create Your Account
                    </span>

                    <!-- Display error messages -->
                    <?php if (isset($error)): ?>
                        <div class="error-container">
                            <p><?= htmlspecialchars($error) ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- First Name -->
                    <div class="wrap-input100 validate-input" data-validate="First name is required">
                        <input class="input100" type="text" name="firstname" id="firstname" placeholder="First Name" required pattern="[A-Za-z]+" title="Only letters allowed">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Last Name -->
                    <div class="wrap-input100 validate-input" data-validate="Last name is required">
                        <input class="input100" type="text" name="lastname" id="lastname" placeholder="Last Name" required pattern="[A-Za-z]+" title="Only letters allowed">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Email -->
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" id="email" placeholder="Email" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Password -->
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <div class="password-container">
                            <input class="input100" type="password" name="password" id="password" placeholder="Password" required minlength="8">
                            <span class="focus-input100"></span>
                            <span class="password-toggle" onclick="togglePassword()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s3-7 11-7 11 7 11 7-3 7-11 7-11-7-11-7z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="wrap-input100 validate-input" data-validate="Please confirm your password">
                        <div class="password-container">
                            <input class="input100" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="submit" type="submit">Sign Up</button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">Already have an account?</span>
                        <a class="txt2" href="login.php">Login</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="../views/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../views/vendor/bootstrap/js/popper.js"></script>
    <script src="../views/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../views/vendor/select2/select2.min.js"></script>
    <script src="../views/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        });

        // Password toggle visibility function
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.querySelector('.password-toggle svg');
            const confirmPasswordInput = document.getElementById('confirm_password');

            if (passwordInput.type === "password") {
                passwordInput.type = "text"; // Show the password
                confirmPasswordInput.type = "text"; // Show the confirm password
                passwordToggle.setAttribute('stroke', '#2196F3'); // Change icon color to blue
            } else {
                passwordInput.type = "password"; // Hide the password
                confirmPasswordInput.type = "password"; // Hide the confirm password
                passwordToggle.setAttribute('stroke', '#888'); // Change icon color to grey
            }
        }
    </script>
</body>

</html>
