<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process data received from the client

    // Check if a file is uploaded
    if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == UPLOAD_ERR_OK) {
        $fileName = $_FILES["fileUpload"]["name"];
        $tempFilePath = $_FILES["fileUpload"]["tmp_name"];

        // Save the image file
        $imageFilePath = "uploads/" . $fileName;
        move_uploaded_file($tempFilePath, $imageFilePath);

        // Save the text file with the same name as the image
        $textFilePath = "uploads/" . pathinfo($fileName, PATHINFO_FILENAME) . ".txt";
        file_put_contents($textFilePath, "Objects detected:\n");

        $pythonScript = "yolo.py";

        // Use the correct variable names in the Python script execution command
        $command = "python $pythonScript $imageFilePath $textFilePath";

        // Execute the Python script
        shell_exec($command);

        // Perform operations with the data
        $responseData = [
            'message' => 'Data received on the server',
            'imagePath' => $imageFilePath
        ];

        // Send a response back to the client as JSON
        header('Content-Type: application/json');
        echo json_encode($responseData);
    } else {
        echo "Error uploading file.";
    }
}
?>
