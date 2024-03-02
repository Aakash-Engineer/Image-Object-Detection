<?php
// ini_set('session.gc_maxlifetime', 300);
// session_set_cookie_params(300);
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    $image = $_FILES["Image"]["name"]; // Assuming the input name for the file is "Image"

    // Validate email and password (you can add more validation as needed)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if the user ID is set in the session
        if (isset($_SESSION['user_id'])) {
            $userid = $_SESSION['user_id'];

            // Connect to the database (replace with your database connection code)
            $conn = new mysqli("localhost", "root", "", "database");

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $target_dir = "user-images/";
            $target_file = $target_dir . basename($_FILES["Image"]["name"]);
            move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file);

            // Prepare the SQL statement to update the user details
            $stmt_update_user = $conn->prepare("UPDATE user SET user_name = ?, user_email = ?, user_password = ? WHERE user_id = ?");
            $stmt_update_user->bind_param("ssss", $name, $email, $hashedPassword, $userid); // Corrected parameter order
            $result_update_user = $stmt_update_user->execute();
            $stmt_update_user->close();

            $stmt_update_image = $conn->prepare("UPDATE image SET img = ? WHERE user_id = ?");
            $stmt_update_image->bind_param("ss", $target_file, $userid); // Corrected parameter order
            $result_update_image = $stmt_update_image->execute();
            $stmt_update_image->close();


            // Set session variables
            

            // Move uploaded image to a designated folder

            // Check if SQL statements executed successfully
            if ($result_update_user && $result_update_image) {
                // Send JSON response
                $_SESSION['user_email'] = $email;
                $_SESSION['user_image'] = $target_file;
                $_SESSION['user_name'] = $name;

                header('Content-Type: application/json');
                echo json_encode(["message" => "done"]);
            } else {
                // Send JSON response
                header('Content-Type: application/json');
                echo json_encode(["message" => "no"]);
            }

            // Close the database connection
            $conn->close();
            exit();
        } else {
            // User ID not set in the session
            echo "User ID not found in session.";
        }
    } else {
        // Invalid email address
        echo "Invalid email address";
    }
}
?>
