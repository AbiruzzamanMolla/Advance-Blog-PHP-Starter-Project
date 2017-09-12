<?php include "delete_popup.php"; ?>
    <!-- Modal -->
    <?php
if(isset($_POST['submit'])){
    $comment_reply = $_POST['comment_reply'];
    $comment_id = $_POST['comment_id'];
    date_default_timezone_set("Asia/Dhaka");
    $comment_reply_date = date('D, F d, Y - h:i:s A');

    $query = "UPDATE comments SET ";
    $query .= "comment_reply = '{$comment_reply}', ";
    $query .= "comment_reply_date = '{$comment_reply_date}'";
    $query .= " WHERE comment_id = {$comment_id}";

    $reply_query = mysqli_query($connection, $query);
    if(!$reply_query){
        die('Failed'. mysqli_error($connection));
    }

}
?>
        <script>
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover();
            });
        </script>
        <div class="modal fade" id="myReplyModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4><span class="glyphicon glyphicon-lock"></span> Reply: </h4> </div>
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" action="" method="post">
                            <div class="form-group">
                                <label for="comment_reply"><span class="glyphicon glyphicon-user"></span> Message: </label>
                                <textarea class="form-control" name="comment_reply" id="body" cols="50" rows="10"></textarea>
                            </div>
                            <input type="hidden" name="comment_id" class="reply_comment_id" value="">
                            <input type="submit" name="submit" class="btn btn-success btn-block" value="Responce"> </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>In Responce to</th>
                    <th>Date</th>
                    <th>Reply</th>
                    <th>Change Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
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
            $post_query_count = "SELECT * FROM comments";
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count / 5);

        $query = "SELECT * FROM comments ORDER BY comment_id DESC  LIMIT $page_1,$per_page";
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
            echo "<td>$comment_author</td>";
            if($comment_content == $comment_srt_content){
                echo "<td>$comment_srt_content</td>";
            } else {
                echo "<td><p>$comment_srt_content <a title='Full Message' data-toggle='popover' data-trigger='hover' data-content='$comment_content'>.....</a></p></td>";
            }




            echo "<td>$comment_email</td>";
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
                echo  "<td><a title='Reply' data-toggle='popover' data-trigger='hover' data-content='$comment_reply' rel='$comment_id' class='btn btn-info reply_comment_link' id='myBtn' href='javascript:void(0)'>Update</a></td>";
            } else {
                echo  "<td><a rel='$comment_id' class='btn btn-info reply_comment_link' href='javascript:void(0)'>Reply</a></td>";
            }

            if($comment_status == 'approve'){
                echo  "<td><a class='btn btn-warning' href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            } elseif($comment_status == 'unapproved'){
                echo  "<td><a class='btn btn-success' href='comments.php?approve={$comment_id}'>Approve</a></td>";
            }
            echo  "<td><a rel='$comment_id' class='btn btn-danger delete_link' href='javascript:void(0)'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
        <center>
            <ul class="pagination pagination-lg">
                <?php
                    for($i = 1; $i <= $count; $i++){
                        if($i == $page){
                            echo "<li class='active'><a href='comments.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='comments.php?page={$i}'>{$i}</a></li>";
                        }

                    }
                    ?>
            </ul>
        </center>
        <?php
if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection, $query);
    header('Location: comments.php');
}

if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection, $query);
    header('Location: comments.php');
}

if(isset($_GET['delete'])){
    $the_comment_id = $_GET['delete'];
        if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
            $the_comment_id = mysqli_real_escape_string($connection, $the_comment_id);

            $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
            $delete_query = mysqli_query($connection, $query);
            header('Location: comments.php');
            }
        }
}
?>
            <script>
                $(document).ready(function () {
                    $(".delete_link").on('click', function () {
                        var id = $(this).attr("rel");
                        var delete_url = "comments.php?delete=" + id + " ";
                        $(".modal_delete_link").attr("href", delete_url);
                        $("#myModal").modal('show');
                    });
                });
            </script>
            <script>
                $(document).ready(function () {
                    $(".reply_comment_link").on('click', function () {
                        var id = $(this).attr("rel");
                        $(".reply_comment_id").attr("value", id);
                        $("#myReplyModal").modal('show');
                    });
                });
            </script>
