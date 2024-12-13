<?php
    session_start();
    include '../utils/checkUserLogin.php';

    if (isset($_POST['title'])) {
        // POST method
        try {
            $imgUrl = null;
            if (!empty($_FILES['image']['tmp_name'])) {
                // User did upload an image
                include '../utils/uploadImage.php';
                $imgUrl = $target_file;    
            }

            include '../models/post.php';
            updatePost($_POST['id'], $_POST['title'], $_POST['content'], $GLOBALS['imgUrl'], $_POST['module_id'], $user['id']);
            header('location: home.php');
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
        catch (Exception $e) {
            $error = 'Server Error: ' . $e->getMessage();
        }
    }

    // GET method
    try {
        include '../models/module.php';
        $modules = getAllModules();

        include '../models/post.php';
        $post = getPost();

        ob_start();
        include "../views/editpost.html.php";
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    $title = 'Edit Post';
    include "../views/layout.html.php";
?>