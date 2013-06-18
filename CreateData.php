<?php

header("Content-type: text/json");

require('hqf-functions.php');

$quiz

// Create DB Connection first
createDBConnection();

function CreateQuestion( $obj )
{
	$quiz = json_decode($obj);
	$id = UpdateQuestion( $quiz->{'question_text'} , $quiz->{'level'} , $quiz->{'type'} );
	
	if($id == 0) return 0;
	
	$opt_id = 0;
	foreach ( $quiz->{'answer_text'} as $ans) 
	{
	$opt_id++;
	$sql = "INSERT INTO options (QuestionId,OptionId,OptionValue) VALUES ('$id','$opt_id','$ans') " ;
	mysqli_query($linkID,$sql)
	}
	
	foreach ( $quiz->{'answer_options'} as $option) 
	{
	$sql = "INSERT INTO answers (QuestionId,OptionId) VALUES ('$id','$option') " ;
	mysqli_query($linkID,$sql)
	}
	
	foreach ( $quiz->{'tags'} as $tag) 
	{
	$sql = "INSERT INTO meta_data (QuestionId,MetaKey,MetaValue) VALUES ('$id',tag,'$tag') " ;
	mysqli_query($linkID,$sql)
	}
	
	return 1;
}


function UpdateQuestion( $question,$level,$type)
{
	$sql = "INSERT INTO questions (Question,Level,ChoiceType) VALUES ('$question','$level','$type') " ;
	if(mysqli_query($linkID,$sql)) //successfull entry
	{
		$sql = "SELECT MAX(ID) FROM questions where QuestionId = $qId";
		$id = mysql_query($sql, $linkID);
		return $id;
	}	
}

?>