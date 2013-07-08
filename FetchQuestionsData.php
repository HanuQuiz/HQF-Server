<?php

header("Content-type: text/json");

require('hqf-functions.php');

$question_ids = $_POST['question_ids'];

$pwd = $_POST['pwd'];

$referer = $_SERVER['HTTP_REFERER'];
if($referer != "HanuQuizRocks" && $pwd != "WeAreTheAdmins:P"){
	$message = "You think we are stupid to allow any one ?";
	die(json_encode($message));
}

// Create DB Connection first
createDBConnection();

// Get Questions based on Ids
$questions = getQuestionsData($question_ids);

// Send Data
echo json_encode($questions);

?>
