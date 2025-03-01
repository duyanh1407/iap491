<?php
session_start();

include "connectDB.php"; //connect to database
function editPost($postId)
{
    global $conn;
    // Fetch post details from the database
    $sql = "SELECT * FROM posts WHERE id = $postId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display a form to edit the post
        echo "<form action='editPost.php?action=update&id=$postId' method='post'>";
        echo "<div id='top-bar'>";
        echo "<a href='newfeed.php'>Back to New Feed</a>";
        echo "</div>";
        echo "<div id='add-post-form'>";
        echo "<h2>Edit Post</h2>";
        echo "<label>Title:</label>";
        echo "<input type='text' name='edited_title' value='" . $row['title'] . "' style='font-size: medium;' required></br>";
        echo "<label>Content:</label> ";
        echo "<input type='text' name='edited_content' value='" . $row['content'] . "' style='font-size: medium;' required></br>";
        echo "<button type='submit'  class='button'>Update</button>";
        echo "</div>";
        echo "</form>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $postId = $_GET['id'];
    if ($action === "edit") {
        editPost($postId);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === "update") {
    $postId = $_GET['id'];
    $editedTitle = ($_POST['edited_title']);
    $editedContent = ($_POST['edited_content']);

    // Check if edited title and content are not empty
    if (!empty($editedTitle) && !empty($editedContent)) {
        $sql = "UPDATE posts SET title = '$editedTitle', content = '$editedContent' WHERE id = $postId";
        $result = $conn->query($sql);

        if ($result) {
            echo "<script>alert('Post updated successfully')</script>";
            header("location: newfeed.php");
        } else {
            echo "<script>alert('Error updating post')</script>";
        }
    }
}
// Handle update action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] === "update") {
    $postId = $_GET['id'];
    $editedTitle = ($_POST['edited_title']);
    $editedContent = ($_POST['edited_content']);

    // Check if edited title and content are not empty
    if (!empty($editedTitle) && !empty($editedContent)) {
        $sql = "UPDATE posts SET title = '$editedTitle', content = '$editedContent' WHERE id = $postId";
        $result = $conn->query($sql);

        if ($result) {
            echo "<script>alert('Post updated successfully')</script>";
        } else {
            echo "<script>alert('Error updating post')</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    #bar {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: left;
    }

    #bar a {
        color: #fff;
        text-decoration: none;
        margin-right: 10px;
    }

    #container {
        margin: 20px;
    }

    #add-post-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    #add-post-form label {
        display: block;
        margin-bottom: 10px;
    }

    #add-post-form input,
    #add-post-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    #add-post-form button {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
    }

    #add-post-form button:hover {
        background-color: #0056b3;
    }
</style>

<body>


</body>

</html>