<?php
include 'partials/header.php';
//GET BACK FORM DATA IF INVALID
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

//RESET
unset($_SESSION['add-category-data']);
?>

?>

<!-----ADD CATEGORY----->
<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Category</h2>
<!--//ADD CATEGORY ERROR MESSAGE-->
    <?php if (isset($_SESSION['add-category'])) : //shows if add category not successful ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['add-category'];
                //DELETE AFER EXECUTING
                unset($_SESSION['add-category']);
                ?>
            </p>
        </div>
    <?php endif ?>
            
        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">

            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <textarea rows="4" name="description" placeholder="Description"><?= $description ?></textarea>

            <button type="submit" name="submit" class="btn">Add Category</button>

        </form>
    </div>
</section>
<!-----ADD CATEGORY ENDS---->

<?php
include '../partials/footer.php';

?>