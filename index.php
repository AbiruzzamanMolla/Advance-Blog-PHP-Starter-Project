<!-- Including Header PHP -->
<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "admin/includes/functions.php";?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            $per_page = 5;
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
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $post_query_count = "SELECT * FROM posts";
            } else {
                $post_query_count = "SELECT * FROM posts WHERE post_status = 'publish'";
            }
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);
            if($count < 1){
                echo "<center><div class='alert alert-info'><strong>Sorry!</strong> No post abilable.....</div></center>";
            }
            else {
            $count = ceil($count / 5);
            $query = "SELECT * FROM posts ORDER BY post_id DESC  LIMIT $page_1,$per_page";
            $select_all_posts_query = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_tags = $row['post_tags'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,100);
                $post_status = $row['post_status'];
?>
                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <?php echo $post_title; ?> </a>
                    </h2>
                    <p class="lead"> by
                        <a href="author_post.php?author=<?php echo $post_author; ?>">
                            <?php echo $post_author; ?>  </a> <span>
                            <?php //select interest based on comma and generet random classs
                                    $tags = $post_tags;
                                    $tags = explode(',',$tags);
                                    foreach ($tags as $tag) {
                                        $classes = array('primary','default','success','info','warning','danger','default','success','info','warning','danger','primary','default','success');
                                        $class = array_rand($classes);
                                        echo "<span class='label label-$classes[$class]'>$tag</span>";
                                    }
                            ?>

                            </span>
                       
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
                    <?php } }
                      ?>
                    <!-- Pager -->
                    <center>
                        <ul class="pagination pagination-lg">
                            <?php
                    for($i = 1; $i <= $count; $i++){
                        if($i == $page){
                            echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
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
