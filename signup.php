<?php
session_start();

include "connectDB.php";//connect to database
//req method server
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $username = $_POST["username"];
   $password = $_POST["password"];
   $re_password = $_POST["re-password"];
   //check if password match or not
   if ($password != $re_password) {
      echo "<script>alert('Password is not match')</script>";
      echo "<script>window.location = 'signup.php'</script>";
      exit();
   }
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   $sql = "SELECT * FROM users where username = '$username'";
   $result = $conn->query($sql);
   //check if user already exists in the database
   if ($result->num_rows > 0) {
      echo "<script>alert('User Already Exists')</script>";
      echo "<script>window.location = 'signup.php'</script>";
      exit();
   } else {
      //insert new user into the database
      $sql1 = "INSERT INTO users (username, password, role) VALUES('$username', '$password', 'normal')";
      if ($conn->query($sql1) == TRUE) {
         echo "<script>alert('Signup successful')</script>";
         header("Location: login.php");
         //foward to login is signup successful
         exit();
      } else {
         echo "<script>alert('Signup error')</script>";
         echo "<script>window.location = 'signup.php'</script>";
         exit();
      }
   }
}$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>signup</title>
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
    .signup-button {
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

    .signup-button:hover {
        background-color: #0056b3;
    }
</style>
<body>
<div id="container">
        <form action="signup.php" method="post">
            <h2>Signup</h2>
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter Username" style="height: 30px; width: 300px;"
                required></textarea></br>
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter Password" style="height: 30px; width: 300px;"
                required></textarea></br>
            <label>Re-Password:</label>
            <input type="password" name="re-password" placeholder="Re-Enter Password" style="height: 30px; width: 300px;" 
                required></textarea></br>
            <button type="submit" class="signup-button">signup</button></br>
            <p class="message">Already registered? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>

</html>