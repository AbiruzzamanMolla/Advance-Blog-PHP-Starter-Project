<?php
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query  = "SELECT * FROM users WHERE username = '{$username}'";
    $get_senderinfo = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_senderinfo)){
        $msg_sender_id = $row['user_id'];
        $msg_sender = $row['username'];
    }

}
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];

    $query  = "SELECT * FROM users WHERE user_id = {$user_id}";
    $get_authorinfo = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($get_authorinfo)){
        $msg_author_id = $row['user_id'];
        $msg_author = $row['username'];
    }

}

    if(isset($_POST['submit'])) {
        $msg_sender_id = $_POST['msg_sender_id'];
        $msg_sender = $_POST['msg_sender'];
        $msg_author_id = $_POST['msg_author_id'];
        $msg_author = $_POST['msg_author'];
        $msg_subject = $_POST['msg_subject'];
        $msg_content = $_POST['msg_content'];
        date_default_timezone_set("Asia/Dhaka");
        $msg_date = date('D, F d, Y - h:i:s A');
        
         $query = "INSERT INTO `user_inbox` (`msg_sender_id`, `msg_sender`, `msg_author_id`, `msg_author`, `msg_subject`, `msg_content`, `msg_date`) VALUES ($msg_sender_id, '{$msg_sender}', $msg_author_id, '{$msg_author}', '{$msg_subject}', '{$msg_content}','{$msg_date}')";
        $send_msg_query = mysqli_query($connection, $query);
        if(!$send_msg_query){
            die('SQL connection Failed'. mysqli_error($connection));
        }

        $message = "<div class='alert alert-success center-block text-center'><center><strong>Success!</strong> Your message has been send. </center></div>";
    } else {
        $message = "";
    }
    ?>
            <?php echo $message; ?>

                     <form role="form" action="" method="post">
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
                                        <input class="form-control" name="msg_subject" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="msg_content"><span class="glyphicon glyphicon-user"></span> Message: </label>
                                        <textarea class="form-control" name="msg_content" id="body" cols="50" rows="10"></textarea>
                                    </div>
                                    <input type="hidden" name="msg_sender_id" value="<?php echo $msg_sender_id; ?>">
                                    <input type="hidden" name="msg_sender" value="<?php echo $msg_sender; ?>">
                                    <input type="hidden" name="msg_author" value="<?php echo $msg_author; ?>">
                                    <input type="hidden" name="msg_author_id" value="<?php echo $msg_author_id; ?>">
                                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Send Message"> </form>

