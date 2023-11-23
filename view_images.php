<?php
// Include necessary functions
require_once('functions.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['view_images'])) {
    // Your image_viewer.php logic here
    $selectedFolder = sanitize_folder($_GET['folder']);
    // Database configuration - Update with your actual database credentials
    $dbHost = 'localhost';
    $dbUser = 'afnan';
    $dbPass = 'john_wick_77';
    $dbName = 'mywebsite_images';

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to retrieve encrypted image data from the selected folder table
    $sql = "SELECT id, images FROM $selectedFolder";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='image-container'>";
        while ($row = $result->fetch_assoc()) {
            $imageId = $row["id"];
            $encryptedImageData = $row["images"];

            // Define your decryption key (must be the same as the encryption key)
            $encryptionKey = '123'; // Replace with your actual key

            // Decrypt the image data
            $decryptedImageData = xor_decrypt($encryptedImageData, $encryptionKey);

            $base64Image = base64_encode($decryptedImageData);
            echo "<div class='image-item'>";
            echo "<h2>Image $imageId</h2>";
            echo "<img src='data:image/jpeg;base64,$base64Image' alt='Image $imageId'>";
            echo "</div>";
        }
        echo "</div>";

        // ...
    } else {
        echo "No images found in $selectedFolder.";
    }

    $conn->close();
}
?>
