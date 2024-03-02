<?php

session_start();

// Check if the session is started


        // Use the session variables as needed
        // echo "User ID: $userId, Name: $userName, Email: $userEm
// Function to process the image using Python script
function processImage($imageFileName, $textFileName) {
    $pythonScript = "yolo.py";
    // $returnCode = FALSE;
    $command = "python $pythonScript $imageFileName $textFileName";

    // Execute the Python script
    shell_exec($command);

    // Check if Python script executed successfully
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileUpload"])) {
    // Get the uploaded file details
    

    // Process the image using Python
    processImage($imageFilePath, $textFilePath);
$fileName = $_FILES["fileUpload"]["name"];
    $tempFilePath = $_FILES["fileUpload"]["tmp_name"];

    // Save the image file
    $imageFilePath = "uploads/$fileName";
    move_uploaded_file($tempFilePath, $imageFilePath);

    // Save the text file with the same name as the image
    $textFilePath = "uploads/" . pathinfo($fileName, PATHINFO_FILENAME) . ".txt";
    file_put_contents($textFilePath, "Objects detected:\n");
    if (isset($_SESSION['user_id'])) {
        $_SESSION['file']=$imageFilePath;
        header("Location: index.php");
    }
    // Set JSON content type
    // header('Content-Type: application/json');

    // Return the file paths as JSON
    // if ($success) {
        // echo json_encode(['imageFilePath' => $imageFilePath, 'textFilePath' => $textFilePath]);
    // } else {
        // Handle the case where processing was not successful
        // echo json_encode(['error' => 'Image processing failed']);
    // }
}

else{echo "file not received";}
