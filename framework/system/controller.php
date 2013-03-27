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
 * @package		  root/system
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