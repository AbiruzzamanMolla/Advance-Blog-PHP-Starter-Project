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
        $user_password  = $row['user_password'];
    }
}
// Post request to update user
if(isset($_POST['change_password'])) {
    $user_password = escape($_POST['user_password']);
    if($user_password !== ''){
        $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>10));
        $query = "UPDATE users SET ";
        $query .="user_password   = '{$password}' ";
        $query .= "WHERE username = '{$s_username}' ";
        $edit_profile_query = mysqli_query($connection,$query);
        if(!$edit_profile_query){
            die('Faild' . mysqli_error($connection));
        } else {
            echo "Password Changed!";
        }
    } else {
        echo "Password is empty!";
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
                    <label for="post_content">Password</label>
                    <input type="password" value="" class="form-control" name="user_password"> </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="change_password" value="Update Profile"> </div>
            </form>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
    <hr>
    <!-- Including Footer PHP -->
    <?php include "includes/footer.php"; ?>
