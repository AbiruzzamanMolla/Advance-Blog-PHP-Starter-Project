<?php include "delete_popup.php";
if(isset($_SESSION['username'])){
    $s_username = $_SESSION['username'];
}
?>
<!-- Modal -->
<?php
if(isset($_POST['submit'])){
    $msg_reply = $_POST['msg_reply'];
    $msg_sender_id = $_POST['msg_author_id'];
    $msg_sender = $_POST['msg_author'];
    $msg_author_id = $_POST['msg_sender_id'];
    $msg_author = $_POST['msg_sender'];
    $msg_subject = $_POST['msg_subject'];
    $msg_reply_subject = $msg_subject;
    $msg_id = $_POST['msg_id'];
    date_default_timezone_set("Asia/Dhaka");
    $msg_reply_date = date('D, F d, Y - h:i:s A');

if($msg_reply !== ''){
    $query = "UPDATE user_inbox SET ";
    $query .= "msg_reply = '{$msg_reply}', ";
    $query .= "msg_reply_status = 'Replied', ";
    $query .= "msg_reply_date = '{$msg_reply_date}'";
    $query .= " WHERE msg_id = {$msg_id}";

    $reply_query = mysqli_query($connection, $query);
    if(!$reply_query){
        die('Failed'. mysqli_error($connection));
    }

    if($msg_reply !== ''){
        $query = "INSERT INTO `user_inbox` (`msg_sender_id`, `msg_sender`, `msg_author_id`, `msg_author`, `msg_subject`, `msg_content`, `msg_date`) VALUES ($msg_sender_id, '{$msg_sender}', $msg_author_id, '{$msg_author}', '{$msg_reply_subject}', '{$msg_reply}','{$msg_reply_date}')";

    $msg_reply_query = mysqli_query($connection, $query);
    if(!$msg_reply_query){
        die('Failed'. mysqli_error($connection));
    }
    }
} else {
    $query = "UPDATE user_inbox SET ";
    $query .= "msg_reply = '{$msg_reply}', ";
    $query .= "msg_reply_date = '', ";
    $query .= "msg_reply_status = 'Unreplied'";
    $query .= " WHERE msg_id = {$msg_id}";

    $reply_query = mysqli_query($connection, $query);
    if(!$reply_query){
        die('Failed'. mysqli_error($connection));
    }
} 
    

}
?>
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
        });

    </script>
    <table class="table table-bordered table-striped table-hover" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sender</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Date</th>
                <th>Reply</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $query = "SELECT * FROM user_inbox WHERE msg_author = '{$s_username}' ORDER BY msg_id DESC";
        $select_comments = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_comments)){
            $msg_id = $row['msg_id'];
            $msg_sender_id = $row['msg_sender_id'];
            $msg_sender = $row['msg_sender'];
            $msg_author_id = $row['msg_author_id'];
            $msg_author = $row['msg_author'];
            $msg_content = $row['msg_content'];
            $msg_subject = $row['msg_subject'];
            $msg_content = filter_var($msg_content, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $msg_sort_content = substr($row['msg_content'],0,100);
            $msg_date = $row['msg_date'];
            $msg_reply = $row['msg_reply'];
            $msg_reply_status = $row['msg_reply_status'];
            $msg_reply_date = $row['msg_reply_date'];
            ?>
                <div class="modal fade" id="myReplyModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="padding:35px 50px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4><span class="glyphicon glyphicon-lock"></span> Reply: </h4>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                                <form role="form" action="" method="post">
                                    <div class="form-group">
                                        <label for="msg_reply"><span class="glyphicon glyphicon-user"></span> Message: </label>
                                        <textarea class="form-control" name="msg_reply" id="body" cols="50" rows="10"></textarea>
                                    </div>
                                    <input type="hidden" name="msg_id" class="reply_msg_id" value="">
                                    <input type="hidden" name="msg_sender_id" value="<?php echo $msg_sender_id; ?>">
                                    <input type="hidden" name="msg_sender" value="<?php echo $msg_sender; ?>">
                                    <input type="hidden" name="msg_author" value="<?php echo $msg_author; ?>">
                                    <input type="hidden" name="msg_author_id" value="<?php echo $msg_author_id; ?>">
                                    <input type="hidden" name="msg_subject" value="<?php echo $msg_subject; ?>">
                                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Reply"> </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

            echo "<tr>";
            echo "<td width='5%'>$msg_id</td>";
            echo "<td><a href='../profile.php?user=$msg_sender'>$msg_sender</a></td>";
            echo "<td><a href='?source=view_msg&show_msg={$msg_id}'>$msg_subject</a></td>";
            echo "<td>$msg_reply_status</td>";
            echo  "<td>$msg_date</td>";

            if($msg_reply !== ''){
                echo  "<td><a title='Reply' data-toggle='popover' data-trigger='hover' data-content='$msg_reply' rel='$msg_id' class='btn btn-info reply_msg_link' id='myBtn' href='javascript:void(0)'>Update</a></td>";
            } else {
                echo  "<td><a rel='$msg_id' class='btn btn-info reply_msg_link' href='javascript:void(0)'>Reply</a></td>";
            }
            echo  "<td><a rel='$msg_id' class='btn btn-danger delete_link' href='javascript:void(0)'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
if(isset($_GET['delete'])){
    $the_msg_id = $_GET['delete'];
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] == $s_username){
            $the_msg_id = mysqli_real_escape_string($connection, $the_msg_id);

            $query = "DELETE FROM user_inbox WHERE msg_id = {$the_msg_id}";
            $delete_query = mysqli_query($connection, $query);
            header('Location: user_inbox.php');
        }
    }
}
?>
        <script>
            $(document).ready(function() {
                $(".delete_link").on('click', function() {
                    var id = $(this).attr("rel");
                    var delete_url = "user_inbox.php?delete=" + id + " ";
                    $(".modal_delete_link").attr("href", delete_url);
                    $("#myModal").modal('show');
                });
            });

        </script>
        <script>
            $(document).ready(function() {
                $(".reply_msg_link").on('click', function() {
                    var id = $(this).attr("rel");
                    $(".reply_msg_id").attr("value", id);
                    $("#myReplyModal").modal('show');
                });
            });

        </script>
