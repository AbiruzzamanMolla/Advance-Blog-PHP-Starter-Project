<?php include "includes/admin_header.php"; ?>
    <?php  // Get request user id and database data extraction


if(isset($_SESSION['username'])){
    $s_username =  $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$s_username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_id        = $row['user_id'];
        $username       = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $user_email     = $row['user_email'];
        $user_image     = $row['user_image'];
        $user_role      = $row['user_role'];

    }
}
?>
        <?php  // Post request to update user


    if(isset($_POST['edit_profile'])) {

            $user_firstname   = escape($_POST['user_firstname']);
            $user_lastname    = escape($_POST['user_lastname']);
            $user_role        = escape($_POST['user_role']);
            $username      = escape($_POST['username']);
            $user_email    = escape($_POST['user_email']);

            $query = "UPDATE users SET ";
            $query .="user_firstname  = '{$user_firstname}', ";
            $query .="user_lastname = '{$user_lastname}', ";
            $query .="user_role   =  '{$user_role}', ";
            $query .="username = '{$username}', ";
            $query .="user_email = '{$user_email}', ";
            $query .= "WHERE username = '{$s_username}' ";
            $edit_profile_query = mysqli_query($connection,$query);
            confirmQuery($edit_profile_query);
            echo "Profile Updated" . " <a href='users.php'>View Users?</a>";

    }

?>
            <div id="wrapper">
                <!-- Navigation -->
                <?php include "includes/admin_navigation.php"; ?>
                    <!-- /.navbar-collapse -->
                    <div id="page-wrapper">
                        <div class="container-fluid">
                            <!-- Page Heading -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                        Edit Admin Profile
                        <small></small>
                    </h1>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="title">Firstname</label>
                                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname"> </div>
                                        <div class="form-group">
                                            <label for="post_status">Lastname</label>
                                            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname"> </div>
                                        <div class="form-group">
                                            <select name="user_role" id="">
                                                <option value="<?php echo $user_role; ?>">
                                                    <?php echo $user_role; ?>
                                                </option>
                                                <?php
                        if($user_role == 'admin') {
                            echo "<option value='subscriber'>subscriber</option>";
                            } else {
                            echo "<option value='admin'>admin</option>";
                        }
                            ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="post_tags">Username</label>
                                            <input type="text" value="<?php echo $username; ?>" class="form-control" name="username"> </div>
                                        <div class="form-group">
                                            <label for="post_content">Email</label>
                                            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email"> </div>
                                        <div class="form-group">
                                            <input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile"> </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /#page-wrapper -->
            </div>
            <!-- /#wrapper -->
            <?php include "includes/admin_footer.php" ?>
