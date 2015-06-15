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

		// Assuming the city name will be after the string 'in', like 'What is the temperature in Dhaka?'
		$inPos = strpos($question, ' in');

	$city = 'Dhaka,Bangladesh';

	if($inPos !== false){

		// the word(s) after 'in'
		$city = substr($question, $inPos+3);

	}

//	echo $city.'\n';

	$weatherdata = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?units=metric&q=' . urlencode($city) . '&APPID=cb9a8e7244d144f7248457d8f057b4bd' ));

//	print_r($weatherdata);

	$answer = "";


	// unrecognized city
	if($weatherdata->cod !== 200){

		$answer = "Sorry Kitty, I did not find a valid city name in your question";

	} else {

		if(in_array('temperature', $question_words))
			$answer = $weatherdata->main->temp . " C";

		else if(in_array('humidity', $question_words))
			$answer = $weatherdata->main->humidity . "%";


		else if(in_array('rain', $question_words))
			$answer = str_contains(strtolower($weatherdata->weather[0]->main), 'rain')?'Yes':'No';

		else if(in_array('cloud', $question_words) || in_array('cloudy', $question_words))
			$answer = str_contains(strtolower($weatherdata->weather[0]->main), 'cloud')?'Yes':'No';

		else if(in_array('clear', $question_words))
			$answer = str_contains(strtolower($weatherdata->weather[0]->main), 'clear')?'Yes':'No';

		else $answer = "Sorry Kitty, I did not understand your question.";

	}


	$response = array(
		"answer" => $answer
		);

	header('Content-Type: application/json');
	echo json_encode($response);







	?>