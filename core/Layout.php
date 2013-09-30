<?php
class Layout{

	public $layout 			= 'default';

	/**
	* Get the template for include the view
	*	@param array $viewVars Data for send to the view
	*	@param string $controller controller name
	*	@param string $viewname
	**/
	public function render( $viewVars, $controller, $viewname ){
		
		extract($viewVars);
		if ( strpos($viewname, '/') === 0 ) {
			$viewname = trim($viewname, '/');
			$view 	  = ROOT . DS . 'view' . DS . 'error' . DS . $viewname . '.php';
		}else{
			$view  	  = ROOT . DS . 'view' . DS . $controller . DS . $viewname . '.php';
		}
		
		if(file_exists($view)){
			ob_start();
			require $view;
			$content  = ob_get_clean();
			$template = ROOT . DS . 'view' . DS . 'layout' . DS . $this->layout . '.php';
			require $template;
		}
	}
	
}