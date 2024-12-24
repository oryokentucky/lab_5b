<?php
session_start(); // Start the session

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Redirect to login page
    exit;
}

// Include DB connection
include 'db_connection.php';

// Fetch all users from the database
$query = "SELECT matric, name, role FROM users";
$result = mysqli_query($conn, $query);

echo "<h2>User List</h2>";
echo "<table border='1'>
        <tr>
            <th>Matric Number</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>";

// Loop through the result and display each user's details with options to update or delete
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>" . $row['matric'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['role'] . "</td>
            <td>
                <a href='update_delete.php?matric=" . $row['matric'] . "&action=update'>Update</a> |
                <a href='update_delete.php?matric=" . $row['matric'] . "&action=delete' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
            </td>
          </tr>";
}

echo "</table>";
?>

<!-- Logout Button -->
<form action="logout.php" method="POST">
    <button type="submit" style="background-color: #f44336; color: white; padding: 10px 15px; border: none; cursor: pointer;">Logout</button>
</form>
