<?php include "includes/admin_header.php"; ?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>
    <!-- /.navbar-collapse -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?php
                        $inbox_query_count = "SELECT * FROM inbox";
                        $find_count = mysqli_query($connection, $inbox_query_count);
                        $count = mysqli_num_rows($find_count); ?>
                            Inbox<sup><span class="badge"><?php echo $count; ?></span></sup>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <script>
                    $(document).ready(function() {
                        $('[data-toggle="popover"]').popover();
                    });

                </script>
                <?php include "includes/delete_popup.php"; ?>
                <table class="table table-bordered table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Msg Author</th>
                            <th>Msg Subject</th>
                            <th>Content</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $per_page = 5;
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                        } else {
                            $page = "";
                        }

                        if($page == "" || $page == 1){
                            $page_1 = 0;
                        } else {
                            $page_1 = ($page * $per_page) - $per_page;
                        }


                        ?>
                            <?php
                        $post_query_count = "SELECT * FROM inbox";
                        $find_count = mysqli_query($connection, $post_query_count);
                        $count = mysqli_num_rows($find_count);
                        $count = ceil($count / 5);

                        $query = "SELECT * FROM inbox ORDER BY msg_id DESC LIMIT $page_1,$per_page";
                        $select_msg = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select_msg)){
                            $msg_id = $row['msg_id'];
                            $msg_status = $row['msg_status'];
                            $msg_date = $row['msg_date'];
                            $msg_author = $row['msg_author'];
                            $msg_subject = $row['msg_subject'];
                            $author_email = $row['author_email'];
                            $msg_content = $row['msg_content'];
                            $msg_content = filter_var($msg_content, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                            $msg_sort_content = substr($row['msg_content'],0,100);


                            echo "<tr>";
                            echo "<td>$msg_id</td>";
                            echo "<td>$msg_author</td>";
                            echo "<td>$msg_subject</td>";


                            if($msg_content == $msg_sort_content){
                                echo "<td>$msg_sort_content</td>";
                            } else {
                                echo "<td>$msg_sort_content.... <a title='Full Message' data-toggle='popover' data-trigger='hover' data-content='$msg_content'>show more</a></td>";
                            }
                            echo "<td>$author_email</td>";
                            echo "<td>$msg_date</td>";
                            echo "<td>$msg_status</td>";
                            if($msg_status == 'Panding'){
                                echo "<td><a class='btn btn-success' href='inbox.php?replied={$msg_id}'>Replied</a></td>";
                            } else if($msg_status == 'replied'){
                                echo "<td><a class='btn btn-info' href='inbox.php?panding={$msg_id}'>Panding</a></td>";
                            }

                            echo "<td><a rel='$msg_id' class='btn btn-danger delete_link' href='javascript:void(0)'>Delete</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <center>
                    <ul class="pagination pagination-lg">
                        <?php
                        for($i = 1; $i <= $count; $i++){
                            if($i == $page){
                                echo "<li class='active'><a href='inbox.php?page={$i}'>{$i}</a></li>";
                            } else {
                                echo "<li><a href='inbox.php?page={$i}'>{$i}</a></li>";
                            }

                        }
                        ?>
                    </ul>
                </center>
                <?php
                if(isset($_GET['replied'])){
                    $the_msg_id = $_GET['replied'];

                    $query = "UPDATE inbox SET msg_status = 'replied' WHERE msg_id = $the_msg_id ";
                    $approve_comment_query = mysqli_query($connection, $query);
                    header('Location: inbox.php');
                }

                if(isset($_GET['panding'])){
                    $the_msg_id = $_GET['panding'];

                    $query = "UPDATE inbox SET msg_status = 'Panding' WHERE msg_id = $the_msg_id ";
                    $approve_comment_query = mysqli_query($connection, $query);
                    header('Location: inbox.php');
                }

                if(isset($_GET['delete'])){
                    $gMsg_id = $_GET['delete'];
                    if(isset($_SESSION['user_role'])){
                        if($_SESSION['user_role'] == 'admin'){
                            $the_comment_id = mysqli_real_escape_string($connection, $gMsg_id);

                            $query = "DELETE FROM inbox WHERE msg_id = {$gMsg_id}";
                            $delete_query = mysqli_query($connection, $query);
                            header('Location: inbox.php?message=Message succesfully deleted');
                        }
                    }
                }
                ?>
                    <script>
                        $(document).ready(function() {
                            $(".delete_link").on('click', function() {
                                var id = $(this).attr("rel");
                                var delete_url = "inbox.php?delete=" + id + " ";
                                $(".modal_delete_link").attr("href", delete_url);
                                $("#myModal").modal('show');
                            });
                        });

                    </script>
            </div>
            <!-- /.row -->
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>
