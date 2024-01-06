<?php
include 'partials/header.php';

//FETCH POST FROM DATABASE IF ID IS SET
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}

?>

 <!-------SINGLE POST---------->

 <section class="singlepost">
    <div class="container singlepost_container">
        <h2><?= $post['title'] ?></h2>
        <div class="post_author">
                    <?php
                    //FETCH AUTHOR FROM USERS TABLE USING AUTHOR_ID
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                        <div class="post_author-avatar">
                            <img src="./images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post_author-info">
                        <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                            <?php
                            // Assuming $featured['date_time'] contains the timestamp
                            $timestamp = strtotime($post['date_time']);
                            $current_time = time();
                            $time_difference = $current_time - $timestamp;

                            if ($time_difference < 60) {
                                $output = "Just now";
                            } elseif ($time_difference < 3600) {
                                $minutes = floor($time_difference / 60);
                                $output = ($minutes == 1) ? "1 minute ago" : $minutes . " minutes ago";
                            } elseif ($time_difference < 86400) {
                                $hours = floor($time_difference / 3600);
                                $output = ($hours == 1) ? "1 hour ago" : $hours . " hours ago";
                            } elseif ($time_difference < 604800) {
                                $days = floor($time_difference / 86400);
                                $output = ($days == 1) ? "1 day ago" : $days . " days ago";
                            } elseif ($time_difference < 2592000) {
                                $weeks = floor($time_difference / 604800);
                                $output = ($weeks == 1) ? "1 week ago" : $weeks . " weeks ago";
                            } else {
                                $months = floor($time_difference / 2592000);
                                $output = ($months == 1) ? "1 month ago" : $months . " months ago";
                            }

                            $formattedDate = date("M d, Y - H:i", $timestamp);
                            ?>

                            <small>
                                <?= $output ?>.<br> <?= $formattedDate ?>
                            </small>

                        </div>
                    </div>
        <div class="singlepost_thumbnail">
            <img src="./images/<?= $post['thumbnail'] ?>">
        </div>
        <div class="post_info">
                    <?php
                    // FETCH CATEGORY FROM CATEGORIES TABLE USING CATEGORY_ID
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    ?>

                    <a href="<?= ROOT_URL ?>category_posts.php?id=<?= $post['category_id'] ?>" class="category_button">
                    <?= $category['title'] ?></a>
                    <p class="post_body">
                        <?= $post['body'] ?>
                    </p>
    </div>

 </section>
     <!-------END OF SINGLEPOST---------->

     <?php
include 'partials/footer.php';

?>