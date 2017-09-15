<!-- Including Header PHP -->
<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
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
             $post_query_count = "SELECT * FROM posts";
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count / 5);
                if(isset($_POST['search_submit'])){
                    $search = $_POST['search'];
                }
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'  ORDER BY post_id DESC LIMIT $page_1,$per_page";
            $search_query = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($search_query)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
            ?>
                    <!-- First Blog Post -->
                    <h2>
                        <a href="#">
                            <?php echo $post_title; ?> </a>
                    </h2>
                    <p class="lead"> by
                        <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>">
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
                    </p>
                    <hr>
                    <?php } ?>
                    <!-- Pager -->
                    <center>
                        <ul class="pagination pagination-lg">
                            <?php
                    for($i = 1; $i <= $count; $i++){
                        if($i == $page){
                            echo "<li class='active'><a href='search.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='search.php?page={$i}'>{$i}</a></li>";
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
