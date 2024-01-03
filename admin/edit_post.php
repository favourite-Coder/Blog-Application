<?php
include 'partials/header.php';

?>


<!-----EDIT POST----->
<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit Post</h2>

        <form action="">

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
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" id="thumbnail">
            </div>
            <button type="submit" class="btn">Update Post</button>

        </form>
    </div>
</section>
<!-----EDIT POST ENDS---->

<?php
include '../partials/footer.php';

?>