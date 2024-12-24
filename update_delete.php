<?php
// update_delete.php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $action = $_GET['action'];

    if ($action == 'update') {
     
        $query = "SELECT * FROM users WHERE matric = '$matric'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <h2>Update User</h2>
        <form action="update_delete.php?matric=<?php echo $matric; ?>&action=update" method="POST">
            <label for="matric">Matric Number:</label>
            <input type="text" name="matric" value="<?php echo $row['matric']; ?>" readonly><br><br>

            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

            <label for="role">Role:</label>
            <input type="text" name="role" value="<?php echo $row['role']; ?>" required><br><br>

            <input type="submit" value="Update">
        </form>
        <?php
    } elseif ($action == 'delete') {
    
        $query = "DELETE FROM users WHERE matric = '$matric'";
        if (mysqli_query($conn, $query)) {
            echo "User deleted successfully. <a href='display_users.php'>Back to Users List</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == 'update') {
    
    $matric = $_GET['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];


    $query = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";
    if (mysqli_query($conn, $query)) {
        echo "User updated successfully. <a href='display_users.php'>Back to Users List</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
