<?php

header("Content-type: text/json");

require('hqf-functions.php');

$question_ids = $_POST['question_ids'];

// Create DB Connection first
createDBConnection();

// Get Questions based on Ids
$questions = getQuestionsData($question_ids);

// Send Data
echo json_encode($questions);

?>