<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
        }

        .dashboard {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 60px;
        }

        .dashboard a {
            display: block;
            background-color: white;
            color: #007bff;
            padding: 15px 25px;
            margin: 10px 0;
            text-decoration: none;
            border: 2px solid #007bff;
            border-radius: 8px;
            width: 220px;
            text-align: center;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .dashboard a:hover {
            background-color: #007bff;
            color: white;
        }

        .logout {
            margin-top: 30px;
            text-align: center;
        }

        .logout a {
            color: red;
            text-decoration: none;
            font-size: 14px;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Welcome, Admin</h2>
    </div>

    <div class="dashboard">
        <a href="add-job.php">Add Job</a>
        <a href="view-jobs.php">View Jobs</a>
        <a href="view-applications.php">View Applications</a>
    </div>


</body>
</html>
