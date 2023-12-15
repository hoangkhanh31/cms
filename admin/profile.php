<?php include "includes/admin_header.php" ?>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $query_result = mysqli_query($connection, $query);
    ConfirmQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
    }
}
?>

<?php 
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
    $query .= "WHERE username = '$username'";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $user_firstname, $user_lastname, $user_role, $user_email, $username, $user_password);
    $query_result = mysqli_stmt_execute($stmt);

    ConfirmQuery($query_result);

    // header('Location: profile.php');
}
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin page
                        <small>Subheading</small>
                    </h1>

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
                                } else {
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
                            <input class="btn btn-primary" name="submit" type="submit" value="Update Profile">
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<?php include "includes/admin_footer.php" ?>