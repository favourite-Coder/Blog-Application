<?php
include 'partials/header.php';

?>
    <!----------Manage Users------->
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

                    <li><a href="add_user.php"><i class="uil uil-user-plus"></i>
                            <h5>Add User</h5>
                        </a></li>

                    <li><a href="manage_users.php" class="active"><i class="uil uil-users-alt"></i>
                            <h5>Manage User</h5>
                        </a></li>

                    <li><a href="add_category.php"><i class="uil uil-folder-plus"></i>
                            <h5>Add Category</h5>
                        </a></li>

                    <li><a href="manage_categories.php"><i class="uil uil-list-ul"></i>
                            <h5>Manage Categories</h5>
                        </a></li>
                </ul>
            </aside>

            <main>
                <h2>Manage Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sena Gabriel</td>
                            <td>Sena</td>
                            <td><a href="edit_category.php" class="btn sm">Edit</a></td>
                            <td><a href="delete_category.php" class="btn sm danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>

                        <tr>
                            <td>Willam Gift</td>
                            <td>Gify</td>
                            <td><a href="edit_category.php" class="btn sm">Edit</a></td>
                            <td><a href="delete_category.php" class="btn sm danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>

                        <tr>
                            <td>Kenny Black</td>
                            <td>DeBlack</td>
                            <td><a href="edit_category.php" class="btn sm">Edit</a></td>
                            <td><a href="delete_category.php" class="btn sm danger">Delete</a></td>
                            <td>No</td>
                        </tr>

                        <tr>
                            <td>George Bush</td>
                            <td>Bush</td>
                            <td><a href="edit_category.php" class="btn sm">Edit</a></td>
                            <td><a href="delete_category.php" class="btn sm danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>

                        <tr>
                            <td>Ernest White</td>
                            <td>White</td>
                            <td><a href="edit_category.php" class="btn sm">Edit</a></td>
                            <td><a href="delete_category.php" class="btn sm danger">Delete</a></td>
                            <td>No</td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </section>

    <!-----Manage Categories Ends--------->

    <?php
include '../partials/footer.php';

?>