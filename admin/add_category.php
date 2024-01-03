<?php
include 'partials/header.php';

?>

<!-----ADD CATEGORY----->
<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Category</h2>
        <div class="alert_message error">
            <p>An error occurred</p>
        </div>
        <form action="" enctype="multipart/form-data">

            <input type="text" placeholder="Title">
            <textarea rows="4" placeholder="Description"></textarea>

            <button type="submit" class="btn">Add Category</button>

        </form>
    </div>
</section>
<!-----ADD CATEGORY ENDS---->

<?php
include '../partials/footer.php';

?>