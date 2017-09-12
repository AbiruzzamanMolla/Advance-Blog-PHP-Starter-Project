<?php

/* #####################################admin header functions###############################################################
1. Online Users Counting
2. Admin session checking
3.
*/

function users_online(){

    global $connection;

    $session = session_id();
    $time = time();
    $time_out_in_seconds = 30;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM online_users WHERE session = '$session' ";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if($count == null){
        mysqli_query($connection, "INSERT INTO online_users(session, time) VALUES('$session', '$time')");
    } else {
        mysqli_query($connection, "UPDATE online_users SET time = '$time' WHERE session = '$session' ");
    }

    $user_online_query = mysqli_query($connection, "SELECT * FROM online_users WHERE time > '$time_out' ");
    return $count_online_users = mysqli_num_rows($user_online_query);

}

function is_admin($username = ''){
    global $connection;
    $query  = "SELECT user_role FROM users WHERE username = '{$username}' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $row = mysqli_fetch_array($result);
    if($row['user_role'] == 'admin'){
        return true;
    } else {
        return false;
    }
}

function is_user($username = ''){
    global $connection;
    $query  = "SELECT user_role FROM users WHERE username = '{$username}' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $row = mysqli_fetch_array($result);
    if($row['user_role'] == 'subscriber'){
        return true;
    } else {
        return false;
    }
}
/* ********************************************admin header functions ends here******************************************************** */

/* ##################################### global functions###############################################################################

*/

function redirect($location){
    return header("Location:" . $location);
}

function confirm($result){
    global $connection;

    if(!$result){
        die('Query Failed ' . mysqli_error($connection));
    }
    return $result;

}

function confirmQuery($result) {

    global $connection;

    if(!$result ) {

        die("QUERY FAILED ." . mysqli_error($connection));


    }


}

function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));


}

function msg_show($msg, $msg2){
    if($msg !== ''){
                    echo "<div class='alert alert-success alert-dismissable fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><strong>$msg!</strong> $msg2</center></div>";
                }
            }



function welcome(){
    echo "Welcome ".$_SESSION['username'];
}

function dateSave(){
    date('D, F d, Y - h:i:s A');
}
/* ***********************************************global functions ends here******************************************************* */

/* #################################################registation functions###########################################################

*/
function register_user($username, $firstname, $lastname, $sex, $email, $password){
    global $connection;

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        date_default_timezone_set("Asia/Dhaka");
        $reg_date = date('Y-m-d h:i:s A');
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>10));
        $query = "INSERT INTO users (username, user_firstname, user_lastname, user_sex, user_reg, user_email, user_password, user_role) VALUES('{$username}','{$firstname}','{$lastname}','{$sex}', '{$reg_date}', '{$email}', '{$password}', 'subscriber')";
        $registration_user_query = mysqli_query($connection, $query);
        confirmQuery($registration_user_query);


}


function username_exists($username){
    global $connection;
    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function email_exists($email){
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}


/* ********************************************registation functions ends here********************************************************** */

/* ###############################################login functions######################################################################

*/
function login_user($username, $password){
    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_username_query = mysqli_query($connection, $query);

    if(!$select_username_query) {
        die('Query Failed' . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_username_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_email = $row['user_email'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }

    if (password_verify($password, $db_user_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['email'] = $db_email;

        if($db_user_role == 'admin'){
            redirect("../admin");
            } else {
                redirect("../index.php");
            }

    } else {
        redirect("../index.php");
    }
}

/* ********************************************login functions ends here**************************************************************** */


/* ####################################################Category functions##############################################################

*/

function add_category(){
    global $connection;
     if(isset($_POST['submit'])){
                $cat_title = $_POST['cat_title'];
                if($cat_title == "" || empty($cat_title)){
                    echo $ctg_warnnning = "<div class='alert alert-danger alert-dismissable'><strong>Opps!</strong> Field can't be empty.</div>";
                }
                else {
                    $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUE(?)");
                        mysqli_stmt_bind_param($stmt, "s", $cat_title);
                        mysqli_stmt_execute($stmt);
                    if($stmt){
                        redirect("categories.php?msg=Done&msg2=New%20category%20created");
                    } else {
                        die('Query Failed' . mysqli_error($connection));
                    }
                }
                mysqli_stmt_close($stmt);
            }
}

function category_table(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories_query = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_categories_query)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    $post_count_query = "SELECT * FROM posts WHERE post_category_id = {$cat_id} ";
    $post_count = mysqli_query($connection, $post_count_query);
    $count = mysqli_num_rows($post_count);

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td><a href='../category.php?category=$cat_id'>{$cat_title}</a></td>";
    echo "<td>{$count}</td>";
    echo "<td><a class='btn btn-info' href='?edit=$cat_id'>Edit</a></td>";
    echo "<td><a rel='$cat_id' class='btn btn-danger delete_link' href='javascript:void(0)'>Delete</a></td>";
    echo "</tr>";
 }
}

function update_category($da_cat_title, $cat_id){
    global $connection;
    $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ?");
            mysqli_stmt_bind_param($stmt, "si", $da_cat_title, $cat_id);
            mysqli_stmt_execute($stmt);
            if(!$stmt){
                die('Query Failed' . mysqli_error($connection));
            } else {
                redirect("categories.php?msg=Done&msg2=Category%20name%20updated");
            }
            mysqli_stmt_close($stmt);
}

function delete_category() {
    global $connection;
     if(isset($_GET['delete'])){
         $the_cat_id = $_GET['delete'];
         if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'admin'){
                $the_cat_id = mysqli_real_escape_string($connection, $the_cat_id);
                $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

                $delete_query = mysqli_query($connection, $query);
                    if($delete_query){
                        echo $ctg_success = "<div class='alert alert-info alert-dismissable'><strong>Seccess!</strong> Category Deleted</div>";
                    } else {
                        die('Query Failed' . mysqli_error($connection));
                    }
                    redirect("categories.php?msg=Done&msg2=Category%20deleted");
            }
             }
     }
}

/* ********************************************Category functions ends here*********************************************************** */

function delete_user() {
    global $connection;
    if(isset($_GET['delete'])){
        $the_user_id = $_GET['delete'];
        if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'admin'){
                $the_user_id = mysqli_real_escape_string($connection, $the_user_id);
                $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
                $delete_query = mysqli_query($connection, $query);
                if($delete_query){
                echo $ctg_success = "<div class='alert alert-info alert-dismissable'><strong>Seccess!</strong> Category Deleted</div>";
                } else {
                    die('Query Failed' . mysqli_error($connection));
                }
                    redirect("users.php");
            }
        }
    }
}

function delete_post() {
    global $connection;
    if(isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
        $the_post_id = mysqli_real_escape_string($connection, $the_post_id);

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
        $delete_query = mysqli_query($connection, $query);
        if($delete_query){
            echo $ctg_success = "<div class='alert alert-info alert-dismissable'><strong>Seccess!</strong> Post Deleted</div>";
        } else {
            die('Query Failed' . mysqli_error($connection));
        }
        redirect("posts.php");

    }
        }
        }
}



?>
