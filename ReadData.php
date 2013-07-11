<?php

header("Content-type: text/json");

require('hqf-functions.php');

// Create DB Connection first
createDBConnection();

$pwd = $_POST['secret_key'];
$qid = $_POST['qid'];

$quest = array( "message"=>"",
				"status"=>"FAIL" ,
				"question"=>"",
				"level"=>"",
				"type"=>"",
				"meta"=>"",
				"options"=>"",
				"answers"=>""
			);
				
if($pwd != secret_key ){
	$quest["status"] = "RESTRICTED";
	$quest["message"] = "You think we are stupid to allow any one ?";
	die(json_encode($quest));	
}
else
{
	
	global $linkID;
		
	$sql = "SELECT * FROM questions WHERE ID = '$qid'";
		
	$result = mysql_query($sql, $linkID);

	while($row = mysql_fetch_assoc($result)){
	
	$quest["status"] =  "";
	$quest["question"] = $row["Question"];	
	$quest["level"] = $row["Level"];	
	$quest["type"] = $row["ChoiceType"];
	
	$quest["options"] = read_options($qid);
	$quest["answers"] = read_answers($qid);	
	$quest["meta"] = read_meta($qid);
	
	die(json_encode($quest));
	}
	
	
}


function read_options($id)
{
	global $linkID;
	
	$output = array();
	$i = 0;
	
	$sql = "SELECT * FROM options WHERE QuestionId = '$id'";
	
	$result = mysql_query($sql, $linkID);
	
	while($row = mysql_fetch_assoc($result)){
		$output[$i] = array();
		$output[$i][0] = $row['OptionId'];
		$output[$i][1] = $row['OptionValue'];
		$i++;
	}
	
	return $output;
}

function read_answers($id)
{
	global $linkID;
	
	$output = array();
	$i = 0;
	
	$sql = "SELECT * FROM answers WHERE QuestionId = '$id'";
	
	$result = mysql_query($sql, $linkID);
	
	while($row = mysql_fetch_assoc($result)){
		$output[$i++] = $row['OptionId'];
	}
	
	return $output;
}

function read_meta($id)
{
	global $linkID;
	
	$output = array( );
	$i = 0;
	
	$sql = "SELECT * FROM meta_data WHERE QuestionId = '$id' ";
	
	$result = mysql_query($sql, $linkID);
	
	while($row = mysql_fetch_assoc($result)){
		$output[$i] = array( );
		$output[$i][0] = $row['MetaKey'];
		$output[$i][1] = $row['MetaValue'];
		$i++;
	}
		
	return $output;
}

?>
