<?php
include 'partials/header.php';

?>


<!-----ADD POST----->
<section class="form_section">
    <div class="container form_section-container">
        <h2>Add Post</h2>
        <div class="alert_message error">
            <p>An error occurred</p>
        </div>
        <form action="" enctype="multipart/form-data">

            <input type="text" placeholder="Title">
            <textarea rows="10" placeholder="Body"></textarea>
            <select>
                <option value="1">Love</option>
                <option value="1">Nature</option>
                <option value="1">Tech</option>
                <option value="1">survival</option>
                <option value="1">Tech</option>
                <option value="1">Nature</option>
            </select>
            <div class="form_control inline">
                <input type="checkbox" id="is_featured" checked>
                <label for="is_featured">Featured</label>
            </div>
            <div class="form_control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" id="thumbnail">
            </div>
            <button type="submit" class="btn">Add Post</button>

        </form>
    </div>
</section>
<!-----ADD POST ENDS---->

<?php
include '../partials/footer.php';

?>