<?php
function handleUploadedFile($file) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        exit("Error during file upload.");
    }

    if ($file['size'] > 100 * 1024) {
        exit("File must be less than 100KB.");
    }

    $allowedTypes = ['image/jpg','image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        exit("Only image files allowed.");
    }

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $safeFileName = uniqid() . '-' . basename($file['name']);
    $destination = $uploadDir . $safeFileName;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return $safeFileName;
    } else {
        exit("Failed to move uploaded file.");
    }
}
?>