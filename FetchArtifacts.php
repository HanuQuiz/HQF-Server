<?php

header("Content-type: text/json");

require('hqf-functions.php');

$question_sync_time = $_POST['question_sync_time'];
$quiz_sync_time = $_POST['quiz_sync_time'];

if($question_sync_time ==  "" && $quiz_sync_time == ""){
    die("No input!");
}

$meta_data = $_POST['meta_data'];
$meta_data = stripslashes($meta_data);

if($meta_data == ""){
	$metaData = "";
}
else{
	// Parse meta data and use it in selection
	$metaData = json_decode($meta_data,true);
}
// Create DB Connection first
createDBConnection();

// Get Question Artifacts
$questions = getQuestionArtifacts($question_sync_time, $metaData);
	
// Get Quiz Artifacts
$quiz = getQuizArtifacts($quiz_sync_time);
	
// Send Data
$output = array('questions' => $questions, 'quizzes' => $quiz);
echo json_encode($output);

?>
