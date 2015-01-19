<?php

/*
 * PHP (re)Quest
 * Lib for simple requests (basicly a cURL wrapper)
 *
 *
 */

class phpQuest{

	// in case some one is using an weird api that only has one url
	private static $url;

	// in case some one wants to send the same headers every request
	private static $settings;

	// in case some one wants to send the same data every request
	private static $data;

	private static $timeout = 10;


	/*
	 * Set basic settings (these might be overwritten at any time)
	 *
	 *
	 */
	public function __construct($url = false, $settings = false, $data = false){

		// run start up check first
		if(!$this->isInstalled()):
			throw new Exception('cUrl is not installed.');
		endif;




	}

	private function isInstalled(){
		if (!function_exists('curl_init')):
        	return false;
    	endif;
		return true;
	}

	/*
	 * Basic function to send all requests
	 *
	 *
	 */
	public function request($url, $settings = false, $data = false, $requestType = 'GET'){



		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);

		if(isset($settings['user_agent'])):
			curl_setopt($curl, CURLOPT_USERAGENT, $settings['user_agent']);
		endif;


		if(isset($setting['return_headers'])):
			curl_setopt($curl, CURLOPT_HEADER, $setting['return_headers']);
		else:
			curl_setopt($curl, CURLOPT_HEADER, false);
		endif;

		if(isset($settings['headers'])):

			curl_setopt($curl, CURLOPT_HTTPHEADER, $this->createHeaders($settings['headers']));
			curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		endif;

		if($requestType === 'PUT' || $requestType === 'POST'):
			curl_setopt($curl, CURLOPT_POST, true);
			if($data):
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			endif;
		endif;

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($curl, CURLOPT_TIMEOUT, static::$timeout);


		if($requestType):
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestType);
		endif;


		$output = curl_exec($curl);

		curl_close($curl);

		return $output;


	}



	public function post(){}

	public function get(){}

	public function put(){}

	public function delete(){}

	/*
	 * Transforms array of headers into some thing usefull
	 *
	 * @param $headerArray array of headers key/val
	 * @return array of valid headers
	 */
	public function createHeaders($headerArray){
		$return = [];
		foreach($headerArray as $key=>$header):
			$return[] = $key.': '.$header;
		endforeach;
		return $return;
	}




}