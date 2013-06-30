<?php

header("Content-type: text/json");

require('hqf-functions.php');

// Create DB Connection first
createDBConnection();

$question_text = $_POST['question_text'];
$level = $_POST['level'];
$type = $_POST['type'];
$options = json_decode($_POST['options']);
$answers = json_decode($_POST['answers']);
$answers_no = $_POST['answers_no'];
$tags = json_decode($_POST['tags']);

//echo json_encode("Question = ".$question_text.", level = ".$level.", Type = ".$type.", Options= ".$options.", Answers =".$answers." , Answers_no = ".$answers_no." , Tags = ".$tags);
//echo json_encode( Array( 'options' => $options , 'answers' => $answers) );

//$id=0;
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
	If(mysql_query($sql,$linkID)) $log .= "<br>Option ('$opt_id','$opt') sucessfully inserted";
	}
	
	foreach ( $answers as $answer ) 
	{
	$sql = "INSERT INTO answers (QuestionId,OptionId) VALUES ('$id','$answer') " ;
	If(mysql_query($sql,$linkID)) $log .= "<br>Answer ('$id','$answer') sucessfully inserted";	
	}
	
	foreach ( $tags as $tag) 
	{
	$sql = "INSERT INTO meta_data (QuestionId,MetaKey,MetaValue) VALUES ('$id','tag','$tag') " ;
	If(mysql_query($sql,$linkID)) $log .= "<br>MetaData ('tag','$tag') sucessfully inserted";
	}
	
	echo json_encode($log);
	

function UpdateQuestion($q, $l, $t)
{
	global $linkID;
	
	//echo json_encode("Question = ".$q.", level = ".$l.", Type = ".$t);
	$qsql = "INSERT INTO questions (Question,Level,ChoiceType) VALUES ('$q','$l','$t')" ;
	//echo json_encode($linkID);
	IF( mysql_query($qsql,$linkID) ) //successfull entry
	{
		$qsql = "SELECT MAX(ID) AS ID FROM questions";
		$row = mysql_query($qsql, $linkID);
		$id = mysql_fetch_assoc($row);
		
		return ($id['ID'] - 0 );
	}
}

?>