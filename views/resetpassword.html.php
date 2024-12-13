<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $success = isset($_SESSION['success']) ? $_SESSION['success'] : false;
    unset($_SESSION['message']); // Clear the message after it is displayed
    unset($_SESSION['success']); // Clear the success flag after it is displayed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            font-size: 18px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            font-size: 16px;
            color: #d9534f;
            margin-bottom: 20px;
        }

        .message.success {
            color: #28a745;
        }

        /* For mobile responsiveness */
        @media (max-width: 768px) {
            h2 {
                font-size: 24px;
            }

            .container {
                padding: 20px;
            }

            input, button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Reset Password</h2>

        <?php if (isset($message)) { ?>
            <p class="message <?= $success ? 'success' : ''; ?>">
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
            </p>
        <?php } ?>

        <!-- Reset password form -->
        <form method="POST" action="resetpassword.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>

            <label for="activation_code">Activation Code:</label>
            <input type="text" name="activation_code" id="activation_code" placeholder="Enter activation code" required>

            <label for="newpassword">New Password:</label>
            <input type="password" name="newpassword" id="newpassword" placeholder="Enter new password" required>

            <label for="confirmpassword">Confirm New Password:</label>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm new password" required>

            <button type="submit" name="submit">Reset Password</button>
        </form>
    </div>

</body>
</html>
