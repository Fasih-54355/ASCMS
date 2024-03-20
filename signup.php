<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $email = $password = $confirm_password = $contact = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Function to sanitize user input
    function sanitizeInput($input)
    {
        return htmlspecialchars(stripslashes(trim($input)));
    }
    
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Retrieve user input and sanitize
        $name = sanitizeInput($_POST['name']);
        $email = sanitizeInput($_POST['email']);
        $contact = sanitizeInput($_POST['contact']);
        $password = sanitizeInput($_POST['password']);
        $confirm_password = sanitizeInput($_POST['confirm_password']);
        $role = sanitizeInput($_POST['role']);

    
        // // Validate username
        // if(!preg_match('/^[a-zA-Z0-9_]+$/')){
        //     die("name can only contain letters, numbers, and underscores");
        // }
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email address.");
        }
    
        // Validate password
        if (strlen($password) < 6) {
            die("Password must be at least 6 characters long.");
        }
    
        // Check if password and confirm_password match
        if ($password !== $confirm_password) {
            die("Passwords do not match.");
        }
    
        // Check if the username already exists
        $check_username_query = "SELECT * FROM login WHERE name='$name'";
        $result_username = mysqli_query($link, $check_username_query);
    
        if (mysqli_num_rows($result_username) > 0) {
            die("Username already exists.");
        }
    
        // Check if the email already exists
        $check_email_query = "SELECT * FROM login WHERE email='$email'";
        $result_email = mysqli_query($link, $check_email_query);
    
        if (mysqli_num_rows($result_email) > 0) {
            die("Email already exists.");
        }

        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $query = "INSERT INTO admin (name, email, password,contact_no, status,role) VALUES ('$name', '$email', '$password', '$contact', 'pending','$role')";
    
        // If registration is successful, you can redirect to a success page
        if (mysqli_query($link, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($link);
    }}}
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
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
  .account-text {
    color: #fff;
}

  
      </style>
</head>
<body>
    <div class="login-box">
    <h2>User Registration</h2>
    <form method="post" action="signup.php">
    <div class="user-box">    
        <input type="text" name="name" required>
        <label for="name">Username:</label>
</div>
<div class="user-box">
<input type="email" name="email" required>
<label for="email">Email:</label>
</div>
<div class="user-box">    
        <input type="text" name="contact" required>
        <label for="name">Contact No:</label>
</div>
<div class="user-box">
<input type="password" name="password" required>
<label for="password">Password:</label>
</div>

<div class="user-box">
<input type="password" name="confirm_password" required>
<label for="confirm_password">Confirm Password:</label>
</div>
<div class="account-text">
<label for="role">Role</label>
<select name="role" id="role">
	<option value=""></option>
  <option value="team_lead">Team Leader</option>
  <option value="web_developer">Web Developer</option>
	<option value="web_designer">Web Designer</option>
	<option value="SEO">SEO</option>
  <option value="sales">Sales</option>
	<!-- <option value="animator">Animator</option> -->
</select>
</div>

        <input type="submit" name="submit" value="submit" class="btn btn-light custom-button">
    </form>

            <br><p class="account-text">Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>