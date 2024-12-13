<?php
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        include '../models/post.php';
        deletePost($_POST['id'], $user['id']);
        // Redirect to homepage
        header('location: home.php');
    } catch (Exception $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
    // Update list of posts
    include 'home.php';
?>