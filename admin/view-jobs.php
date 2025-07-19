<?php
include('../db/config.php');
$result = $conn->query("SELECT * FROM jobs ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Jobs</title>
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
            margin-bottom: 30px;
            color: #333;
        }

        .job-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fafafa;
        }

        .job-title {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }

        .job-info {
            margin: 8px 0;
            color: #444;
        }

        .delete-btn {
            color: red;
            text-decoration: none;
            font-size: 14px;
        }

        .delete-btn:hover {
            text-decoration: underline;
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
    <h3>Job Listings</h3>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="job-card">
            <div class="job-title"><?php echo $row['title']; ?></div>
            <div class="job-info">
                <strong>Company:</strong> <?php echo $row['company']; ?><br>
                <strong>Location:</strong> <?php echo $row['location']; ?><br>
                <strong>Type:</strong> <?php echo $row['type']; ?><br>
                <strong>Salary:</strong> <?php echo $row['salary']; ?>
            </div>
            <a class="delete-btn" href="delete-job.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this job?');">Delete</a>
        </div>
    <?php endwhile; ?>

    <div class="back-link">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
