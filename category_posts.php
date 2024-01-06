<?php
include 'partials/header.php';

//FETCH POST FROM DATABASE IF ID IS SET
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}

?>

<!-------CATEGORY HEADER---------->

<header class="category_title">
<h2>
<?php
    // FETCH CATEGORY FROM CATEGORIES TABLE USING CATEGORY_ID
    $category_id = $id;
    $category_query = "SELECT * FROM categories WHERE id=$id";
    $category_result = mysqli_query($connection, $category_query);
    $category = mysqli_fetch_assoc($category_result);
    echo $category['title'];
    ?>
</h2>
</header>


<!-------CATEGORY HEADER ENDS---------->

<?php if(mysqli_num_rows($posts) > 0) : ?>
<section class="posts">
    <div class="container posts_container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post_thumbnail">
                    <img src="./images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post_info">
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
<?php else : ?>
    <div class="alert_message error lg">
    <p>No posts found for this category</p>
    </div>
    <?php endif ?>
<!-------POSTS ENDS---------->





<!-------CATEGORY BUTTONS STARTS---------->
<section class="category_buttons">
    <div class="container category_button-container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category_posts.php?id=<?= $category['id'] ?>" class="category_button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
<!-------CATEGORY BUTTONS ENDS---------->

<?php
include 'partials/footer.php';

?>