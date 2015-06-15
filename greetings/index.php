	<?php

	include_once "../lib.php";

	header('Content-Type: application/json');


	// handle malformed request
	if(! isset($_GET['q'])){
		$response = array(
			"answer" => "Kitty! You should read the documentation and ask the questions in a proper format!"
			);

		echo json_encode($response);
		die();
	}


	$question = strtolower(urldecode($_GET['q']));



	$answer = "Hello, Kitty!";

	$question_words = str_word_count($question, 2);


	// Handle first part of greeting
	if(in_array('morning', $question_words))
		$answer .= " Good morning to you too.";

	else if(in_array('day', $question_words))
		$answer .= " Good day to you too.";

	else if(in_array('afternoon', $question_words))
		$answer .= " Good afternoon to you too.";

	else if(in_array('evening', $question_words))
		$answer .= " Good evening to you too.";

	else if(in_array('night', $question_words))
		$answer .= " Good night to you too.";




	// handle 2nd part
	if(in_array('how', $question_words))
		$answer .= " Everything is fine, thanks for asking.";

	if(in_array('name', $question_words) || str_contains($question, 'who are you'))
		$answer .= " I'm Mehedee.";

	$answer .= " Welcome to our home planet.";

	$response = array(
		"answer" => $answer
		);

	echo json_encode($response);


	?>