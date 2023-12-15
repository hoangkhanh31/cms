<?php
if (isset($_POST['submit'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";
    $query .= "VALUES('$username', '$user_password', '$user_firstname', '$user_lastname', '$user_email', '$user_role')";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);

    echo "<script>alert('User added successfully')</script>";
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname" class="form-label">Firstname</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_lastname" class="form-label">Firstname</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_role" class="form-label">User Role</label>
        <br>
        <select class="form-select" name="user_role" id="">
            <option value="user">Select Role</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>

    <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email" class="form-label">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password" class="form-label">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" name="submit" type="submit" value="Add User">
    </div>
</form>