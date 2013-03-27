<?php

/**
 * 
 * 
 * PHP 5
 *
 * Sistema : Miniframework PHP OO para aplicações web.
 * 
 *
 * 
 * @copyright     Copyright 2013, Iggow
 * @author		  Vagner Leite (vagnerleitte@outlook.com)
 * @created 	  17-01-2013
 * @link          http://www.iggow.com
 * @version       Sistema v 0.1
 * @package		  root
 */
	
	/*
	 * Armazena configurações básicas para o funcionamento do sistema.
	 * 
	 */
	
	if(DEVELOPMENT_ENVIROMENT == true){
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');
		
	}else{
		ini_set('display_errors', 'Off');
	}
	ini_set("log_errors", 1);
	ini_set("error_log", ROOT. DS . 'temp'. DS . 'logs'. DS .'php-error.log');
	
	
	define ('SYSTEM', 'system');
	define('CONTROLLERS', 'app' . DS . 'controllers'. DS);
	define('VIEWS', 'app' . DS . 'views' . DS);
	define('MODELS', 'app' . DS . 'models' . DS);
	define('HELPERS', SYSTEM . DS . 'helpers' . DS);
	define('CONFIG', ROOT . DS . SYSTEM . DS . 'config');
	define('PUBLIC_DIR', PATH_ROOT.'public/');
	
	/** constantes que armazenam tags HTML para acesso rápido**/
	define('pre','<pre>');
	define('endpre','</pre>');
	define('hr', '<hr/>');
	define('br', '<br/>');
	
	
	/** diretórios estáticos do site  **/
	
	define('TEMPLATES', 	PUBLIC_DIR . 'templates/' );
	define ('IMAGES',  		'images/' );
	define ('STYLESHEETS',  'css/' );
	define ('JAVASCRIPTS',  'js/' );
	
	
	require_once(ROOT . DS . SYSTEM . DS . 'system.php');
	require_once(ROOT . DS . SYSTEM . DS . 'controller.php');
	require_once(ROOT . DS . SYSTEM . DS . 'model.php');
	
	
	session_save_path(DIR_ROOT. DS . 'temp'. DS .'sessions');
	