<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="index.php">User Control Panel</a> </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li> <a href="users_online.php"><strong>Users Online: </strong> <?php echo users_online(); ?>
            </a> </li>
        <li> <a href="../index.php">Home Page</a> </li>
        <!--Admin Massege Dropdown menu-->
        <?php include "user_dropdown_msg.php"; ?>
        <!--#Admin Massege Dropdown menu-->
        <!--Notification Dropdown menu-->
        <?php include "user_notification.php"; ?>
        <!--Notification Dropdown menu-->
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username'];?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li> <a href="./view_profile.php"><i class="fa fa-fw fa-user"></i> Profile</a> </li>
                <li> <a href="./change_password.php"><i class="fa fa-fw fa-key"></i> Change Password</a> </li>
                <li class="divider"></li>
                <li> <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a> </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "user_sidebar.php"; ?>
</nav>
