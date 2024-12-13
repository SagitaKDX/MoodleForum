<?php
session_start();
include '../utils/checkUserLogin.php';

try {
    // Fetch the post data
    include '../models/post.php';
    $post = getPost();

    if (empty($post)) throw new Exception('No post found');
    
    // Fetch the comments for the post
    include '../models/comment.php';
    $comments = getComments($post['post_id']);
    include '../models/commentvote.php';
    // Fetch the vote type for each comment (this will be similar to how it's done for posts)
    foreach ($comments as $key => $comment) {
        // Fetch user vote for each comment
        $comments[$key]['user_vote'] = getCommentVoteType($_SESSION['user']['id'], $comment['comment_id']);
    }

    // Render the comment section
    ob_start();
    include '../views/comments.html.php';
    $commentSection = ob_get_clean();

    // Render the post view
    ob_start();
    include '../views/readpost.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $error = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $error = 'Error: ' . $e->getMessage();
}

if (isset($error)) {
    $title = 'Error';
} else {
    $title = "$post[title]";
}

include '../views/layout.html.php';
?>
