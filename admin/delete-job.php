<?php
include('../db/config.php');
$id = $_GET['id'];
$conn->query("DELETE FROM jobs WHERE id=$id");
header("Location: view-jobs.php");
?>