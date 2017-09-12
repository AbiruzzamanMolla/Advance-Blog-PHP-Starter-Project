<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/includes/functions.php"; ?>
<?php

// if(isset($_POST['register']))
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = trim($_POST['username']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $sex = trim($_POST['sex']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = ['username'=> '', 'firstname'=> '', 'lastname'=> '', 'sex'=> '', 'email'=> '','password'=> ''];

    if(strlen($username) < 4){
        $error['username'] = 'Username is too short, user longer than 4 charecter.';
    }
    if($username == ''){
        $error['username'] = 'Username can not be empty.';
    } 
    if(preg_match('/[^a-z0-9_-]+/i', $username)){
        $error['username'] = 'Username must only content alfanumurical desh and underscrol .';
    }
    
    if(username_exists($username)){
        $error['username'] = 'Username already exists, Pick another one.';
    }
    if($email == ''){
        $error['email'] = 'Email can not be empty.';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'Email is not Validate.';
    }

    if(email_exists($email)){
        $error['email'] = 'Email already exists, Pick another one.';
    }
    if($password == ''){
        $error['password'] = 'Password can not be empty.';
    }
    foreach($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }

    }
        if(empty($error)){
        register_user($username, $firstname, $lastname, $sex, $email, $password);
        login_user($username, $password);
        }

}

?>
    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                        <div class="form-wrap panel panel-primary"><div class="panel-heading">
                            <h1>Registation Form</h1></div><div class="panel-body">
                            <form role="form" action="" method="post" id="login-form" autocomplete="on">
                                <div class="col-xs-6">
                                <div class="form-group panel panel-default panel-body">
                                    <label for="username"><abbr title="Needs to longer than 4 charecter, allowed alfanumurical words, desh, underscroll only"><i class="fa fa-fw fa-user"></i>Username: </abbr></label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" value="<?php echo isset($username) ? $username : '' ; ?>" required>
                                    <p>
                                        <?php echo isset($error['username']) ? $error['username'] : '' ; ?>
                                    </p>
                                </div>
                                <div class="form-group panel panel-default panel-body">
                                    <label for="firstname"><abbr title="Needs to longer than 4 charecter, allowed alfanumurical words, desh, underscroll only"><i class="fa fa-fw fa-pencil-square"></i>Firstname: </abbr></label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Your Firstname" value="<?php echo isset($firstname) ? $firstname : '' ; ?>">
                                    <p>
                                        <?php echo isset($error['firstname']) ? $error['firstname'] : '' ; ?>
                                    </p>
                                </div>
                                
                                <div class="form-group panel panel-default panel-body">
                                    <label for="lastname"><abbr title="Needs to longer than 4 charecter, allowed alfanumurical words, desh, underscroll only"><i class="fa fa-fw fa-pencil-square"></i>Lastname: </abbr></label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Your Lastname" value="<?php echo isset($lastname) ? $lastname : '' ; ?>" required>
                                    <p>
                                        <?php echo isset($error['lastname']) ? $error['lastname'] : '' ; ?>
                                    </p>
                                </div> </div>
                                <div class="col-xs-6">
                                <div class="form-group panel panel-default panel-body">
                                    <label for="sex"><abbr title="Needs to longer than 4 charecter, allowed alfanumurical words, desh, underscroll only"><i class="fa fa-fw fa-meh-o"></i>Gender: </abbr></label><br>
                                    <input type="radio" name="sex" value="Male" checked><i class="fa fa-fw fa-male"></i>Male <br>
                                    <input type="radio" name="sex" value="Female"><i class="fa fa-fw fa-female"></i>Female
                                    
                                    <p>
                                        <?php echo isset($error['sex']) ? $error['sex'] : '' ; ?>
                                    </p>
                                </div>
                                <div class="form-group panel panel-default panel-body">
                                    <label for="username"><abbr title="Must be a validate email."><i class="fa fa-fw fa-at"></i>Email: </abbr> </label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" value="<?php echo isset($email) ? $email : '' ; ?>" required>
                                    <p>
                                        <?php echo isset($error['email']) ? $error['email'] : '' ; ?>
                                    </p>
                                </div>
                                <div class="form-group panel panel-default panel-body">
                                    <label for="username"><abbr title="Use a strong password"><i class="fa fa-fw fa-key"></i>Password: </abbr></label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                                    <p>
                                        <?php echo isset($error['password']) ? $error['password'] : '' ; ?>
                                    </p>
                                </div>
                                </div>
                                <div class="form-group panel panel-default panel-body">
                                <center><input type="submit" name="register" id="btn btn-login" class="btn btn-custom btn-lg btn-block" value="Register"></center></div></form>
                                </div>
                                
                        </div>
                    <!-- /.col-xs-12 -->
                </div>
                <!-- /.row -->
            </div>

            <?php include "includes/footer.php";?>
