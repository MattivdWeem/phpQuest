<?php

class SuperSecretClass{

	public function __construct(){


	}

	public function muted($call,$func){

		$func($call);

	}

}


$obj = new SuperSecretClass();
$obj->muted('This is my variable',function($call){
	echo $call;
});

