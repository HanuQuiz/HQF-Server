<?php

header("Content-type: text/json");

require('hqf-functions.php');

// Create DB Connection first
createDBConnection();

$pwd = $_POST['pwd'];
$description = $_POST['description'];
$level = $_POST['level'];
$qids = $_POST['qids'];
$count = $_POST['count'];

$meta = json_decode(stripslashes($_POST['meta']));


if($pwd != secret_key ){
	$message = "You think we are stupid to allow any one ?";
	die(json_encode($message));
}

$log = " ----- DataBase Log ------ <br> ";

	$id = InsertQuiz($description , $level , $qids , $count);
	
	//$id = $id - 0;
	
    if($id == 0) die(json_encode("Could Not Insert quiz"));
	else $log .= "Quiz ID : ".$id;
	
	foreach ( $meta as $meta_row ) 
	{
	$sql = "INSERT INTO quiz_meta_data (QuizId,MetaKey,MetaValue) VALUES ('$id','$meta_row[0]','$meta_row[1]') " ;
	If(mysql_query($sql,$linkID)) $log .= "<br>MetaData ('$meta_row[0]','$meta_row[1]') sucessfully inserted";
	}
		
	echo json_encode($log);
	

function InsertQuiz($d, $l, $qs,$cnt)
{
	global $linkID;
	
	$qsql = "INSERT INTO quiz (Description,Level,QuestionIds,Count,ActiveStatus) VALUES ('$d','$l','$qs','$cnt',' ')" ;
	//echo json_encode($linkID);
	IF( mysql_query($qsql,$linkID) ) //successfull entry
	{
		return mysql_insert_id();
	}

}

?>
