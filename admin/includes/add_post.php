<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name']; // lấy tên của file được tải lên
    $post_image_temp = $_FILES['post_image']['tmp_name']; // lấy tên tạm của file đã được tải lên máy chủ
    move_uploaded_file($post_image_temp, "../images/$post_image"); // có thể tránh đặt theo tên file gốc để bảo mật

    $post_date = date('d-m-Y');
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_comment_count = 0;

    $query = "INSERT INTO posts(post_title, post_category_id, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES('$post_title', $post_category_id, '$post_author', now(), '$post_image', '$post_content', '$post_tags', $post_comment_count, '$post_status')";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title" class="form-label">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_category_id" class="form-label">Post Category Title</label>
        <br>
        <select class="form-select" name="post_category_id">
            <?php
            $query = "SELECT * FROM categories";
            $query_result = mysqli_query($connection, $query);
            ConfirmQuery($query_result);

            while ($row = mysqli_fetch_assoc($query_result)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author" class="form-label">Post Author</label>
        <input type="text" name="post_author" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status" class="form-label">Post Status</label>
        <br>
        <select name="post_status" id="">
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image" class="form-label">Post Image</label>
        <input type="file" name="post_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_tags" class="form-label">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content" class="form-label">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" name="create_post" type="submit" value="Publish Post">
    </div>
</form>