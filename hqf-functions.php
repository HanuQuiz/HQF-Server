<?php

require('config.php');

$linkID = null;

function createDBConnection(){
	
	global $linkID;
	
	$linkID = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect to host.");
	mysqli_select_db(DB_NAME, $linkID) or die("Could not find database.");

}

function getQuizArtifacts($quiz_sync_time, $metaData){
	
	global $linkID;
	$sql = "SELECT q.QuizId, q.CreatedAt FROM quiz";
	
	if(empty($metaData)){

		$sql .= " as q WHERE CreatedAt >= '$quiz_sync_time' AND ActiveStatus = 'X'";

	}
	else{
	
		// Since meta data is provided, we need to filter based on this.
		$sql .= " as q INNER JOIN quiz_meta_data as m ON q.QuizId = m.QuizId WHERE q.CreatedAt >= '$quiz_sync_time' AND ActiveStatus = 'X'";
		
		foreach ($metaData as $metaDataRow){
			
			$metaKey = $metaDataRow['meta_key'];
			$metaValue = $metaDataRow['meta_value'];
			
			$sql .= " AND m.MetaKey = '$metaKey' AND m.MetaValue = '$metaValue'";
		
		}
	}

	//echo $sql;
	
	$output = array();
	
	// Execute Query
	$result = mysqli_query($sql, $linkID);
	
	while($row = mysqli_fetch_assoc($result)) {
		$output[] = $row;
	}
	
	// Return the result
	return $output;
}

function getQuestionArtifacts($question_sync_time, $metaData){
	
	global $linkID;
	$sql = "SELECT q.ID, q.CreatedAt FROM questions";
	
	if(empty($metaData)){
	
		$sql .= " as q WHERE CreatedAt >= '$question_sync_time' AND ActiveStatus = 'X'";
		
	}
	else{
		
		// Since meta data is provided, we need to filter based on this.
		$sql .= " as q INNER JOIN meta_data as m ON q.ID = m.QuestionId WHERE q.CreatedAt >= '$question_sync_time' AND ActiveStatus = 'X'";
		
		foreach ($metaData as $metaDataRow){
			
			$metaKey = $metaDataRow['meta_key'];
			$metaValue = $metaDataRow['meta_value'];
			
			$sql .= " AND m.MetaKey = '$metaKey' AND m.MetaValue = '$metaValue'";
		
		}
		
	}
	
	// For testing.
	//echo "<br>SQL = " . $sql;
	
	$output = array();
	
	// Execute Query
	$result = mysqli_query($sql, $linkID);
	
	while($row = mysqli_fetch_assoc($result)) {
		$output[] = $row;
	}
	
	// Return the result
	return $output;
}

function getQuizData($ids){

	global $linkID;
	
	$output = array();
	
	$sql = "SELECT * FROM quiz WHERE QuizId in ($ids)";
	
	$result = mysqli_query($sql, $linkID);
	
	while($quiz = mysqli_fetch_assoc($result)) {

		$qId = $quiz['QuizId'];
		
		$metaSQL = "SELECT * FROM quiz_meta_data where QuizId = $qId AND MetaKey = 'sync'";
		$metaData = mysqli_query($metaSQL, $linkID);
		
		$metaArray = array();
		while($meta = mysqli_fetch_assoc($metaData)) {
			$metaArray[] = $meta;
		}
		
		$qRow = array('quiz' => $quiz, 'meta' => $metaArray);
		$output[] = $qRow;
	}
	
	return $output;
}

function getQuestionsData($ids){
	
	global $linkID;
	
	$output = array();
	
	$sql = "SELECT * FROM questions WHERE ID in ($ids)";
	
	$questions = mysqli_query($sql, $linkID);
	
	while($question = mysqli_fetch_assoc($questions)) {
		
		$qId = $question['ID'];
		
		$optionsSQL = "SELECT * FROM options where QuestionId = $qId";
		$options = mysqli_query($optionsSQL, $linkID);
		
		$answersSQL = "SELECT * FROM answers where QuestionId = $qId";
		$answers = mysqli_query($answersSQL, $linkID);
		
		$metaSQL = "SELECT * FROM meta_data where QuestionId = $qId AND MetaKey <> 'sync'";
		$metaData = mysqli_query($metaSQL, $linkID);
		
		$optionArray = array();
		while($option = mysqli_fetch_assoc($options)) {
			$optionArray[] = $option;
		}
		
		$answerArray = array();
		while($answer = mysqli_fetch_assoc($answers)) {
			$answerArray[] = $answer;
		}
		
		$metaArray = array();
		/* DO NOT Return any meta data
		while($meta = mysql_fetch_assoc($metaData)) {
			$metaArray[] = $meta;
		}
		*/
		
		$qRow = array('question' => $question, 'options' => $optionArray, 'answers' => $answerArray, 'meta' => $metaArray);
		
		$output[] = $qRow;
	}
	
	return $output;
}

function getQuestionsInQuiz($quizId){
	
	global $linkID;

	$sql = "CALL get_questions_in_quiz($quizId)";

	$result = mysqli_query($sql, $linkID);

	return $result;

}

function getQuestionsByTag($tag){
	
	global $linkID;

	$sql = "CALL get_questions_by_tag('$tag')";

	$result = mysqli_query($sql, $linkID);

	return $result;

}

function getUnGroupedQuestionsByTag($tag){
	
	global $linkID;

	$sql = "CALL get_ungrouped_questions_by_tag('$tag')";

	$result = mysqli_query($sql, $linkID);

	return $result;

}

function getAllUnGroupedQuestions(){
	
	global $linkID;

	$sql = "CALL get_all_ungrouped_questions()";

	$result = mysqli_query($sql, $linkID);

	return $result;

}

function setQuizStatus($quizId, $status){

	global $linkID;

	$sql = "CALL update_quiz_status($quizId,'$status')";

	$result = mysqli_query($sql, $linkID);

	return $result;
}

?>
