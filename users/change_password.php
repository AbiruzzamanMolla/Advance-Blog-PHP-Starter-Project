<?php include "includes/user_header.php"; ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/user_navigation.php"; ?>
    <!-- /.navbar-collapse -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php welcome(); ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-dashboard"></i> <a href="index.php">Deshboard</a> </li>
                        <li class="active"> <i class="fa fa-file"></i> Change PAssword</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <?php  // Get request user id and database data extraction


                if(isset($_SESSION['username'])){
                    $susername = $_SESSION['username'];

                    $query = "SELECT * FROM users WHERE username = '$susername' ";
                    $select_users_query = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($select_users_query)) {
                        $user_id = $row['user_id']; }
                }
                ?>
                <?php  // Post request to update user
                if(isset($_POST['change_password'])) {

                    $user_password = escape($_POST['user_password']);
                    if($user_password !== ''){
                        $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>10));

                        $query = "UPDATE users SET ";
                        $query .="user_password  = '{$password}' ";
                        $query .= "WHERE user_id = {$user_id} ";
                        $edit_user_query = mysqli_query($connection,$query);
                        confirmQuery($edit_user_query);
                        echo "Password changed.......";
                    }
                    else {
                        echo "Password is empty";
                    }
                }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_content">Password: </label>
                        <input type="password" value="" name="user_password"> </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="change_password" value="Change Password"> </div>
                </form>
            </div>
            <!-- /.row -->
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include "includes/user_footer.php" ?>
