<?php
function ConfirmQuery($query_result)
{
    global $connection;

    if (!$query_result) {
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

function Insert_Category()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = trim($_POST['cat_title']);

        if (empty($cat_title)) {
            echo 'Input không hợp lệ';
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('{$cat_title}') ";
            // $create_category_query = mysqli_query($connection, $query);

            $create_category_query = mysqli_multi_query($connection, $query);
            // '); DROP TABLE test; --

            //** PREVENTION
            // $create_category_query = $connection->execute_query('INSERT INTO categories(cat_title) VALUES(?)', [$cat_title]);

            if (!$create_category_query) {
                die('QUERY FAILED' . mysqli_errno($connection));
            }

            // header('Location: categories.php');
        }
    }
}

function Show_All_Categories()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories_query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo
        "<tr>
            <td>{$cat_id}</td>
            <td>{$cat_title}</td>
            <td>
                <div>
                    <a href='categories.php?delete={$cat_id}'>Delete</a>
                    <a style='border-left: solid 1px black; padding-left: 2px;' href='categories.php?update={$cat_id}'>Update</a>
                </div>                                        
            </td>
        </tr>";
    }
}

function Delete_Category()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = $cat_id";
        $query_result = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function Get_Category_Title_By_ID($id)
{
    global $connection;

    $query = "SELECT * FROM categories WHERE cat_id = $id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
        return $row['cat_title'];
    }
}

function Get_Post_Title_By_ID($post_id)
{
    global $connection;
    
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $query_result = mysqli_query($connection, $query);

    if (!$query_result) {
        die('QUERY FAILED' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($query_result)) {
        $post_title = $row['post_title'];
    }
    
    return $post_title;
}
