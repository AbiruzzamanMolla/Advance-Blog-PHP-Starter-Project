<?php include "includes/user_header.php";

?>
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
                        <li> <i class="fa fa-dashboard"></i> <a href="index.php">Deshboard</a> </li>
                        <li class="active"> <i class="fa fa-file"></i> View Comments</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <script>
                    $(document).ready(function() {
                        $('[data-toggle="popover"]').popover();
                    });

                </script>
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Posted in</th>
                            <th>Date</th>
                            <th>Admin Reply Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_SESSION['username'])){
                            $s_username = $_SESSION['username'];
                        }
                        $query = "SELECT * FROM comments WHERE comment_author = '{$s_username}' ORDER BY comment_id DESC";
                        $select_comments = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select_comments)){
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_content = $row['comment_content'];
                            $comment_email = $row['comment_email'];
                            $comment_status = $row['comment_status'];
                            $comment_reply = $row['comment_reply'];
                            $comment_date = $row['comment_date'];
                            $comment_content = filter_var($comment_content, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                            $comment_srt_content = substr($row['comment_content'],0,70);

                            echo "<tr>";
                            echo "<td>$comment_id</td>";
                            if($comment_content == $comment_srt_content){
                                echo "<td>$comment_srt_content</td>";
                            } else {
                                echo "<td><p>$comment_srt_content <a title='Full Message' data-toggle='popover' data-trigger='hover' data-content='$comment_content'>.....</a></p></td>";
                            }

                            echo "<td>$comment_status</td>";
                            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                            $select_post_id_query = mysqli_query($connection,$query);
                            if(!$select_post_id_query){
                                die('Query Failed' . mysqli_error($connection));
                            }
                            while($row = mysqli_fetch_assoc($select_post_id_query)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];

                                echo  "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                            }
                            echo  "<td>$comment_date</td>";

                            if($comment_reply !== ''){
                                echo  "<td>Yes</td>";
                            } else {
                                echo  "<td>No</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include "includes/user_footer.php" ?>
