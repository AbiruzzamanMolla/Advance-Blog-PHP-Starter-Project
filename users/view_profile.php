<?php include "includes/user_header.php"; ?>
<div id="wrapper">
	<!-- Navigation -->
	<?php include "includes/user_navigation.php"; ?>
	<!-- /.navbar-collapse -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<!--                    <div class="container text-center" width="100%">-->
			<div class="row">
			           <?php 
           if(isset($_GET['user'])){
                $get_username = $_GET['user'];
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
                        $user_image = $row['user_image'];
                        $user_role = $row['user_role'];
                        $user_facebook = $row['user_facebook'];
                        $user_likes = $row['user_likes'];
                        $user_interests = $row['user_interests'];
                        $user_status = $row['user_status'];
?>

				<div class="container text-center">
                    <div class="row">
                        <div class="col-sm-3 well">
                            <div class="well">
                                <img src="images/user_pic/<?php echo $user_image; ?>" class="img-circle" height="85" width="85" alt="<?php echo $username; ?>"><br><a href="#" class="btn btn-danger disabled" disabled><?php echo $username; ?></a></p> </div>
                            <div class="well">
                                <p><ul class="pagination"><li class="disabled"><a href="#">Interests</a></li></ul></p>

                                <p>
                                    <?php //select interest based on comma and generet random classs
                                    $tags = $user_interests;
                                    $tags = explode(',',$tags);
                                    foreach ($tags as $tag) {
                                        $classes = array('primary','default','success','info','warning','danger');
                                        $class = array_rand($classes);
                                        echo "<span class='label label-$classes[$class]'>$tag</span>";
                                    }
                                     ?>
                                    
                                </p>
                            </div>

                            <div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $user_bio; ?> </div>
                                <?php
                                if ($user_site !== '') {
                                     echo "<p><a href='http://$user_site'>Visit Website</a></p>";
                                 } 
                                 ?>
                            
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="panel panel-default text-left">
                                        <div class="panel-body">
                                            <p contenteditable="true">Status: Feeling Blue</p>
                                            <button type="button" class="btn btn-default btn-sm"> <span class="glyphicon glyphicon-thumbs-up"></span> Like </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="panel text-right">
                                        <div class="panel-body">
                                            <button type="button" class="btn btn-default btn-sm disabled text-right"> <span class="glyphicon glyphicon-thumbs-up"></span> 8 </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <p><?php echo $user_firstname; ?></p>
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
                                            <p><?php echo $user_lastname; ?></p>
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
                                            <p><?php echo $user_sex; ?></p>
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
                                            <p><a href="<?php echo $user_number; ?>"><?php echo $user_number; ?></a></p>
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
                                            <p><a href="mailto:<?php echo $user_email; ?>"><?php echo $user_email; ?></a></p>
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
                                            <p><?php echo $user_city; ?></p>
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
                                            <p><?php echo $user_country; ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                <tr>
                                    
                                    <div class="row">
                                    <div class="well">
                                    <b>Bio</b>
                                    </div>
                                    </div>
                                 
                                </tr>
                                    <tr>
                                        <td class="text-center" width="100%">
                                         <?php echo $user_bio; ?>   
                                        </td>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-2 well">
                            <div class="thumbnail">
                                <p>Birthday:</p> <img src="images/site_icon/birthday.jpg" alt="Paris" width="400" height="300">
                                <p><strong>Paris</strong></p>
                                <p><?php 
                                    $date=date_create("$user_birthday");
                                    date_add($date,date_interval_create_from_date_string("0 days"));
                                    echo date_format($date,"l, F d Y")."</p>";
                                     
                                     $todayDate = date('Y-m-d');
                                     if($user_birthday == $todayDate){
                                        echo "<button class='btn btn-primary'>Wish</button>";
                                     }
                                ?>
                            </div>
                            <?php 
                            if(isset($_SESSION['username'])){
                              echo "<div class='well'>
                                <p><a href='users/user_inbox.php?source=send_msg&user_id=$user_id' class='btn btn-success'>Send Message</a></p>
                            </div>";  
                            }
                            ?>
                            <?php
                            if($user_twitter !== '' or $user_medium !== '' or $user_instagram !== '' or $user_facebook !== ''){
                                echo "<div class='panel'>
                                <p>Social Networks</p>
                                <a href='http://facebook.com/$user_facebook'><span><i class='fa fa-fw fa-facebook-square'></i></span></a> | <a href='http://twitter.com/$user_twitter'><span><i class='fa fa-fw fa-twitter-square'></i></span></a> | <a href='http://medium.com/$user_medium'><span><i class='fa fa-fw fa-medium'></i></span></a> | <a href='http://instagram.com/$user_instagram'><span><i class='fa fa-fw fa-instagram'></i></span></a>
                            </div>";
                            
                            } 
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    }
            }
        } else {
             header("Locaton: ../index.php");
        } {
               
            }
 ?>


			</div>
			<!--                    </div>-->
			<!-- /.row -->
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include "includes/user_footer.php" ?>
