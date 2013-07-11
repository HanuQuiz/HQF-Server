<?php

header("Content-type: text/json");

require('hqf-functions.php');

$ids = $_POST['ids'];

// Create DB Connection first
createDBConnection();

// Get Artifacts based on mod time and meta data
$output = getQuestionsData($ids);

// Send Data
echo json_encode($output);

?>