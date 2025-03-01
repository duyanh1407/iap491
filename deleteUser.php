<?php
include "connectDB.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_user"])) {
    $userId = $_POST["delete_user"];
    //take username from database
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Delete user from the database
        $sql1 = "DELETE FROM users WHERE id ='$userId'";
        if ($conn->query($sql1) === TRUE) {
            echo "Delete Successful";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>alert('Delete error')</script>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeleteUser</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="top-bar">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2>Welcome to the Admin Page</h2>
            <p>You are logged in as:
                <?php echo $_SESSION['username']; ?>
            </p>
            <h3>User List</h3>
    </div>
    <?php

    include "connectDB.php";
    // Fetch the user list from the database
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    // Check the user
    if ($result->num_rows > 0) {
        echo "<ul>";
        // Show all the user
        while ($row = $result->fetch_assoc()) {
            if ($row['role'] !== 'admin') {
                echo "<div class='post'>";
                echo "<li>" . $row['username'] . " - <button type='submit' name='delete_user' value='" . $row['id'] . "' >Delete</button></li>";
                echo "</div>";
            }
        }
        echo "</ul>";
    } else {
        echo "No users found.";
    }
    $conn->close();
    ?>

    <!-- home -->
    <a href="home.php">Home</a>
    </form>
</body>

</html>