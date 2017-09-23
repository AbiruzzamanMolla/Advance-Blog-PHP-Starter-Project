<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
<!-- Page Content -->
<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
    <?php
    if(isset($_POST['submit'])) {
        $to         = "abiruzzaman.molla@gmail.com";
        $subject    = wordwrap($_POST['subject'], 60);
        $body       = $_POST['body'];
        $header     = "From: " .$_POST['email'];
        mail($to,$subject,$body, $header);
        $msg_author = $_POST['msg_author'];
        $msg_author = mysqli_real_escape_string($connection, $msg_author);
        $msg_subject = wordwrap($_POST['subject'], 60);
        $msg_subject = mysqli_real_escape_string($connection, $msg_subject);
        $author_email = $_POST['email'];
        $author_email = mysqli_real_escape_string($connection, $author_email);
        $msg_body = $_POST['body'];
        $msg_body = mysqli_real_escape_string($connection, $msg_body);
        $msg_content = $msg_body;
        date_default_timezone_set("Asia/Dhaka");
        $msg_date = date('Y-m-d h:i:s A');
        $query = "INSERT INTO inbox(msg_status, msg_date, msg_author, msg_subject, author_email, msg_content) ";
        $query .= "VALUES('Panding','{$msg_date}','{$msg_author}','{$msg_subject}','{$author_email}','{$msg_content}') ";
        $send_msg_query = mysqli_query($connection, $query);
        if(!$send_msg_query){
            die('SQL connection Failed'. mysqli_error($connection));
        }
        $message = "<div class='alert alert-success center-block text-center'><center><strong>Success!</strong> Your email has been send. </center></div>";
    } else {
        $message = "";
    }
?>
        <h2 class="text-center">CONTACT</h2>
        <div class="row">
            <?php echo $message; ?>
            <div class="col-sm-5">
                <p>Contact us and we'll get back to you within 24 hours.</p>
                <p><span class="glyphicon glyphicon-map-marker"></span> Narshingdi, Dhaka</p>
                <p><span class="glyphicon glyphicon-phone"></span> +880 1787350229</p>
                <p><span class="glyphicon glyphicon-envelope"></span> abiruzzaman.molla@gmail.com</p>
            </div>
            <div class="col-sm-7 slideanim">
                <div class="row">
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="col-sm-4 form-group">
                            <input class="form-control" id="name" name="msg_author" placeholder="Name" type="text" required> </div>
                        <div class="col-sm-4 form-group">
                            <input class="form-control" id="name" name="subject" placeholder="Subject" type="text" required> </div>
                        <div class="col-sm-4 form-group">
                            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required> </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <textarea class="form-control" id="comments" name="body" placeholder="Comment" rows="5" cols="4"></textarea>
                                <button class="btn btn-default pull-right" type="submit" name="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php include "includes/footer.php";?>
