<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    //FETCH CURRENT USER INPUT BEFORE EDITING
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

} else {
    header('location: ' . ROOT_URL . 'admin/manage_users.php');
}

?>


<!-----EDIT USER----->
<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit User</h2>
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
         <!-----HIDDEN INPUT- bad idea for security wise---->
        <input type="hidden" value="<?= $user['id'] ?>" name="id">

            <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="First Name">
            <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Last Name">
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>


            <button type="submit" name="submit" class="btn">Update User</button>
        </form>


    </div>
</section>
<!-----EDIT USER ENDS---->

<?php
include '../partials/footer.php';

?>