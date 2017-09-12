<?php
if(isset($_GET['show_msg'])){
    $rmsg_id = $_GET['show_msg'];
}

 include "delete_popup.php";
if(isset($_SESSION['username'])){
    $s_username = $_SESSION['username'];
}
 $query = "SELECT * FROM user_inbox WHERE msg_id = $rmsg_id";
$select_post_by_id = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($select_post_by_id)){
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
        $query = "UPDATE user_inbox SET ";
        $query .= "msg_reply = '{$msg_reply}', ";
        $query .= "msg_reply_status = 'Replied', ";
        $query .= "msg_reply_date = '{$msg_reply_date}'";
        $query .= " WHERE msg_id = {$msg_id}";
        $reply_query = mysqli_query($connection, $query);
        if(!$reply_query){ die('Failed'. mysqli_error($connection)); }
        if($msg_reply !== ''){
            $query = "INSERT INTO `user_inbox` (`msg_sender_id`, `msg_sender`, `msg_author_id`, `msg_author`, `msg_subject`, `msg_content`, `msg_date`) VALUES ($msg_sender_id, '{$msg_sender}', $msg_author_id, '{$msg_author}', '{$msg_reply_subject}', '{$msg_reply}','{$msg_reply_date}')";
            $msg_reply_query = mysqli_query($connection, $query);
            if(!$msg_reply_query){
                die('Failed'. mysqli_error($connection));
            } } } } ?>
    <table class="table table-bordered table-striped table-hover" width="100%">
        <thead>
            <tr>
                <th width='90%'>Message</th>
                <th width='10%'>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td height='200px'>
                     <div class="form-group">
                                        <label for="msg_author"><span class="glyphicon glyphicon-user"></span> From: </label>
                                        <input class="form-control" value="<?php echo $msg_sender; ?>" name="msg_author" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="msg_author"><span class="glyphicon glyphicon-user"></span> To: </label>
                                        <input class="form-control" value="<?php echo $msg_author; ?>" name="msg_author" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="msg_subject"><span class="glyphicon glyphicon-user"></span> Subject: </label>
                                        <input class="form-control" name="msg_subject" value="<?php echo $msg_subject; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="msg_content"><span class="glyphicon glyphicon-user"></span> Message: </label>
                                        <textarea class="form-control" name="msg_content" id="body" cols="50" rows="10" disabled><?php echo $msg_content; ?></textarea>
                                    </div>
                </td>
                <td><a rel='<?php echo $rmsg_id; ?>' class='btn btn-danger delete_link' href='javascript:void(0)'>Delete</a></td>
            </tr>
            <tr>
                <td>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="msg_reply"><span class="glyphicon glyphicon-user"></span> Reply: </label>
                            <textarea class="form-control" name="msg_reply" id="body" cols="20" rows="10"></textarea>
                        </div>
                        <input type="hidden" name="msg_id" value="<?php echo $rmsg_id; ?>">
                        <input type="hidden" name="msg_sender_id" value="<?php echo $msg_sender_id; ?>">
                        <input type="hidden" name="msg_sender" value="<?php echo $msg_sender; ?>">
                        <input type="hidden" name="msg_author" value="<?php echo $msg_author; ?>">
                        <input type="hidden" name="msg_author_id" value="<?php echo $msg_author_id; ?>">
                        <input type="hidden" name="msg_subject" value="<?php echo $msg_subject; ?>">
                        <td>
                            <input type="submit" name="submit" class="btn btn-success btn-block" value="Reply"> </form>
                    </td>
            </tr>
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
