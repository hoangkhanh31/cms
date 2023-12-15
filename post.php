<?php include "./includes/db.php"; ?>
<?php include "./includes/header.php"; ?>

<!-- Navigation -->
<?php include "./includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
            }

            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                    <img class="img-responsive" src="./images/<?php echo $post_image ?> " alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>

            <?php
            }
            ?>

            <!-- Blog Comments -->

            <?php
            if (isset($_POST['submit'])) {
                $post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query .= "VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'approved', now())";
                $query_result = mysqli_query($connection, $query);
                ConfirmQuery($query_result);

                Increase_Comment_Count($post_id);
            }

            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" role="form" method="post">
                    <div class="form-group">
                        <label for="comment_author" class="form-label">Họ tên</label>
                        <input name="comment_author" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment_email" class="form-label">Email</label>
                        <input name="comment_email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment_content" class="form-label">Nội dung bình luận</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php
            $query = "SELECT * FROM comments ";
            $query .= "WHERE comment_post_id = $post_id AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC";
            $query_result = mysqli_query($connection, $query);
            ConfirmQuery($query_result);

            while ($row = mysqli_fetch_assoc($query_result)) {
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_date = $row['comment_date'];
            ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>
            <?php
            }
            ?>

            <!-- Nested Comment -->
            <!-- <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Nested Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div> -->
            <!-- End Nested Comment -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "./includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "./includes/footer.php"; ?>