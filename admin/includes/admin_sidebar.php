
<?php
// counting draft posts
$post_count_query = "SELECT * FROM posts WHERE post_status = 'draft' ";
$find_count = mysqli_query($connection, $post_count_query);
$count_dpost = mysqli_num_rows($find_count);
// counting all posts
$post_count_query = "SELECT * FROM posts";
$find_count = mysqli_query($connection, $post_count_query);
$count_allpost = mysqli_num_rows($find_count);
// counting all categorys
$categories_count_query = "SELECT * FROM categories";
$find_count = mysqli_query($connection, $categories_count_query);
$count_categories = mysqli_num_rows($find_count);
// counting unapproved comments
$comment_count_query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
$find_count = mysqli_query($connection, $comment_count_query);
$count_upcomments = mysqli_num_rows($find_count);
// counting all comments
$comment_count_query = "SELECT * FROM comments";
$find_count = mysqli_query($connection, $comment_count_query);
$count_allcomments = mysqli_num_rows($find_count);
// counting all users
$user_count_query = "SELECT * FROM users";
$find_count = mysqli_query($connection, $user_count_query);
$count_users = mysqli_num_rows($find_count);
?>


<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li> <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> </li>
        <li> <a href="javascript:;" data-toggle="collapse" data-target="#post_dropdown"><i class="fa fa-fw fa-clipboard"></i> Posts <i class="fa fa-fw fa-caret-down"></i> <small class='pull-right'><span class='badge'> <?php echo $count_dpost."/".$count_allpost; ?></span></small></a>
            <ul id="post_dropdown" class="collapse">
                <li> <a href="./posts.php">View Post</a> </li>
                <li> <a href="./posts.php?source=add_post">Add Post</a> </li>
            </ul>
        </li>
        <li> <a href="./categories.php"><i class="fa fa-fw fa-comments"></i> Category <small class='pull-right'><span class='badge'> <?php echo $count_categories; ?></span></small></a> </li>
        <li> <a href="comments.php"><i class="fa fa-fw fa-comments"></i> Comments <small class='pull-right'><span class='badge'> <?php echo $count_upcomments."/".$count_allcomments; ?></span></small></a> </li>
        <li><a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-user"></i>Users <i class="fa fa-fw fa-caret-down"></i> <small class='pull-right'><span class='badge'> <?php echo $count_users; ?></span></small></a>
            <ul id="users_dropdown" class="collapse">
                <li> <a href="./users.php">View Users</a> </li>
                <li> <a href="./users.php?source=add_user">Add Users</a> </li>
            </ul>
        </li>
        <li> <a href="./settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a> </li>
    </ul>
</div>
