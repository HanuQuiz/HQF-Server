<?php

header("Content-type: text/json");

require('hqf-functions.php');

// Create DB Connection first
createDBConnection();

$pwd = $_POST['pwd'];
$qid = $_POST['qid'];
$question_text = $_POST['question_text'];
$level = $_POST['level'];
$type = $_POST['type'];
$options = json_decode(stripslashes($_POST['options']));	// Read what is the use of stripslashes
$answers = json_decode(stripslashes($_POST['answers']));
$meta = json_decode(stripslashes($_POST['meta']));

if($pwd != secret_key ){
	$message = "You think we are stupid to allow any one ?";
	die(json_encode($message));
}

//echo json_encode("Question = ".$question_text.", level = ".$level.", Type = ".$type.", Options= ".$options.", Answers =".$answers." , Answers_no = ".$answers_no." , Tags = ".$tags);
//echo json_encode( Array( 'options' => $options , 'answers' => $answers) );

//$id=0;
$log = " ----- DataBase Log ------ <br> ";
$success=0;

global $linkID;

	//Update Question
	$sql = "UPDATE questions SET Question='$question_text', Level='$level', ChoiceType='$type' WHERE ID='$qid'" ;
	If(mysql_query($sql,$linkID)) { $log .= "<br>Question table with ID='$qid' UPDATE"; $success = 1; }
	else{ $log .= "<br>Could not update Question ID='$qid' <br>"; $success = 0;}

   if($success == 1 ){
	
		global $linkID;
	
		$sql = "DELETE FROM options WHERE QuestionId = $qid" ;
		if(mysql_query($sql,$linkID)) $log .= "<br>Previous options sucessfully deleted";
	
		
		$opt_id = 0;
		foreach ( $options as $opt ) 
		{
		global $linkID;
		$opt_id++;
		$sql = "INSERT INTO options (QuestionId,OptionId,OptionValue) VALUES ('$qid','$opt_id','$opt') " ;
		If(mysql_query($sql,$linkID))
		{ $log .= "<br>Option ('$opt_id','$opt') sucessfully inserted"; }
		else {  $log .= "Failed!"; }
		}	
		
		
		
		//echo(json_encode($log));		
				
		$sql = "DELETE FROM answers WHERE QuestionId = $qid" ;
		if(mysql_query($sql,$linkID)){ $log .= "<br>Previous answers sucessfully deleted"; }
		else {  $log .= "Failed!"; }
		
		
		foreach ( $answers as $answer ) 
		{
		global $linkID;
		$sql_option = "INSERT INTO answers (QuestionId,OptionId) VALUES ('$qid','$answer') " ;
		if(mysql_query($sql_option,$linkID)) 
		{ $log .= "<br>Answer ('$qid','$answer') sucessfully inserted"; }
		else {  $log .= "Failed!"; }
		}
		
		$sql_meta = "DELETE FROM meta_data WHERE QuestionId = $qid" ;
		if(mysql_query($sql_meta,$linkID)){ $log .= "<br>Previous meta data sucessfully deleted"; }
		else {  $log .= "Failed!"; }
		
		foreach ( $meta as $meta_data ) 
		{
		global $linkID;
		$sql_meta = "INSERT INTO meta_data (QuestionId,MetaKey,MetaValue) VALUES ('$qid','$meta_data[0]','$meta_data[1]') " ;
		if(mysql_query($sql_meta,$linkID))
		{ $log .= "<br>MetaData ('$meta_data[0]','$meta_data[1]') sucessfully inserted"; }
		else {  $log .= "Failed!"; }
		}
		
		echo(json_encode($log));		
		
	}
	

	
?>
