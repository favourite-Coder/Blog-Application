<?php
 // Session already started in constants.php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
//$password = $_SESSION['signin-data']['password'] ?? null;


unset($_SESSION['signin-data']);
?>

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
     <!-----SIGN In----->
<section class="form_section">
<div class="container form_section-container">
    <h2>Sign In</h2>

            <!----PASS THE SUCCESS MESSAGE-FROM signup-logic.php--->
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert_message success">
                    <p>
                   <?= $_SESSION['signup-success'];
                    //DELETE AFER EXECUTING
                    unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['signin'])) :  ?>
                 <!----PASS THE ERROR MESSAGE-FROM signup-logic.php--->
                <div class="alert_message error">
                    <p>
                   <?= $_SESSION['signin'];
                    //DELETE AFER EXECUTING
                    unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

    <form action="<?= ROOT_URL ?>signin_logic.php" enctype="multipart/form-data" method="POST">
       
        <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">
        <input type="password" name="password" placeholder="Password">

        <button type="submit" name="submit" class="btn">Sign In</button>
        <small>Don't have an account? 
            <a href="signup.php">Sign up</a></small>
    </form>
</div>
</section>
  <!-----SIGN IN-ENDS---->


</body>
</html>


   