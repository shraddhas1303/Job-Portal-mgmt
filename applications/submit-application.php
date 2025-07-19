<?php
include('../db/config.php');

$job_id = $_POST['job_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$file = $_FILES['resume'];

$response = [];

if ($file['type'] === 'application/pdf') {
    $filename = uniqid() . '.pdf';
    move_uploaded_file($file['tmp_name'], '../assets/uploads/' . $filename);
    $stmt = $conn->prepare("INSERT INTO job_applications (job_id, name, email, resume_path, applied_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("isss", $job_id, $name, $email, $filename);
    $stmt->execute();

    $response['status'] = 'success';
    $response['message'] = 'Application Submitted!';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Only PDF files are allowed.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
