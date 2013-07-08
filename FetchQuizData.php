<?php

header("Content-type: text/json");

require('hqf-functions.php');

$quiz_ids = $_POST['quiz_ids'];

$pwd = $_POST['pwd'];

$referer = $_SERVER['HTTP_REFERER'];
if($referer != "HanuQuizRocks" && $pwd != "WeAreTheAdmins:P"){
	$message = "You think we are stupid to allow any one ?";
	die(json_encode($message));
}

// Create DB Connection first
createDBConnection();

// Get Quizzes based on Ids
$quizzes = getQuizData($quiz_ids);

// Send Data
echo json_encode($quizzes);

?>
