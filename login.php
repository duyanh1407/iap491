<?php
session_start();
include "connectDB.php"; //connect to database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM users where username = '$username'and password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //check password
        // if (password_verify($password, $row['password'])) {
        if ($row['role'] === 'admin') {
            echo "<script>alert('Welcome admin ')</script>";
            echo "<script>window.location = 'deleteUser.php'</script>";
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            exit();
        } else {
            echo "<script>window.location = 'home.php'</script>";
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            exit();
        }
        // } else {
        //     echo "<script>alert('Invalid username or password')</script>";
        //     echo "<script>window.location = 'login.php'</script>";
        //     exit();
        // }
    } else {
        echo "<script>alert('Invalid username or password')</script>";
        echo "<script>window.location = 'login.php'</script>";
        exit();
    }

}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<style>
    #container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* Set the container to cover the full viewport height */
    }

    #container form {
        text-align: center;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #fff;
    }

    /* Input styles */
    #container input {
        height: 30px;
        width: 300px;
        border: none;
        padding: 5px;
        margin-bottom: 10px;
        border-radius: 10px;
        /* Set border-radius for four curved corners */
    }

    #container label {
        display: block;
        margin-bottom: 5px;
    }

    /* Button styles */
    .login-button {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 25px;
        /* Use a larger value for a more curved appearance */
        transition: background-color 0.3s;
    }

    .login-button:hover {
        background-color: #0056b3;
    }
</style>

<body>
    <div id="container">
        <form action="login.php" method="post">
            <h2>Login Mr.Least Website</h2>
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter Username" style="height: 30px; width: 300px;"
                required></textarea></br>
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter Password" style="height: 30px; width: 300px;"
                required></textarea></br>
            <button type="submit" class="login-button">login</button></br>
            <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
        </form>
    </div>
</body>

</html>