<?php
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        include '../models/module.php';
        $module = getModule($_GET['id']);
        include '../models/post.php';
        $posts = getPostsInModule($_GET['id']);
        foreach ($posts as $key => $post) {
            // Fetch user vote for each post
            $posts[$key]['user_vote'] = getVoteType($_SESSION['user']['id'], $post['post_id']);
        }
        ob_start();
        include '../views/feeds.html.php';
        $feeds = ob_get_clean();

        ob_start();
        include '../views/module.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    $title = 'Module: ' . $module['name'];
    include '../views/layout.html.php'
?>