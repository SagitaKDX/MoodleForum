<?php
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        include '../models/comment.php';
        deleteComment($_POST['id'], $user['id']);
        // Redirect to post reading
        header("location: readpost.php?id=$_POST[post_id]");
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
    // Update list of posts
    include '../views/layout.html.php';
?>