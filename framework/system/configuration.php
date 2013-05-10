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
 * @package		  root/system
 */
/**
 * Armazena configurações básicas para o funcionamento do sistema.
 *
 */

function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT === true) {
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');

	} else {
		error_reporting(0);
		ini_set('display_errors', 'off');

	}
}

date_default_timezone_set('America/Sao_Paulo');

ini_set('upload_tmp_dir', DIR_ROOT . DS . 'temp' . DS . 'cache' . DS);
ini_set("log_errors", 1);
ini_set("error_log", DIR_ROOT . DS . 'temp' . DS . 'logs' . DS . 'php-error.log');

define('SYSTEM', 'system');
define('CONTROLLERS', 'app' . DS . 'controllers' . DS);
define('VIEWS', 'app' . DS . 'views' . DS);
define('MODELS', 'app' . DS . 'models' . DS);
define('HELPERS', SYSTEM . DS . 'helpers' . DS);
define('CONFIG', ROOT . DS . SYSTEM . DS . 'config');
define('PUBLIC_DIR', PATH_ROOT . 'public' . DS);

/** constantes que armazenam tags HTML para acesso rápido**/
define('pre', '<pre>');
define('endpre', '</pre>');
define('hr', '<hr/>');
define('br', '<br/>');

/** diretórios estáticos do site  **/

define('TEMPLATES', PUBLIC_DIR . 'templates' . DS);
define('IMAGES', 'images' . DS);
define('STYLESHEETS', 'css' . DS);
define('JAVASCRIPTS', 'js' . DS);

/** inlui automaticamente arquivos necessários ao funcionamento do sistema.*/
require_once (ROOT . DS . SYSTEM . DS . 'system.php');
require_once (ROOT . DS . SYSTEM . DS . 'controller.php');
require_once (ROOT . DS . SYSTEM . DS . 'model.php');

session_save_path(DIR_ROOT . DS . 'temp' . DS . 'sessions');
