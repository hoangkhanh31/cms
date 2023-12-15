<table class="w-auto table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Date</th>
            <th>Image</th>
            <th>Content</th>
            <th>Tags</th>
            <th>Comment Count</th>
            <th>Status</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM posts";
        $query_result = mysqli_query($connection, $query);
        ConfirmQuery($query_result);

        while ($row = mysqli_fetch_assoc($query_result)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];
        ?>
            <tr>
                <td><?php echo $post_id ?></td>
                <td><?php echo $post_title ?></td>
                <td><?php echo Get_Category_Title_By_ID($post_category_id) ?></td>
                <td><?php echo $post_author ?></td>
                <td><?php echo $post_date ?></td>
                <td><img style="width: 100px;" src="../images/<?php echo $post_image ?>" alt=""></td>
                <td><?php echo $post_content ?></td>
                <td><?php echo $post_tags ?></td>
                <td><?php echo $post_comment_count ?></td>
                <td><?php echo $post_status ?></td>
                <td><a href='./posts.php?source=update_post&p_id=<?php echo $post_id ?>'>Update</a></td>
                <td><a href="./posts.php?delete=<?php echo $post_id ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = $post_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
    header('Location: posts.php');
}
?>