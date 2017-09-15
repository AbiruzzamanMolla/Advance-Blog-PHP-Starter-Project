<?php include "includes/admin_header.php"; ?>

<div id="wrapper">


    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>
    <!-- /.navbar-collapse -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome
                        <?php echo $_SESSION['username'];?>
                        <small>(<?php echo $_SESSION['user_role'];?>)</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $all_post_count = mysqli_query($connection, $query);
                                    $post_count = mysqli_num_rows($all_post_count);
                                    echo "<div class='huge'>{$post_count}</div>";
                                    ?>
                                        <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $all_comments_count = mysqli_query($connection, $query);
                                    $comments_count = mysqli_num_rows($all_comments_count);
                                    echo "<div class='huge'>{$comments_count}</div>";
                                    ?>
                                        <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $all_users_count = mysqli_query($connection, $query);
                                    $users_count = mysqli_num_rows($all_users_count);
                                    echo "<div class='huge'>{$users_count}</div>"; ?>
                                        <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $all_categories_count = mysqli_query($connection, $query);
                                    $categories_count = mysqli_num_rows($all_categories_count);
                                    echo "<div class='huge'>{$categories_count}</div>";
                                    ?>
                                        <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
<?php 

    $query = "SELECT * FROM posts WHERE post_status = 'publish' ";
    $select_all_published_posts = mysqli_query($connection,$query);
    $post_published_count = mysqli_num_rows($select_all_published_posts);
                                                                  
    $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
    $select_all_draft_posts = mysqli_query($connection,$query);
    $post_draft_count = mysqli_num_rows($select_all_draft_posts);

    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
    $unapproved_comments_query = mysqli_query($connection,$query);
    $unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);

    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
    $select_all_subscribers = mysqli_query($connection,$query);
    $subscriber_count = mysqli_num_rows($select_all_subscribers);

?>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Counts'],
          ['All Posts', <?php echo $post_count; ?>],
          ['Active Posts', <?php echo $post_published_count; ?>],
          ['Draft Posts', <?php echo $post_draft_count; ?>],
          ['Comments', <?php echo $comments_count; ?>],
          ['Pending Comments', <?php echo $unapproved_comment_count; ?>],
          ['Users', <?php echo $users_count; ?>],
          ['Subscriber', <?php echo $subscriber_count; ?>],
          ['Categories', <?php echo $categories_count; ?>]
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            
</div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



<?php include "includes/admin_footer.php" ?>
