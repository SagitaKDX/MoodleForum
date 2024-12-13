<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?> </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

    <!-- Dynamic css file link -->
    <?php if ($title == 'Profile'): ?>
        <!-- At the profile page -->
        <link rel="stylesheet" href="../css/style.css">
    <?php else: ?>
        <link rel="stylesheet" href="../../css/style.css">
    <?php endif; ?>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column; /* Changed to column layout */
            background-color: #f4f7fa;
            overflow-x: hidden;
        }

        /* Header style with white background */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: white; /* White background */
            color: #007bff; /* Blue text color */
            height: 70px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .header .brand {
            font-size: 28px;
            font-weight: bold;
        }

        .header .menu {
            display: flex;
            gap: 25px;
        }

        .header .menu a {
            color: #007bff; /* Blue text color */
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .header .menu a:hover {
            background-color: #007bff; /* Blue background on hover */
            color: white; /* White text on hover */
        }

        .main-content {
            margin-top: 70px; /* Adjusted for fixed header */
            padding: 20px;
            width: 100%;
            overflow-y: auto;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
                font-size: 20px;
            }

            .header .menu {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: white; /* White background on mobile */
            }

            .header .menu a {
                padding: 15px;
                border-bottom: 1px solid #f1f1f1;
            }

            .header .burger {
                display: block;
                cursor: pointer;
            }

            .show:checked + .menu {
                display: flex;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

    </style>
</head>
<body>

    <nav class="header">
        <!-- Dynamic navigation link for different pages -->
        <?php if ($title == 'Profile'): ?>
            <a class="brand" href="../">
                <img class="logo" src="https://moodlecurrent.gre.ac.uk/pluginfile.php/1/core_admin/logocompact/300x300/1698130741/LOGO_REVISION_MASTER%20N%202022%20150.png" alt="Logo"> 
            </a>
        <?php else: ?>
            <a class="brand" href="../../">
                <img class="logo" src="https://moodlecurrent.gre.ac.uk/pluginfile.php/1/core_admin/logocompact/300x300/1698130741/LOGO_REVISION_MASTER%20N%202022%20150.png" alt="Logo"> 
            </a>
        <?php endif; ?>

        <!-- Burger menu for mobile -->
        <input id="bmenub" type="checkbox" class="show">
        <label for="bmenub" class="burger pseudo button">☰ Menu</label>

        <div class="menu">
            <?php if ($title == 'Profile'): ?>
                <a href="../controllers/admin/home.php">Home</a>
                <a href="../controllers/admin/adduser.php">Add a user</a>
                <a href="../controllers/admin/addmodule.php">Add a module</a>
                <a href="../controllers/profile.php">View profile</a>
                <a href="../controllers/admin/messages.php">View messages</a>
                <a href="../controllers/logout.php">Logout</a>
            <?php else: ?>
                <a href="../../controllers/admin/home.php">Home</a>
                <a href="../../controllers/admin/adduser.php">Add a user</a>
                <a href="../../controllers/admin/addmodule.php">Add a module</a>
                <a href="../../controllers/profile.php">View profile</a>
                <a href="../../controllers/admin/messages.php">View messages</a>
                <a href="../../controllers/logout.php">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="main-content">
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
    </div>

</body>
</html>
