<?php
class Loader{

	public $request;
	public $session;

	/**
	* Init the system
	**/
	public function __construct(){
		$this->request 			= new Request();
		$this->session 			= new Session();
		$this->request->data 	= $_POST;
		$this->request->query 	= $_GET;
		$controller = $this->initController($this->request->controller);
		if( in_array($this->request->action, get_class_methods(get_parent_class($controller))) ||
			!in_array($this->request->action, get_class_methods($controller))
		 ){
			$this->returnError('this action ' . $this->request->action .' does not exist');

		}elseif( !$controller ){

			$this->returnError( $this->request->controller .' does not exist');

		}else if(in_array($this->request->action, get_class_methods($controller))){

			call_user_func_array(array($controller,$this->request->action), $this->request->params);
			$controller->renderView($this->request->action);
			
		}
	}

	/**
	* Load the controller in the request url
	* @param string $controllerName
	**/
	public function initController ( $controllerName ) {
		$name = ucfirst($controllerName) . "Controller";
		$file = ROOT . DS . 'Controller' . DS . ucfirst($name) . '.php';
		if(file_exists($file)){
			require $file;
			return new $name($this->request);
		}
		return false;
	}
	/**
	* Display error
	* @param string $controllerName
	**/
	public function returnError( $message ){
		header("HTTP/1.0 404 Not Found");
		$Controller = new Controller($this->request);
		$Controller->set("message",$message);
		$Controller->renderView('/error');
		return true;
	}
}