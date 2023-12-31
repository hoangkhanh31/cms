<?php include "db.php" ?>
<?php include "functions.php" ?>

<?php session_start() ?>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}

// $username = mysqli_real_escape_string($connection, $username);
// $password = mysqli_real_escape_string($connection, $password);

// $query = "SELECT * FROM users WHERE username = '$username'";
// $query_result = mysqli_query($connection, $query);
// ConfirmQuery($query_result);

// while ($row = mysqli_fetch_assoc($query_result)) {
//     $db_user_id = $row['user_id'];
//     $db_username = $row['username'];
//     $db_user_password = $row['user_password'];
//     $db_user_firstname = $row['user_firstname'];
//     $db_user_lastname = $row['user_lastname'];
//     $db_user_role = $row['user_role'];
// }

// if ($username === $db_username && $password === $db_user_password) {
//     //Login Successfully
//     $_SESSION['username'] = $db_username;
//     $_SESSION['firstname'] = $db_user_firstname;
//     $_SESSION['lastname'] = $db_user_lastname;
//     $_SESSION['user_role'] = $db_user_role;

//     header("Location: ../admin");
// } else {
//     header("Location: ../index.php");
// }

// **** DEMO SQL INJECTION ****
// ' or 1=1 --'

$query = "SELECT * FROM users WHERE username = '$username' AND user_password = '$password'";
// $query_result = mysqli_multi_query($connection, $query);
$query_result = mysqli_query($connection, $query);
ConfirmQuery($query_result);

if (mysqli_num_rows($query_result) > 0) {
    while ($row = mysqli_fetch_assoc($query_result)) {
        $db_username = $row['username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }
    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;

    header("Location: ../admin");
} else {
    header("Location: ../index.php");
}


// **** PREVENTION SQL INJECTION USING execute_query (PHP ver 8.2>>) ****

// $query = "SELECT * FROM users WHERE username = '$username' AND user_password = '$password'";
// $query_result = $connection->execute_query('SELECT * FROM users WHERE username = ? AND user_password = ?', [$username, $password]);

// if (mysqli_num_rows($query_result) > 0) {
//     while ($row = mysqli_fetch_assoc($query_result)) {
//         $db_username = $row['username'];
//         $db_user_firstname = $row['user_firstname'];
//         $db_user_lastname = $row['user_lastname'];
//         $db_user_role = $row['user_role'];
//     }
//     $_SESSION['username'] = $db_username;
//     $_SESSION['firstname'] = $db_user_firstname;
//     $_SESSION['lastname'] = $db_user_lastname;
//     $_SESSION['user_role'] = $db_user_role;

//     header("Location: ../admin");
// } else {
//     header("Location: ../index.php");
// }

?>
