<?php
class Controller {
	
	public function __construct(){

		echo "main controler";
	}

	public function error(){
		require('views/error.html');
	}
}

?>