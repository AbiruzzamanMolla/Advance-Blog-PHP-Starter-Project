<?php
include "delete_popup.php";

if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postId){
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options){
            case 'publish':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postId} ";
                $update_to_publish = mysqli_query($connection, $query);
                break;

            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postId} ";
                $update_to_draft = mysqli_query($connection, $query);
                break;
            case 'delete':
                $query = "delete FROM posts WHERE post_id = {$postId} ";
                $update_to_delete = mysqli_query($connection, $query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postId}' ";
                $select_post_by_id = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($select_post_by_id)){
                $post_title = $row['post_title'];
                $post_content = $row['post_content'];
                $post_author = $row['post_author'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_date = $row['post_date'];
                $post_tags = $row['post_tags'];
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
                $clone_query = mysqli_query($connection, $query);

                break;
        }

        }
}


?>
    <?php
// delete post function
delete_post();

if(isset($_GET['reset'])){
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) ." ";
    $reset_query = mysqli_query($connection, $query);
    header('Location: posts.php');
}
?>
        <script>
            $(document).ready(function () {
                $(".delete_link").on('click', function () {
                    var id = $(this).attr("rel");
                    var delete_url = "posts.php?delete=" + id + " ";
                    $(".modal_delete_link").attr("href", delete_url);
                    $("#myModal").modal('show');
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover();
            });
        </script>
        <?php //message request
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    $msg2 = $_GET['msg2'];
} else {
    $msg = '';
    $msg2 = '';
}
?>
            <?php //message show
msg_show($msg, $msg2);
?>
                <h1 class="page-header">
            View all Post
            <small></small>
        </h1>
                <form action="" method="post">
                    <table class="table table-bordered table-striped table-hover" width="100%">
                        <div id="bulkOptionsContainer" class="col-xs-4">
                            <select class="form-control" name="bulk_options" id="">
                                <option>Select Option</option>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                                <option value="delete">Delete</option>
                                <option value="clone">Clone</option>
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <input type="submit" class="btn btn-success" name="submit" value="Apply"> <a href="posts.php?source=add_post" class="btn btn-default">Add Post</a> </div>
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAllBoxs"> </th>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>Views</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <!-- <tfoot align="right">
    <tr class="right">


    </tr>
</tfoot> -->
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
                $post_query_count = "SELECT * FROM posts";
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count / 5);

        // $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1,$per_page";
        $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_date, posts.post_image, posts.post_content, posts.post_tags, posts.post_comment_count, posts.post_status, posts.post_views_count, categories.cat_id, categories.cat_title, categories.cat_image FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC LIMIT $page_1,$per_page";

        $select_post_by_id = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_post_by_id)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_date = $row['post_date'];
            $post_views_count = $row['post_views_count'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "<tr>";
            ?>
            <td>
            <input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"> </td>
            <?php
            echo "<td>$post_id</td>";
            echo "<td><a href='../author_post.php?author=$post_author'>$post_author</a></td>";
            echo "<td>$post_title</td>";
            echo "<td><a href='../category.php?category={$cat_id}'>$cat_title</a></td>";
            echo  "<td>$post_status</td>";
            echo  "<td><img width='100' src='../images/post_pic/$post_image' alt='image'/></td>";
            echo  "<td>$post_tags</td>";
            echo  "<td>$post_comment_count</td>";
            echo  "<td>$post_date</td>";
            echo  "<td><a onClick=\"javascript: return confirm('Are you sure want to reset?'); \" href='posts.php?reset={$post_id}'>$post_views_count</a></td>";
            echo  "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo  "<td><a class='btn btn-danger delete_link' rel='$post_id' href='javascript:void(0)'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
                        </tbody>
                    </table>
                </form>
                <center>
                    <ul class="pagination pagination-lg">
                        <?php
                    for($i = 1; $i <= $count; $i++){
                        if($i == $page){
                            echo "<li class='active'><a href='posts.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='posts.php?page={$i}'>{$i}</a></li>";
                        }

                    }
                    ?>
                    </ul>
                </center>
