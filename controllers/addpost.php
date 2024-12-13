<?php
    session_start();
    include '../utils/checkUserLogin.php';

    if (isset($_POST['title'])) {
        // POST method
        try {
            if (!empty($_FILES['image']['tmp_name'])) {
                // User did upload an image
                include '../utils/uploadImage.php';
                $imgUrl = $target_file;    
            }
        
            include '../models/post.php';
            addPost($_POST['title'], $_POST['content'], $GLOBALS['imgUrl'], $_POST['module_id'], $user['id']);
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

        ob_start();
        include "../views/addpost.html.php";
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }

    $title = 'Add Post';
    include "../views/layout.html.php";
?>