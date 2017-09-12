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
                        <li class="active"> <i class="fa fa-file"></i> Inbox</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <?php
                if(isset($_GET['source'])){
                    $source = $_GET['source'];
                } else {$source = '';}
                switch($source){
                    case 'view_msg';
                        include "includes/user_view_msg.php";
                        break;
                        case 'send_msg';
                        include "includes/send_msg.php";
                        break;

                    default:
                        include "includes/user_view_all_messages.php";
                        break;
                }
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
