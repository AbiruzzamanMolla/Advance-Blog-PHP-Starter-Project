<?php

if(isset($_POST['create_user'])) {
    $user_firstname    = escape($_POST['user_firstname']);
    $user_lastname     = escape($_POST['user_lastname']);
    $user_sex          = escape($_POST['user_sex']);
    $user_role         = escape($_POST['user_role']);
    $username          = escape($_POST['username']);
    $user_email        = escape($_POST['user_email']);
    $user_password     = escape($_POST['user_password']);
    $user_reg          = escape(date('d-m-y'));
    $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>10));

    if(!empty($user_firstname) && !empty($user_lastname) && !empty($user_sex) && !empty($user_role) && !empty($username) && !empty($user_email) && !empty($user_password) && !empty($user_reg)){

    $query = "INSERT INTO users(user_firstname, user_lastname, user_sex, user_reg, user_role,username,user_email,user_password) ";

    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_sex}',now(),'{$user_role}','{$username}','{$user_email}', '{$password}') ";

    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);


       echo "<div class='alert alert-success'><strong>Success!</strong> User successfully added. <a href='users.php'>View User</a></div>";
    } else {
        echo "<div class='alert alert-danger'><strong>Sorry!</strong> Fields can not be empty. </div>";
    }
}
?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Firstname</label>
            <input type="text" class="form-control" name="user_firstname"> </div>
        <div class="form-group">
            <label for="post_status">Lastname</label>
            <input type="text" class="form-control" name="user_lastname"> </div>
        <div class="form-group">
            <label for="post_status">Sex</label>
            <select name="user_sex" id="">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <select name="user_role" id="">
                <option value="subscriber">Select Options</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
            </select>
        </div>
        <div class="form-group">
            <label for="post_tags">Username</label>
            <input type="text" class="form-control" name="username"> </div>
        <div class="form-group">
            <label for="post_content">Email</label>
            <input type="email" class="form-control" name="user_email"> </div>
        <div class="form-group">
            <label for="post_content">Password</label>
            <input type="password" class="form-control" name="user_password"> </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_user" value="Add User"> </div>
    </form>
