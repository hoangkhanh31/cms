<?php
if (isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        $post_category_id = $row['post_category_id'];
    }

    if (isset($_POST['submit'])) {
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        $post_image = $_FILES['post_image']['name']; // lấy tên của file được tải lên
        $post_image_temp = $_FILES['post_image']['tmp_name']; // lấy tên tạm của file đã được tải lên máy chủ
        move_uploaded_file($post_image_temp, "../images/$post_image"); // có thể tránh đặt theo tên file gốc để bảo mật

        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $query_result = mysqli_query($connection, $query);
            ConfirmQuery($query_result);

            while ($row = mysqli_fetch_assoc($query_result)) {
                $post_image = $row['post_image'];
            }
        }

        //Update Post To Database
        $query = "UPDATE posts SET ";
        $query .= "post_category_id = ?,";
        $query .= "post_title = ?,";
        $query .= "post_author = ?,";
        $query .= "post_date = now(),";
        $query .= "post_image = ?,";
        $query .= "post_status = ?,";
        $query .= "post_tags = ?,";
        $query .= "post_content = ? ";
        $query .= "WHERE post_id = ?";

        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "issssssi", $post_category_id, $post_title, $post_author, $post_image, $post_status, $post_tags, $post_content, $post_id);
        $query_result = mysqli_stmt_execute($stmt);

        ConfirmQuery($query_result);

        header('Location: posts.php');
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title" class="form-label">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" name="post_title" class="form-control" id="post_title">
    </div>

    <div class="form-group">
        <label for="post_category_id" class="form-label">Post Category Title</label>
        <br>
        <select class="form-select" name="post_category_id" id="">
            <?php
            $query = "SELECT * FROM categories";
            $query_result = mysqli_query($connection, $query);
            ConfirmQuery($query_result);

            while ($row = mysqli_fetch_assoc($query_result)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                if ($cat_id == $post_category_id) {
                    echo "<option selected value='$cat_id'>$cat_title</option>";
                } else {
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author" class="form-label">Post Author</label>
        <input value="<?php echo $post_author ?>" type="text" name="post_author" class="form-control" id="post_author">
    </div>

    <div class="form-group">
        <label for="post_status" class="form-label">Post Status</label>
        <br>
        <select name="post_status" id="">
            <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <?php 
            if ($post_status == 'published') {
                echo "<option value='draft'>draft</option>";
            } else {
                echo "<option value='published'>published</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image" class="form-label">Post Image</label>
        <br>
        <img width="200px" src="../images/<?php echo $post_image ?>" alt="">
        <input style="margin-top: 10px;" type="file" name="post_image" class="form-control" id="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags" class="form-label">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" name="post_tags" class="form-control" id="post_tags">
    </div>

    <div class="form-group">
        <label for="summernote" class="form-label">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" name="submit" type="submit" value="Publish Post">
    </div>
</form>