<table class="w-auto table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Content</th>
            <th>Status</th>
            <th>Post</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM comments";
        $query_result = mysqli_query($connection, $query);
        ConfirmQuery($query_result);

        while ($row = mysqli_fetch_assoc($query_result)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            $post_title = Get_Post_Title_By_ID($comment_post_id);
        ?>
            <tr>
                <td><?php echo $comment_id ?></td>
                <td><?php echo $comment_author ?></td>
                <td><?php echo $comment_email ?></td>
                <td><?php echo $comment_content ?></td>
                <td><?php echo $comment_status ?></td>
                <td><a href="../post.php?p_id=<?php echo $comment_post_id ?>"><?php echo $post_title ?></a></td>
                <td><?php echo $comment_date ?></td>
                <td><a href="comments.php?approve=<?php echo $comment_id ?>">Approve</a></td>
                <td><a href="comments.php?unapprove=<?php echo $comment_id ?>">Unapprove</a></td>
                <td>
                    <div>
                        <a href="comments.php?delete=<?php echo $comment_id ?>">Delete</a>
                    </div>

                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_GET['approve'])) {
    $comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
    header('Location: comments.php');
}

if (isset($_GET['unapprove'])) {
    $comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
    header('Location: comments.php');
}

if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = $comment_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
    header('Location: comments.php');
}
?>