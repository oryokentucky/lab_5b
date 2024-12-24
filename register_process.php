<?php
// register_process.php
include 'db_connection.php'; // Include your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match. Please try again.";
        exit;
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the users table
    $query = "INSERT INTO users (matric, name, role, password) VALUES ('$matric', '$name', '$role', '$hashed_password')";
    if (mysqli_query($conn, $query)) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
