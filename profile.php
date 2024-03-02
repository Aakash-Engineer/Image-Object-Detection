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
    } else {
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
    <title>Home- OpenVision</title>
    <link rel="icon" href="uploads\favicon-32x32.png" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .file-upload-container {
            border: 2px dashed #ccc;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            height: 300px;
            position: relative;
        }

        #fileUpload {
            display: none;
        }

        #selectedImage {
            max-width: 100%;
            max-height: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }
        .profile-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            max-width: 100%;
        }

        .profile-card img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #eee;
        }

        .profile-info {
            padding: 20px;
        }

        .profile-info h2 {
            margin-bottom: 10px;
            color: #333;
        }

        .profile-info p {
            color: #666;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">OpenVision</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link active"> <i class="bi bi-house"></i> Home</a>
                <a href="" class="nav-item nav-link active"> About</a>
                <a href="#" class="nav-item nav-link active"><i class="bi bi-telephone-fill"></i> Contact</a>
            </div>
            <div class="navbar-nav ms-auto">
                <a href="profile.php" class="nav-item nav-link active"><i class="bi bi-person-circle"></i> <?php echo $_SESSION['user_id'];?></i></a>
                <a href="" class="nav-item nav-link inactive"></a>
            </div>
        </div>
        <form class="d-flex ms-auto">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary text-white" type="submit">Search</button>
            </form>
    </div>
</nav>


<div class="container-md">
    <div class="row">
        <div class="col"><br><br><br>
            <div class="d-flex justify-content-center">
                <div class="profile-card">
                    <img src="<?php echo $_SESSION['user_image'];?>" alt="User Profile Image" id="image">
                    
                    <div class="profile-info">
                        <h2><?php echo $_SESSION['user_name'];?> Pal</h2>
                        <p><span style="font-weight: bold;">user id : </span> <?php echo $_SESSION['user_id'];?></p>
                        <p><span style="font-weight: bold;">Email    : </span> <?php echo $_SESSION['user_email'];?></p>
                        <a href="login.php" > logout </a> &nbsp;&nbsp;&nbsp;
                        <a href="edit.php" > Edit </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br>
<div class="container-fluid bg-primary" > 
<footer class="py-3 text-white">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <p class="mb-0">Copyright © 2023 OpenVision</p>
            </div>
            <div class="col-6 text-md-end">
                <a href="#" class="text-light">Terms of Use</a>
                <span class="text-muted mx-2">|</span>
                <a href="#" class="text-light">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>
</div>
</body>
</html>
