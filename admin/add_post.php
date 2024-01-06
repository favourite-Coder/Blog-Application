<?php
include 'partials/header.php';

//FETCH CATEGORY FROM DATABASE

$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

//GET BACK FORM DATA IF FORM IS INVALID

$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

//DELETE AFTER USAGE
unset($_SESSION['add-post-data']);
?>


?>


<!-----ADD POST----->
<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Post</h2>
         <!--/ EDIT POST ERROR MESSAGE-->
         <?php if (isset($_SESSION['add-post'])) : //shows if edit post was NOT successful 
    ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['add-post'];
                //DELETE AFER EXECUTING
                unset($_SESSION['add-post']);
                ?>
            </p>
        </div>
    <?php endif ?>

        <form action="<?= ROOT_URL ?>admin/add_post_logic.php" enctype="multipart/form-data" method="POST">

            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <select name="category">
                <!----LOOP THROUGH AND DISPLAY CATEGORY FROM DATABASE----->
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"><?= $body ?></textarea>
            <!---CHECK IF A USER IS AN ADMIN TO DISPLAY IS_FEATURED--->
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
            <div class="form_control inline">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                <label for="is_featured">Featured</label>
            </div>
            <?php endif ?>
            <div class="form_control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>

        </form>
    </div>
</section>
<!-----ADD POST ENDS---->

<?php
include '../partials/footer.php';

?>