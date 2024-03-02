<?php
// Start or resume the session
session_start();

// Check if the session is started
if (session_status() == PHP_SESSION_ACTIVE) {
    // Session is started, fetch variables
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $userName = $_SESSION['user_name'];
        $userEmail = $_SESSION['user_email'];

        if(isset($_SESSION['file'])){
            $filename=$_SESSION['file'];
            unset($_SESSION['file']);       
        }

        else {$filename="Human Tech (1).png";}

        // Use the session variables as needed
        // echo "User ID: $userId, Name: $userName, Email: $userEmail";
    } 
    else {
        // Redirect to login.php if session variables are not set
        header("Location: login.php");
        exit();
    }
} else {
    // Redirect to login.php if the session is not started
    header("Location: login.php");
    // exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>openVision - edit details</title>
    <link rel="icon" href="uploads\favicon-32x32.png" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form id="loginForm" class="needs-validation" enctype="multipart/form-data" novalidate>
            <h2 class="text-center mb-4">Edit details</h2>
            <div class="mb-3 position-relative">
                <label class="form-label" for="inputUsername">Name</label>
                <input type="text" class="form-control" id="inputUsername" name="Name" placeholder="Username" autocomplete="new-password" value="<?php echo $userName; ?>" required>
                <div class="invalid-tooltip">Please enter a valid username.</div>
            </div>
            <div class="mb-3 position-relative">
                <label class="form-label" for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="Email" placeholder="Email" autocomplete="off" value="<?php echo $userEmail; ?>" required>
                <div class="invalid-tooltip">Please enter a valid email address.</div>
            </div>
            <div class="mb-3 position-relative">
                <label class="form-label" for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="Password" placeholder="Password" autocomplete="new-password" required>
                <div class="invalid-tooltip">Please enter your password to continue.</div>
            </div>
            <div class="mb-3 position-relative">
                <label class="form-label" for="inputImage">Profile Image</label>
                <input type="file" class="form-control" id="inputImage" name="Image" accept="image/*" required>
                <div class="invalid-tooltip">Please choose a profile image.</div>
            </div>
            <button type="button" onclick="submitForm()" class="btn btn-primary btn-block">Save</button>
        </form>

        <!-- JavaScript for handling form submission with XMLHttpRequest and simple validation -->
        <script>
            function submitForm() {
                var form = document.getElementById('loginForm');
                var username = document.getElementById('inputUsername').value;
                var email = document.getElementById('inputEmail').value;
                var password = document.getElementById('inputPassword').value;
                var image = document.getElementById('inputImage').value;

                if (username.trim() === '' || !validateEmail(email) || password.trim() === '' || image.trim() === '') {
                    // Simple validation failed, display an error message
                    alert('Please fill in all the fields with valid information.');
                } else {
                    // Form is valid, proceed with submission
                    var formData = new FormData(form);
                    var xhr = new XMLHttpRequest();

                    xhr.open('POST', 'edit-server.php', true);
                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            // Success, handle the response
                            var response = JSON.parse(xhr.responseText);
                            if (response.message === "done") {
                                alert("Details updated successfully.");
                            } else {
                                alert("Failed to update details.");
                            }
                        } else {
                            // Error, handle the error
                            console.error(xhr.statusText);
                        }
                    };
                    xhr.send(formData);
                }
            }

            function validateEmail(email) {
                // Simple email validation
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        </script>
    </div>
</body>
</html>
