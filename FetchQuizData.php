<?php

header("Content-type: text/json");

require('hqf-functions.php');

$quiz_ids = $_POST['quiz_ids'];

// Create DB Connection first
createDBConnection();

// Get Quizzes based on Ids
$quizzes = getQuizData($quiz_ids);

// Send Data
echo json_encode($quizzes);

?>