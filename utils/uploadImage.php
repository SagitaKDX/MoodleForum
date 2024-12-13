<?php
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $msg = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $errMsg = "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    // if (file_exists($target_file) && $uploadOk) {
    //     $errMsg = "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size
    // if ($_FILES["image"]["size"] > 500000 && $uploadOk) {
    //     $errMsg = "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $uploadOk) {
        $errMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        throw new Exception("Sorry, your file was not uploaded. This is why: " . $errMsg);
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        } else {
            throw new Exception("Sorry, your file was not uploaded.");
        }
    }
?>