<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?> </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #f0f8ff; /* Light blue color that complements royal blue */
            background-image: url('../images/background.jpg'); /* Optional: Add a background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* Ensure the background covers the full height */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: royalblue; /* Changed background color to royal blue */
            color: #fff;
            height: 60px; /* Set a fixed height for the header */
        }
        .header .brand {
            font-size: 24px; /* Set font size for the brand text */
            font-weight: bold; /* Set font weight for the brand text */
        }
        .menu {
            display: flex;
            gap: 15px;
        }
        .menu a {
            color: #fff; /* Set text color to white */
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s; /* Added transition for color */
        }
        .menu a:hover,
        .menu a:focus {
            background-color: #fff; /* Change background color to white on hover/focus */
            color: royalblue; /* Change text color to royal blue on hover/focus */
        }
        .burger {
            display: none;
        }
        @media (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: royalblue; /* Changed background color to royal blue */
            }
            .menu a {
                padding: 15px;
                border-bottom: 1px solid #444;
            }
            .burger {
                display: block;
                cursor: pointer;
            }
            .show:checked + .menu {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <nav class="header">
        <a class="brand" href="../">
            Greenwich forum
        </a>

        <!-- responsive-->
        <input id="bmenub" type="checkbox" class="show">
        <label for="bmenub" class="burger pseudo button">☰ Menu</label>
        
        <div class="menu">
            <a href="../controllers/home.php">Home</a>
            <a href="../controllers/addpost.php">Add a post</a>
            <a href="../controllers/contact.php">Contact us</a>
            <a href="../controllers/profile.php">View profile</a>
            <a href="../controllers/logout.php">Logout</a>
        </div>
    </nav>

    <?php if (isset($error)): ?> 
        <?php
            ob_start();
            include '../views/error.html.php';
            $errorContainer = ob_get_clean(); 
            echo $errorContainer;
        ?>
    <?php else: ?>
        <main class="dynamic-content">
            <?=$output?>
        </main>
    <?php endif; ?>
</body>
</html>