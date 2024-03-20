<?php
    // Include config file and start session
    include('config.php');
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['sessUsername'])) {
        header("Location: index.php");
        exit;
    }

    // Fetch user data based on the logged-in user's ID
    $username = $_SESSION['sessUsername'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Handle form submission to update user details
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Retrieve form data
        $newUsername = $_POST['txtUsername'];
        $newPassword = $_POST['txtPassword'];
        $newFname = $_POST['txtFname'];
        $newLname = $_POST['txtLname'];
        $newEmail = $_POST['txtEmail'];
        $newPhone = $_POST['txtPhone'];
        $newAddress = $_POST['txtAddress'];

        // Update the user's details in the database
        $updateQuery = "UPDATE users SET username = '$newUsername', password = '$newPassword', fname = '$newFname', lname = '$newLname', email = '$newEmail', phone = '$newPhone', address = '$newAddress' WHERE username = '$username'";
        
        if (mysqli_query($conn, $updateQuery)) {
            // Update session variable with new username
            $_SESSION['sessUsername'] = $newUsername;
            // Redirect to profile page with success message
            header("Location: profile.php?success=1");
            exit;
        } else {
            // Redirect to profile page with error message
            header("Location: profile.php?error=1");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>User Profile</h2>
                <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
                    <div class="alert alert-success" role="alert">
                        Profile updated successfully.
                    </div>
                <?php } elseif (isset($_GET['error']) && $_GET['error'] == 1) { ?>
                    <div class="alert alert-danger" role="alert">
                        Failed to update profile. Please try again.
                    </div>
                <?php } ?>
                <form action="profile.php" method="POST">
                    <div class="form-group">
                        <label for="txtUsername">Username</label>
                        <input type="text" class="form-control" id="txtUsername" name="txtUsername" value="<?php echo $row['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="txtPassword">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" value="<?php echo $row['password']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Font Awesome for eye icon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    
    <script>
        // Toggle password visibility
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('txtPassword');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
