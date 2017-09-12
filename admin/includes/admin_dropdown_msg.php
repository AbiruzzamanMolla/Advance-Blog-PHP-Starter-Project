<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
    <ul class="dropdown-menu message-dropdown">
        <?php
        $query = "SELECT * FROM inbox ORDER BY msg_id DESC LIMIT 5";
        $select_msg = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_msg)){
        $msg_id = $row['msg_id'];
        $msg_status = $row['msg_status'];
        $msg_date = $row['msg_date'];
        $msg_author = $row['msg_author'];
        $msg_subject = $row['msg_subject'];
        $author_email = $row['author_email'];
        $msg_content = $row['msg_content'];
        $msg_content = filter_var($msg_content, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $msg_sort_content = substr($row['msg_content'],0,100);

            echo "<li class='message-preview'>
                <a href='inbox.php?show_msg={$msg_id}'>
                    <div class='media'> <span class='pull-left'>
                        <img class='media-object' src='/images/user_pic/img_avatar1.png' alt='alt' style='width:50px;height:50px;'>
                    </span>
                        <div class='media-body'>
                            <h5 class='media-heading'>
                                <strong>{$msg_author}</strong>
                            </h5>
                            <p class='small text-muted'><i class='fa fa-clock-o'></i> {$msg_date} <small>({$msg_status})</small> </p>
                            <p> {$msg_sort_content} ... </p>
                        </div>
                    </div>
                </a>
            </li>";
            } ?>
            <li class="message-footer"> <a href="inbox.php">Read All New Messages</a> </li>
    </ul>
</li>
