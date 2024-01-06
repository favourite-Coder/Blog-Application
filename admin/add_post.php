<?php
include 'partials/header.php';

//FETCH CATEGORY FROM DATABASE

$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

?>


<!-----ADD POST----->
<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Post</h2>
        <div class="alert_message error">
            <p>An error occurred</p>
        </div>
        <form action="<?= ROOT_URL ?>admin/add_post_logic.php" enctype="multipart/form-data" method="POST">

            <input type="text" name="title" placeholder="Title">
            <select name="category">
                <!----LOOP THROUGH AND DISPLAY CATEGORY FROM DATABASE----->
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"></textarea>
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