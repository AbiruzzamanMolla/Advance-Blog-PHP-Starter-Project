<!-- Including Header PHP -->
<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "admin/includes/functions.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            $per_page = 10;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
                } else {
                    $page = "";
                }

            if($page == "" || $page == 1){
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }


            ?>
                <?php
                if(isset($_GET['category'])){
                $the_category = $_GET['category'];

                if(is_admin($_SESSION['username'])){
                    $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? ORDER BY post_id DESC LIMIT ? , ?");
                } else {
                    $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ORDER BY post_id DESC LIMIT ? , ?");
                    $publish = 'publish';
                }

                if(isset($stmt1)){
                    mysqli_stmt_bind_param($stmt1, "iii", $the_category, $page_1, $per_page);
                    mysqli_stmt_execute($stmt1);
                    mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
                    $stmt = $stmt1;

                } else {
                    mysqli_stmt_bind_param($stmt2, "isii", $the_category , $publish, $page_1, $per_page);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
                    $stmt = $stmt2;
                }

                $count = mysqli_stmt_num_rows($stmt);
               
                $count = ceil($count / 5);

                while(mysqli_stmt_fetch($stmt)):

            ?>
                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <?php echo $post_title; ?> </a>
                    </h2>
                    <p class="lead"> by
                        <a href="author_post.php?author=<?php echo $post_author; ?>">
                            <?php echo $post_author; ?>
                        </a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on
                        <?php echo $post_date; ?>
                    </p>
                    <hr> <img class="img-responsive" src="images/post_pic/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p>
                        <?php echo $post_content; ?>
                    </p> <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
                    <?php endwhile; mysqli_stmt_close($stmt); } else {
                        redirect("index.php");
            } ?>
                    <!-- Pager -->
                    <center>
                        <ul class="pagination pagination-lg">
                            <?php
                    for($i = 1; $i <= $count; $i++){
                        if($i == $page){
                            echo "<li class='active'><a href='category.php?page={$i}&category={$the_category}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='category.php?page={$i}&category={$the_category}'>{$i}</a></li>";
                        }

                    }
                    ?>
                        </ul>
                    </center>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
    <hr>
    <!-- Including Footer PHP -->
    <?php include "includes/footer.php"; ?>
