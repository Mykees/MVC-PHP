<?php
class Request{

	public $data 		= false;
	public $query 		= false;
	public $controller 	= false;
	public $model	 	= false;
	public $action 		= false;
	public $params 		= array();
	
	/**
	*	Init the request
	**/
	public function __construct(){
		$request_url = $_SERVER['PATH_INFO'];
		$this->parseUrl($request_url);
	}

	/**
	*	Parse the url and define the controller, action and params
	*	@param array $url
	**/
	private function parseUrl( $url ){
		$url = trim($url,'/');
		$req = explode('/',$url);
		$this->controller = $req[0];
		$this->action	  = isset($req[1]) ? $req[1] : 'index';
		$this->params     = array_slice($req, 2);
		return true;
	}
}