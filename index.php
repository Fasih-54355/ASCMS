<?php
	include('config.php');

  $reqErr = $loginErr = "";
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (!empty($_POST['txtUsername']) && !empty($_POST['txtPassword']) && isset($_POST['login_type'])) {
          session_start();
          $username = $_POST['txtUsername'];
          $password = $_POST['txtPassword'];
          $_SESSION['sessLogin_type'] = $_POST['login_type'];
  
          if ($_SESSION['sessLogin_type'] == "admin") {
              $query_selectAdmin = "SELECT * FROM users WHERE username='$username' AND password='$password'";
              $result = mysqli_query($conn, $query_selectAdmin);
              $row = mysqli_fetch_array($result);

              if ($row) {
                  $_SESSION['admin_login'] = true;
                  $_SESSION['sessUsername'] = $_POST['txtUsername'];
                  $_SESSION['sessPassword'] = $_POST['txtPassword'];
                  header('Location:admin/dashboard.php');
              } else {
                  $loginErr = "* Username or Password is incorrect.";
              }
          } elseif ($_SESSION['sessLogin_type'] == "distributor") {
              $query_selectDist = "SELECT username,password FROM users WHERE username='$username' AND password='$password'";
              $result = mysqli_query($conn, $query_selectDist);
              $row = mysqli_fetch_array($result);

              if ($row) {
                  $_SESSION['dist_login'] = true;
                  $_SESSION['sessUsername'] = $_POST['txtUsername'];
                  $_SESSION['sessPassword'] = $_POST['txtPassword'];
                  header('Location:distributor_panel/dashboard.php');
              } else {
                  $loginErr = "* Username or Password is incorrect.";
              }
          }
      } else {
          $reqErr = "* All fields are required.";
      }
  }
  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
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
    position: relative;
  }
  
  .custom-button:hover {
      background: #03e9f4;
      color: #fff;
      box-shadow: 0 0 5px #03e9f4, 0 0 25px #03e9f4, 0 0 50px #03e9f4, 0 0 100px #03e9f4;
  }
  .custom-text {
    color: #fff;
  }
  
  
  </style>
</head>
<body>
 <div  class="login-box">
	<h2>LOGIN</h2>
	<form action="index.php" method="POST">
	<div class="user-box">
		<input type="text" id="login:username" name="txtUsername" placeholder="Username">
		<label for="login:username">Username</label>
		</div>
<div class="user-box">
	<input type="password" id="login:password" name="txtPassword" placeholder="Password" >
	<label for="login:password">Password</label>
</div>
		<div class="account-text">
		<label for="login:type">Login Type</label>
		<!-- <div class="input-box"> -->
		<select name="login_type" id="login:type">
		<option value="" disabled selected></option>
		<option value="distributor">Distributor</option>
		<!-- <option value="manufacturer">Manufacturer</option> -->
		<option value="admin">Admin</option>
		</select>
		</div>

        <input type="submit" name="submit" value="submit" class="btn btn-light custom-button">

	</form>
  <br><p class="custom-text">Don't have an account? <a href="signup.php">Sign up now</a>.</p>
</body>
</html>