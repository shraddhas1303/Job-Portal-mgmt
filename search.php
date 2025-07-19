<?php
include('db/config.php');

$query = trim($_POST['query'] ?? '');
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = 5;
$jobType = $_POST['jobType'] ?? '';
$salaryRange = $_POST['salaryRange'] ?? '';
$offset = ($page - 1) * $limit;

$whereClauses = [];
$params = [];
$types = '';


if (!empty($query)) {
    $whereClauses[] = "(title LIKE ? OR location LIKE ?)";
    $searchTerm = '%' . $query . '%';
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= 'ss';
}


if (!empty($jobType)) {
    $whereClauses[] = "type = ?";
    $params[] = $jobType;
    $types .= 's';
}


if (!empty($salaryRange)) {
    if (strpos($salaryRange, '-') !== false) {
        list($minSalary, $maxSalary) = explode('-', $salaryRange);
        $whereClauses[] = "(salary BETWEEN ? AND ?)";
        $params[] = (int)$minSalary;
        $params[] = (int)$maxSalary;
        $types .= 'ii';
    } else {
        $params[] = (int)$salaryRange;
        $whereClauses[] = "salary >= ?";
        $types .= 'i';
    }
}

$whereSQL = '';
if (!empty($whereClauses)) {
    $whereSQL = "WHERE " . implode(" AND ", $whereClauses);
}


$countSql = "SELECT COUNT(*) as total FROM jobs $whereSQL";
$stmt = $conn->prepare($countSql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$countResult = $stmt->get_result()->fetch_assoc();
$totalJobs = $countResult['total'];
$totalPages = ceil($totalJobs / $limit);


$params[] = $limit;
$params[] = $offset;
$types .= 'ii';


$sql = "SELECT * FROM jobs $whereSQL ORDER BY created_at DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();


$jobsHTML = '';
while($row = $result->fetch_assoc()) {
    $jobsHTML .= "<div class='job-card'>";
    $jobsHTML .= "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    $jobsHTML .= "<p><strong>" . htmlspecialchars($row['company']) . "</strong></p>";
    $jobsHTML .= "<p>📍 Location: " . htmlspecialchars($row['location']) . "</p>";
    $jobsHTML .= "<p>💰 Salary: ₹" . htmlspecialchars($row['salary']) . "</p>";
    $jobsHTML .= "<p>🕒 Type: " . htmlspecialchars($row['type']) . "</p>";
    $jobsHTML .= "<button onclick='applyForm(" . (int)$row['id'] . ")'>Apply Now</button>";
    $jobsHTML .= "</div>";
}

if ($jobsHTML === '') {
    $jobsHTML = "<div class='job-card'><p>No jobs found.</p></div>";
}


$paginationHTML = '';
for ($i = 1; $i <= $totalPages; $i++) {
    $active = ($i === $page) ? 'active' : '';
    $paginationHTML .= "<button class='$active' onclick='goToPage($i)'>$i</button>";
}


echo json_encode([
    'jobs' => $jobsHTML,
    'pagination' => $paginationHTML
]);
?>
