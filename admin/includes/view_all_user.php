<?php include "delete_popup.php"; ?>
<table class="table table-bordered table-striped table-hover" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firs Name</th>
            <th>Last Name</th>
            <th>Sex</th>
            <th>Email</th>
            <th>Role</th>
            <th>Reg Date</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
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
         $post_query_count = "SELECT * FROM users";
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count / 5);

        $query = "SELECT * FROM users ORDER BY user_id DESC LIMIT $page_1,$per_page";
        $select_users = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_users)) {
            $user_id             = $row['user_id'];
            $username            = $row['username'];
            $user_password       = $row['user_password'];
            $user_firstname      = $row['user_firstname'];
            $user_lastname       = $row['user_lastname'];
            $user_reg            = $row['user_reg'];
            $user_sex            = $row['user_sex'];
            $user_email          = $row['user_email'];
            $user_image          = $row['user_image'];
            $user_role           = $row['user_role'];
            echo "<tr>";
            echo "<td>$user_id </td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_sex</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            echo "<td>$user_reg</td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure want to change to admin?'); \" class='btn btn-success' href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a class='btn btn-primary' href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a class='btn btn-info' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a rel='$user_id' class='btn btn-danger delete_link' href='javascript:void(0)'>Delete</a></td>";
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
                            echo "<li class='active'><a href='users.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='users.php?page={$i}'>{$i}</a></li>";
                        }

                    }
                    ?>
    </ul>
</center>
<?php

if(isset($_GET['change_to_admin'])) {

    $the_user_id = escape($_GET['change_to_admin']);

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id   ";
    $change_to_admin_query = mysqli_query($connection, $query);
    echo "<div class='alert alert-success'><h1 class='text-center'>Changed To Admin</h></div>";
    header("Location: users.php");



}


if(isset($_GET['change_to_sub'])){

    $the_user_id = escape($_GET['change_to_sub']);


    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id   ";
    $change_to_sub_query = mysqli_query($connection, $query);
    header("Location: users.php");

}

delete_user();
?>
    <script>
        $(document).ready(function() {
            $(".delete_link").on('click', function() {
                var id = $(this).attr("rel");
                var delete_url = "users.php?delete=" + id + " ";
                $(".modal_delete_link").attr("href", delete_url);
                $("#myModal").modal('show');
            });
        });

    </script>
