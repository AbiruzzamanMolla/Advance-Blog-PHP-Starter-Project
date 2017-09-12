<?php
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
 }
 ?>

    <?php
// counting unapproved comments
$comment_count_query = "SELECT * FROM comments WHERE comment_author = '{$username}' AND comment_reply = '' ";
$find_count = mysqli_query($connection, $comment_count_query);
$count_unreplied_comments = mysqli_num_rows($find_count);

?>
        <?php
// counting unreplied messages
$comment_inbox_query = "SELECT * FROM user_inbox WHERE msg_reply = '' AND msg_author = '{$username}' ";
$find_count = mysqli_query($connection, $comment_inbox_query);
$count_inbox = mysqli_num_rows($find_count);

?>
<?php $allcount = $count_unreplied_comments + $count_inbox; ?>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b><?php if($count_unreplied_comments !== 0 || $count_inbox !== 0){ echo "<small><span class='badge'>".$allcount."</span></small>"; } ?></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <?php

                        if($count_unreplied_comments !== 0 || $count_inbox !== 0){
                            if($count_unreplied_comments !== 0){
                                echo "<li> <a href='view_comments.php'><span class='label label-default'>Unreplied comments: <b class='pull-right'><span class='badge'> $count_unreplied_comments</span></b></span></a></li>";
                            }

                            if($count_inbox !== 0){
                                echo "<li> <a href='user_inbox.php'><span class='label label-success'>Unreplied Messages: <b class='pull-right'><span class='badge'> $count_inbox</span></b></span></a></li>";
                            }  
                    } else {
                            echo "<li class='divider'></li>
                            <li><center><span class='label label-default'> No notification......</span></center></li>";
                        }

                        ?>
                    </ul>
                </li>
