<?php
define('ASSETS', dirname(__FILE__));
define('ROOT', dirname(ASSETS));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT . DS  . 'core');
define('BASE', dirname(dirname($_SERVER["SCRIPT_NAME"])) . DS);
define('CSS', BASE . DS . "assets" . DS . 'css' . DS);
define('JS', BASE . DS . "assets" . DS . 'js' . DS);
define('IMG', BASE . DS . "assets" . DS . 'img' . DS);


require CORE . '/functions.php';
require CORE . '/Request.php';
require CORE . '/Controller.php';
require CORE . '/Session.php';
require CORE . '/Model.php';
require CORE . '/Layout.php';
require CORE . '/loader.php';

$loader = new Loader();
