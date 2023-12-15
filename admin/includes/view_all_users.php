<table class="w-auto table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change To Admin</th>
            <th>Change To User</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM users";
        $query_result = mysqli_query($connection, $query);
        ConfirmQuery($query_result);

        while ($row = mysqli_fetch_assoc($query_result)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];

        ?>
            <tr>
                <td><?php echo $user_id ?></td>
                <td><?php echo $username ?></td>
                <td><?php echo $user_firstname ?></td>
                <td><?php echo $user_lastname ?></td>
                <td><?php echo $user_email ?></td>
                <td><?php echo $user_role ?></td>
                <td><a href="users.php?change_to_admin=<?php echo $user_id ?>">Admin</a></td>
                <td><a href="users.php?change_to_user=<?php echo $user_id ?>">User</a></td>
                <td><a href="users.php?source=update_user&update=<?php echo $user_id ?>">Update</a></td>
                <td><a href="users.php?delete=<?php echo $user_id ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_GET['change_to_admin'])) {
    $user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
    header('Location: users.php');
}

if (isset($_GET['change_to_user'])) {
    $user_id = $_GET['change_to_user'];

    $query = "UPDATE users SET user_role = 'user' WHERE user_id = $user_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
    header('Location: users.php');
}

if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = $user_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);
    header('Location: users.php');
}
?>