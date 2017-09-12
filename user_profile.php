<!-- Including Header PHP -->
<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "admin/includes/functions.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php  // Get request user id and database data extraction
if(isset($_SESSION['username'])){
    $s_username =  $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$s_username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $user_email     = $row['user_email'];
        $user_sex     = $row['user_sex'];
    }
}
  // Post request to update user
    if(isset($_POST['edit_user_profile'])) {
            $user_firstname   = escape($_POST['user_firstname']);
            $user_lastname    = escape($_POST['user_lastname']);
            $user_email       = escape($_POST['user_email']);
            $user_sex         = escape($_POST['user_sex']);
            $query = "UPDATE users SET ";
            $query .="user_firstname  = '{$user_firstname}', ";
            $query .="user_lastname = '{$user_lastname}', ";
            $query .="user_sex = '{$user_sex}', ";
            $query .="user_email = '{$user_email}' ";
            $query .= "WHERE username = '{$s_username}' ";

            $edit_profile_query = mysqli_query($connection,$query);
            if(!$edit_profile_query){
                die('Query Failed  ' . mysqli_error($connection));
            } else {
                echo "Profile Updated...!";
            }
    }
?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Firstname</label>
                    <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname"> </div>
                <div class="form-group">
                    <label for="post_status">Lastname</label>
                    <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname"> </div>
                <div class="form-group">
                    <label for="post_status">Sex</label>
                    <select name="user_sex" id="">
                                            <option value="<?php echo $user_sex; ?>">
                                                <?php echo $user_sex; ?>
                                            </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                </div>
                <div class="form-group">
                    <label for="post_content">Email</label>
                    <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email"> </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="edit_user_profile" value="Update Profile"> </div>
            </form>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
    <hr>
    <!-- Including Footer PHP -->
    <?php include "includes/footer.php"; ?>
