<?php
require 'config/database.php';
?> name=""


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog APP PHP & MYSQL</title>
    <!---CUSTOM CSS--->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <!---ICONSCOUT CDN--->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!---GOOGLE FONTS (POPPINS)--->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>

     <!-----SIGN UP----->
<section class="form_section">
<div class="container form_section-container">
    <h2>Sign Up</h2>
    <div class="alert_message error">
        <p>An error Occurrred</p>
    </div>
    <form action="<?= ROOT_URL ?>signup_logic.php" enctype="multipart/form-data" method="POST">
        <input type="text" name="firstname" placeholder="First Name">
        <input type="text" name="lastname" placeholder="Last Name">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="createpassword" placeholder="Create Password">
        <input type="password" name="confirmpassword" placeholder="Confirm Password">
        <div class="form_control">
            <label for="avatar">User Avatar</label>
            <input type="file" name="avatar" id="avatar">
        </div>
        <button type="submit" name="submit" class="btn">Sign Up</button>
        <small>Already have an account? 
            <a href="<?= ROOT_URL ?>signin.php">Sign In</a></small>
    </form>
</div>
</section>
  <!-----SIGN UP-ENDS---->


</body>
</html>


   