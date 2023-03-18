<?php
// Include the database connection code
include_once 'conn_db.php';

// Start the session
session_start();

// Retrieve the form data
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Validate the input
if (empty($username) || empty($password)) {
    // Handle the error - username and password are required
    $_SESSION['login_error'] = 'Username and password are required';
    header('Location: l_login_page.php');
    exit();
}

// Check the credentials against the database
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)) {
    // The login credentials are valid - set the session variable and redirect the user to the products page
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['user_id'];
    header('Location: product_display.php');
    exit();
} else {
    // The login credentials are invalid - display an error message and prompt the user to try again
    $_SESSION['login_error'] = 'Invalid username or password';
    header('Location: l_login_page.php?error=login');
    exit();
}
?>
