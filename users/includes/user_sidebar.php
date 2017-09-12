<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li> <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> </li>
        <li> <a href="javascript:;" data-toggle="collapse" data-target="#post_dropdown"><i class="fa fa-fw fa-clipboard"></i> Profile <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="post_dropdown" class="collapse">
                <li> <?php if(isset($_SESSION['username'])){ $username = $_SESSION['username']; } ?><a href="../profile.php?user=<?php echo $username; ?>">View Profile</a> </li>
                <li> <a href="./edit_profile.php">Edit Profile</a> </li>
                <li> <a href="./change_password.php">Change Password</a> </li>
            </ul>
        </li>
        <li> <a href="./add_post.php"><i class="fa fa-fw fa-comments"></i>Add Posts</a> </li>
        <li> <a href="view_comments.php"><i class="fa fa-fw fa-comments"></i>View Comments  <small class='pull-right'><span class='badge'> 1/2</span></small></a></li>
        <li> <a href="./user_settings.php"><i class="fa fa-fw fa-gear"></i>Settings</a> </li>
    </ul>
</div>
