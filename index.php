<?php
include 'partials/header.php';

//FETCH FEATURED POST FROM DATABASE

$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);


//FETCH 9 POST FOR HOME PAGE
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
$posts = mysqli_query($connection, $query);
?>


<!-------SHOW FEATURED POST IF THERE IS ANY---------->
<?php if (mysqli_num_rows($featured_result) == 1) : ?>
    <!-------FEATURED POST starts here---------->
    <section class="featured">
        <div class="container featured_container">
            <div class="post_thumbnail">
                <img src="./images/<?= $featured['thumbnail'] ?>">
            </div>
            <div class="post_info">
                <?php
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
                <a href="<?= ROOT_URL ?>category_posts.php?id=<?= $category['id'] ?>" class="category_button"><?= $category['title'] ?></a>
                <h2 class="post_title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post_body">
                    <?= substr($featured['body'], 0, 300) ?>...
                </p>
                <div class="post_author">
                    <?php
                    //FETCH AUTHOR FROM USERS TABLE USING AUTHOR_ID
                    $author_id = $featured['author_id'];
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
                        $timestamp = strtotime($featured['date_time']);
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
            </div>
        </div>
    </section>

<?php endif ?>
<!-------FEATURED POST ENDS---------->



<section class="posts">
    <div class="container posts_container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post_thumbnail">
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

                    <a href="<?= ROOT_URL ?>category_posts.php?id=<?= $post['category_id'] ?>" class="category_button"><?= $category['title'] ?></a>
                    <h3 class="post_title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
                    <p class="post_body">
                        <?= substr($post['body'], 0, 150) ?>...
                    </p>
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
                </div>
            </article>
        <?php endwhile ?>
    </div>
</section>
<!-------POSTS ENDS---------->



<!-------CATEGORY BUTTONS STARTS---------->
<section class="category_buttons">
    <div class="container category_button-container">
        <?php
          $all_categories_query = "SELECT * FROM categories";
          $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
        <a href="<?= ROOT_URL ?>category_posts.php?id=<?= $category['id'] ?>" 
        class="category_button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
<!-------CATEGORY BUTTONS ENDS---------->


<?php
include 'partials/footer.php';

?>