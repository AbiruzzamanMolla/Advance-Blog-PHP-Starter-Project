<?php
if(isset($_GET['p_id'])){
$p_id = $_GET['p_id'];
}

if(isset($_SESSION['username'])){
    $s_username = $_SESSION['username'];
}

$query = "SELECT * FROM posts WHERE post_id = $p_id";
$select_post_by_id = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($select_post_by_id)){
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_content = $row['post_content'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_date = $row['post_date'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];

    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $s_username;
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($post_image_temp, "../images/post_pic/$post_image");

        $post_tags = $_POST['post_tags'];
        $post_content = escape($_POST['post_content']);

        move_uploaded_file($post_image_temp, "../images/post_pic/$post_image");
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $p_id ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($select_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}'";
        $query .= " WHERE post_id = {$p_id}";

        $update_query = mysqli_query($connection, $query);
        confirm($update_query);

        echo "<div class='alert alert-success'><strong>Success!</strong> Post successfully updated. <a href='../post.php?p_id={$p_id}'>View Post</a> or <a href='posts.php'>Edit More</a></div>";
    }

}
?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>"> </div>
        <table class="table table-bordered table-striped table-hover" width="100%">
            <thead>
                <tr>
                    <th class="col-sm-2 control-label">Select Category</th>
                    <th class="col-sm-2 control-label">Post Author</th>
                    <th class="col-sm-2 control-label">Post Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="post_category" id="" class="form-control">
                            <?php
                            $query = "SELECT * FROM categories";
                            $select_category = mysqli_query($connection, $query);
                            confirm($select_category);

                            while($row = mysqli_fetch_assoc($select_category)){
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                if($cat_id == $post_category_id){
                                    echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
                                } else {
                                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                                }

                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="post_author" id="disabledInput" disabled>
                            <option>
                                <?php echo $s_username; ?>
                            </option>
                        </select>
                    </td>
                    <td>
                        <select name="post_status" id="" class="form-control">
                            <option value="<?php echo $post_status; ?>">
                                <?php echo $post_status; ?>
                            </option>
                            <?php
                            if($post_status == 'publish') {
                                echo "<option value='draft'>Draft</option>";
                            } else {
                                echo "<option value='publish'>Publish</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="form-group">
            <label for="post_image">Post Image</label> <img width="100" src="../images/post_pic/<?php echo $post_image; ?>" alt="image">
            <input type="file" name="image"> </div>
        <div class="form-group">
            <label for="post_tags">Tags</label>
            <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>"> </div>
        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10">
                <?php echo $post_content; ?>
            </textarea>
        </div>
        <div class="btn-group btn-group-lg">
            <input type="submit" name="update_post" class="btn btn-primary" value="Update Post"> </div>
    </form>
