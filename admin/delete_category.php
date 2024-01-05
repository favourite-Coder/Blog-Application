<?php
require 'config/database.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);



    //FOR LATER
    //UPDATE CATEGORY_id OF POSTS THAT BELONG TO THE DELETED CATEGORY INTO UNCATEGORIZED






    //DELETE CATEGORY
    $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);
    if($result) {
        $_SESSION['delete-category-success'] = "Category deleted successfully.";
    } else {
        $_SESSION['delete-category'] = "Failed to delete category.";
    }
}
header('location: ' . ROOT_URL . 'admin/manage_categories.php');

die();
?>