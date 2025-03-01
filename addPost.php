<?php
session_start();
include "connectDB.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $username = $_SESSION["username"];

    //check if title or content is empty
    if (empty($title) || empty($content)) {
        echo "<script>alert('title or content cant be empty')</script>";
    } else {
        $sql = "INSERT INTO posts (username, title, content) VALUES ('$username', '$title', '$content')";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            echo "<script>alert('Post added successfully')</script>";
            header('location: newfeed.php');
        } else {
            echo "<script>alert('Error adding post')</script>";
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
    <title>Document</title>
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
    <div id="bar">
        <a href="newfeed.php">Back to New Feed</a>
    </div>

    <div id="container">
        <div id="add-post-form">
            <h2>Add New Post</h2>
            <form action="addPost.php" method="post">
                <label for="title">Title:</label>
                <input type="text" name="title" placeholder="Enter title" required>

                <label for="content">Content:</label>
                <textarea name="content" placeholder="Enter content" required></textarea>

                <button type="submit">Add Post</button>
            </form>
        </div>
    </div>
</body>

</html>