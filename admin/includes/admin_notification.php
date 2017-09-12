<?php
// counting draft posts
$post_count_query = "SELECT * FROM posts WHERE post_status = 'draft' ";
$find_count = mysqli_query($connection, $post_count_query);
$count_dpost = mysqli_num_rows($find_count);
?>
    <?php
// counting unapproved comments
$comment_count_query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
$find_count = mysqli_query($connection, $comment_count_query);
$count_upcomments = mysqli_num_rows($find_count);

?>
        <?php
// counting unreplied comments
$comment_reply_query = "SELECT * FROM comments WHERE comment_reply = '' ";
$find_count = mysqli_query($connection, $comment_reply_query);
$count_reply = mysqli_num_rows($find_count);

?>
            <?php
// counting unreplied messages
$inbox_query = "SELECT * FROM inbox WHERE msg_status = 'Panding' ";
$find_count = mysqli_query($connection, $inbox_query);
$count_inbox = mysqli_num_rows($find_count);
?>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <?php

                        if($count_dpost !== 0 || $count_upcomments !== 0 || $count_reply !== 0 || $count_inbox !== 0){
                            if($count_dpost !== 0){
                                echo "<li> <a href='posts.php'><span class='label label-default'>Draft Post: <b class='pull-right'><span class='badge'> $count_dpost</span></b></span></a></li>";
                            }

                            if($count_upcomments !== 0){
                                echo "<li> <a href='comments.php'><span class='label label-primary'>Unapproved Comments: <b class='pull-right'><span class='badge'> $count_upcomments</span></b></span></a></li>";
                            }

                            if($count_reply !== 0){
                                echo "<li> <a href='comments.php'><span class='label label-success'>Unreplied Comments: <b class='pull-right'><span class='badge'> $count_reply</span></b></span></a></li>";
                            }

                            if($count_inbox !== 0){
                                echo "<li> <a href='inbox.php'><span class='label label-info'>Unreplied Emails: <b class='pull-right'><span class='badge'> $count_inbox</span></b></span></a></li>";
                            }
                        } else {
                            echo "<li class='divider'></li>
                            <li><center><span class='label label-default'> No notification......</span></center></li>";
                        }

                        ?>
                    </ul>
                </li>
