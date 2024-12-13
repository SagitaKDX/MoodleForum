<?php
    session_start();
    include '../utils/checkUserLogin.php';

    try {        
        // Get all modules
        include "../models/module.php";
        $modules = getAllModules();

        include "../views/modules.html.php";
        return;
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
    
    include '../views/error.html.php';
?>