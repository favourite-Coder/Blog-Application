<?php
include 'partials/header.php';

//FETCH CURRENT USER POSTs FROM THE DATABASE


$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id FROM posts 
WHERE author_id=$current_user_id ORDER BY id DESC";

$posts = mysqli_query($connection, $query);


?>


<!----------Manage Users------->
<section class="dashboard">
        <!--//ADD POST SUCCESS MESSAGE-->
 <?php if (isset($_SESSION['add-post-success'])) : //shows if add post  was successful ?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['add-post-success'];
                //DELETE AFER EXECUTING
                unset($_SESSION['add-post-success']);
                ?>
            </p>
        </div>
                <!--//EDIT POST SUCCESS MESSAGE-->
 <?php elseif (isset($_SESSION['edit-post-success'])) : //shows if edit post  was successful ?>
        <div class="alert_message success container">
            <p>
                <?= $_SESSION['edit-post-success'];
                //DELETE AFER EXECUTING
                unset($_SESSION['edit-post-success']);
                ?>
            </p>
        </div>

                        <!--//EDIT POST ERROR MESSAGE-->
 <?php elseif (isset($_SESSION['edit-post'])) : //shows if edit post  was NOT successful ?>
        <div class="alert_message error container">
            <p>
                <?= $_SESSION['edit-post'];
                //DELETE AFER EXECUTING
                unset($_SESSION['edit-post']);
                ?>
            </p>
        </div>
        <?php endif ?>

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

                <li><a href="index.php" class="active"><i class="uil uil-create-dashboard"></i>
                        <h5>Manage Post</h5>
                    </a></li>
                    <?php if(isset($_SESSION['user_is_admin'])) : ?>


                <li><a href="add_user.php"><i class="uil uil-user-plus"></i>
                        <h5>Add User</h5>
                    </a></li>

                <li><a href="manage_users.php"><i class="uil uil-users-alt"></i>
                        <h5>Manage User</h5>
                    </a></li>

                <li><a href="add_category.php"><i class="uil uil-folder-plus"></i>
                        <h5>Add Category</h5>
                    </a></li>

                <li><a href="manage_categories.php"><i class="uil uil-list-ul"></i>
                        <h5>Manage Categories</h5>
                    </a></li>
                    <?php endif ?>
            </ul>
        </aside>

        <main>
            <h2>Manage Users</h2>
            <!--IF NO POSTS FOUND-->
            <?php if(mysqli_num_rows($posts) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                     <!--LOOP THROUGH AND DISPLAY POSTS-->
                     <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                     <!--GET CATEGORY TITLE OF ECAH POST FROM CATEGORIES TABLE-->
                      <?php 
                          $category_id = $post['category_id'];
                          $category_query = "SELECT title FROM categories WHERE id=$category_id";
                          $category_result = mysqli_query($connection, $category_query);
                          $category = mysqli_fetch_assoc($category_result);

                         ?>
                    
                     <tr>
                        <td><?= $post['title'] ?></td>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit_post.php?id=<?= $post['id'] ?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete_post.php?id=<?= $post['id'] ?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <!--DISPLAY IF NO POSTS FOUND-->
            <?php else : ?>
                <div class="alert_message error"><?= "No posts found" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>

<!-----Manage Categories Ends--------->

<?php
include '../partials/footer.php';

?>
