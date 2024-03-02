<?php
// Start the session
session_start();

// Check if a specific session variable is set
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Unset the session cookie by setting its expiration time in the past
    setcookie(session_name(), '', time() - 3600, '/');
    
    // Optional: Redirect to a different page after destroying the session
    header("Location: login.php");
    exit(); // Ensure that no further code is executed after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
        <form action="http://localhost//MINOR//Authinticate.php" class="needs-validation" enctype="multipart/form-data" method="GET" novalidate>
            <h2 class="text-center mb-4">Login</h2>
            <div class="mb-3 position-relative">
                <label class="form-label" for="inputUserID">User ID</label>
                <input type="text" class="form-control" id="inputUserID" name="UserID" value="" placeholder="User ID" required>
                <div class="invalid-tooltip">Please enter a valid user ID.</div>
            </div>
            <div class="mb-3 position-relative">
                <label class="form-label" for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="Password" value="" placeholder="Password" required>
                <div class="invalid-tooltip">Please enter your password to continue.</div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkRemember" name="checkRemember">
                    <label class="form-check-label" for="checkRemember">Remember me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>

        <!-- JavaScript for disabling form submissions if there are invalid fields -->
        <script>
            // Self-executing function
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </div>


</body>
</html>
