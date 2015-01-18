<?php

$env = new Dotenv();

$env->load('.env');

class SuperSecretClass{

	public function __construct(){


	}

	public function muted($vars,$func){
		if(is_array($vars)):
			foreach($vars as $key => $var):
				$$key = $var;
				$func($$key);
			endforeach;
		endif;


	}

	public function shifted($url, $data = [], $config = [] , $function = false){

		$function($url,$data,$config);

	}

	public function asManyAsSecret(){

		print_r(func_get_args());


	}

}


$obj = new SuperSecretClass();
$obj->muted(['$var' => 'This is my variable','var' => 'this is my second vrrr'],function($call){
	echo $call;
});

echo "\n";

$obj->shifted('http://test.nl',['username' => 'matti'], [], function($url,$data,$config){
	print_r(func_get_args());
});

echo "\n";

$obj->asManyAsSecret(1,2,4,5,5,6,456,45,64,56);

