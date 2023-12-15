<?php
function ConfirmQuery($query_result)
{
    global $connection;

    if (!$query_result) {
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

function Increase_Comment_Count($post_id)
{
    global $connection;

    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
    $query .= "WHERE post_id = $post_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
}
