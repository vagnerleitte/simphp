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
 * @author	  Vagner Leite (vagnerleitte@outlook.com)
 * @created 	  03-12-2012
 * @link          http://www.vagnerleitte.com.br
 * @version       v 0.1
 * @package	  root
 */

 	/**
	 * Obtem o valor da string de separação de diretórios no servidor. 
	 */
	define('DIR_ROOT', __DIR__);
	 
	
	define('DS', DIRECTORY_SEPARATOR);
	
	define ('PATH_ROOT', DS);

	/**
	 * Define o ambiente de execução do site. 
	 */
	define('DEVELOPMENT_ENVIROMENT', true);

	/**
	 *  Obtém o diretório ROOT do Sistema
	 */
	define('ROOT', dirname(__FILE__));
	
	 
	/**
	 *  Obtém o endereço completo do Sistema no servidor. 
	 * 	Ex.: http://endereco.com.br/ 
	 */
	define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/');
	
	
	/**
	 * Inclui as configurações padrão do sistema
	 */
	require_once(ROOT. DS .'system' . DS . '/configuration.php');
	require_once(ROOT . DS . SYSTEM . DS . 'languages/pt-br.php');
	


	/**
	 * Carrega automaticamente as classes de Modelo (MODELS)
	 * e ajundantes (HELPERS) do sistema
	 */
	 
	function __autoload( $file ){
		
		$file  = str_replace('admin', '', $file );
		
		
		if(file_exists(ROOT . DS . MODELS.$file.'.php'))
			require_once(ROOT . DS . MODELS.$file.'.php');
		
		else if(file_exists(ROOT . DS . HELPERS.$file.'.php'))
			require_once(ROOT . DS . HELPERS.$file.'.php');
		else
			die("Model ou Helper ".$file." n&atilde;o encontrado! \n\r");
		
	}

	
	
	/**
	 * Inicia o sistema
	 */
	$start = new System;
	$start->run();
	

?>
