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
 * Executa views da aplicação
 *
 */

class Controller extends System {
	public $Html;

	protected function view($nome, $vars = NULL) {
		$this->Html = new HtmlHelper;
		$this->Lang = new TranslationHelper("ptbr");
		

		//extract($info[0], EXTR_PREFIX_ALL, 'info');

		if (is_array($vars) && count($vars) > 0)
			extract($vars, EXTR_PREFIX_ALL, 'view');

		$file = ROOT. DS. VIEWS . DS . $nome . '.phtml';

		if (!file_exists($file))
			$file = ROOT. DS. SYSTEM . DS . 'views' . DS . 'Error404.phtml';

		require_once ($file);

	}
	

}