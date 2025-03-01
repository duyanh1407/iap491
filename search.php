<?php
include "connectDB.php"; //connect to database
session_start();
//req method server
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST["search_term"];

    // Search by username or title
    $sql = "SELECT * FROM posts WHERE username LIKE '%$searchTerm%' OR title LIKE '%$searchTerm%'";
    $result = $conn->query($sql);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="top-bar">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <a href="home.php" class="button">Home</a>
            <h2>Search Posts</h2>
            <!-- Search Form -->
            <label for="search_term">Search:</label>
            <input type="text" id="search_term" name="search_term" required>
            <button type="submit" class="button">Search</button>
        </form>
    </div>

    <div id="container">
        <!-- Display Search Results -->
        <h3>Search Results:</h3>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='post'>";
                    echo "<h3>Title: " . $row['title'] . "</h3>";
                    echo "<p>Content: " . $row['content'] . "</p>";
                    echo "<p>Posted by: " . $row['username'] . "</p>";
                    echo "</div><br>";
                }
            } else {
                echo "<p>No results found.</p>";
            }
        }
        ?>
    </div>
</body>

</html>