	<?php

	include_once "../lib.php";


	

	// handle malformed request
	if(! isset($_GET['q'])){
		$response = array(
			"answer" => "Kitty! You should read the documentation and ask the questions in a proper format!"
			);

		echo json_encode($response);
		die();
	}


	$question = trim(strtolower(urldecode($_GET['q'])), '?');

	$question_words = str_word_count($question, 1);




//	echo "#{$question}#";

	$answer = "";

	// try duckduckgo api
	$response = json_decode(file_get_contents('http://api.duckduckgo.com/?format=json&q='.urlencode($question)));

	if($response->AbstractText !== ""){
		$answer = $response->AbstractText;


	// duckduckgo failed. Try SPARQL	
	} else {
		$answer = 'Your majesty! Jon Snow knows nothing! So do I!';

	}


//	print_r($response);

//	echo $response->AbstractText;

//	echo $html->save();

//echo $answer;
	// $anser="";
	$response = array(
		"answer" => $answer
		);

	header('Content-Type: application/json');
	echo json_encode($response);







	?>