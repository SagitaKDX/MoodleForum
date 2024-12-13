<?php
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        // Get all posts
        include "../models/post.php";
        // include "../models/vote.php";
       
        $posts = getAllPosts();
        foreach ($posts as $key => $post) {
            $posts[$key]['user_vote'] = getVoteType($_SESSION['user']['id'], $post['post_id']);
        }
        include "../views/feeds.html.php";
        return;
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }

    include '../views/error.html.php';
?>

