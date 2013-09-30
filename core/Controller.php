<?php

class Controller{

	private $view;
	public 	$request;
	private $vars = array();
	private $is_rendered = false;

	public function __construct( $request ){
		$this->request 	= $request;
		$this->view 	= new Layout();
		//Autoload the Model
		$this->initModel( $this->request->controller );
	}
	/**
	* Display the view of the controller action in the template
	* @param string $controllerName
	**/
	public function renderView( $view ){
		if($this->is_rendered){ return false; }
		$this->view->render( $this->vars, $this->request->controller, $view );
		$this->is_rendered = true;
	}
	/**
	* prepare the vars for send to the view
	* @param $key
	* @param $value
	**/
	public function set( $key, $value ){
		if(is_array($key)){
			$this->vars += $key;
		}else{
			$this->vars[$key] = $value;
		}
	}
	/**
	* Load the Model with the controller name
	* @param string $controllerName
	**/
	public function initModel( $controllerName ){
		$model = singular(ucfirst($controllerName));
		$file = ROOT . DS . 'Model' . DS . ucfirst($model) . '.php';
		if(file_exists($file)){
			require $file;
			return $this->$model = new $model();
		}
		return false;
	}
}