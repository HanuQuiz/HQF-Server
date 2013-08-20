<?php

require('hqf-functions.php');

$code = $_POST['code'];
$pwd = $_POST['pwd'];

if($pwd != "WeAreTheAdmins:P"){
	$message = "You think we are stupid to allow any one ?";
	die($message);
}

// Create DB Connection first
createDBConnection();

if($code == "quiz-questions"){

	$quiz_id = $_POST['quiz_id'];

	$result = getQuestionsInQuiz($quiz_id);
	
	$html = "<table border='1'>";
	$html .= "<tr>".
		"<th>ID</th>".
		"<th>Question</th>".
		"<th>Level</th>".
		"<th>Status</th>".
		"</tr>";
		
	while($row = mysql_fetch_assoc($result)) {
			
		$html .= "<tr>";
	
		$html .= "<td>".$row['ID']."</td>";
		$html .= "<td>".$row['Question']."</td>";
		$html .= "<td>".$row['Level']."</td>";
		$html .= "<td>".$row['ActiveStatus']."</td>";
		$html .= "</td>";
		
		$html .= "</tr>";

	}	
	
	echo "<br>" . $html;

}

if($code == "questions-by-tag"){

	$tag = $_POST['tag'];

	$result = getQuestionsByTag($tag);
	
	$html = "<table border='1'>";
	$html .= "<tr>".
		"<th>ID</th>".
		"<th>Question</th>".
		"<th>Level</th>".
		"<th>Status</th>".
		"</tr>";
		
	while($row = mysql_fetch_assoc($result)) {
			
		$html .= "<tr>";
	
		$html .= "<td>".$row['QuestionID']."</td>";
		$html .= "<td>".$row['Question']."</td>";
		$html .= "<td>".$row['Level']."</td>";
		$html .= "<td>".$row['ActiveStatus']."</td>";
		$html .= "</td>";
		
		$html .= "</tr>";

	}	
	
	echo "<br>" . $html;

}

if($code == "ungrouped-questions-by-tag"){

	$tag = $_POST['tag'];

	$result = getUnGroupedQuestionsByTag($tag);
	
	$html = "<table border='1'>";
	$html .= "<tr>".
		"<th>TAG</th>".
		"<th>Level</th>".
		"<th>ID</th>".
		"<th>Question</th>".
		"<th>Status</th>".
		"</tr>";
		
	while($row = mysql_fetch_assoc($result)) {
			
		$html .= "<tr>";
	
		$html .= "<td>".$row['MetaValue']."</td>";
		$html .= "<td>".$row['Level']."</td>";
		$html .= "<td>".$row['ID']."</td>";
		$html .= "<td>".$row['Question']."</td>";
		$html .= "<td>".$row['ActiveStatus']."</td>";
		$html .= "</td>";
		
		$html .= "</tr>";

	}	
	
	echo "<br>" . $html;

}

if($code == "all-ungrouped-questions"){

	$result = getAllUnGroupedQuestions();
	
	$html = "<table border='1'>";
	$html .= "<tr>".
		"<th>TAG</th>".
		"<th>Level</th>".
		"<th>ID</th>".
		"<th>Question</th>".
		"<th>Status</th>".
		"</tr>";
		
	while($row = mysql_fetch_assoc($result)) {
			
		$html .= "<tr>";
	
		$html .= "<td>".$row['MetaValue']."</td>";
		$html .= "<td>".$row['Level']."</td>";
		$html .= "<td>".$row['ID']."</td>";
		$html .= "<td>".$row['Question']."</td>";
		$html .= "<td>".$row['ActiveStatus']."</td>";
		$html .= "</td>";
		
		$html .= "</tr>";

	}	
	
	echo "<br>" . $html;

}

if($code == "activate-quiz"){

	$quiz_id = $_POST['quiz_id'];

	$result = setQuizStatus($quiz_id,'X');
	
	if($result){
		echo "Quiz Activated successfully";
	}
	else{
		echo "Quiz Activation Failed !";
	}

}

if($code == "deactivate-quiz"){

	$quiz_id = $_POST['quiz_id'];

	$result = setQuizStatus($quiz_id,'');
	
	if($result){
		echo "Quiz De-Activated successfully";
	}
	else{
		echo "Quiz De-Activation Failed !";
	}

}

?>
