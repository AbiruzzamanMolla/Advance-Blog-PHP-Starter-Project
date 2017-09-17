<div class="col-md-4">
	<?php

                            if(isset($_SESSION['user_role'])){
                            $user_role = $_SESSION['user_role'];
                            $user_name = $_SESSION['username'];
                            if($user_role == 'admin') {
                                echo "<div class='well'><h4>Hi, $user_name</h4><br><li><a href='admin/index.php'>Admin Panel</a></li><li><a href='users'>Control Panel</a></li><li><a href='admin/users.php?source=change_password'>Change Password</a></li><br><center><a class='btn btn-danger' href='logout.php'>Logout</a></center></div>";
                            } else {
                                echo "<div class='well'><h4>Hi, $user_name</h4><br><li><a href='../cms/users'>Control Panel</a></li><li><a href='change_password.php'>Change Password</a></li><br><center><a class='btn btn-danger' href='logout.php'>Logout</a></center></div>";
                            }
                           } else { //message request
                                    if(isset($_GET['msg'])){
                                        $msg = $_GET['msg'];
                                        $msg2 = $_GET['msg2'];
                                        msg_show($msg, $msg2);
                                    } else {
                                        $msg = '';
                                        $msg2 = '';
                                    }
                                
                            echo "<div class='well'>
                                <h4>Login</h4>
                                <form action='includes/login.php' method='post'>
                                <div class='input-group'>
                                <label for='username'><i class='fa fa-fw fa-user'></i>Username:</label>
                                <input name='username' type='text' class='form-control' placeholder='Enter Username'>
                                </div>
                                <div class='input-group'>
                                <label for='password'><i class='fa fa-fw fa-key'></i>Password:</label>
                                <input name='password' type='text' class='form-control' placeholder='Enter Password'>
                                </div>
                                <div class='input-group'>
                                <button name='login' class='btn btn-default' type='submit'>Login</button>
                                </div>
                                </form>
                                </div>
                                "; } ?>
		<!-- Blog recent post Well -->
		<div class="well">
			<h4>Recent Posts</h4>
			<div class="row">
				<div class="col-lg-6">
					<ul class="list-unstyled">
						<?php
                    $query = "SELECT * FROM posts WHERE post_status = 'publish' ORDER BY post_id DESC LIMIT 5";
                    $select_recent_posts_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_recent_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        echo "<li><p><i class='fa fa-fw fa-clipboard'></i> <a href='post.php?p_id={$post_id}'>{$post_title}</a></p></li>";
                    }
                    ?>
					</ul>
				</div>
				<!-- /.col-lg-6 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- Blog Categories Well -->
		<div class="well">
			<h4>Recent Comments</h4>
			<div class="row">
				<div class="col-lg-6">
					<ul class="list-unstyled">
						<?php
                    $query = "SELECT posts.post_id, posts.post_title, comments.comment_id, comments.comment_post_id, comments.comment_author, comments.comment_status FROM posts LEFT JOIN comments ON posts.post_id = comments.comment_post_id ORDER BY comments.comment_id DESC LIMIT 5";
                    $select_recent_comments_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_recent_comments_query)){
                        $post_id = $row['post_id'];
                        $comment_author = $row['comment_author'];
                        $comment_status = $row['comment_status'];
                        $post_title = $row['post_title'];
                        if($comment_status == 'approve'){
                        echo "<li><p><i class='fa fa-fw fa-comments'></i> {$comment_author} on <a href='post.php?p_id={$post_id}'>{$post_title}</a></p></li>";
                        }
                    }
                    ?>
					</ul>
				</div>
				<!-- /.col-lg-6 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- Blog Categories Well -->
		<div class="well">
			<h4>Blog Categories</h4>
			<div class="row">
				<div class="col-lg-6">
					<ul class="list-unstyled">
						<?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><i class='fa fa-fw fa-arrow-right'></i><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                    ?>
					</ul>
				</div>
				<!-- /.col-lg-6 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- Side Widget Well -->
		<?php include "includes/widget.php"; ?>
</div>
