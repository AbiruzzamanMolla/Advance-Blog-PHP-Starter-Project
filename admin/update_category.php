<?php //edit query
                            if(isset($_GET['edit'])){
                              $cat_id = $_GET['edit'];
                                $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                                 $edit_query = mysqli_query($connection, $query);
                                 while($row = mysqli_fetch_assoc($edit_query)){
                                  $cat_title = $row['cat_title'];
                                  $cat_id = $row['cat_id'];
                                  ?>
<div class='col-xs-6'>
    <h1 class='page-header'>
        Edit Category
        <small></small>
    </h1>
    <form action="" method="post">
        <div class="input-group input-group-lg">
            <input type='text' name='cat_title' value='<?php if(isset($cat_title)){echo $cat_title;} ?>' class='form-control'>
        </div>
        <div class="btn-group btn-group-lg">
            <input type="submit" name="update" class="btn btn-primary" value="Edit Category">
        </div>
    </form>
</div>
<?php }}
              ?>
<?php // update category query
                        if(isset($_POST['update'])){
                            $da_cat_title = $_POST['cat_title'];
                            update_category($da_cat_title, $cat_id);
                        }
?>
