<?php include('db/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Listings</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        
        #search {
            text-align: center;
            margin-bottom: 20px;
        }

        #search input {
            width: 60%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #search button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #search button:hover {
            background-color: #0056b3;
        }

       
        .job-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #007bff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            margin-bottom: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .job-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .job-card h3 {
            font-size: 20px;
            margin: 0 0 10px;
            color: #007bff;
        }

        .job-card p {
            font-size: 15px;
            color: #555;
            margin: 5px 0;
        }

        .job-card i {
            margin-right: 6px;
            color: #007bff;
        }

        .job-card button {
            margin-top: 12px;
            padding: 10px 18px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .job-card button:hover {
            background-color: #218838;
        }

       
        .pagination {
            text-align: center;
            margin-top: 30px;
        }

        .pagination button {
            margin: 0 5px;
            padding: 8px 14px;
            font-size: 16px;
            background-color: #fff;
            color: #007bff;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }

        .pagination button.active {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        .pagination button:hover {
            background-color: #0056b3;
            color: #fff;
        }

        #applySection {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🧑‍💼 Job Listings</h2>

    <div id="search">
        <div style="margin-bottom: 10px;">
            <select id="jobTypeFilter">
                <option value="">All Types</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Remote">Remote</option>
                <option value="Internship">Internship</option>
            </select>
            <select id="salaryFilter">
                <option value="">All Salaries</option>
                <option value="0-30000">Up to 30,000</option>
                <option value="30001-60000">30,001 - 60,000</option>
                <option value="60001-100000">60,001 - 1,00,000</option>
                <option value="100001">Above 1,00,000</option>
            </select>
        </div>
        <input type="text" id="searchInput" placeholder="Search by title or location">
        <button onclick="searchJobs()">Search</button>
    </div>

    <div id="jobResults">
       
    </div>

    <div id="pagination" class="pagination">
       
    </div>

    <div id="applySection"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let currentPage = 1;
let currentQuery = '';

$(document).ready(function() {
    loadJobs(); 
});

function loadJobs() {
    const jobType = $('#jobTypeFilter').val();
    const salaryRange = $('#salaryFilter').val();
    $.post('search.php', { query: currentQuery, page: currentPage, jobType, salaryRange }, function(data) {
        const result = JSON.parse(data);
        $('#jobResults').html(result.jobs);
        $('#pagination').html(result.pagination);
    });
}

function searchJobs() {
    currentQuery = $('#searchInput').val();
    currentPage = 1;
    loadJobs();
}

function goToPage(page) {
    currentPage = page;
    loadJobs();
}

function applyForm(jobId) {
    $.post('applications/apply.php', { job_id: jobId }, function(data) {
        $('#applySection').html(data);
    });
}
</script>

</body>
</html>
