<?php include "includes/user_header.php"; ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

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
                        <li class="active"> <i class="fa fa-file"></i> Edit Profile</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                           <?php 
                if(isset($_SESSION['username'])){
                $get_username = $_SESSION['username'];
                if($get_username !== ''){
                    $query = "SELECT * FROM users WHERE username = '{$get_username}' ";
                    $select_profile = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_profile)){
                        $user_id = $row['user_id'];
                        $username = $row['username'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_birthday = $row['user_birthday'];
                        $user_city = $row['user_city'];
                        $user_country = $row['user_country'];
                        $user_sex = $row['user_sex'];
                        $user_bio = $row['user_bio'];
                        $user_number = $row['user_number'];
                        $user_twitter = $row['user_twitter'];
                        $user_medium = $row['user_medium'];
                        $user_instagram = $row['user_instagram'];
                        $user_site = $row['user_site'];
                        $user_lastlogin = $row['user_lastlogin'];
                        $user_reg = $row['user_reg'];
                        $user_email = $row['user_email'];
                        $dbs_password   = $row['user_password'];
                        $user_image = $row['user_image'];
                        $user_role = $row['user_role'];
                        $user_facebook = $row['user_facebook'];
                        $user_likes = $row['user_likes'];
                        $user_interests = $row['user_interests'];
                        $user_status = $row['user_status'];
                    }
                 // Post request to update user
                        if(isset($_POST['edit_profile'])) {
                            $user_firstname   = escape($_POST['user_firstname']);
                            $user_lastname    = escape($_POST['user_lastname']);
                            $user_birthday    = escape($_POST['user_birthday']);
                            $user_city        = escape($_POST['user_city']);
                            $user_country     = escape($_POST['user_country']);
                            $user_bio         = escape($_POST['user_bio']);
                            $user_number      = escape($_POST['user_number']);
                            $user_twitter     = escape($_POST['user_twitter']);
                            $user_medium      = escape($_POST['user_medium']);
                            $user_instagram   = escape($_POST['user_instagram']);
                            $user_site        = escape($_POST['user_site']);


                            $user_image = $_FILES['image']['name'];
                            $user_image_temp = $_FILES['image']['tmp_name'];
                            move_uploaded_file($user_image_temp, "../images/user_pic/$user_image");
                            if(empty($user_image)){
                                $query = "SELECT * FROM users WHERE username = '{$get_username}' ";
                                $select_image = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($select_image)){
                                    $user_image = $row['user_image'];
                                }
                            }

                            $user_facebook    = escape($_POST['user_facebook']);
                            $user_interests   = escape($_POST['user_interests']);
                            $user_sex         = escape($_POST['user_sex']);
                            $user_email       = escape($_POST['user_email']);

                                $query = "UPDATE users SET ";
                                $query .="user_firstname  = '{$user_firstname}', ";
                                $query .="user_lastname = '{$user_lastname}', ";
                                $query .="user_birthday   =  '{$user_birthday}', ";
                                $query .="user_city   =  '{$user_city}', ";
                                $query .="user_country   =  '{$user_country}', ";
                                $query .="user_bio   =  '{$user_bio}', ";
                                $query .="user_number   =  '{$user_number}', ";
                                $query .="user_twitter   =  '{$user_twitter}', ";
                                $query .="user_medium   =  '{$user_medium}', ";
                                $query .="user_instagram   =  '{$user_instagram}', ";
                                $query .="user_image   =  '{$user_image}', ";
                                $query .="user_facebook   =  '{$user_facebook}', ";
                                $query .="user_interests   =  '{$user_interests}', ";
                                $query .="user_sex   =  '{$user_sex}', ";
                                $query .="user_email = '{$user_email}'";
                                $query .= " WHERE username = '{$get_username}' ";
                                $edit_user_query = mysqli_query($connection,$query);
                                confirmQuery($edit_user_query);
                                header("Location: ../profile.php?user=$get_username");
    }

?>
<form action="" method="post" enctype="multipart/form-data">
       <div class="form-group">
            <label for="post_image">Profile Picture</label> <img width="100" src="../images/user_pic/<?php echo $user_image; ?>" alt="image" download>
            <input type="file" name="image"> </div>

            <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                <tr>
                                    
                                    <div class="row">
                                    <div class="well">
                                    <b>Personal Information</b>
                                    </div>
                                    </div>
                                 
                                </tr>
                                    <tr>
                                        <td class="text-left" width="19%">
                                         <b>First Name</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" autofocus>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" width="20%">
                                         <b>Last Name</b>  
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="text-left" width="20%">
                                         <b>Gander</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                            <select name="user_sex" id="" class="form-group">
                                            <option value="<?php echo $user_sex; ?>">
                                            <?php echo $user_sex; ?>
                                        </option>
                                        <?php
                                        if($user_sex == 'Male') {
                                            echo "<option value='Female'>Female</option>";
                                            } else {
                                                echo "<option value='Male'>Male</option>";
                                        }
                                    ?>
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" width="19%">
                                         <b>Birthday</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                            <input class="form-control" id="date" name="user_birthday" placeholder="<?php echo $user_birthday; ?>" value="<?php echo $user_birthday; ?>" type="date" min="1996-01-01" "1960-12-31">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" width="19%">
                                         <b>Interests</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                            <input type="text" value="<?php echo $user_interests; ?>" class="form-control" name="user_interests">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                             <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                <tr>
                                    
                                    <div class="row">
                                    <div class="well">
                                    <b>Contect Information</b>
                                    </div>
                                    </div>
                                 
                                </tr>
                                    <tr>
                                        <td class="text-left" width="19%">
                                         <b>Mobile</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                            <input type="tel" value="<?php echo $user_number; ?>" class="form-control" name="user_number">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" width="20%">
                                         <b>Email</b>  
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email" autocomplete="on">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="text-left" width="20%">
                                         <b>City</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                            <input type="text" value="<?php echo $user_city; ?>" class="form-control" name="user_city">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="text-left" width="20%">
                                         <b>Country</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                        <input type="text" value="<?php echo $user_country; ?>" class="form-control" name="user_country">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="text-left" width="20%">
                                         <b>Facebook</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                        <input type="text" value="<?php echo $user_facebook; ?>" class="form-control" name="user_facebook">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="text-left" width="20%">
                                         <b>Twitter</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                        <input type="text" value="<?php echo $user_twitter; ?>" class="form-control" name="user_twitter">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="text-left" width="20%">
                                         <b>Instagram</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                        <input type="text" value="<?php echo $user_instagram; ?>" class="form-control" name="user_instagram">
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="text-left" width="20%">
                                         <b>Medium</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                        <input type="text" value="<?php echo $user_medium; ?>" class="form-control" name="user_medium">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" width="20%">
                                         <b>URL</b>   
                                        </td>
                                        <td class="text-left" width="1%">
                                         <b>:</b>   
                                        </td>
                                        <td class="text-left" width="80%">
                                        <input type="url" value="http://<?php echo $user_site; ?>" class="form-control" name="user_site">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                <tr widtd="90%">
                                    
                                    <div class="row">
                                    <div class="well">
                                    <b>Bio</b>
                                    </div>
                                    </div>
                                 
                                </tr>
                                    <tr>
                                        <td class="text-center" width="100%">
                                        <textarea type="text" class="form-control" name="user_bio" id="" cols="30" rows="10"><?php echo $user_bio; ?> </textarea>  
                                        </td>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                    <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_profile" value="Update User"> <input type="submit" formaction="demo_admin.php" value="Submit as admin"> </div>
</form>

<?php }
} // Post reques to update user end

?>

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
