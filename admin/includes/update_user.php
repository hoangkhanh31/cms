<?php
if (isset($_GET['update'])) {
    $user_id = $_GET['update'];

    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
    }

    if (isset($_POST['submit'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['user_email'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];

        $query = "UPDATE users SET ";
        $query .= "user_firstname = ?,";
        $query .= "user_lastname = ?,";
        $query .= "user_role = ?,";
        $query .= "user_email = ?,";
        $query .= "username = ?,";
        $query .= "user_password = ? ";
        $query .= "WHERE user_id = $user_id";

        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $user_firstname, $user_lastname, $user_role, $user_email, $username, $user_password);
        $query_result = mysqli_stmt_execute($stmt);

        ConfirmQuery($query_result);

        header('Location: users.php');
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname" class="form-label">Firstname</label>
        <input value="<?php echo $user_firstname ?>" type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_lastname" class="form-label">Firstname</label>
        <input value="<?php echo $user_lastname ?>" type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_role" class="form-label">User Role</label>
        <br>
        <select class="form-select" name="user_role" id="">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>

            <?php
            if ($user_role == 'admin') {
                echo "<option value='user'>user</option>";
            }
            else {
                echo "<option value='admin'>admin</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input value="<?php echo $username ?>" type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email" class="form-label">Email</label>
        <input value="<?php echo $user_email ?>" type="email" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password" class="form-label">Password</label>
        <input value="<?php echo $user_password ?>" type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" name="submit" type="submit" value="Update User">
    </div>
</form>