<?php
class Router {

	protected $controller = ""; 
	protected $method;
	protected $params = array();
	protected $obj;

	public function __construct(){

		$url = $this->getURL();
		$file = 'controllers/'. $url[0] .'Controller.php';
		//check if controller exist
		if(file_exists($file)){
			$this->controller = $url[0];
			unset($url[0]);
		} else {
			$this->controller = 'error';

		}
		//require existing controller
		require_once('controllers/'. $this->controller.'Controller.php');
		//make insance of existing class and save it into controller atributn
		$this->controller = new $this->controller.'Controller()';
		//chceck if there is given method and if exists
		if(isset($url[1])){

			if(method_exists($this->controller, $url[1])){
			$this->method = $url[1];
			unset($url[1]);
			} else {
				$this->method = 'error';
				$this->controller->$this->method.'()';
			}
		//save given parameters into params atribut otherwise save empty array
		$params = $url ? array_values($url) : array();
		//call method with given parameters
		call_user_func_array([$this->controller, $this->method], $this->params);

		}
	}

	public function getURL(){

		$url=isset($_GET['uri']) ? $_GET['uri'] : '/';
		$url=ltrim($url, '/');
		$url=explode('/', $url);
		return $url;

	}


}

?>