<?php

class UsersController extends Controller{

	public function index(){
		$d['hello'] = "Hello world";
		$this->set($d);
	}

	
}