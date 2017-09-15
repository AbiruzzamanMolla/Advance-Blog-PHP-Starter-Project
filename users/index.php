<?php include "includes/user_header.php"; ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/user_navigation.php"; ?>
            <!-- /.navbar-collapse -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                <?php welcome(); ?>
                    </h1>
                            <ol class="breadcrumb">
                                <li> <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
                                <li class="active"> <i class="fa fa-file"></i> </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
<?php 

   if(isset($_SESSION['username'])){
       $un = $_SESSION['username'];
   }
    $query = "SELECT * FROM posts WHERE post_author = '{$un}' ";
    $select_all_posts = mysqli_query($connection,$query);
    $post_all_count = mysqli_num_rows($select_all_posts);
    
    $query = "SELECT * FROM posts WHERE post_author = '{$un}' AND post_status = 'publish' ";
    $select_all_published_posts = mysqli_query($connection,$query);
    $post_published_count = mysqli_num_rows($select_all_published_posts);
                                                                  
    $query = "SELECT * FROM posts WHERE post_status = 'draft' AND post_author = '{$un}' ";
    $select_all_draft_posts = mysqli_query($connection,$query);
    $post_draft_count = mysqli_num_rows($select_all_draft_posts);

    $query = "SELECT * FROM comments WHERE comment_status = 'approve' AND comment_author = '{$un}' ";
    $comments_query = mysqli_query($connection,$query);
    $comment_count = mysqli_num_rows($comments_query);

    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' AND comment_author = '{$un}' ";
    $unapproved_comments_query = mysqli_query($connection,$query);
    $unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);
   
?>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Counts'],
          ['All Posts', <?php echo $post_all_count; ?>],
          ['Active Posts', <?php echo $post_published_count; ?>],
          ['Draft Posts', <?php echo $post_draft_count; ?>],
          ['Comments', <?php echo $comment_count; ?>],
          ['Pending Comments', <?php echo $unapproved_comment_count; ?>]
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

    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
</div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include "includes/user_footer.php" ?>
