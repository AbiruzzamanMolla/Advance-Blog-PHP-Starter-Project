<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container panel panel-primary">
<div class="panel-heading"><h1>LOGIN</h1></div>
<div class="panel-body"> 
    <section id="login">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">                       
                            <form role="form" action="/cms/includes/login.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group panel panel-default panel-body">
                                <label for="username"><i class="fa fa-fw fa-user"></i>Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Your Username">
                            </div>
                            <div class="form-group panel panel-default panel-body">
                                <label for="password"><i class="fa fa-fw fa-key"></i>Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Enter Your Password">
                            </div>

                            <input type="submit" name="login" id="btn btn-login" class="btn btn-custom btn-lg btn-block" value="Login">

                        </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-xs-12 -->
 
        <!-- /.container -->
        </section>
        </div>

    <hr>



    <?php include "includes/footer.php";?>
