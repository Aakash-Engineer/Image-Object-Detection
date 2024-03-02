<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the image data from the POST request
    $imageData = $_POST['image'];

    // Remove the "data:image/jpeg;base64," prefix from the base64-encoded data
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);

    // Decode the base64-encoded image data
    $decodedImage = base64_decode($imageData);

    // Generate a unique filename (you may want to implement a more sophisticated naming strategy)
    $imageFile = 'img' . uniqid() . '.jpg';
    $textFile= 'img' . uniqid() . '.txt';


    // Specify the path where you want to save the image
    $imagePath = 'uploads/' . $imageFile;
    $textPath = 'uploads/' . $textFile;

    // Save the decoded image data to the file
    file_put_contents($imagePath, $decodedImage);
    file_put_contents($textPath, "Objects detected:\n");

    $pythonScript = "yolo.py";
    // $returnCode = FALSE;
    $command = "python $pythonScript $imagePath $textPath";

    // Execute the Python script
    shell_exec($command);

    $responseData = [
        'message' => 'Data received on the server.',
        // 'filename' => $imageFile,
        'imagePath' => $imagePath,
        'textFilePath' => $textPath
        // Add more data as needed
    ];

    // Send a response back to the client as JSON
    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    // Handle invalid requests
    http_response_code(400);
    echo 'Invalid request method.';
}
?>
