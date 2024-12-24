<?php
// login_process.php
include 'db_connection.php'; // Include your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Fetch the user by matric and name
    $query = "SELECT * FROM users WHERE matric = '$matric' AND name = '$name'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Get the user data
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Successful login
            echo "Login successful. <a href='display_users.php'>View Users</a>";
        } else {
            // Incorrect password
            echo "Error: Invalid password. <a href='login.php'>Try again</a>";
        }
    } else {
        // No user found
        echo "Error: Invalid Matric or Name. <a href='login.php'>Try again</a>";
    }
}
?>
