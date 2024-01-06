<?php
require 'config/database.php';


//MAKE AURE EDIT POST BUTON WAS SUCCESSFUL


if(isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], 
    FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

   //SET IS_FEATURED TO 0 IF IT WAS UNCHECKED
   $is_featured = $is_featured == 1 ?: 0;

   //CHECK AND VALIDATE INPUT VALUES

   if (!$title) {
    $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
   }elseif (!$category_id) {
    $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
   }elseif (!$body) {
    $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
   } else {
     //DELETE EXISTING THUMBNAIL IF NEW THUMBNAIL IS AVAILABLE
     if($thumbnail['name']) {
        $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
        If ($previous_thumbnail_path) {
           unlink($previous_thumbnail_path);


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
        $_SESSION['edit-post'] =  "Could'nt update post. Thumbnail size too big. Should be less than 2mb";
            }
        } else{
            $_SESSION['edit-post'] = "Could'nt update post. Thumbnail should be png, jpg, or jpeg";
                }
            }
        }

 }
 if ($_SESSION['edit-post']) {
    //REDIRECT TO MANAGE FORM PAGE IF FORM IS INVALID

    header('location: ' . ROOT_URL . 'admin/');
    die();
 } else {
      //SET IS_FEATURED OF ALL POSTS TO 0 IF IS_FEATURED FOR THE POST IS 1

      if($is_featured == 1) {
        $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
        $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
      }

      //SET THUMBNAIL NMAE IF A NEW ONE WAS UPLAODED, ELSE KEEP THE OLD THUMBNAIL NAME
      $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

      $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', 
      category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
      $result = mysqli_query($connection, $query);
 }

 if(!mysqli_errno($connection)) {
    $_SESSION['edit-post-success'] = "Post updated successfully!";
      }
     }

   header('location: ' . ROOT_URL . 'admin/');
die();



?>