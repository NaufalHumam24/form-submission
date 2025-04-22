<?php
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName  = $_POST['first_name'] ?? '';
    $lastName   = $_POST['last_name'] ?? '';
    $studentId  = $_POST['student_id'] ?? '';
    $email      = $_POST['email'] ?? '';
    $paperTitle = $_POST['paper_title'] ?? '';
    $description= $_POST['description'] ?? '';
    $date       = $_POST['date'] ?? '';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmp  = $_FILES['file']['tmp_name'];
        $fileName = basename($_FILES['file']['name']);
        $filePath = $uploadDir . time() . "_" . $fileName;

        if (move_uploaded_file($fileTmp, $filePath)) {
            echo "Submission Successful!<br><br>";
            echo "Name: $firstName $lastName<br>";
            echo "Student ID: $studentId<br>";
            echo "Email: $email<br>";
            echo "Date: $date<br>";
            echo "Paper Title: $paperTitle<br>";
            echo "Description: $description<br>";
            echo "Uploaded File: $fileName";
        } else {
            echo "Error: Failed to move uploaded file.";
        }
    } else {
        echo "Error: No file uploaded or upload failed.";
    }
} else {
    echo "Invalid request.";
}
