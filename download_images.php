<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['download_images'])) {
    $folder = sanitize_folder($_POST['folder']);

    // Directory where the images for the selected folder are stored
    $imageDirectory = 'path_to_image_directory/' . $folder; // Update with your actual path

    // Create a zip archive
    $zip = new ZipArchive();
    $zipFileName = 'images_' . $folder . '.zip';

    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        // Add all image files in the folder to the zip archive
        $files = scandir($imageDirectory);
        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                $zip->addFile($imageDirectory . '/' . $file, $file);
            }
        }

        // Close the zip archive
        $zip->close();

        // Prompt the user to download the zip file
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        readfile($zipFileName);

        // Delete the zip file after download (optional)
        unlink($zipFileName);
    } else {
        echo 'Failed to create the ZIP file.';
    }
}
?>
