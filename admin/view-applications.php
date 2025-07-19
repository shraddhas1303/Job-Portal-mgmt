<?php
include('../db/config.php');
$result = $conn->query("SELECT a.*, j.title FROM job_applications a JOIN jobs j ON a.job_id = j.id ORDER BY a.applied_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Applications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .app-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fafafa;
        }

        .applicant-name {
            font-weight: bold;
            font-size: 18px;
            color: #007bff;
        }

        .job-title {
            font-style: italic;
            color: #555;
        }

        .email {
            color: #444;
            margin: 5px 0;
        }

        .download-link {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 14px;
            background-color: #28a745;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .download-link:hover {
            background-color: #218838;
        }

        .back-link {
            text-align: center;
            margin-top: 30px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Job Applications</h3>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="app-card">
            <div class="applicant-name"><?php echo $row['name']; ?></div>
            <div class="job-title">applied for "<?php echo $row['title']; ?>"</div>
            <div class="email">Email: <?php echo $row['email']; ?></div>
            <a class="download-link" href="../assets/uploads/<?php echo $row['resume_path']; ?>" download>Download Resume</a>
        </div>
    <?php endwhile; ?>

    <div class="back-link">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
