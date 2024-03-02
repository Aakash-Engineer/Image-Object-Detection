<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userID = $_GET["UserID"];
    $password = $_GET["Password"];

    $conn = new mysqli("localhost", "root", "", "database");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT user_id, user_name, user_password FROM user WHERE user_id = ?");
    
    if (!$stmt) {
        die("Error in preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("s", $userID); // Use "i" for integer

    $stmt->execute();

    if ($stmt->error) {
        die("Error in executing the statement: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["user_id"];
        $name = $row["user_name"];
        $hashedPassword = $row["user_password"];
        

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email']=$row['Email'];

            $stmt->close();
            $conn->close();

            header("Location: index.php");
        } else {
            echo "<h1>Invalid Password</h1>";
        }
    } else {
        $stmt->close();
        $conn->close();
        header("Location: signup.php");
        }

    
} else {
    echo "Invalid request method";
}
?>
