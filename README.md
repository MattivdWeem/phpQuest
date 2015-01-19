# PHP (re)Quest
Library to send requests in php (basicly a simple wrapper for cURL)

// basics:

	$request = new phpQuest(/* Basic settings here */);

	$request->post('http://example.com',$settings,$data,function($response, $headers, $succes){

		if($succes):
			// on success
		else:
			// on fail
		endif;

	});

