"<?php
session_start();
require 'config/database.php';

//GET SIGNUP FORM DATA IF SUBMIT BUTTON CLICKED

if(isset($_POST['submit'])) {
   $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
   $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
   $avatar = $_FILES['avatar'];

   //VALIDATE INPUTS
   if(!$firstname) {
    $_SESSION['add-user'] = "Please enter your First Name";
   } elseif(!$lastname) {
    $_SESSION['add-user'] = "Please enter your Last Name";
   } elseif(!$username) {
    $_SESSION['add-user'] = "Please enter your Username";
   } elseif(!$email) {
    $_SESSION['add-user'] = "Please enter a valid email address";
   }elseif(strlen($createpassword) < 8 || strlen($confirmpassword)
    < 8) {
    $_SESSION['add-user'] = "Password should be 8+ characters";
   } elseif(!$avatar['name']) {
    $_SESSION['add-user'] = "Please add an avatar";
   } else {
    //CHECK IF PASSWORDS DON'T MATCH
    if($createpassword !== $confirmpassword) {
        $_SESSION['add-user'] = "Passwords do not match!";
    }else {
        // IF MATCHED THEN HASH PASSWORD
        $hashed_password = password_hash($createpassword,
        PASSWORD_DEFAULT);

        //CHECK IF USERNAME OR EMAIL ALREADY EXIST IN DATABASE
      $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
      $user_check_result = mysqli_query($connection, $user_check_query);
     if(mysqli_num_rows($user_check_result) > 0) {
        $_SESSION['add-user'] = "Username or email already exist";
     } else {

        //WORK ON AVATAR USING UNIQUE ELEMENT
        //RENAME AVATAR

        $time = time(); //make image unique
        $avatar_name = $time . $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_destination_path = '../images/' . $avatar_name;

        //make sure file is an image

        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $avatar_name);
        $extention = end($extention); // to get the end of the array from the image
        if(in_array($extention, $allowed_files)) {
            //to make sure image is not too large(1mb)
            if($avatar['size'] < 1000000) {
                //Upload avatar
                move_uploaded_file($avatar_tmp_name, $avatar_destination_path);


            }else {
                $_SESSION['add-user'] = "File size too big.
                Must be less than 1mb";
            } 
        } else {
            $_SESSION['add-user'] = "File MUST  be png, jpg, jpeg";
        }
     }
    }
   }
   //REDIRECT BACK TO SIGNUP PAGE IF ANY REQUIREMENT NOT MET

   if(isset($_SESSION['add-user'])) {
    // Pass form data back to signup page
    $_SESSION['add-user-data'] = $_POST;
    header('location: ' . ROOT_URL . '/admin/add_user.php');
    die();

    } else {
        //insert new user into users table
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, 
        avatar, is_admin) VALUES('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', '$is_admin')";
        //$insert_user_query = "INSERT INTO users firstname='$firstname', lastname='$lastname', username='$username', email='$email', 
        //password='$hashed_password', avatar='$avatar_name', is_admin=0 ";  THIS CAN BE USED TOO
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if(!mysqli_errno($connection)) {
            // REDIRECT TO LOGIN PAGE WITH SUCCESS MESSAGE

            $_SESSION['add-user-success'] = "Ner user $firstname $lastname added successfully!";
            header('location: ' . ROOT_URL . 'admin/manage_users.php');
            die();
        }
    }
    
}else {
        //WHEN add-user FORM BUTTON NOT CLICKED
   header('location: ' . ROOT_URL . 'admin/add_user.php');
   die();
}