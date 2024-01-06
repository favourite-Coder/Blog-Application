<?php
require 'config/database.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


    //FETCH USER FROM DATABASE
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);


    //MAKE SURE TO GET BACK ONLY ONE USER

    if(mysqli_num_rows($result) == 1){
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        //DELETE IMAGE IF AVAILABLE
        if($avatar_path) {
            unlink($avatar_path);
        }
    }

    //FOR LATER
    //FETCH ALL THUMBNAILS OF USER'S POSTS AND DELETE THEM
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if (mysqli_num_rows($thumbnails_result) > 0) {
        while ($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];

            //DELETE THUMBNAIL FROM IMAGES FOLDER IF IT EXISTS
            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }
    



    //DELETE USER FROM DATABASE
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if(mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Could'nt delete user {$user['firstname']} 
        {$user['lastname']} ";
    } else {
        $_SESSION['delete-user-success'] = "{$user['firstname']} 
        {$user['lastname']} deleted successfully. ";
    }

}

header('location: ' . ROOT_URL . 'admin/manage_users.php');
die();


?>