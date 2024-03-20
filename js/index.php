<?php
include 'config.php';
session_start(); // Start the session

// Check if the user is already authenticated (e.g., they are logged in)
if (isset($_SESSION['user_id'])) {
    // Redirect to a dashboard or home page if the user is already logged in
    header("Location: home.php");
    exit;
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Change 'email' to the appropriate form field name
    $password = $_POST['password']; // Change 'password' to the appropriate form field name

    // Replace this with your actual authentication logic (using prepared statements)
    $sql = "SELECT id FROM login WHERE email = ? AND password = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ss", $email, $password); // Bind the parameters
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    // Perform authentication
    if (!empty($user_id)) {
        // Authentication successful
        $_SESSION['user_id'] = $user_id; // Store the user's ID
        header("Location: home.php"); // Redirect to the dashboard or home page
        exit;
    } else {
        $error = "Invalid username or password"; // Display an error message
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
      html {
    height: 100%;
  }
  body {
    margin:0;
    padding:0;
    font-family: sans-serif;
    background: linear-gradient(#141e30, #243b55);
  }
  
  .login-box {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 400px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,.5);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
  }
  
  .login-box h2 {
    margin: 0 0 30px;
    padding: 0;
    color: #fff;
    text-align: center;
  }
  
  .login-box .user-box {
    position: relative;
  }
  
  .login-box .user-box input {
    width: 100%;
    padding: 10px 0;
    font-size: 16px;
    color: #fff;
    margin-bottom: 30px;
    border: none;
    border-bottom: 1px solid #fff;
    outline: none;
    background: transparent;
  }
  .login-box .user-box label {
    position: absolute;
    top:0;
    left: 0;
    padding: 10px 0;
    font-size: 16px;
    color: #fff;
    pointer-events: none;
    transition: .5s;
  }
  
  .login-box .user-box input:focus ~ label,
  .login-box .user-box input:valid ~ label {
    top: -20px;
    left: 0;
    color: #03e9f4;
    font-size: 12px;
  }

.custom-button {
  background: transparent;
  border: 2px solid transparent;
  color: #03e9f4;
  padding: 10px 20px;
  font-size: 16px;
  text-transform: uppercase;
    letter-spacing: 4px;
    transition: border 0.3s;
    cursor: pointer;
    border-radius: 5px;
    position: relative; /* Added to make ::before and ::after relative to the button */
  }
  
  .custom-button:hover {
      background: #03e9f4;
      color: #fff;
      box-shadow: 0 0 5px #03e9f4, 0 0 25px #03e9f4, 0 0 50px #03e9f4, 0 0 100px #03e9f4;
  }
  .custom-text {
    color: #fff;
}
/* Add this CSS for the line */
/* .line {
  position: absolute;
  width: 2px; /* Width of the line 
  height: 100%; /* Full height of the button 
  background-color: #03e9f4; /* Line color 
  top: 50%;
  left: 50%;
  transform-origin: center;
  animation: rotateLine 4s linear infinite; /* Adjust the duration as needed 
}

@keyframes rotateLine {
  0% {
    transform: translateX(-50%) rotate(0deg); /* Initial position and rotation 
  }
  100% {
    transform: translateX(-50%) rotate(360deg); /* Rotate 360 degrees for a full circle
  }
} */

  
  </style>
</head>

<body>
     <div class="login-box">
<h2>Login</h2>
    <form action="index.php" method="post">
        <div class="user-box">
            <input type="text" name="email" required><br><br>
            <label for="email">Email:</label>
</div>
<div class="user-box">
    <input type="password" name="password" required><br><br>
    <label for="password">Password:</label>
</div>
                <input type="submit" class="btn btn-secodary custom-button" value="Login">
                
    </form>
    <br><p class="custom-text">Don't have an account? <a href="signup.php">Sign up now</a>.</p>
</body>
    <!--<h2>Login</h2>
    <form action="login.php" method="post"> -->
      <!-- <div class="user-box">
        <input type="text" name="" required="">
        <label>Username</label>
      </div> -->
      <!-- <div class="user-box">
        <input type="text" name="email" required>
        <label></label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required>
        <label></label>
      </div>
      <a href="index.php">Login
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a> -->
      <!-- <br><a href="signup.php">Signup
      <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a>; -->
  <!-- </form>
  <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
</div> -->
</body>
</html>