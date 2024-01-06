<?php 
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];

    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //SET IS_FEATURED TO 0(ZERO) IF UNCHECKED

    $is_featured = $is_featured == 1 ?: 0;

    //VALIDATE FORM DATA

    if(!$title){
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select post category";
    }elseif (!$body) {
        $_SESSION['add-post'] = "Enter post body";
    }elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choose post thumbnail";
    }else {
        //WORK ON THUMBNAIL
        //RENAME THE IMAGE

        $time = time(); //make image unique
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        //make sure file is an image

        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $thumbnail_name);
        $extention = end($extention); // to get the end of the array from the image
        if(in_array($extention, $allowed_files)) {
            //to make sure image is not too large(2mb+)
            if($thumbnail['size'] < 2000000) {
            //UPLOAD THUMNAIL
            move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
    }else {
        $_SESSION['add-post'] =  "File size too big. Should be less than 2mb";
            }
        } else{
            $_SESSION['add-post'] = "File should be png, jpg, or jpeg";
        }
    }

    //REDIRECT BACK WITH FORM DATA TO ADD_POST PADE IF ERROR OCCUR

    if(isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_post.php');
        die();
    } else {
          //SET IS_FEATURED OF ALL POST TO 0 IF IS_FEATURED FOT A POST IS 1
          $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES 
          ('$title', '$body', '$thumbnail_name', $category_id, $author_id, $is_featured)";
          $result = mysqli_query($connection,$query);

          if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New post added successfully!";
            header('location: ' . ROOT_URL . 'admin/');
            die();
          }
    }
}

header('location: ' . ROOT_URL . 'admin/add_post.php');
die();
?>