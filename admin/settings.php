<?php include "includes/admin_header.php"; ?>
<?php  // Get request user id and database data extraction

?>
<?php  // Post request to update user


if(isset($_POST['update_settings'])) {
    $id = '1';
    $admin_id     = escape($_POST['admin_id']);
    $css          = escape($_POST['css']);
    $admin_access = escape($_POST['admin_access']);
    $site_status  = escape($_POST['site_status']);
    $url          = escape($_POST['url']);

    $query = "UPDATE settings SET css = '$css', admin_access = '$admin_access', site_status = '$site_status', url = '$url', admin_id = '$admin_id' WHERE id = $id ";
    $edit_settings_query = mysqli_query($connection,$query);
    confirmQuery($edit_settings_query);

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
                        View Users
                        <small></small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="admin_id">Admin Name:</label>
                            <select name="admin_id" id="">
                                                <?php
                                                $query = "SELECT * FROM users";
                                                $select_user_query = mysqli_query($connection, $query);

                                                while($row = mysqli_fetch_array($select_user_query)) {
                                                    $user_id        = $row['user_id'];
                                                    $username       = $row['username'];
                                                    $user_role      = $row['user_role'];

                                                if($user_role == 'admin'){
                                                    echo "<option value='$user_id'>$username</option>";
                                                }
                                                }
                                                ?>
                                            </select>
                        </div>
                        <div class="form-group">
                            <label for="admin_access">Admin Access:</label>
                            <select name="admin_access" id="">
                                                <option value="yes">Yes</option>
                                                <option value="no">NO</option>
                                            </select>
                        </div>
                        <div class="form-group">
                            <label for="css">Site CSS:</label>
                            <select name="css" id="">
                                                <option value="">default</option>
                                            </select>
                        </div>
                        <div class="form-group">
                            <label for="site_status">Site Status</label>
                            <select name="site_status" id="">
                                                <option value="published">Published</option>
                                                <option value="hidden">Hidden</option>
                                            </select>
                        </div>
                        <div class="form-group">
                            <label for="url">Site URL:</label>
                            <input type="email" value="<?php ?>" class="form-control" name="url"> </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_settings" value="Update"> </div>
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
