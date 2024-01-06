<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // FETCH POST FROM DATABASE TO DELETE THUMBNAIL FROM IMAGES FOLDER
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);

    // MAKE SURE ONLY ONE RECORD/POST WAS FETCHED
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);

            // DELETE POST FROM DATABASE
            $delete_post_query = "DELETE FROM posts WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($connection, $delete_post_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-post-success'] = "Post deleted successfully";
            }
        }
    }
}
header('location: ' . ROOT_URL . 'admin/');
