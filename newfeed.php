<?php
// newfeed.php will contain deletepost and editpost
session_start();
include "connectDB.php"; //connect to database
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

//display delete and edit buttons
function displayButtons($postId)
{
    echo "<a href='newfeed.php?action=delete&id=$postId'>Delete</a> | ";
    echo "<a href='editPost.php?action=edit&id=$postId'>Edit</a>";
}
// Function to delete a post by post ID
function deletePost($postId)
{
    global $conn;
    $sql = "DELETE FROM posts WHERE id = $postId";
    $result = $conn->query($sql);

    if ($result) {
        echo "<script>alert('Post deleted successfully')</script>";
    } else {
        echo "<script>alert('Error deleting post')</script>";
    }
}

// Handle delete and edit actions
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $postId = $_GET['id'];

    if ($action === "delete") {
        deletePost($postId);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Feed</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="top-bar">
        <a href="logout.php" class="button">Logout</a>
        <p>You are logged in as:
            <?php echo $_SESSION['username']; ?><br><br>
            <a href="addPost.php" class="button">Add Post</a>
            <a href="search.php" class="button">Search post</a>
        </p>
    </div>

    <div id="container">
        <h2>New Feed</h2>

        <?php
        // Fetch posts from the database
        $sql = "SELECT * FROM posts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<h3>Title: " . $row['title'] . "</h3>";
                echo "<p>Content: " . $row['content'] . "</p>";
                echo "<p>Posted by: " . $row['username'] . "</p>";
                echo "<p>Post ID: " . $row['id'] . "</p>";
                displayButtons($row['id']); // Display delete and edit buttons
                echo "</div><br>";
            }
        } else {
            echo "No posts found.";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>