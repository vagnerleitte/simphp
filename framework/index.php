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
 * @copyright     Copyright 2013-2014, Vagner Leite http://vagnerleitte.github.io/simphp/
 * @author		  Vagner Leite (vagnerleitte@outlook.com)
 * @created 	  03-12-2012
 * @link          http://vagnerleitte.github.io/simphp/
 * @version       Sistema v 0.1
 * @package		  root
 */

/*
 * Define o caminho absoluto para o diretório inicial da aplicação.
 */
define('DIR_ROOT', getcwd());

/**
 * Define a string de deparação de diretório do servidor da aplicação
 */
define('DS', '/');

/**
 * Define o nome do diretório raiz da aplicação
 * no caso de ser diferente do diretório root da aplicação
 */
define('PATH_ROOT', DS . 'cmspref' . DS);

/**
 * Essa constante é utilzada pela function setReporting() que
 * define como os erros serão tratados na aplicação.
 * @param const DEVELOPMENT_ENVIRONMENT bool
 * TRUE exibe os erros
 * FALSE oculta os erros mas salva no log.
 */
define('DEVELOPMENT_ENVIRONMENT', true);

/*
 *  Obtém o diretório ROOT do Sistema
 */
define('ROOT', dirname(__FILE__));

/*
 *  Obtém o endereço completo do Sistema no servidor.
 * 	Ex.: http://endereco.com.br/
 */
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');

/*
 * Inclui as configurações padrão do sistema
 */
require_once (ROOT . DS . 'system' . DS . '/configuration.php');
setReporting();

/*
 * Carrega automaticamente as classes de Modelo (MODELS)
 * e ajundantes (HELPERS) do sistema
 */

function __autoload($file) {

	$file = str_replace('admin', '', $file);

	if (file_exists(ROOT . DS . MODELS . $file . '.php')) {
		require_once (ROOT . DS . MODELS . $file . '.php');
	} else if (file_exists(ROOT . DS . HELPERS . $file . '.php')) {
		require_once (ROOT . DS . HELPERS . $file . '.php');
	} else
		die("Model ou Helper " . $file . " n&atilde;o encontrado! \n\r");

}

/*
 * Inicia o sistema
 */
$start = new System;
$start -> run();
?>