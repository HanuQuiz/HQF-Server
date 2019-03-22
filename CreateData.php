<?php

header("Content-type: text/json");

require('hqf-functions.php');

// Create DB Connection first
createDBConnection();

$pwd = $_POST['pwd'];
$question_text = $_POST['question_text'];
$level = $_POST['level'];
$type = $_POST['type'];

$options = json_decode(stripslashes($_POST['options']));
$answers = json_decode(stripslashes($_POST['answers']));
$meta = json_decode(stripslashes($_POST['meta']));


if($pwd != secret_key ){
	$message = "You think we are stupid to allow any one ?";
	die(json_encode($message));
}

$log = " ----- DataBase Log ------ <br> ";

	$id = UpdateQuestion( $question_text , $level , $type );
	
	//$id = $id - 0;
	
    if($id == 0) echo json_encode("Could Not Insert question");
	else $log .= "Question ID : ".$id;
	
	$opt_id = 0;
	foreach ( $options as $opt ) 
	{
	$opt_id++;
	$sql = "INSERT INTO options (QuestionId,OptionId,OptionValue) VALUES ('$id','$opt_id','$opt') " ;
	If(mysqli_query($sql,$linkID)) $log .= "<br>Option ('$opt_id','$opt') sucessfully inserted";
	}
	
	foreach ( $answers as $answer ) 
	{
	$sql = "INSERT INTO answers (QuestionId,OptionId) VALUES ('$id','$answer') " ;
	If(mysqli_query($sql,$linkID)) $log .= "<br>Answer ('$id','$answer') sucessfully inserted";	
	}
	
	foreach ( $meta as $meta_row ) 
	{
	$sql = "INSERT INTO meta_data (QuestionId,MetaKey,MetaValue) VALUES ('$id','$meta_row[0]','$meta_row[1]') " ;
	If(mysqli_query($sql,$linkID)) $log .= "<br>MetaData ('$meta_row[0]','$meta_row[1]') sucessfully inserted";
	}
	
	echo json_encode($log);
	

function UpdateQuestion($q, $l, $t)
{
	global $linkID;
	
	//echo json_encode("Question = ".$q.", level = ".$l.", Type = ".$t);
	$qsql = "INSERT INTO questions (Question,Level,ChoiceType) VALUES ('$q','$l','$t')" ;
	//echo json_encode($linkID);
	IF( mysqli_query($qsql,$linkID) ) //successfull entry
	{
		return mysqli_insert_id();
	}

}

?>
