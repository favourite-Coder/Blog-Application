<?php
include 'partials/header.php';

// FETCH CATEGORIES FROM DATABASE

$query = "SELECT * FROM categories ORDER BY  title";   //YOU CAN ORDER BY ASCENDING OR DESCENDING = ASC | DESC
$categories = mysqli_query($connection, $query);

?>

<!----------Manage Categories------->
<section class="dashboard">
    <div class="container dashboard_container">

        <button id="show_sidebar-btn" class="sidebar_toogle">
            <i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toogle">
            <i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li><a href="add_post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a></li>

                <li><a href="index.php"><i class="uil uil-create-dashboard"></i>
                        <h5>Manage Post</h5>
                    </a></li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>

                    <li><a href="add_user.php"><i class="uil uil-user-plus"></i>
                            <h5>Add User</h5>
                        </a></li>

                    <li><a href="manage_users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage User</h5>
                        </a></li>

                    <li><a href="add_category.php"><i class="uil uil-folder-plus"></i>
                            <h5>Add Category</h5>
                        </a></li>

                    <li><a href="manage_categories.php" class="active"><i class="uil uil-list-ul"></i>
                            <h5>Manage Categories</h5>
                        </a></li>
                <?php endif ?>
            </ul>
        </aside>

        <main>
            <h2>Manage Categories</h2>
            <!--CHECK THE NUMBER OF INPUTS WE ARE GETTING is = 0-->
            <?php if (mysqli_num_rows($categories) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-----LOOP AND SHOW CATEGORIES AVAILABLE--------->
                        <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                            <tr>
                                <td><?= $category['title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit_category.php?id=<?= $category['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete_category.php?id=<?= $category['id'] ?>" class="btn sm danger">Delete</a></td>
                            </tr>
                            <!-----END WHILE LOOP--------->
                        <?php endwhile ?>

                    </tbody>
                </table>
                <!-----IF 0 DISPLAY THIS ERROR MESSAGE--------->
            <?php else : ?>
                <div class="alert_message error"><?= "No categories found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>

<!-----Manage Categories Ends--------->

<?php
include '../partials/footer.php';

?>