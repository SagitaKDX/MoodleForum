<?php
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        include '../models/comment.php';
        updateComment($_POST['id'], $_POST['content'], $user['id']);
        header("location: readpost.php?id=$_POST[post_id]");
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    include '../views/layout.html.php';
?>