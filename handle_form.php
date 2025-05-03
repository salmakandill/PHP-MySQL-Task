<?php
require 'fileHandler.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? '';
    $profile_picture = '';

    if (isset($_FILES['profile_picture'])) {
        $uploadedFileName = handleUploadedFile($_FILES['profile_picture']);
    }

    $stmt = $conn->prepare("INSERT INTO students (name, email, age, photo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $age, $profile_picture);

    if ($stmt->execute()) {
        echo "✅ Data saved successfully.";
    } else {
        echo "🚨 Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>