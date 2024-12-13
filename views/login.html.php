<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="../views/images/icons/favicon.ico"/>
    <link rel="stylesheet" href="../views/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../views/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../views/vendor/animate/animate.css">
    <link rel="stylesheet" href="../views/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" href="../views/vendor/select2/select2.min.css">
    <link rel="stylesheet" href="../views/css/util.css">
    <link rel="stylesheet" href="../views/css/main.css">
    <style>
        /* Password container styling */
        .password-container {
            position: relative;
        }

        /* Password toggle icon styling */
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            width: 20px;  /* Smaller icon size */
            height: 20px; /* Smaller icon size */
        }

        /* Input field padding adjustment to make space for the icon */
        .input100 {
            padding-right: 30px;  /* Adjust padding to make space for the toggle icon */
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

                <form class="login100-form validate-form" action="../controllers/login.php" method="POST">
                    <span class="login100-form-title">
                        Member Login
                    </span>

                    <?php if (isset($error)) { ?>
                        <div class="error-container">
                            <p><?= htmlspecialchars($error) ?></p>
                        </div>
                    <?php } ?>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" placeholder="Email" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Updated Password Input Field -->
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

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="submit" type="submit">Login</button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">Forgot</span>
                        <a class="txt2" href="../controllers/forgotpassword.php">Password?</a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="../controllers/signup.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
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

            if (passwordInput.type === "password") {
                passwordInput.type = "text"; // Show the password
                passwordToggle.setAttribute('stroke', '#2196F3'); // Change icon color to blue
            } else {
                passwordInput.type = "password"; // Hide the password
                passwordToggle.setAttribute('stroke', '#888'); // Change icon color to grey
            }
        }
    </script>
</body>

</html>
