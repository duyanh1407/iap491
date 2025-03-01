<?php
$servername = "localhost";
$username = "root";
$password = "@Nohj2015";
try {

    $conn = new PDO("mysql: host = $servername, dbname = dbcrud", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to database";
} catch (PDOException $e) {

    echo "Connection failed: " . $e->getMessage();
}
?>