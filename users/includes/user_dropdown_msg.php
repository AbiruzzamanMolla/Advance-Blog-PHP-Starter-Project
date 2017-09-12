<?php
if(isset($_SESSION['username'])){
    $s_username = $_SESSION['username'];
}
// counting all msg
$msg_count_query = "SELECT * FROM user_inbox WHERE msg_author = '{$s_username}' ";
$find_count = mysqli_query($connection, $msg_count_query);
$count_all_msg = mysqli_num_rows($find_count);

$msg_count_query = "SELECT * FROM user_inbox WHERE msg_author = '{$s_username}' AND msg_reply_status = 'Unreplied' ";
$find_count = mysqli_query($connection, $msg_count_query);
$count_unreplied_msg = mysqli_num_rows($find_count);

?>
    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b> <?php if($count_unreplied_msg !== 0){ echo "<small><span class='badge'>".$count_unreplied_msg."</span></small>"; } ?> </a>
        <ul class="dropdown-menu message-dropdown">
            <?php
            $query = "SELECT * FROM user_inbox WHERE msg_author = '{$s_username}' ORDER BY msg_id DESC LIMIT 5";
        $select_msg = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_msg)){
            $msg_id = $row['msg_id'];
            $msg_sender_id = $row['msg_sender_id'];
            $msg_sender = $row['msg_sender'];
            $msg_author_id = $row['msg_author_id'];
            $msg_author = $row['msg_author'];
            $msg_content = $row['msg_content'];
            $msg_content = filter_var($msg_content, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $msg_sort_content = substr($row['msg_content'],0,100);
            $msg_date = $row['msg_date'];
            $msg_reply = $row['msg_reply'];
            $msg_reply_status = $row['msg_reply_status'];
            $msg_reply_date = $row['msg_reply_date'];

            echo "<li class='message-preview'>
                <a href='user_inbox.php?source=view_msg&show_msg={$msg_id}'>
                    <div class='media'> <span class='pull-left'>
                        <img class='media-object' src='../images/user_pic/img_avatar1.png' alt='alt' style='width:60px;height:60px;'>
                    </span>
                        <div class='media-body'>
                            <h5 class='media-heading'>
                                <strong>{$msg_sender}</strong>
                            </h5>
                            <p class='small text-muted'><i class='fa fa-clock-o'></i> {$msg_date} <small>({$msg_reply_status})</small> </p>
                            <p> {$msg_sort_content} ... </p>
                        </div>
                    </div>
                </a>
            </li>";
            } ?>
                <li class="message-footer"> <a href="../users/user_inbox.php">Read All Messages<b class='pull-right'><span class='badge'> <?php echo $count_unreplied_msg."/".$count_all_msg; ?></span></b></a> </li>
        </ul>
    </li>
