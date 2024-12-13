/**
 * This script handles the addition of a comment to a post.
 * 
 * It starts a session, includes necessary utility and model files,
 * and attempts to add a comment to the database. If successful, it
 * redirects the user to the post page. If an error occurs, it catches
 * the PDOException and stores the error message.
 * 
 * @package CommentController
 * 
 * @throws PDOException If there is an error with the database operation.
 * 
 * @uses checkUserLogin.php To verify if the user is logged in.
 * @uses comment.php To access the addComment function.
 * 
 * @param int $_POST['post_id'] The ID of the post to which the comment is being added.
 * @param string $_POST['content'] The content of the comment.
 * @param int $user['id'] The ID of the user adding the comment.
 * 
 * @return void
 */
<?php
    session_start();
    include '../utils/checkUserLogin.php';

    try {
        include '../models/comment.php';
        addComment($_POST['post_id'], $_POST['content'], $user['id']);
        header("location: readpost.php?id=$_POST[post_id]");
    } catch (PDOException $e) {
        $error = 'Databaser error: ' . $e->getMessage();
    }

    include "../views/layout.html.php";
?>