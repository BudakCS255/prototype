<!DOCTYPE html>
<html>
<head>
    <title>Image Upload and Viewer</title>
</head>
<body>
    <h1>Upload Images</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <!-- Allow multiple file selection -->
        <label for="image">Choose image(s) to upload:</label>
        <input type="file" name="image[]" id="image" accept="image/*" multiple>
        <br>
        <label for="folder">Select a folder:</label>
        <select name="folder" id="folder">
            <option value="Case001">Case001</option>
            <option value="Case002">Case002</option>
            <option value="Case003">Case003</option>
        </select>
        <br>
        <input type="submit" value="Upload">
    </form>

    <!-- The image viewing section -->
    <h1>Image Viewer</h1>
    <form action="view_images.php" method="GET">
        <label for="view_folder">Select a folder to view images:</label>
        <select name="folder" id="view_folder">
            <option value="Case001">Case001</option>
            <option value="Case002">Case002</option>
            <option value="Case003">Case003</option>
        </select>
        <input type="submit" name="view_images" value="View Images">
    </form>

    <?php
    // Include necessary functions
    require_once('functions.php');

    if (isset($_GET['message'])) {
        echo '<div id="upload-feedback"><p>' . htmlspecialchars($_GET['message']) . '</p></div>';
    }

    // Add a button to trigger downloading all images in a folder as a ZIP file
    if (isset($_GET['folder'])) {
        $folder = sanitize_folder($_GET['folder']);
        echo '<form action="download_images.php" method="POST">';
        echo '<input type="hidden" name="folder" value="' . $folder . '">';
        echo '<input type="submit" name="download_images" value="Download Images as ZIP">';
        echo '</form>';
    }
    ?>
</body>
</html>
